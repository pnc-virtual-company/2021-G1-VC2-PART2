<template>
  <div class="main">
    <div class="text-center">
      <v-dialog v-model="dialog" width="450">
          <template v-slot:activator="{ on, attrs }">
              <v-btn color="blue lighten" dark v-bind="attrs" v-on="on">+ Create user</v-btn>
          </template>

          <v-card>
              <h3>Create new user</h3>
              <v-card-text>
                  <input type="text" placeholder="Username" v-model="username" required>
                  <input type="email" placeholder="Email" v-model="email" required>
                  <input type="password" placeholder="Password" v-model="password" required>
                  <input type="password" placeholder="Confirm password" v-model="password_confirmation" required>
                  <label for="role">Role</label>
                  <select name="role" id="role" v-model="role" required>
                      <option value="Admin">Admin</option>
                      <option value="Social Affair">Social Affair</option>
                      <option value="Student">Student</option>
                  </select>
                  <input type="file" name="profile" @change="Image" required>
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
                  <td>
                    <img :src="url + user.profile" alt="">
                  </td>
                  <td>{{ user.username }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.role }}</td>
                  
                  <td><v-list-item-icon>
                      <v-icon @click="Show(user)">mdi-pencil-box-multiple-outline</v-icon>

                  </v-list-item-icon>

                  <v-list-item-icon>
                    <!-- <Dialog /> -->
                    <v-icon @click="DeleteUser(user.id)">mdi-delete</v-icon>
                  </v-list-item-icon></td>

                  <dialog-edit v-if="displayEdit"
                    :data ="userInfo"
                    @cancel ="cancel"
                    @update ="EditUser"
                  />

                </tr>
            </tbody>
            </template>
        </v-simple-table>
      </div>

      
    </div>
</template>

<script>
import axios from '../../axios-http.js';
// import DialogRemove from './DialogRemove.vue';
import DialogEdit from './DialogEdit.vue';

export default {
  components: {
    // DialogRemove,
    DialogEdit
    },
  data() {
    return {
      userInfo: '',
      username: '',
      email: '',
      password: '',
      password_confirmation: '',
      role: '',
      image: '',
      users: [],
      dialog: false,
      showDialog: false,
      displayEdit: false,
      error: '',
      url: "http://127.0.0.1:8000/storage/imageUser/",
    };
  },
  methods: {
    Image(event){
      this.image = event.target.files[0];
    },
    Adduser(){
      let newUser = new FormData();
      newUser.append('username', this.username);
      newUser.append('email', this.email);
      newUser.append('password', this.password);
      newUser.append('password_confirmation', this.password_confirmation);
      newUser.append('role', this.role);
      newUser.append('profile', this.image);
  
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
    },
    getUsers(){
      axios.get('/users').then(res => {
        this.users = res.data;
      })
    }
  },
  mounted() {
    this.getUsers();
  },
};
</script>

<style scoped>
  .userLists{
      width: 90%;
      margin-left: 5%;
  }
  .main{
    height: 90vh;
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
    margin-left: 84%;
    width: 10%;
    margin-top: 4%;
  
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
</style>