<template>
  <v-expansion-panels class="main">


    <!-- ========= Dialog Disciple =================-->
    <v-dialog width="600" v-model="showEdit">
        <v-card>
            <v-card-title class="text-h5 grey lighten-2">
                Update Disciple form
            </v-card-title>

            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col
                        cols="12"
                        sm="12"
                        >
                        <v-autocomplete
                            v-model="student"
                            :items="studentlist"
                            dense
                            label="Choose Students"
                        ></v-autocomplete>
                        </v-col>

                        <v-col 
                        cols="12" 
                        sm="12">
                        <v-select
                            v-model="leavetype"
                            :items="['sick', 'have a task to do', 'sick too', 'sick three']"
                            label="Choose leave type"
                            required
                        ></v-select>
                        </v-col>
                        <v-col 
                           cols="12" 
                          sm="12"
                        >
                          <v-menu
                              v-model="menu2"
                              :close-on-content-click="false"
                              transition="scale-transition"
                              offset-y
                              max-width="290px"
                              min-width="auto"
                          >
                            <template v-slot:activator="{ on, attrs }">
                              <v-text-field
                                v-model="computedDateFormatted"
                                label="Date (read only text field)"
                                hint="MM/DD/YYYY format"
                                persistent-hint
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              v-model="date"
                              no-title
                              @input="menu2 = false"
                            ></v-date-picker>
                          </v-menu>
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
<!-- ===================Edit disciple dialog======================== -->

    <v-dialog v-model="editdialog" max-width="600px">
      <v-card class="card">
        <v-card-title color='blue' class="text-h6">
          <span>Are you sure you want to update this item?</span>
        </v-card-title>
        <v-container>
          <v-row>
            <v-col
                cols="6"
                sm="6"
            >
                <v-autocomplete
                    v-model="student_id"
                    label="Choose student"
                    rows='1'
                    prepend-icon='mdi-account'
                ></v-autocomplete>
            </v-col>

            <v-col
              cols="6"
              sm="6"
            >
                <v-autocomplete
                  v-model="dnt"
                  :items="leavelist"
                  label="Choose discipline notice type"
                  multiple
                  rows='1'
                  prepend-icon='mdi-alert-outline'
                ></v-autocomplete>
            </v-col>
        
            <v-col
              cols="12"
              sm="12"
            >
            <v-textarea
              v-model="description"
              class="mx-2"
              label="Description"
              rows="1"
              prepend-icon="mdi-comment-processing-outline"
          ></v-textarea>
          </v-col>
          </v-row>
        </v-container>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="gray darken-1" text @click="editdialog = false">Cancel</v-btn>
          <v-btn color="green darken-1" text @click="Update(id)">OK</v-btn>
        
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- ==========================End edit Dialog===================================== -->
  <!-- ===================Delete disciple dialog======================== -->

    <v-dialog v-model="dialog" max-width="500px">
      <v-card class="cardForm">
        <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="gray darken-1" text @click="dialog = false">Cancel</v-btn>
          <v-btn color="green darken-1" text @click="Remove(id)">OK</v-btn>
          
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- ==========================End Dialog===================================== -->
   
   <v-card-title>
      <v-text-field
        v-if="userRole !== 'Student' "
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    
     <form-disciple v-if="userRole == 'Admin' "></form-disciple>

    <v-expansion-panel
        v-for="disciple of disciples " :key="disciple.id"
      >
      <v-expansion-panel-header class="header">
        <div
          class="d-flex sm-6"
          style="width: 300px"
        >
            <v-img
          max-height="140"
          max-width="80"
          src="../../assets/wl.png">
        </v-img>
          <p
           class="pt-7"
          >{{disciple.dnt}}</p>
        </div>
        
        <div
          class="d-flex sm-6"
          style="width: 300px"
        >
          <v-img
          max-height="100"
          max-width="80"
          src="../../assets/sreytouch.jpeg">
        </v-img>
          <div class="username" >
            <h3 style="margin-bottom: 10px;">{{disciple.first_name}} {{disciple.last_name}}</h3>
            <p>{{disciple.Class}}</p>
          </div>
        </div>
        
        <div
          style="width: 300px"
        >
           <div class="date" style="margin-left: 58px; margin-bottom: -23px;" >
            <h4 >{{disciple.Class}}</h4>
           </div>

           <v-img
          
            max-height="50"
            max-width="50"
            src="../../assets/date.png" alt="">
          </v-img>
        
        </div>

        <div
          v-if="userRole == 'Admin' "
          style="
                 width: 100px;
                 "
        >
         <v-list-item-icon >
            <v-icon class="edit" @click ="ShowDilogEdit(disciple)">mdi-pencil-box-multiple-outline</v-icon>
        </v-list-item-icon>

        <v-list-item-icon  >
            <v-icon class="delete" @click="ShowDialog(disciple)">mdi-delete</v-icon>
        </v-list-item-icon>
        </div>
        
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        {{disciple.description}}
      </v-expansion-panel-content>

    </v-expansion-panel>
  </v-expansion-panels>
</template>
<script>
import axios from '../../axios-http.js';
import formDisciple from '../ui/formDisciple.vue';

export default {
  components: { formDisciple },
  data () {
    return {
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu1: false,
      showEdit: false,
      search: '',
      dialog:false,
      editdialog:false,
      description: '',
      class: '',
      studentlist:[],
      id:'',
      students:'',
      url: "http://127.0.0.1:8000/storage/imagestudent/",
      student_id:'',
      dnt: '',
      leavelist:['leavelist', 'Oral warning', 'Warning letter', 'Termination'],
      disciples: [
        {
          id:1,
          type:'sick',
          description:'Welcome to me'
        },
        {
          id:2,
          type:'sick',
          description:'Welcome to you'
        },
        {
          id:3,
          type:'sick',
          description:'Welcome to her'
        },
        {
          id:4,
          type:'sick',
          description:'Welcome to his'
        }
      ],
    }
  },
  computed: {
      computedDateFormatted () {
        return this.formatDate(this.date)
      },
    },

    watch: {
      date () {
        this.dateFormatted = this.formatDate(this.date)
      },
    },
  methods: {
    formatDate(date) {
        if (!date) return null

        const [year, month, day] = date.split('-')
        return `${month}/${day}/${year}`
    },
     ShowDilogEdit(disciple){
      this.id=disciple.id;
      this.description = disciple.description;
      this.dnt = disciple.type;
      console.log(disciple);
      this.editdialog = true;
    },
    Update() {
      // this.editdialog = false;
      // console.log("updated");
      let updateDic = {
        description: this.description,
      }
      axios.put('/disciples/' + this.id, updateDic).then(res => {
        this.editdialog = false;
        this.getDisciple();
        return res.data;
      })
    },
    Adddisciple(disciple){
      this.disciples.push(disciple);
    },

     Remove(id){
      axios.delete('/disciples/' + id).then(res => {
        this.getDisciple();
        this.dialog = false;
        return res.data
      })},
    getDisciple(){
      axios.get('/disciples').then(res => {
        this.disciples = res.data;
      })
    },
      ShowDialog(disciple){
      this.dialog = true;
      this.id = disciple.id;
    },
   getStudent(){
      axios.get('/students').then(res => {
        this.studentlist = res.data;
      });
    },
     
    parseDate (date) {
      if (!date) return null

      const [month, day, year] = date.split('/')
      return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
    }
  },
  
  mounted() {
    // this.getDisciple();
    this.getDisciple();
    this.getStudent();
    this.userRole = localStorage.getItem('role');
  },

  
}
</script>

<style scoped>
  .card-row{
    background:rgb(76, 231, 231);
    padding: 20px;
    margin: 50px;
    width: 90%;
    margin-left: 5%;
  }
  .username{
    padding: 10px;
    margin: 10px;
    
  }
  .v-icon {
    /* background: cornflowerblue; */
    margin-left: 170%;
    padding: 5px;
 }
.delete {
    margin-left: 10%;
    padding: 5px;
     margin-top: 11px;
 }
 .edit{
    margin-left: 100%;
    padding: 5px;
    margin-top: 11px;
 }
  img {
    width: 20px;
    height: 50px;
    padding: 40px;
  }
  .header{
    margin-right: 5%;
    /* background: rgb(245, 250, 250); */
  }
  .main{
    width: 90%;
    margin-left: 5%;
    margin-top: 5%;
  }
</style>
