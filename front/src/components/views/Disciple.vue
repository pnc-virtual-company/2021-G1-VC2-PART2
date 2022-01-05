<template>
  <v-expansion-panels class="main">
    <div class="headerManin">
      <!-- ===================Edit disciple dialog======================== -->

      <v-dialog v-model="editdialog" max-width="600px">
        <v-card class="card">
          <v-card-title color="blue" class="para2">
            <span>Are you sure you want to update this item?</span>
          </v-card-title>
          <v-container>
            <v-row>
              <v-col cols="6" sm="6" id="date">
                <img src="../../assets/date.png" alt="" />
                <input
                  type="date"
                  v-model="date"
                  label="Date"
                  multiple
                  rows="1"
                  prepend-icon="mdi-alert-outline"
                />
              </v-col>

              <v-col cols="6" sm="6">
                <v-autocomplete
                  v-model="dnt"
                  :items="leavelist"
                  label="Choose discipline notice type"
                  rows="1"
                  prepend-icon="mdi-alert-outline"
                ></v-autocomplete>
              </v-col>

              <v-col cols="12" sm="12">
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
            <v-btn color="gray darken-1" text @click="editdialog = false"
              >Cancel</v-btn
            >
            <v-btn color="green darken-1" text @click="Update(id)">OK</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <!-- ==========================End edit Dialog===================================== -->

      <v-dialog v-model="dialog" max-width="500px">
        <v-card class="cardForm">
          <v-card-title class="text-h5"
            >Are you sure you want to delete this item?</v-card-title
          >
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="gray darken-1" text @click="dialog = false"
              >Cancel</v-btn
            >
            <v-btn color="green darken-1" text @click="Remove(id)">OK</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
      <!-- ==========================End Dialog===================================== -->

      <v-dialog v-model="dialog" max-width="500px">
        <v-card class="cardForm">
          <v-card-title class="text-h5"
            >Are you sure you want to delete this item?</v-card-title
          >
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="gray darken-1" text @click="dialog = false"
              >Cancel</v-btn
            >
            <v-btn color="green darken-1" text @click="Remove(id)">OK</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>

      <!-- ===================search============= -->
      <div class="cardheader" v-if="userRole !== 'Student'">
        <v-col cols="12" sm="4" style="margin-left: -15px">
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search discipline"
            color="blue darken-1"
            v-on:keyup="searchBotton"
            single-line
            outlined
            dense
          ></v-text-field>
        </v-col>

        <v-col cols="12" sm="3">
          <v-combobox
            v-on:keyup="selectClass"
            v-model="classes"
            :items="items"
            class="select"
            label="Select Class"
            outlined
            single-line
            dense
            color="deep-purple accent-4"
          ></v-combobox>
        </v-col>

        <v-col cols="12" sm="6" style="margin-left: 19px">
          <form-disciple
            @add-discipline="getDisciples"
          ></form-disciple>
        </v-col>

      </div>


      <v-expansion-panel v-for="disciple of disciples" :key="disciple.id">
        <v-expansion-panel-header class="header">
          <v-row>
            <v-col cols="12" sm="1">
              <v-img
                id="wearning"
                max-height="70"
                max-width="70"
                src="../../assets/stop.png"
              >
              </v-img>
            </v-col>
            <v-col cols="12" sm="2">
              <p
                v-if="disciple.dnt == 'Termination'"
                id="dnt"
                style="color: red"
              >
                {{ disciple.dnt }} ( This student is out school )
              </p>
              <p
                v-else-if="disciple.dnt == 'Warning letter'"
                id="dnt"
                style="color: orange"
              >
                {{ disciple.dnt }}
              </p>
              <p
                v-else-if="disciple.dnt == 'Oral warning'"
                id="dnt"
                style="color: #ffd600"
              >
                {{ disciple.dnt }}
              </p>
              <p v-else id="dnt" style="color: green">{{ disciple.dnt }}</p>
            </v-col>

            <v-col cols="12" sm="4" class="image">
              <v-img
                max-height="120"
                max-width="100"
                :src="url + disciple.student.picture"
              >
              </v-img>
            </v-col>

            <v-col cols="12" sm="4">
              <div class="username">
                <h3>
                  {{ disciple.student.firstName }}
                  {{ disciple.student.lastName }}
                </h3>
              </div>

              <div class="date">
                <v-img
                  max-height="50"
                  max-width="50"
                  src="../../assets/date.png"
                  alt=""
                >
                </v-img>
                <h4>{{ disciple.date }}</h4>
              </div>
              <p id="class">{{ disciple.student.class }}</p>
            </v-col>
          </v-row>
          <!-- ===================end button edit&delete============= -->
        </v-expansion-panel-header>
        <!-- ====================start show details========== -->
        <v-expansion-panel-content class="description">
          <span style="font-weight:bold;margin-left:0%;font-size:17px;">The explanation :</span>  {{ disciple.description }}
        </v-expansion-panel-content>

        <!-- ====================end show details=================== -->
        <div
          v-if="userRole !== 'Student' "
          class="btn"
          align="center"
        >
          <v-icon @click="ShowDilogEdit(disciple)" color="green" left
            >mdi-pencil-box-multiple-outline</v-icon
          >
          <v-icon @click="ShowDialog(disciple)" color="#EF5350" right
            >mdi-delete</v-icon
          >
        </div>
      </v-expansion-panel>

      <h4 id="noResult" v-if="disciples == '' ">NO RESULTS HERE!</h4>
    </div>
  </v-expansion-panels>
</template>

<script>
import axios from "../../axios-http.js";
import formDisciple from "../ui/formDisciple.vue";
export default {
  components: { formDisciple },
  data() {
    return {
      dialog: false,
      editdialog: false,
      classes: "",
      search: "",
      description: "",
      class: "",
      disciples: [],
      disFilter: [],
      id: "",
      student_id: "",
      dnt: "",
      date: "",
      userRole: "",
      url: "http://127.0.0.1:8000/storage/imagestudent/",
      leavelist: [
        "Notification",
        "Oral warning",
        "Warning letter",
        "Termination",
      ],
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
  computed: {
    computedDateFormatted() {
      return this.formatDate(this.date);
    },
  },

  watch: {
    date() {
      this.dateFormatted = this.formatDate(this.date);
    },
  },
  methods: {
    Remove(id) {
      axios.delete("/disciples/" + id).then((res) => {
        this.getDisciples();
        this.dialog = false;
        return res.data;
      });
    },
    ShowDilogEdit(disciple) {
      this.editdialog = true;
      this.id = disciple.id;
      this.date = disciple.date;
      this.description = disciple.description;
      this.dnt = disciple.dnt;
    },
    Update() {
      this.editdialog = false;
      let updateDic = {
        date: this.date,
        dnt: this.dnt,
        description: this.description,
      };
      console.log(updateDic);

      axios.put("/disciples/" + this.id, updateDic).then((res) => {
        this.editdialog = false;
        this.getDisciples();
        return res.data;
      });
    },

    getDisciples() {
      let studentId = localStorage.getItem("studentId");
      axios.get("/disciples").then((res) => {
        this.disFilter = res.data;
        if (this.userRole === "Student") {
          for (let disciple of res.data) {
            if (disciple.student.id == studentId) {
              this.disciples.push(disciple);
            }
          }
        } else {
          this.disciples = res.data;
        }
      });
    },
    ShowDialog(disciple) {
      this.dialog = true;
      this.id = disciple.id;
    },
    getStudent() {
      axios.get("/students").then((res) => {
        this.studentlist = res.data;
      });
    },

    // =================Search btn=======================
    searchBotton() {
      if (this.search !== "") {
        this.disciples = this.disciples.filter(
          (disciple) =>
            disciple.student.firstName
              .toLowerCase()
              .includes(this.search.toLowerCase()) ||
            disciple.student.lastName
              .toLowerCase()
              .includes(this.search.toLowerCase())
        );
      } else {
        this.getDisciples();
      }
    },
    selectClass() {
      this.disciples = [];
      if (this.classes !== "") {
        for (let dis of this.disFilter) {
          if (dis.student.class === this.classes) {
            this.disciples.push(dis);
          }
        }
      } else {
        this.getDisciples();
      }
    },
  },
  mounted() {
    this.getDisciples();
    this.getStudent();

    this.userRole = localStorage.getItem("role");
  },
};
</script>

<style scoped>
.cardheader {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;

}
.headerManin {
  width: 80%;
  margin-top: 1%;
  margin-bottom: 5%;
}
.header {
  margin-right: 5%;
}
.main {
  height: 88vh;
  overflow-y: scroll;
  margin-top: 1%;
}
.cardForm {
  border-top: 5px solid red;
}
#wearning {
  margin-top: 60%;
}

img {
  width: 45px;
  height: 35px;
}
input[type="date"] {
  width: 80%;
  border-bottom: 1px solid gray;
}
.btn {
  display: flex;
  justify-content: flex-end;
  margin-right: 2%;
  padding-bottom: 5px;
}
.para2 {
  padding: 2px;
  color: #fff;
  background: rgb(108, 185, 226);
}
span {
  margin-left: 16%;
}
#dnt {
  margin-top: 45%;
  font-size: 18px;
}
.username {
  margin-top: 7%;
  padding-left: 15px;
}
.date {
  display: flex;
  align-items: center;
  margin-top: 2%;
}
#class {
  margin-top: 3%;
  margin-left: 5%;
}
.image {
  display: flex;
  align-items: center;
  justify-content: center;
}
#noResult {
  text-align: center;
  margin-top: 20%;
  color: gray;
}
.description{
  border-top: 1px solid rgba(128, 128, 128, 0.514);
  padding-top: 15px ;
}
</style>
