<template>
    <div class="containner">
        <div>
            <img class="profile" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT0Tieuqmvua1ZDpFM5xZ7zcbWFdN4FojKkQA&usqp=CAU"  alt="Avatar">
        </div>
        <h1>Sreytouch</h1>
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
                <p class="paragrab">WEP</p>
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
      v-for="(item,i) in 2"
      :key="i">
      <v-expansion-panel-header class="header">
        <div class="d-flex">
            <v-img
          max-height="100"
          max-width="53"
          src="data:image/png;base64,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">
        </v-img>
        <p>Warning Letter</p>
        <div class="image">
        <v-img
          max-height="40"
          max-width="53"
          src="https://thumbs.dreamstime.com/b/calendar-icon-isolated-white-background-calender-symbol-vector-deadline-date-time-185768346.jpg">
        </v-img>
        </div>
        <space>Jan-24-2021</space>
        </div>
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      </v-expansion-panel-content>
    </v-expansion-panel>
    <span>Permission</span>
    <v-expansion-panel
      v-for="(item,i) in 2"
      :key="i">
      <v-expansion-panel-header class="header-1">
        <div class="d-flex">
        <v-img
          max-height="100"
          max-width="100"
          src="../../assets/medicine.png" alt="">
        </v-img>
               <div class="para">
                   <h3>10 Jun / Morning</h3>
                   <h5 style="margin-left:30px;margin-top: -20px;">0.5 day</h5>
               </div> 
        </div>
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      </v-expansion-panel-content>
    </v-expansion-panel>
    </v-expansion-panels>
    </div>
</div>
</template>
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