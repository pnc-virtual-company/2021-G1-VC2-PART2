<template>
  <div class="containner">
    <div class="mainContent">
      <div class="student" style="">
        <img class="batch" src="../../assets/batch.png" alt="" />
        <p class="paragrab1">BATCH 2021</p>
      </div>

      <div class="student">
        <img class="classroom" src="../../assets/class.png" alt="" />
        <p class="paragrab2">{{ students.class }}</p>
      </div>

      <!-- =======================Managage Termination============== -->
      <div class="student" v-if="num3 >= 3">
        <img class="action" src="../../assets/emoji.png" alt="" />
        <p class="paragrab3" style="color: #e53935">OUT SCHOOL</p>
      </div>

      <div class="student" v-else-if="num4">
        <img class="action" src="../../assets/emoji.png" alt="" />
        <p class="paragrab3" style="color: #e53935">OUT SCHOOL</p>
      </div>

      <div class="student" v-else>
        <img class="action1" src="../../assets/school.png" alt="" />
        <p class="paragrab3" style="color: #388e3c">AT SCHOOL</p>
      </div>
    </div>
    <br />

    <v-expansion-panels class="main">
      <v-tabs dark background-color="blue" grow>
        <v-tab @click="getDisciple">
          <v-badge :value="num"> All discipline </v-badge>
        </v-tab>

        <v-tab @click="Notification">
          <v-badge color="green" :content="num1" :value="num1">
            Notification
          </v-badge>
        </v-tab>

        <!-- ================Oral warning================== -->
        <v-tab @click="Oral" v-if="num2 == 1">
          <v-badge color="green" :content="num2" :value="num2">
            Oral Warning
          </v-badge>
        </v-tab>
        <v-tab @click="Oral" v-else-if="num2 == 2">
          <v-badge color="yellow" :content="num2" :value="num2">
            Oral Warning
          </v-badge>
        </v-tab>
        <v-tab @click="Oral" v-else>
          <v-badge :content="num2" :value="num2"> Oral Warning </v-badge>
        </v-tab>

        <!-- ===================Warning letter================= -->
        <v-tab @click="Weaning" v-if="num3 == 1">
          <v-badge color="yellow" :content="num3" :value="num3">
            Warning letter
          </v-badge>
        </v-tab>
        <v-tab @click="Weaning" v-else-if="num3 == 2">
          <v-badge color="orange" :content="num3" :value="num3">
            Warning letter
          </v-badge>
        </v-tab>
        <v-tab @click="Weaning" v-else-if="num3 == 3">
          <v-badge color="red" :content="num3" :value="num3">
            Warning letter
          </v-badge>
        </v-tab>
        <v-tab @click="Weaning" v-else>
          <v-badge :content="num3" :value="num3"> Warning letter </v-badge>
        </v-tab>

        <v-tab @click="Terminated">
          <v-badge color="error" icon="mdi-lock" :value="num4">
            Termination
          </v-badge>
        </v-tab>
      </v-tabs>
      
      <h4 id="noResult" v-if="disciples == '' ">NO RESULTS HERE!</h4>

      <v-expansion-panel v-for="disciple of disciples" :key="disciple.id">
        <v-expansion-panel-header>
          <div class="d-flex">
            <v-col cols="12" sm="1">
              <v-img
                max-height="100"
                max-width="70"
                src="../../assets/stop.png"
              >
              </v-img>
            </v-col>
            <v-col cols="12" sm="3">
              <p>{{ disciple.leavetype }}</p>
            </v-col>

            <div class="image">
              <v-img
                max-height="40"
                max-width="53"
                src="https://thumbs.dreamstime.com/b/calendar-icon-isolated-white-background-calender-symbol-vector-deadline-date-time-185768346.jpg"
              >
              </v-img>
              <p>Jan-24-2021</p>
            </div>
          </div>
        </v-expansion-panel-header>

        <v-expansion-panel-content>
          <span style="font-weight:bold;margin-left:0%;font-size:17px;">The resean is : </span>  {{disciple.description}}
        </v-expansion-panel-content>
      </v-expansion-panel>

      <!-- ========================Permission=================================== -->
      <v-tabs dark background-color="orange" grow>
        <v-tab  v-if="permissions !== '' ">
          <v-badge color="green" :content="num5" :value="num5">Permission</v-badge>
        </v-tab>
      </v-tabs>
      
      <h4 id="noResult" v-if="permissions == '' ">NO RESULTS HERE!</h4>

      <v-expansion-panel v-for="per of permissions" :key="per.id">
        <v-expansion-panel-header>
          <div class="d-flex">
            <v-col cols="12" sm="2">
              <v-img
                max-height="70"
                max-width="70"
                src="../../assets/medicine.png"
                alt=""
              >
              </v-img>
            </v-col>
            <v-col cols="12" sm="6">
              <div class="para">
                <h3>From : {{ per.startDate }} to {{ per.endDate}}</h3>

                <div class="amount">
                  <h3>Amount day : </h3>
                  <h4 v-html=" Math.round(
                  (new Date(per.endDate).getTime() -
                  new Date(per.startDate).getTime()) /
                  (1000 * 3600 * 24))"></h4>
                  <h4> day</h4>
                </div>
              
              </div>
            </v-col>
          </div>
        </v-expansion-panel-header>

        <v-expansion-panel-content>
          <span style="font-weight:bold;margin-left:0%;font-size:17px;">The resean is : </span>  {{per.description}}
          </v-expansion-panel-content>
      </v-expansion-panel>
    </v-expansion-panels>
  </div>
</template>

<script>
import axios from "../../axios-http.js";
export default {
  data() {
    return {
      num: 0,
      num1: 0,
      num2: 0,
      num3: 0,
      num4: false,
      num5: 0,
      disciples: [],
      permissions:[],
      students: [],
      studentId: "",
      url: "http://127.0.0.1:8000/storage/imagestudent/",
    };
  },
  methods: {
    getStudent() {
      let studentid = localStorage.getItem("studentId");
      axios.get("/students").then((res) => {
        for (let student of res.data) {
          if (studentid == student.id) {
            this.students = student;
          }
        }
      });
    },
    getDisciple() {
      axios.get("/disciples").then((res) => {
        this.disciples = [];
        this.num1 = 0;
        this.num2 = 0;
        this.num3 = 0;

        for (let disciple of res.data) {
          if (disciple.student.id == this.studentId) {
            this.disciples.push(disciple);
            if (disciple.dnt == "Notification") {
              this.num1 += 1;
            } else if (disciple.dnt == "Oral warning") {
              this.num2 += 1;
            } else if (disciple.dnt == "Warning letter") {
              this.num3 += 1;
            } else {
              if (disciple.dnt == "Termination") {
                this.num4 = true;
              }
            }
          }
        }
      });
    },
    getPermission() {
      axios.get("/permissions").then((res) => {
        this.permissions = [];
        this.num5 = 0;
        for(let per of res.data){
          if(per.student.id == this.studentId){
            this.permissions.push(per)
            this.num5 += 1
          }
        }

      });
    },
    Notification() {
      this.disciples = [];
      for (let dis of this.students.disciple) {
        if (dis.dnt == "Notification") {
          this.disciples.push(dis);
        }
      }
    },
    Oral() {
      this.disciples = [];
      for (let dis of this.students.disciple) {
        if (dis.dnt == "Oral warning") {
          this.disciples.push(dis);
        }
      }
    },

    Terminated() {
      this.disciples = [];
      for (let dis of this.students.disciple) {
        if (dis.dnt == "Termination") {
          this.disciples.push(dis);
        }
      }
    },

    Weaning() {
      this.disciples = [];
      for (let dis of this.students.disciple) {
        if (dis.dnt == "Warning letter") {
          this.disciples.push(dis);
        }
      }
    },
  },
  mounted() {
    this.getStudent();
    this.getDisciple();
    this.getPermission();
    this.studentId = localStorage.getItem("studentId");
  
  },
};
</script>

<style scoped>
.amount{
  display: flex;
  align-items: center;
  margin-top: 3%;
}
h4{
  margin-left: 2%;
}
.mainContent {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 80%;
  height: 25vh;
  margin-left: 10%;
  border-radius: 10px;
  background-color: #0a89f1b0;
}
.batch {
  width: 55px;
  height: 55px;
}
.classroom {
  width: 60px;
  height: 60px;
}
.action {
  width: 40px;
  height: 40px;
}
.action1 {
  width: 35px;
  height: 35px;
  margin-bottom: 10px;
}

span {
  margin-right: 87%;
  margin: 1% 0%;
  font-weight: bold;
  text-transform: uppercase;
}
.image {
  display: flex;
  align-items: center;
}
.main {
  width: 80%;
  margin-left: 10%;
  margin-bottom: 5%;
}
p {
  padding: 1px;
  margin: 30px 10px;
}

.updateMain {
  margin-top: -10%;
}
.paragrab1,
.paragrab2,
.paragrab3 {
  font-size: 20px;
  font-weight: bold;
}
.paragrab1,
.paragrab2 {
  color: #fff;
}
.student {
  display: flex;
  align-items: center;
  margin-left: 5%;
}
.header-1{
  border-top: 1px solid rgba(128, 128, 128, 0.63);
}
#noResult {
  margin-top: 7%;
  text-align: center;
  color: gray;
  margin-bottom: 5%;
}
</style>