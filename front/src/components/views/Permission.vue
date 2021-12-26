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
            <v-col
              cols="12"
              sm="6"
              md="6"
            >
              <v-text-field
                label="first name"
                hint="input your firstname"
                v-model="firstname"
                required
              ></v-text-field>
            </v-col>
            <v-col
              cols="12"
              sm="6"
              md="6"
            >
              <v-text-field
                label="last name"
                hint="input your lastname"
                v-model="lastName"
                required
              ></v-text-field>
            </v-col>
            <v-col
              cols="12"
              sm="6"
            >
              <v-autocomplete
                v-model="student"
                :items="studentlist"
                dense
                label="Choose Students"
              ></v-autocomplete>
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
                v-model="leavetype"
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
        <v-btn color="success" text @click="Update(id)">Save change</v-btn>

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
    @add-per="Addpermission"
   ></form-permission>

  <!-- ==========search button=============== -->
   <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Filter"
        single-line
        hide-details
        class="search"
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
            <p>{{per.endDate}} day</p>
          </v-col>
          <v-col cols='12' sm='2'>
            <v-img class="image2"
              lazy-src="https://picsum.photos/id/11/10/6"
              max-height="100"
              max-width="100"
              src="https://i.pinimg.com/originals/3a/74/5d/3a745d3dcba72feb73e44e399ec97bea.jpg"
            ></v-img>
          </v-col>

          <v-col cols='12' sm='2'>
            <h3 id="name">{{per.firstName}} {{per.lastName}}</h3>
            <br>
            <p>{{per.class}}</p>
          </v-col>

        </v-row>
      </v-expansion-panel-header>
      <!-- ======space================== -->
      <v-expansion-panel-content class="description">
          {{per.description}}
      </v-expansion-panel-content>
  
      <div class="btn" align="center">
        <v-icon @click="ShowEditDialog(per)" left>mdi-pencil</v-icon>
        <v-icon @click="ShowDialog(per)" tile color="#EF5350" right>mdi-delete </v-icon>
      </div>
    </v-expansion-panel>
  </v-expansion-panels>
</div>
 
</template>

<script>
import formPermission from '../ui/formPermission.vue';
export default {
  components: { formPermission },
  
  data(){
    return{
      dialog: false,
      showEdit: false,
      permission: '',
      id: '',
      search: '',
      permissions: [
        {
          id: 1,
          firstName: 'Student A',
          lastName: 'A', 
          student: 'test',
          teacher: 'hello',
          leavetype: 'Oral warning',
          class: 'Web2021-A',
          startDate: 'Mon-21-12-2021',
          endDate: 'Tus-30-12-2021',
          description: "Lorem ipsum dolor sit amet, consectetur adipiscing"
        },
        {
          id: 2,
          firstName: 'Student B',
          lastName: 'B', 
          student: 'test',
          teacher: 'hello',
          leavetype: 'Warning letter',
          class: 'Web2021-A',
          startDate: 'Mon-21-12-2021',
          endDate: 'Tus-30-12-2021',
          description: "Lorem ipsum dolor sit amet, consectetur adipiscing"
        },
        
      ],
      dates: [],
      studentlist:['chanthy', 'chanthea', 'sreytouch', 'srey vun'],
      teacherlist:['Sim', 'Vandy', 'Davy', 'Thaina', 'Phuty', 'Somkhan'],
      
      firstname: '',
      lastName: '',
      student:'test',
      teacher:'hello',
      leavetype:'Warning letter',
      startDate: '',
      endDate: '',
      description: '',
    }
    
  },
  methods: {
    Addpermission(per){
      this.permissions.push(per);
    },
    Remove(id){
      this.dialog = false;
      console.log(id + " Deleted");
    },
    Update(){
      this.showEdit = false;
      console.log('Save change');
    },

    ShowEditDialog(per){
      this.firstname = per.firstName;
      this.lastName = per.lastName;
      this.student = per.student;
      this.teacher = per.teacher;
      this.leavetype = per.leavetype;
      this.startDate = per.startDate;
      this.endDate = per.endDate;
      this.description = per.description;
      console.log(per);
      this.showEdit = true;
    },
    ShowDialog(per){
      this.dialog = true;
      this.id = per.id;
    }
  },

}
</script>

<style scoped>
  .card-row{
    padding: 20px;
    margin: 50px;
    width: 90%;
    margin-left: 5%;
  }
  .header{
    margin-right: 5%;
  }
  .main{
    width: 90%;
    margin-left: 5%;
    margin-top: 3%;
  }
  .btn{
    display: flex;
    justify-content: flex-end;
    align-items: flex-start;
    margin-right: 2%;
    margin-bottom: 10px;
  }
  .card{
    margin-top: 2%;
    width: 90%;
    margin-left: 5%;
    margin-bottom: 10%;
  }
  #name{
    margin-left: 22%;
    margin-top: 6%;
  }
  span{
    display: flex;
    justify-content: center;
    margin-top: 6%;
    margin-bottom: 3%;
  }
  p{
    text-align: center;
  }
  .search{
    width: 40%;
    margin-left: 5%;
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
  
</style>