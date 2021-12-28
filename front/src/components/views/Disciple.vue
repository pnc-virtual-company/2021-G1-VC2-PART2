<template>
  <v-expansion-panels class="main" id="card">

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
   <v-card-title>
        <v-text-field
        v-if="userRole !== 'Student' "
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
        class="mx-4"
        v-on:keyup="searchBotton"
      ></v-text-field>
    </v-card-title>
    
     <form-disciple
       v-if="userRole !== 'Student' "
     ></form-disciple>
<!-- ==========card=============== -->
  
    <v-expansion-panel class="formCard"
      v-for="disciple of disciples" :key="disciple.id">
      <v-expansion-panel-header class="header">
        <v-img
          max-height="200"
          max-width="100"
          src="../../assets/wl.png">
        </v-img>
        <p>Wearning Letter</p>
        <v-img
         
          max-height="120"
          max-width="90"
          src="../../assets/sreytouch.jpeg">
        </v-img>
        <div class="username" >
          <div>
          <h3 style="margin-bottom: 10px;">{{ disciple.first_name }} {{ disciple.last_name }}</h3>
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
        <!-- ==============start button edit&delete============= -->
        <v-list-item-icon >
            <v-icon class="edit" @click ="ShowDilogEdit(disciple)">mdi-pencil-box-multiple-outline</v-icon>
        </v-list-item-icon>

        <v-list-item-icon  >
            <v-icon class="delete" @click="ShowDialog(disciple)">mdi-delete</v-icon>
        </v-list-item-icon>

        
        <!-- ===================end button edit&delete============= -->
      </v-expansion-panel-header>
      <!-- ====================start show details========== -->
      <v-expansion-panel-content>
        {{ disciple.description }} 
        </v-expansion-panel-content>
       <!-- ====================end show details=================== -->
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
      userRole:'',
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
      // this.editdialog = false;
      // console.log("updated");
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
    // getStudent(){
    //   axios.get('/students').then(res => {
    //     this.studentlist = res.data;
    //   });
    // },
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
  img {
    width: 20px;
    height: 50px;
    padding: 40px;
  }
  .header{
    margin-right: 5%;
    /* / background: rgb(245, 250, 250); / */
  }
  .main{
    width: 90%;
    margin-left: 5%;
    margin-top: 5%;
  }
  .main{
    width: 90%;
    margin-left: 5%;
    margin-top: 5%;
 
  }
  #card{
    
    margin-top: 5%;
    width: 80%;
    margin-left: 10%;
  }
  .card{
    padding: 15px;
    border-top: 7px solid rgba(155, 184, 201, 0.733);
  }
.cardForm{
  border-top: 5px solid red;
}
</style>
