<template>
  <div class="main">
    <div class="header" v-if="!isDetail">

      <v-col cols="12" sm="4" style="margin-left:-15px">
        <v-text-field
          v-if="userRole !== 'Student'"
          v-on:keyup="search"
          v-model="studentName"
          label="Search student"
          color="blue darken-1"
          single-line
          outlined
          dense
          append-icon="mdi-magnify"
        ></v-text-field>
      </v-col>

      <v-col cols="12" sm="3">
        <v-combobox
          v-if="userRole !== 'Student'"
          v-on:keyup="Selectclass"
          v-model="classes"
          :items="items"
          label="Select Class"
          class="combobox"
          outlined
          single-line
          dense
          color="blue darken-1"
        ></v-combobox>
      </v-col>

      <v-col cols="12" sm="6" style="margin-left:55px">
        <formstudent
          v-if="userRole != 'Student' && !isDetail"
          @add-user="getstudent"
        ></formstudent>
      </v-col>

    </div>

    <!-- ===================Delete disciple dialog======================== -->

    <v-dialog v-model="deleteDialog" max-width="500px">
      <v-card class="cardForm">
        <v-card-title>
          Are you sure you want to delete this student?
        </v-card-title>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="gray darken-1" text @click="deleteDialog = false"
            >Cancel</v-btn
          >
          <v-btn color="error" text @click="DeleteStudent(id)">OK</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- ==========================Student Detail===================================== -->

    <student-detail :student="studentInfo" v-if="isDetail" @back="Back" ></student-detail>

    <StudentInfo v-else-if="userRole === 'Student'" />

    <div class="userLists" v-else>
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th>First name</th>
              <th>Last name</th>
              <th>Class</th>
              <th>Batch</th>
              <th>Major</th>
              <th>Phone</th>
              <th>Gender</th>
              <th>Ngo</th>
              <th v-if="userRole !== 'Student'">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="student in studentdata" :key="student.username">
              <td @click="Studentdetail(student)">{{ student.firstName }}</td>
              <td @click="Studentdetail(student)">{{ student.lastName }}</td>
              <td @click="Studentdetail(student)">{{ student.class }}</td>
              <td @click="Studentdetail(student)">{{ student.batch }}</td>
              <td @click="Studentdetail(student)">{{ student.major }}</td>
              <td @click="Studentdetail(student)">0{{ student.phone }}</td>
              <td @click="Studentdetail(student)">{{ student.gender }}</td>
              <td @click="Studentdetail(student)">{{ student.ngo }}</td>

              <td v-if="userRole !== 'Student'">
                <v-list-item-icon>
                  <v-icon @click="addShow(student)" color="green"
                    >mdi-pencil-box-multiple-outline</v-icon
                  >
                </v-list-item-icon>

                <v-list-item-icon>
                  <v-icon @click="showDeleteStudent(student)" color="#EF5350"
                    >mdi-delete</v-icon
                  >
                </v-list-item-icon>
              </td>
            </tr>

            <tr v-if="studentdata == ''">
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td>NO RESULTS HERE!</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
            </tr>
          </tbody>
          <EditStudent
            v-if="showDialog"
            :studentData="studentInfo"
            @Cancel="Cancel"
            @Update="UpdateStudent"
          />
        </template>
      </v-simple-table>
    </div>
  </div>
</template>

<script>
import FormStudent from "../ui/FormStudent.vue";
import EditStudent from "./EditStudent.vue";
import StudentDetail from "./StudentDetail.vue";
import StudentInfo from "./StudentInfo.vue";
import axios from "../../axios-http.js";

export default {
  components: {
    formstudent: FormStudent,
    EditStudent,
    StudentDetail,
    StudentInfo,
  },
  data() {
    return {
      isDetail: false,
      dialog: false,
      showDialog: false,
      studentdata: [],
      studentInfo: "",
      studentName: "",
      userRole: "",
      deleteDialog: false,
      id: "",
      items: [
        "WEB 2021A",
        "WEB 2021B",
        "SNA 2021",
        "WEB 2022A",
        "WEB 2022B",
        "SNA 2022",
      ],
      classes: "",
      classFilter: [],
    };
  },
  methods: {
    Studentdetail(student) {
      this.isDetail = true;
      this.studentInfo = student;
      console.log("hello");
    },
    Back(back) {
      this.isDetail = back;
    },
    getstudent() {
      let studentId = localStorage.getItem("studentId");
      this.userRole = localStorage.getItem("role");

      axios.get("/students").then((res) => {
        this.classFilter = res.data;
        if (this.userRole === "Student") {
          for (let student of res.data) {
            if (student.id == studentId) {
              this.studentdata.push(student);
            }
          }
        } else {
          this.studentdata = res.data;
        }
      });
    },
    DeleteStudent(id) {
      axios.delete("/students/" + id).then((res) => {
        this.getstudent();
        return res.data;
      });
      this.deleteDialog = false;
    },
    showDeleteStudent(student) {
      this.deleteDialog = true;
      this.id = student.id;
    },
    UpdateStudent(id, student, hidden) {
      axios.put("/students/" + id, student).then((res) => {
        this.showDialog = hidden;
        this.getstudent();
        return res.data;
      });
    },
    addShow(student) {
      this.studentInfo = student;
      this.showDialog = true;
    },
    Cancel(hidden) {
      this.showDialog = hidden;
    },

    search() {
      if (this.studentName !== "") {
        axios.get("/students/search/" + this.studentName).then((res) => {
          this.studentdata = res.data;
        });
      } else {
        this.getstudent();
      }
    },
    Selectclass() {
      this.studentdata = [];
      if (this.classes !== "") {
        for (let cls of this.classFilter) {
          if (cls.class === this.classes) {
            this.studentdata.push(cls);
          }
        }
      } else {
        this.getstudent();
      }
    },
  },
  mounted() {
    this.getstudent();
  },
};
</script>

<style scoped>
th {
  background: rgb(108, 185, 226);
}
.header {
  display: flex;
  width: 80%;
  margin-left: 10%;
  margin-top: 1%;
}
.main {
  height: 88vh;
  overflow-y: scroll;
  margin-top: 1%;
}
.btn-student {
  float: right;
  margin-top: 20px;
  margin-right: -149px;
}
h2 {
  text-align: center;
  padding: 10px;
  color: #fff;
  background: rgb(108, 185, 226);
}
.userLists {
  width: 80%;
  margin-left: 10%;
  margin-bottom: 3%;
  box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px,
    rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
}
.table {
  overflow-y: scroll;
  height: 90vh;
}
.search {
  margin-right: 60.7%;
  margin-top: -2px;
}
.cardForm {
  border-top: 5px solid red;
}
tr td:hover {
  cursor: pointer;
}
.search {
  margin-top: -4px;
  margin-right: 55px;
  width: 260px;
}
.combobox {
  width: 230px;
  margin-right: 110px;
}
</style>