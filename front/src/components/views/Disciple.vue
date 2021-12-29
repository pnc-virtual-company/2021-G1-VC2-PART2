<template>
  <v-expansion-panels class="main">
    <div class="headerManin">
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

<!-- ===================search============= -->
    <div class="cardheader">
      <v-card-title>
        <v-text-field
          v-if="userRole !== 'Student' "
          class="searchbtn"
          v-model="search"
          append-icon="mdi-magnify"
          label="Search"
          color="blue darken-1"
          v-on:keyup="searchBotton"
        ></v-text-field>
      </v-card-title>
      
      <form-disciple v-if="userRole == 'Admin' " @add-discipline="getDisciples"></form-disciple>
    </div>
    
<!-- ==========card=============== -->
  
    <v-expansion-panel class="formCard"
      v-for="disciple of disciples" :key="disciple.id">
      <v-expansion-panel-header class="header">
        <v-row>
          <v-col cols="12" sm="1">
            <v-img
              id="wearning"
              max-height="70"
              max-width="70"
              src="../../assets/wl.png">
            </v-img>
            
          </v-col>
          <v-col cols="12" sm="2">
            <p id="dnt">{{disciple.dnt}}</p>
          </v-col>
          
          <v-col cols="12" sm="3">
              <v-img
                max-height="120"
                max-width="90"
                :src="url + disciple.student.picture">
              </v-img>
          </v-col >

          <v-col cols="12" sm="4">
            <div class="username" >
              <div>
                <h3 style="margin-bottom: 10px;">{{ disciple.student.firstName }} {{ disciple.student.lastName }}</h3>
                </div>
                <p>{{ disciple.class }}</p>
            </div>
        
            <div style="disply:flex;" >
                <div class="date" style="margin-left: 58px; margin-bottom: -23px;" >
                    <h4 >Jan/23/2021</h4>
                </div>

                <v-img
                  max-height="50"
                  max-width="50"
                  src="../../assets/date.png" alt="">
                </v-img>
            </div>
          </v-col>

          <v-col cols="12" sm="2">
            <!-- ==============start button edit&delete============= -->
            <v-list-item-icon >
                <v-icon class="edit" @click ="ShowDilogEdit(disciple)">mdi-pencil-box-multiple-outline</v-icon>
            </v-list-item-icon>

            <v-list-item-icon  >
                <v-icon class="delete" @click="ShowDialog(disciple)">mdi-delete</v-icon>
            </v-list-item-icon>
          </v-col>
         
        </v-row>
        <!-- ===================end button edit&delete============= -->
      </v-expansion-panel-header>
      <!-- ====================start show details========== -->
      <v-expansion-panel-content>
        {{ disciple.description }} 
      </v-expansion-panel-content>

       <!-- ====================end show details=================== -->
    </v-expansion-panel>
    </div>
  </v-expansion-panels>
</template>
<script>

 import axios from '../../axios-http.js';
import formDisciple from '../ui/formDisciple.vue';

export default {
  components: { formDisciple },
  data () {
    return {
      dialog:false,
      editdialog:false,
      search: '',
      first_name: '',
      last_name: '',
      type: '',
      description: '',
      class: '',
      categoryInfo: '',
      disciples: [],
      studentlist:[],
      id:'',
      student_id:'',
      dnt: '',
      userRole: '',
      url: "http://127.0.0.1:8000/storage/imagestudent/",
      leavelist:['leavelist', 'Oral warning', 'Warning letter', 'Termination'],
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
     Remove(id){
      axios.delete('/disciples/' + id).then(res => {
        this.getDisciples();
        this.dialog = false;
        return res.data
      })
    },
    ShowDilogEdit(disciple){
      this.id=disciple.id;
      this.description = disciple.description;
      this.dnt = disciple.type;
      console.log(disciple);

      this.editdialog = true;
    },
    Update() {
      this.editdialog = false;
      let updateDic = {
        description: this.description,
      }
      axios.put('/disciples/' + this.id, updateDic).then(res => {
        this.editdialog = false;
        this.getDisciples();
        return res.data;
      })
    },
    
    getDisciples() {
      axios.get("/disciples").then(res => {
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
        console.log(res.data);
      });
    },
     searchBotton(){
            if(this.search!== ""){
                axios.get("/disciples/search/" + this.search).then(res => {
                this.disciples = res.data;
                })
            }else{
                this.getDisciples();
            }           
        }        
  },
  
  mounted() {
    this.getDisciples();
    this.getStudent();
    this.userRole = localStorage.getItem('role');
  },

  
}
</script>

<style scoped>
  .cardheader{
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
  }
  .headerManin{
    width: 80%;
  }
  .username{
    padding: 10px;
    margin: 10px; 
  }
  .v-icon {
    margin-left: 170%;
    padding: 5px;
 }
 .delete {
    margin-left: 40%;
    padding: 5px;
     margin-top: 11px;
 }
 .edit{
    margin-left: 100%;
    padding: 5px;
    margin-top: 11px;
 }
  .header{
    margin-right: 5%;
  }
  .main{
    height: 84vh;
    overflow-y: scroll;
    margin-top: 3%;
  }
  .cardForm{
    border-top: 5px solid red;
  }
  #dnt{
    margin-top: 25%;
  }
  #wearning{
    margin-top: 25%;
  }
  .searchbtn{
    margin-left: -7%;
    margin-top: -9%;
  }
</style>
