<template>
    <div class="containner">
      <div class="mainContent">

        <div class="student" style="">
          <img class="profile-1" src="../../assets/icon.png" alt="" > 
          <p class="paragrab">BATCH 2021</p>
        </div>
      
        <div class="student" >
          <img class="profile-1" src="../../assets/icon.png" alt=""> 
          <p class="paragrab">{{students.class}}</p>
        </div>
    
        <div class="student" >
          <img class="profile-1" src="../../assets/school.png" alt=""> 
          <p class="paragrab" style="color:green;">AT SCHOOL</p>
        </div>

      </div>
     <br>
      <v-expansion-panels class="main" >
        
        <!-- <span>Wearning letter</span> -->
        <div>
         <v-badge
          color="red"
         :content="messages"
         :value="messages"
        >
        Oral warning
        
        </v-badge>
        </div>
        <v-expansion-panel
          v-for="disciple of students.disciple" :key="disciple.firstName">
          <v-expansion-panel-header>

            <div class="d-flex">
              
              <v-col cols="12" sm="1">
                <v-img
                  max-height="100"
                  max-width="70"
                  src="../../assets/stop.png">
                </v-img>
              </v-col>
              <v-col cols="12" sm="3">
                <p>{{disciple.dnt}}</p>
              </v-col>
              
              <div class="image">
                <v-img
                  max-height="40"
                  max-width="53"
                  src="https://thumbs.dreamstime.com/b/calendar-icon-isolated-white-background-calender-symbol-vector-deadline-date-time-185768346.jpg">
                </v-img>
                <p>Jan-24-2021</p> 
              </div>

            </div>
          </v-expansion-panel-header>

          <v-expansion-panel-content>{{disciple.description}}</v-expansion-panel-content>

        </v-expansion-panel>

        <span>Permission</span>
        <v-expansion-panel
          v-for="per of students.permission" :key="per.id">
          <v-expansion-panel-header class="header-1">
            <div class="d-flex">
              <v-col cols="12" sm="2">
                <v-img
                  max-height="70"
                  max-width="70"
                  src="../../assets/medicine.png" alt="">
                </v-img>
              </v-col>
              <v-col cols="12" sm="4">
                <div class="para">
                    <h3>{{per.startDate}} / Morning</h3>
                    <h5 style="margin-left:30px;margin-top: -20px;">0.5 day</h5>
                </div> 
              </v-col>
            </div>
          </v-expansion-panel-header>

          <v-expansion-panel-content>{{per.description}}</v-expansion-panel-content>
        </v-expansion-panel>
    </v-expansion-panels>

  </div>
</template>

<script>
import axios from '../../axios-http.js';
export default {
  data(){
    return {
      messages: 0,
      disciples:[],
      students:'',
      url: "http://127.0.0.1:8000/storage/imagestudent/",
    }
  },
  methods: {
    getStudent(){
      let studentid = localStorage.getItem('studentId');
      axios.get('/students').then(res => {
        for(let student of res.data){
          if(studentid == student.id){
            this.students = student;
          }
        }
      })
    },
    getDisciple(){
      let studentId = localStorage.getItem('studentId');
      axios.get('/disciples').then(res => {
            for(let disciple of res.data){
              if(disciple.student.id == studentId ){
                if(disciple.dnt == 'Oral warning' || disciple.dnt == 'Warning letter'){
                  this.messages+=1
                  this.disciples.push(disciple);
                }
                
              }
            }
        
      })
    }
  },
  mounted() {
    this.getStudent();
    this.getDisciple();
  },
}
</script>

<style scoped>
  .containner{
    /* margin-top: 3%; */
    height: 86vh;
    /* overflow-y: scroll; */
    background: none;
  }
  .mainContent{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 80%;
    height: 25vh;
    margin-left: 10%;
    border-radius: 10px;
    /* margin-top: 1%; */
    background-color: #4397dbb0;
  }
  img {
    margin: 10px;
    width: 50px;
    height: 50px;
  }
  span{
   margin-right: 87%;
   margin: 1% 0%;
   font-weight: bold;
   text-transform: uppercase;
  }
  .image{
    display: flex;
    align-items: center;
  }
  .main{
    width: 80%;
    margin-left: 10%;
    margin-bottom: 5%;
  }
  p{
      padding:1px;
      margin:30px 10px;
  }
  
  h4{
    padding: 25px;
   
  }
  h3{
      padding: 30px;
      margin-top: -20px;
  }
  h5{
      height:1px;
      margin-right: 120px;
  }
  .updateMain{
      margin-top: -10%;
  }
  .paragrab{
    font-size: 15px;
  }
  .student{
    display: flex;
    align-items: center;
  }
</style>