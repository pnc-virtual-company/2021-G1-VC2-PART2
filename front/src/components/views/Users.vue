<template>
  <div class="main">
    <div class="text-center">
      <v-dialog v-model="dialog" width="500">
          <template v-slot:activator="{ on, attrs }">
              <v-btn color="blue lighten" dark v-bind="attrs" v-on="on">+ Create user</v-btn>
          </template>
          <v-card>
              <h3>Create new user</h3>
              <v-card-text>
                <v-text-field
                  v-model="username"
                  :rules="nameRules"
                  :counter="20"
                  label="Username"
                  color="deep-purple accent-4"
                  required
                ></v-text-field>

                <v-text-field
                  v-model="email"
                  :rules="emailRules"
                  label="E-mail"
                  color="deep-purple accent-4"
                  required>
                  </v-text-field>
                <v-row>
                  <v-col cols="12" sm="6">
                    <v-text-field
                      v-model="password"
                      :counter="20"
                      :rules="passwordrules"
                      label="password"
                      color="deep-purple accent-4"
                      required>
                    </v-text-field>
                  </v-col>
                  <v-col cols="12" sm='6'>
                    <v-text-field
                      v-model="password_confirmation"
                      :counter="20"
                      :rules="passwordrules"
                      label="confirm password"
                      color="deep-purple accent-4"
                      required
                    ></v-text-field>
                  </v-col>
                </v-row>
                <v-col
                  cols="12"
                  sm="12"
                >
                <v-combobox
                    v-model="role"
                    :items="items"
                    label="Select role"
                    outlined
                    dense
                    color="deep-purple accent-4"
                  ></v-combobox>
                </v-col>
                <select v-if="role === 'Student' " name="" id="" v-model="studentId">
                  <option v-for="student of studentList" :key="student.id" :value= student.id>{{student.firstName}} {{student.lastName}}</option>
                </select>

                <v-file-input
                  chips
                  counter
                  show-size
                  small-chips
                  v-model="image"
                  color="deep-purple accent-4"
                  truncate-length="32"
                ></v-file-input>
                <p class="message">{{error}}</p>
              </v-card-text>

              <v-divider></v-divider>

              <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="primary" text @click="Adduser">Create</v-btn>
              </v-card-actions>
          </v-card>
      </v-dialog>
    </div>

 <!-- ===================Delete disciple dialog======================== -->

    <v-dialog v-model="deleteDialog" max-width="500px">
      <v-card class="cardForm">
        <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="gray darken-1" text @click="deleteDialog = false">Cancel</v-btn>
          <v-btn color="green darken-1" text @click="DeleteUser(id)">OK</v-btn>
          
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- ==========================End Dialog=================================== -->

    <div class="userLists">
        <h2>List of users</h2>
        <v-simple-table>
            <template v-slot:default>
            <thead>
                <tr>
                    <th class="text-left">Profile</th>
                    <th class="text-left">Username</th>
                    <th class="text-left">Email</th>
                    <th class="text-left">Role</th>
                    <th class="text-left">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user of users" :key="user.username">
                  <td v-if="user.role === 'Admin' ">
                    <img src="../../assets/icon.png" alt="">
                  </td>
                  <td v-else>
                    <img :src="url + user.profile" alt="">
                  </td>
                  <td>{{ user.username }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.role }}</td>
                  <td><v-list-item-icon>
                      <v-icon @click="Show(user)" color='green'>mdi-pencil-box-multiple-outline</v-icon>
                  </v-list-item-icon>

                  <v-list-item-icon>
                    <v-icon @click="showDeleteUser(user)">mdi-delete</v-icon>
                  </v-list-item-icon></td>
                </tr>
            </tbody>
            </template>
        </v-simple-table>
      </div>

       <dialog-edit v-if="displayEdit"
          :data ="userInfo"
          @cancel ="cancel"
          @update ="EditUser"
        />
    </div>
</template>

<script>
import axios from '../../axios-http.js';
import DialogEdit from './DialogEdit.vue';

export default {
  components: {
    DialogEdit
    },
  data() {
    return {
      studentList: '',
      userInfo: '',
      password: '',
      password_confirmation: '',
      image: '',
      studentId: '',
      users: [],
      dialog: false,
      deleteDialog: false,
      showDialog: false,
      displayEdit: false,
      error: '',
      url: "http://127.0.0.1:8000/storage/imageUser/",
      role: '',
      items: [
        'Admin',
        'Student',
        'Social Affiar',
      ],
      id:'',

      valid: false,
      username: '',
      nameRules: [
        v => !!v || 'Username is required',
        v => v.length <= 20 || 'Username must be less than 20 characters',
      ],
      email: '',
      emailRules: [
        v => !!v || 'E-mail is required',
        v => /.+@.+/.test(v) || 'E-mail must be valid',
      ],

      passwordrules: [
        v => !!v || 'Password is required',
        v => v.length >= 8 || 'Password is must be equal or more than 8 characters',
        v => v.length <= 20 || 'Password is to long',
      ]

    };
  },
  methods: {
  
    Adduser(){
      console.log(this.image);
      let newUser = new FormData();
      newUser.append('username', this.username);
      newUser.append('email', this.email);
      newUser.append('password', this.password);
      newUser.append('password_confirmation', this.password_confirmation);
      newUser.append('role', this.role);
      newUser.append('profile', this.image);
      newUser.append('student_id', this.studentId);

      console.log(this.studentId);
      axios.post('/signup', newUser).then(res => {
        console.log(res.data);
        this.dialog = false;
        this.getUsers();
      })
      .catch(error => {
        this.error = "User is not found , please try again!";
        return error;
      })
      
    },
    EditUser(id,userupdated,display) {
      axios.put('/users/' + id , userupdated).then(res => {
        console.log(res.data);
        this.displayEdit = display;
        this.getUsers();
      })
    
    },
    Show(user){
      this.userInfo = user;
      this.displayEdit = true;
      this.showDialog = true;
    },
    cancel() {
        this.displayEdit = false;
    },

    DeleteUser(id) {
      axios.delete('/users/' + id).then(res => {
        console.log(res.data);
        this.getUsers();
      })
      this.deleteDialog = false
    },
    showDeleteUser(user){
      this.deleteDialog = true
      this.id = user.id

    },
    
    getUsers(){
      axios.get('/users').then(res => {
        this.users = res.data;
      })
    },
    getStudent(){
      axios.get('/students').then(res => {
        console.log(res.data)
        this.studentList = res.data
      })
    }
  },
  mounted() {
    this.getUsers();
    this.getStudent();
  },
};
</script>

<style scoped>
  .userLists{
      width: 80%;
      margin-left: 10%;
  }
  .main{
    height: 84vh;
    margin-top: 3%;
    overflow-y: scroll;
  }

  h2{
    margin-top: 2%;
    text-align: center;
    padding: 10px;
    color: #fff;
    background: rgb(108, 185, 226);
  }
  h3{
    text-align: center;
    padding: 10px;
    color: #fff;
    background: rgb(108, 185, 226);
  }
  input[type=text],
  input[type=email],
  input[type=password]
  {
      width: 100%;
      margin-top: 3%;
      padding: 5px;
      outline: none;
        border: 1px solid rgb(194, 193, 193);
      border-radius: 5px;
  }
  select{
      width: 100%;
      margin-top: 2%;
      padding: 5px;
      outline: none;
      border: 1px solid rgb(194, 193, 193);
      border-radius: 5px;
  }
  input[type=password]{
      margin-bottom: 2%;
  }
  input[type=file]{
      width: 100%;
      margin-top: 3%;
      padding: 5px 0;
      outline: none;
  }
  .text-center{
    margin-left: 69%;
  }
  
  img{
    width: 70px;
    height: 70px;
    border-radius: 360px;
    margin-top: 5px;
    padding: 5px;
  }
  .message{
    color: red;
  }

  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

  :root {
    --main-color: #750579;
    --main-color-light: #e21ee9;
  }

  * {
    box-sizing: border-box;
  }

  html {
    font-family: 'Roboto', sans-serif;
  }

  body {
    margin: 0;
  }

  .right-main-button {
    float: right;
    margin-right: 2rem;
  }
  .cardForm{
    border-top: 5px solid red;
    
  }
</style>