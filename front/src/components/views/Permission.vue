<template>
  <div class="card">

  <!-- ================Edete permission dialog================== -->
  <v-dialog width="600" v-model="showEdit">
    <v-card>
      <v-card-title class="text-h5 grey lighten-2">
        Update permission form
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-row>
        
            <v-col cols="12" sm="6">
                <label for="student">Choose student:</label>
                <select name="studentid" id="" v-model="studentId">
                  <option v-for="student of studentlist" :key="student.id" :value= student.id>{{student.firstName}} {{student.lastName}}</option>
                </select>
              </v-col>

            <v-col cols="12" sm="6">
              <v-autocomplete
                v-model="teacher"
                :items="teacherlist"
                dense
                label="Choose Teacher"
              ></v-autocomplete>
            </v-col>

            <v-col cols="6" sm="12">
              <v-select
                v-model="leaveType"
                :items="['sick', 'have a task to do', 'sick too', 'sick three']"
                label="Choose leave type"
                required
              ></v-select>
            </v-col>

            <v-col cols="6" sm="12">
              <label for="startDate">Start date: </label>
              <input type="date" name="date" v-model="startDate">
              <label for="endDate" style="margin-left:15%">End date: </label>
              <input type="date" name="date" v-model="endDate">
            </v-col>

             <v-col
              cols="12"
              sm="12"
            >
              <v-text-field
                label="Description"
                hint="input your description"
                v-model="description"
                required
              ></v-text-field>
            </v-col>

          </v-row>
        </v-container>
      </v-card-text>

      <v-divider></v-divider>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn text @click="showEdit = false">Discard</v-btn>
        <v-btn color="success" text @click="Update">Save change</v-btn>

      </v-card-actions>
    </v-card>
  </v-dialog>

  <!-- ================Delete dialog================== -->
  <v-dialog width="500" v-model="dialog">
    <v-card id="dialog_remove">
      <v-card-title class="text-h5 grey lighten-2">
        Do you want to delete this Permission?
      </v-card-title>
      <v-card-text>
        Are you sur to remove this permission ?
      </v-card-text>
      <v-divider></v-divider>

      <v-card-actions>

        <v-spacer></v-spacer>
        <v-btn text @click="dialog = false">Discard</v-btn>
        <v-btn color="success" text @click="Remove(id)">I accept</v-btn>

      </v-card-actions>
    </v-card>
  </v-dialog>


  <form-permission
    v-if="userRole !== 'Student' "
    @add-per="Addpermission"
   ></form-permission>

  <!-- ==========search button=============== -->
   <v-text-field
        v-if="userRole !== 'Student' "
        v-on:keyup="Search"
        v-model="search"
        append-icon="mdi-magnify"
        label="Search permission"
        class="search"
        color="blue darken-1"
        single-line
      ></v-text-field>
    <!-- ==========card======================== -->
    
  <v-expansion-panels class="main">
    <v-expansion-panel
      v-for="per of permissions"
      :key="per.id">
      <v-expansion-panel-header class="header">
        <v-row>
          <v-col cols="12" sm="1">
            <v-img class="image1"
              lazy-src="https://picsum.photos/id/11/10/6"
              max-height="150"
              max-width="50"
              src="https://icons-for-free.com/iconfiles/png/512/doctors+health+hospital+medical+medicine+icon-1320184696812504400.png"></v-img>
          </v-col>

          <v-col cols='12' sm='4'>
            <span>{{per.startDate}} / Morning</span>
            <p id="endDate">{{per.endDate}} day</p>
          </v-col>
          <v-col cols='12' sm='2'>
            <v-img class="image2"
              lazy-src="https://picsum.photos/id/11/10/6"
              max-height="100"
              max-width="100"
              :src="url + per.student.picture"
            ></v-img>
          </v-col>

          <v-col cols='12' sm='2'>
            <h3 id="name">{{per.student.firstName}} {{per.student.lastName}}</h3>
            <br>
            <p>{{per.student.class}}</p>
            <p>{{per.teacher}}</p>
          </v-col>

        </v-row>
      </v-expansion-panel-header>
      <!-- ======space================== -->
      <v-expansion-panel-content class="description">
          {{per.description}}
      </v-expansion-panel-content>
  
      <div v-if="userRole !== 'Student' " class="btn" align="center">
        <v-icon @click="ShowEditDialog(per)" left color='green'>mdi-pencil-box-multiple-outline</v-icon>
        <v-icon @click="ShowDialog(per)" tile color="#EF5350" right>mdi-delete </v-icon>
      </div>
    </v-expansion-panel>
  </v-expansion-panels>
</div>
 
</template>

<script>
import formPermission from '../ui/formPermission.vue';
import axios from '../../axios-http.js';
export default {
  components: { formPermission },
  
  data(){
    return{
      dialog: false,
      showEdit: false,
      userRole: '',
      id: '',
      search: '',
      studentId: '',
      permissions: [],
      studentlist:[],
      teacherlist:['Sim', 'Vandy', 'Davy', 'Thaina', 'Phuty', 'Somkhan'],
      url: "http://127.0.0.1:8000/storage/imagestudent/",
      
      firstName: '',
      lastName: '',
      teacher:'',
      leaveType:'',
      startDate: '',
      endDate: '',
      description: '',
    }
    
  },
  methods: {
    Addpermission(per){
      axios.post('/permissions', per).then(res => {
        this.getPermission();
        return res.data;
      })
    },
    Remove(id){
      this.dialog = false;
      axios.delete('/permissions/' + id).then(res => {
        this.getPermission();
        return res.data
      })
    },
    Update(){
      let updatePer = {
        student_id: this.studentId,
        teacher: this.teacher,
        leaveType: this.leaveType,
        startDate: this.startDate,
        endDate: this.endDate,
        description: this.description,
      }
      axios.put('/permissions/' + this.id, updatePer).then(res => {
        this.showEdit = false;
        this.getPermission();
        return res.data;
      })
     
    },

    ShowEditDialog(per){
      this.id = per.id;
      this.studentId = per.student.id;
      this.teacher = per.teacher;
      this.leaveType = per.leaveType;
      this.startDate = per.startDate;
      this.endDate = per.endDate;
      this.description = per.description;
  
      this.showEdit = true;
    },
    ShowDialog(per){
      this.dialog = true;
      this.id = per.id;
    },
    getStudent(){
      axios.get('/students').then(res => {
        this.studentlist = res.data;
        
      });
    },
    getPermission(){
      let studentId = localStorage.getItem('studentId');
      axios.get('/permissions').then(res => {
        if(this.userRole === "Student"){
            for(let permission of res.data){
              if(permission.student.id == studentId ){
                this.permissions.push(permission)
              }
            }

          }else{
              this.permissions = res.data;
            }
      })
    },

    Search(){
      if(this.search !== "") {
        this.permissions = this.permissions.filter(
          (per) => (per.student.firstName.toLowerCase().includes(this.search.toLowerCase()) ||
          (per.student.lastName.toLowerCase().includes(this.search.toLowerCase()))))
          console.log(this.permissions);
      }else{
        this.getPermission();
      }
    },

  },

  mounted() {
    this.getStudent();
    this.getPermission();
    this.userRole = localStorage.getItem('role');
  },

}
</script>

<style scoped>
  .card-row{
    padding: 20px;
    margin: 50px;
    width: 80%;
    margin-left: 5%;
  }
  .header{
    margin-right: 5%;
  }
  .main{
    width: 80%;
    margin-left: 10%;
    margin-bottom: 5%;
  
  }
  .btn{
    display: flex;
    justify-content: flex-end;
    align-items: flex-start;
    margin-right: 2%;
    margin-bottom: 10px;
  }
  .card{
    margin-top: 3%;
    height: 84vh;
    overflow-y: scroll;
  }
  #name{
    margin-top: 6%;
  }
  span{
    display: flex;
    justify-content: center;
    margin-top: 6%;
    margin-bottom: 3%;
  }
  .search{
    width: 20%;
    margin-left: 10%;
    margin-top: 12px;
    margin-bottom: 2%;
    height: 10vh;
  }
  input[type=date]{
    outline: none;
  }
  #dialog_remove{
    border-top: 7px solid red;
  }
  .image2{
    margin-bottom: -30px;
    margin-top: 5%;
  }
  .image1{
    margin-top: 50%;
  }
  .description{
    margin-top: 3%;
  }
  select{
    width: 50%;
    outline: none;
    border: none;
    border-bottom: 1px solid gray;
    margin-top: 9px;
    margin-left: 9%;
  }
  #endDate{
    text-align: center;
  }

</style>
