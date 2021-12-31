<template>
  <div class="containner">
    <div class="mainContent">
      <div class="student" style="">
        <img class="profile-1" src="../../assets/icon.png" alt="" />
        <p class="paragrab">BATCH 2021</p>
      </div>

      <div class="student">
        <img class="profile-1" src="../../assets/icon.png" alt="" />
        <p class="paragrab">{{ students.class }}</p>
      </div>

      <div class="student" v-if="num2 <=2 && num4 != true">
        <img class="profile-1" src="../../assets/school.png" alt=""/>
        <p class="paragrab" style="color: green" >AT SCHOOL</p>
      </div>
      <div class="student" v-else>
        <img class="profile-1" src="../../assets/emoji.png" alt="" style="margin-left:30px"/>
        <p class="paragrab" style="color:red" >OUT SCHOOL</p>
      </div>

    </div>
    <br />
    <v-expansion-panels class="main">

      <v-tabs dark background-color="blue" grow>

        <v-tab @click="getDisciple" > 
          <v-badge :content="messages" :value="num">
            All discipline
          </v-badge>
        </v-tab>

        <v-tab>
          <v-badge color="green" :content="messages" :value="num1">
            Misconduct
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
          <v-badge :content="num2" :value="num2">
            Oral Warning
          </v-badge>
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
        <v-tab @click="Weaning" v-else >
          <v-badge>
            Warning letter
          </v-badge>
        </v-tab>


        <v-tab @click="Terminated">
          <v-badge color="error" icon="mdi-lock" :value="num4">
            Termination
          </v-badge>
        </v-tab>
      </v-tabs>

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
              <p>{{ disciple.dnt }}</p>
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

        <v-expansion-panel-content>{{
          disciple.description
        }}</v-expansion-panel-content>
      </v-expansion-panel>

      <span>Permission</span>
      <v-expansion-panel v-for="per of students.permission" :key="per.id">
        <v-expansion-panel-header class="header-1">
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
            <v-col cols="12" sm="4">
              <div class="para">
                <h3>{{ per.startDate }} / Morning</h3>
                <h5 style="margin-left: 30px; margin-top: -20px">0.5 day</h5>
              </div>
            </v-col>
          </div>
        </v-expansion-panel-header>

        <v-expansion-panel-content>{{
          per.description
        }}</v-expansion-panel-content>
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
      disciples: [],
      students: "",
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
            if (disciple.dnt == "Misconduct") {
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
    this.studentId = localStorage.getItem("studentId");
  },
};
</script>

<style scoped>
.containner {
  /* margin-top: 3%; */
  height: 86vh;
  /* overflow-y: scroll; */
  background: none;
}
.mainContent {
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

h4 {
  padding: 25px;
}
h3 {
  padding: 30px;
  margin-top: -20px;
}
h5 {
  height: 1px;
  margin-right: 120px;
}
.updateMain {
  margin-top: -10%;
}
.paragrab {
  font-size: 15px;
}
.student {
  display: flex;
  align-items: center;
}
</style>