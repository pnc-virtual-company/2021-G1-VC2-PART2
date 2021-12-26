<template>
  <div class="main">
    <formstudent
        @add-user="getstudent"
    />

  <div class="userLists">
   
      <v-simple-table>
        <template v-slot:top>
          
          <v-text-field class="mx-4 search"
            v-on:keyup="search"
            v-model="studentName"
            label="Search student"
          ></v-text-field>

        </template>
      
          <template v-slot:default>
          <thead>
              <tr>
                  <th class="text-left">First name</th>
                  <th class="text-left">Last name</th>
                  <th class="text-left">Class</th>
                  <th class="text-left">Phone</th>
                  <th class="text-left">Gender</th>
                  <th class="text-left">Ngo</th>
                  <th class="text-left">Action</th>
              </tr>
          </thead>
          <tbody>
              <tr v-for="student in studentdata" :key="student.username">
                  <td>{{ student.firstName }}</td>
                  <td>{{ student.lastName }}</td>
                  <td>{{ student.class }}</td>
                  <td>0{{ student.phone }}</td>
                  <td>{{ student.gender }}</td>
                  <td>{{ student.ngo }}</td>
                  
                  <td><v-list-item-icon>
                      <v-icon @click="addShow(student)">mdi-pencil-box-multiple-outline</v-icon>
                  </v-list-item-icon>

                  <v-list-item-icon>
                      <v-icon @click="DeleteStudent(student.id)">mdi-delete</v-icon>
                  </v-list-item-icon></td>

                  <EditStudent v-if="showDialog"
                    :studentData = "studentInfo"
                    @Cancel = "Cancel" 
                    @Update = "UpdateStudent" 
                  />

              </tr>
          </tbody>


          </template>
      </v-simple-table>
  </div>
  </div>
</template>

<script>
  import FormStudent from '../ui/FormStudent.vue';
  import EditStudent from './EditStudent.vue';
  import axios from '../../axios-http.js';
 
  export default {
    components: {'formstudent': FormStudent, EditStudent},
    data () {
      return {
        dialog: false,
        showDialog: false,
        studentdata:[],
        studentInfo: '',
        studentName: '',
      }
    },
   
    methods: {
      // let userName = localStorage.getItem('username');
      getstudent(student){
        console.log(student);
        axios.get('/students').then(res => {
          
          this.studentdata = res.data;
          console.log(this.studentdata);
        })
      },
      DeleteStudent(id){
        axios.delete('/students/' + id).then(res => {
          console.log(res.data);
          this.getstudent();
        })
      },
      UpdateStudent(id,student,hidden){
          axios.put('/students/' + id , student).then(res => {
            console.log(res.data);
            this.showDialog = hidden;
            this.getstudent();
          })
      },
      addShow(student){
        this.studentInfo = student;
        this.showDialog = true;
      },
      Cancel(hidden){
        this.showDialog = hidden;
      },
      search(){
        if(this.studentName !== ""){
          axios.get('/students/search/' + this.studentName).then(res => {
            this.studentdata = res.data;
          })
        }else{
          this.getstudent();
        }
      }

    },
    mounted() {
      this.getstudent()
    }
  }
</script>

<style scoped>
  .btn-student {
      float: right;
      margin-top: 20px;
      margin-right: -149px;
  }
  h2{
      text-align: center;
      padding: 10px;
      color: #fff;
      background: rgb(108, 185, 226);
  }
  
  input[type=text] {
      width: 50%;
      margin-top: 3%;
      padding: 3px;
      padding-left: 10px;
      outline: none;
      border: 1px solid rgb(194, 193, 193);
      border-radius: 5px;
  }
  input[type=number]
  {
      width: 100%;
      margin-top: 3%;
      padding: 3px;
      padding-left: 10px;
      outline: none;
        border: 1px solid rgb(194, 193, 193);
      border-radius: 5px;
  }
  select{
      width: 100%;
      margin-top: 2%;
      padding: 3px;
      padding-left: 10px;
      outline: none;
      border: 1px solid rgb(194, 193, 193);
      border-radius: 5px;
  }
  input[type=radio]{
      margin-left: 10px;
      margin-top: 3%;
  }
  input[type=file]{
      width: 100%;
      margin-top: 3%;
      padding: 5px 0;
      outline: none;
  }
  .userLists{
    width: 80%;
    margin-left: 10%;
    margin-top: 2%;
  }
  .table{
    overflow-y: scroll;
    height: 90vh;
  }
  .search{
    width: 30%;
    margin-left: 1%;
  }
</style>