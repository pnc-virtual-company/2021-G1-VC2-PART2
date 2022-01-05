<template>
  <v-row justify="center">
    <v-dialog v-model="dialog" max-width="600px">
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          class="mt-3"
          color="blue"
          dark
          v-bind="attrs"
          v-on="on"
          style="margin-left: 35%"
        >
          Create disciple
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="para2">
          <h3>DISCIPLINE FORM</h3>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="6" sm="6">
                <v-combobox
                  prepend-icon="mdi-account-box-multiple"
                  v-model="studentId"
                  :items="studentLists"
                  label="Choose student"
                  item-text="firstName"
                  item-value="id"
                  dense
                  color="cyan"
                ></v-combobox>
              </v-col>
              <v-col cols="6" sm="6" id="date">
                <img src="../../assets/date.png" alt="" />
                <input
                  type="date"
                  v-model="date"
                  :items="leavelist"
                  label="Date"
                  multiple
                  rows="1"
                  color="cyan"
                  prepend-icon="mdi-alert-outline"
                />
              </v-col>
              </v-row>
<v-row>
              <v-col cols="6" sm="6">
                <v-autocomplete
                  v-model="dnt"
                  :items="leavelist"
                  label="Choose discipline notice type"
                  rows="1"
                  color="cyan"
                  prepend-icon="mdi-alert-outline"
                ></v-autocomplete>
              </v-col>

              <v-col cols="6" sm="6" id="description">
                <v-textarea
                  v-model="description"
                  class="mx-1"
                  label="Description"
                  color="cyan"
                  rows="1"
                  prepend-icon="mdi-comment-processing-outline"
                ></v-textarea>
              </v-col>
            </v-row>
          </v-container>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn color="blue darken-1" text @click="dialog = false">
            Close
          </v-btn>
          <v-btn color="green darken-1" text @click="createDisciple">
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
import axios from "../../axios-http.js";

export default {
  data: () => ({
    emits: ["add-discipline"],
    dialog: false,
    classlist: [
      "WEB 2021A",
      "WEB 2021B",
      "SNA 2021",
      "WEB 2022A",
      "WEB 2022B",
      "SNA 2022",
    ],
    leavelist: ["Notification", "Oral warning", "Warning letter", "Termination"],
    studentLists: [],

    studentId: "",
    dnt: "",
    date: "",
    description: "",
  }),

  methods: {
    createDisciple() {
      let studentid = "";
      if (this.studentId.id == undefined) {
        studentid = "";
      } else {
        studentid = this.studentId.id;
      }
      let newDiscipline = {
        student_id: studentid,
        dnt: this.dnt,
        date: this.date,
        description: this.description,
      };
      axios.post("/disciples", newDiscipline).then((res) => {
        this.$emit("add-discipline", res.data);
        this.dialog = false;
        this.studentId = "";
        this.dnt = "";
        this.date = "";
        this.description = "";
      });
    },
    getStudent() {
      axios.get("/students").then((res) => {
        this.studentLists = res.data;
      });
    },
  },
  mounted() {
    this.getStudent();
  },
};
</script>

<style scoped>
#date {
  display: flex;
  padding-left: 0px;
}
.dnt {
  margin-right: 5%;
  background: teal;
}
#description {
  padding-left: 10px;
}
#student {
  padding-left: 7px;
  display: flex;
  align-items: center;
}
img {
  width: 45px;
  height: 35px;
}
#img1 {
  width: 30px;
  height: 30px;
}
label {
  margin-left: 10px;
}
select {
  width: 70%;
  border-bottom: 1px solid gray;
  outline: none;
  margin-left: 2%;
}
.text-h5 {
  color: white;
  text-align: center;
}
.para2 {
  padding: 2px;
  color: #fff;
  background: rgb(108, 185, 226);
}
h3 {
  margin-left: 30%;
}
</style>