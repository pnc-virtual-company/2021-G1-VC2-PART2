<template>
  <div class="card">
    <!-- ================Edit permission dialog================== -->
    <v-dialog width="600" v-model="showEdit">
      <v-card>
        <v-card-title class="para2">
          <h3>Update permission</h3>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="6" sm="6">
                <v-combobox
                  prepend-inner-icon="mdi-account-box-multiple"
                  v-model="studentId"
                  :items="studentlist"
                  label="Choose student"
                  item-text="firstName"
                  item-value="id"
                  color="cyan"
                ></v-combobox>
              </v-col>

              <v-col cols="6" sm="6">
                <v-combobox
                  prepend-inner-icon="mdi-account-tie"
                  label="Choose Teacher"
                  v-model="teacher"
                  :items="teacherlist"
                  color="cyan"
                ></v-combobox>
              </v-col>
            </v-row>

            <v-row class="date">
              <v-col cols="12" lg="6">
                <label for="startDate">Start date: </label>
                <input type="date" name="date" v-model="startDate" />
              </v-col>
              <v-col cols="12" lg="6">
                <label for="endDate">End date: </label>
                <input type="date" name="date" v-model="endDate" />
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="6" sm="6">
                <v-combobox
                  prepend-inner-icon="mdi-card-account-details-outline"
                  v-model="leaveType"
                  :items="['Authorize', 'Unauthorize']"
                  label="Choose leave type"
                  required
                  color="cyan"
                  dense
                ></v-combobox>
              </v-col>

              <v-col cols="12" sm="6">
                <v-text-field
                  prepend-inner-icon="mdi-message-reply-text"
                  label="Description"
                  hint="Input your description"
                  v-model="description"
                  required
                  color="cyan"
                  dense
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>

        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="showEdit = false">Discard</v-btn>
          <v-btn
            v-if="
              studentId === '' ||
              teacher === '' ||
              description === '' ||
              leavetype === '' ||
              startDate === '' ||
              endDate === ''
            "
            color="success"
            text
            @click="Update"
            disabled
            >Save change</v-btn
          >
          <v-btn v-else color="success" text @click="Update">Save change</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- ================Delete dialog================== -->
    <v-dialog width="500" v-model="dialog">
      <v-card id="dialog_remove">
        <v-card-title class="text-h5 grey lighten-2">
          Do you want to delete this Permission?
        </v-card-title>
        <v-card-text> Are you sur to remove this permission ? </v-card-text>
        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn text @click="dialog = false">Discard</v-btn>
          <v-btn color="success" text @click="Remove(id)">I accept</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- ==========search button=============== -->
    <div class="title" v-if="userRole !== 'Student'">
      <v-col cols="12" sm="4" style="margin-left:-14px">
        <v-text-field
          v-on:keyup="Search"
          v-model="search"
          append-icon="mdi-magnify"
          label="Search permission"
          color="blue darken-1"
          single-line
          outlined
          dense
        ></v-text-field>
      </v-col>

      <v-col cols="12" sm="3">
        <v-combobox
          class="select-class"
          v-on:keyup="selectClass"
          v-model="classes"
          :items="items"
          label="Select Class"
          outlined
          single-line
          dense
          color="deep-purple accent-4"
        ></v-combobox>
      </v-col>

      <v-col cols="12" sm='6' style="margin-left: 5px">
        <form-permission
          @add-per="Addpermission"
        ></form-permission>
      </v-col>

    </div>

    <!-- ==========card======================== -->

    <v-expansion-panels class="main">
      <v-expansion-panel v-for="per of permissionInfo" :key="per.id">
        <v-expansion-panel-header class="header">
          <v-row>
            <v-col cols="12" sm="1">
              <v-img
                class="image1"
                lazy-src="https://picsum.photos/id/11/10/6"
                max-height="150"
                max-width="50"
                src="https://icons-for-free.com/iconfiles/png/512/doctors+health+hospital+medical+medicine+icon-1320184696812504400.png"
              ></v-img>
            </v-col>

            <v-col cols="12" sm="2">
              <p
                v-if="per.leaveType == 'Authorize'"
                id="date"
                style="color: green"
              >
                {{ per.leaveType }}
              </p>
              <p v-else id="date" style="color: red">{{ per.leaveType }}</p>
            </v-col>


            <v-col cols="12" sm="4" class="images">
              <v-img
                class="image2"
                lazy-src="https://picsum.photos/id/11/10/6"
                max-height="100"
                max-width="100"
                :src="url + per.student.picture"
              ></v-img>
            </v-col>

            <v-col cols="12" sm="3">
              <h2 id="name">
                {{ per.student.firstName }} {{ per.student.lastName }}
              </h2>
              <br />
              <p>{{ per.student.class }}</p>
              <p>{{ per.teacher }}</p>
            </v-col>
          </v-row>
        </v-expansion-panel-header>

        <!-- ==============space=============== -->
        <v-expansion-panel-content class="description">
          <div class="dateTime">
            <span style="margin-right:5px">Start from : </span> {{ per.startDate }}
            <p style="margin-left: 10px">to {{ per.endDate }}</p>
          </div>

          <div class="dateDetail">
            <span>Amount of day : </span>
            <p
              style="margin-left: 5px;color:red;"
              v-html="
                Math.round(
                  (new Date(per.endDate).getTime() -
                    new Date(per.startDate).getTime()) /
                    (1000 * 3600 * 24)
                )
              "
            ></p>
            <p style="margin-left:5px"> days </p>
          </div>

          <span>The reason : </span> {{ per.description }}
        </v-expansion-panel-content>

        <div v-if="userRole !== 'Student'" class="btn" align="center">
          <v-icon @click="ShowEditDialog(per)" left color="green"
            >mdi-pencil-box-multiple-outline</v-icon
          >
          <v-icon @click="ShowDialog(per)" title color="#EF5350" right
            >mdi-delete</v-icon
          >
        </div>
      </v-expansion-panel>
    </v-expansion-panels>

    <h4 id="noResult" v-if="permissionInfo == '' ">NO RESULTS HERE!</h4>
  </div>
</template>

<script>
import formPermission from "../ui/formPermission.vue";
import axios from "../../axios-http.js";
export default {
  components: { formPermission },

  data() {
    return {
      dialog: false,
      showEdit: false,
      userRole: "",
      id: "",
      studentID: "",
      search: "",
      studentId: "",
      permissionInfo: [],
      studentlist: [],
      teacherlist: ["Sim", "Vandy", "Davy", "Thaina", "Phuty", "Somkhan"],
      url: "http://127.0.0.1:8000/storage/imagestudent/",

      firstName: "",
      lastName: "",
      teacher: "",
      leaveType: "",
      startDate: "",
      endDate: "",
      description: "",
      classes: "",
      perFilter: [],
      items: [
        "WEB 2021A",
        "WEB 2021B",
        "SNA 2021",
        "WEB 2022A",
        "WEB 2022B",
        "SNA 2022",
      ],
    };
  },
  methods: {
    Addpermission(per) {
      axios.post("/permissions", per).then((res) => {
        this.getPermission();
        return res.data;
      });
    },
    Remove(id) {
      this.dialog = false;
      axios.delete("/permissions/" + id).then((res) => {
        this.getPermission();
        return res.data;
      });
    },
    Update() {
      let studentid = "";
      if (this.studentId.id == undefined) {
        studentid = this.studentID;
      } else {
        studentid = this.studentId.id;
      }

      let updatePer = {
        student_id: studentid,
        teacher: this.teacher,
        leaveType: this.leaveType,
        startDate: this.startDate,
        endDate: this.endDate,
        description: this.description,
      };

      axios.put("/permissions/" + this.id, updatePer).then((res) => {
        this.showEdit = false;
        this.getPermission();
        return res.data;
      });
    },

    ShowEditDialog(per) {
      this.id = per.id;
      this.studentID = per.student.id;
      this.studentId = per.student.firstName;
      this.teacher = per.teacher;
      this.leaveType = per.leaveType;
      this.startDate = per.startDate;
      this.endDate = per.endDate;
      this.description = per.description;

      this.showEdit = true;
    },
    ShowDialog(per) {
      this.dialog = true;
      this.id = per.id;
    },
    getStudent() {
      axios.get("/students").then((res) => {
        this.studentlist = res.data;
      });
    },

    getPermission() {
      let studentId = localStorage.getItem("studentId");
      axios.get("/permissions").then((res) => {
        this.perFilter = res.data;
        if (this.userRole === "Student") {
          for (let per of res.data) {
            if (per.student.id == studentId) {
              this.permissionInfo.push(per);
            }
          }
        } else {
          this.permissionInfo = res.data;
        }
      });
    },

    Search() {
      if (this.search !== "") {
        this.permissionInfo = this.permissionInfo.filter(
          (per) =>
            per.student.firstName
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
            per.student.lastName
              .toLowerCase()
              .includes(this.search.toLowerCase())
        );
        console.log(this.permissionInfo);
      } else {
        this.getPermission();
      }
    },
    selectClass() {
      this.permissionInfo = [];
      if (this.classes !== "") {
        for (let per of this.perFilter) {
          if (per.student.class === this.classes) {
            this.permissionInfo.push(per);
          }
        }
      } else {
        this.getPermission();
      }
    },
  },

  mounted() {
    this.getStudent();
    this.getPermission();
    this.userRole = localStorage.getItem("role");
  },
};
</script>

<style scoped>
.images {
  display: flex;
  align-items: center;
  justify-content: center;
}
.card-row {
  padding: 20px;
  margin: 50px;
  width: 80%;
  margin-left: 5%;
}
.header {
  margin-right: 5%;
}
.main {
  width: 80%;
  margin-left: 10%;
  margin-bottom: 3%;
  margin-top: 2%;
}
.btn {
  display: flex;
  justify-content: flex-end;
  align-items: flex-start;
  margin-right: 2%;
  margin-bottom: 10px;
}
.card {
  height: 88vh;
  overflow-y: scroll;
  margin-top: 1%;
}
#name {
  margin-top: 7%;
}

.title {
  display: flex;
  justify-content: space-between;
  width: 80%;
  margin-left: 10%;
  margin-top: 1%;
}

input[type="date"] {
  outline: none;
}
#dialog_remove {
  border-top: 7px solid red;
}

.image1 {
  margin-top: 50%;
}
.description {
  border-top: 1px solid rgba(182, 174, 174, 0.705);
}

#endDate {
  text-align: center;
}
.para2 {
  color: #fff;
  height: 6vh;
  background: rgb(108, 185, 226);
}
h3 {
  margin-left: 30%;
  margin-top: -2%;
}
#noResult {
  margin-top: 15%;
  text-align: center;
  color: gray;
}
#date {
  margin-left: 10%;
  margin-top: 30%;
  font-size: 20px;
}
.dateDetail {
  display: flex;
  height: 5vh;

}
.dateTime {
  display: flex;
  margin-top: 2%;
  height: 5vh;
 
}
span{
  font-weight: bold;
  font-size: 16px;
}
</style>
