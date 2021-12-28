<template>
    <div class="containner">
        <div>
            <img class="profile" :src="url + students.picture">
        </div>
        <h1>{{students.firstName}} {{students.lastName}}</h1>
        <br>
        <div class="col" >
            <div class="row" >
            <div class="column">  
              <div class="cl" style="">
                <img class="profile-1" src="../../assets/icon.png" alt="" style=" margin-left: 50px; "> 
              </div> 
              <div class="cl">
                <p class="paragrab">BATCH 2021</p>
              </div>
            </div>
             <div class="column">  
              <div class="cl" style="">
                <img class="profile-1" src="../../assets/icon.png" alt="" style=" margin-left: 48px;"> 
              </div> 
              <div class="cl">
                <p class="paragrab">{{students.class}}</p>
              </div>
            </div>
             <div class="column">  
                <div class="cl" style="">
                <img class="profile-1" src="../../assets/school.png" alt="" style=" margin-left: 36px; width:70%;"> 
              </div>
              <div class="cl">
                <p class="paragrab" style="font-size: 10px;color:green;">AT SCHOOL</p>
              </div>
            </div>
          </div>
      </div>
        <div class="updateMain">
        <v-expansion-panels class="main">
        <span>Wearning letter</span>

    <v-expansion-panel
      v-for="disciple of students.disciple" :key="disciple.firstName">
      <v-expansion-panel-header class="header">
        <div class="d-flex">
          <v-img
            max-height="100"
            max-width="70"
            src="../../assets/stop.png">
          </v-img>
          <p>{{disciple.dnt}}</p>
          <div class="image">
            <v-img
              max-height="40"
              max-width="53"
              src="https://thumbs.dreamstime.com/b/calendar-icon-isolated-white-background-calender-symbol-vector-deadline-date-time-185768346.jpg">
            </v-img>
          </div>

          <p>Jan-24-2021</p>

        </div>
      
      </v-expansion-panel-header>

      <v-expansion-panel-content>{{disciple.description}}</v-expansion-panel-content>

    </v-expansion-panel>

    <span>Permission</span>

    <v-expansion-panel
      v-for="per of students.permission" :key="per.id">
      <v-expansion-panel-header class="header-1">
        <div class="d-flex">
        <v-img
          max-height="100"
          max-width="100"
          src="../../assets/medicine.png" alt="">
        </v-img>
               <div class="para">
                   <h3>{{per.startDate}} / Morning</h3>
                   <h5 style="margin-left:30px;margin-top: -20px;">0.5 day</h5>
               </div> 
        </div>
      </v-expansion-panel-header>

      <v-expansion-panel-content>{{per.description}}</v-expansion-panel-content>

    </v-expansion-panel>

    </v-expansion-panels>
    </div>
</div>
</template>

<script>
import axios from '../../axios-http.js';
export default {
  data(){
    return {
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
            console.log(this.students);
          }
         
        }
       
      })
    }
  },
  mounted() {
    this.getStudent();
  },
}
</script>

<style scoped>
  img {
    margin: 10px;
    width: 50px;
    height: 50px;
  }
  span{
    /* border-bottom: 1px solid gray; */
    padding: 5px;
    margin-right: 85%;
  }
  .header{
    margin-right: 7%;
    margin: 0px 0px;
    height: 70px;
    padding: 10px;
  }
  .header-1{
    margin-left: 20px; 
    margin: 0px 0px; 
    height: 70px;
    padding: 10px;
  }
  .main{
    width: 67%;
    margin-left: 20%;
    margin-top: 10%;
    
  }
  p{
      padding:1px;
      margin:30px 10px;
  }
  .image{
      margin: 10px;
      margin-top: 15px;
      max-width: 100px;

  }
  space{
      margin-top: 30px;
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
  .profile{
      margin-left: 20%;
      width:80px;
      height:80px; 
      border-radius:360px;
      margin-top: 1%;
  }
  .updateMain{
      margin-top: -10%;
  }
  h1{
    margin-left: 27%;
    margin-top: -8%;
    color:rgb(100, 96, 96);
    font-size: 22px;
  }
  .profile-1{
    margin-left:28%;
    margin-top: -1%;
    width: 50%;
    height: 20%;
    
  }
  .column {
  float: left;
  width: 33.33%;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}
.col{
  width:38%;
  margin-left:25% ;;
 
}
.paragrab{
  font-size: 10px;
  margin-top: 15%;
 
}
  .cl {
  float: left;
  width: 50%;
  
}

</style>