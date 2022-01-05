<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="600">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="blue" dark v-bind="attrs" v-on="on">
          New permission
        </v-btn>
      </template>

      <v-card>
        <v-card-title class="para2">
          <h2>Permission form</h2>
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
                  dense
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
                  dense
                ></v-combobox>
              </v-col>
            </v-row>

            <v-row class="date">
              <v-col cols="12" lg="6">
                <label for="startDate">Start date: </label>
                <input type="date" name="date" v-model="startDate" />
              </v-col>
              <v-col cols="12" lg="6">
                <label for="endDate" style="margin-left: 10%">End date: </label>
                <input type="date" name="date" v-model="endDate" />
              </v-col>
            </v-row>

            <v-row>

              <v-col cols="6" sm="6">
                <v-combobox
                  prepend-inner-icon="mdi-card-account-details-outline"
                  v-model="leavetype"
                  :items="['Authorize', 'Unauthorize']"
                  label="Choose leave type"
                  required
                  color="cyan"
                  dense
                ></v-combobox>
              </v-col>

              <v-col cols="6" sm="6">
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

         <!-- ===================Create Successfull========================= -->
          <v-col cols="12" sm="12">
            <v-alert
              v-model="alert"
              v-if="success"
              dense
              dismissible
              text
              type="success"
            >
              This permission is have been <strong>created</strong>
            </v-alert>

            <!-- =========================Message error============================= -->
            <v-alert
              v-model="alert"
              v-else
              dense
              outlined
              dismissible
              type="error"
            >
              <strong>The end date must me grater than start date</strong> , please try again !
            </v-alert>
          </v-col>


        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn type="submit" @click="dialog = false" color="gray" text
            >Close</v-btn
          >
          <v-btn
            v-if="
              studentId === '' ||
              teacher === '' ||
              description === '' ||
              leavetype === '' ||
              startDate === '' ||
              endDate === ''
            "
            color="green"
            text
            disabled
            >Save</v-btn
          >
          <v-btn v-else color="green" text @click="createPermission"
            >Create</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import axios from "../../axios-http.js";
export default {
  emits: ["add-per"],
  data: () => ({
    dialog: false,
    success: false,
    alert: false,
    hidden: false,
    studentlist: [],
    teacherlist: ["Sim", "Vandy", "Davy", "Thaina", "Phuty", "Somkhan"],
    value: null,

    studentId: "",
    teacher: "",
    leavetype: "",
    startDate: "",
    endDate: "",
    description: "",
  }),
  methods: {
    createPermission() {
      let studentid = "";
      if (this.studentId.id == undefined) {
        studentid = "";
      } else {
        studentid = this.studentId.id;
      }

      let addpermission = {
        student_id: studentid,
        teacher: this.teacher,
        leaveType: this.leavetype,
        startDate: this.startDate,
        endDate: this.endDate,
        description: this.description,
      };
      if (
        this.studentId !== "" &&
        this.teacher !== "" &&
        this.leavetype !== "" &&
        this.startDate !== "" &&
        this.endDate !== "" && this.endDate >= this.startDate
      ) {
        this.$emit("add-per", addpermission);
        this.alert = true;
        this.success = true;
        this.hidden = true;

        setInterval(() => {
          if (this.hidden) {
            this.dialog = false;
            this.hidden = false;
            this.alert = false;

            this.studentId = "";
            this.teacher = "";
            this.leavetype = "";
            this.startDate = "";
            this.endDate = "";
            this.description = "";
          }
        },3000)

      }else{
          this.alert = true;
          this.success = false;
          setInterval(() => {
            this.alert = false;
          }, 3000);
      }
    },
    getStudent() {
      axios.get("/students").then((res) => {
        this.studentlist = res.data;
      });
    },
  },
  mounted() {
    this.getStudent();
  },
};
</script>
<style scoped>
.text-center{
  margin-left: 40.5%;
}
.dates {
  background: #e1f5fe;
  border-radius: 10px;
}
input[type="date"] {
  outline: none;
}

.para2 {
  color: #fff;
  height: 6vh;
  background: rgb(108, 185, 226);
}
h2 {
  margin-left: 35%;
  font-size: 22px;
  margin-top: -2%;
}
.date {
  font-size: 14.1px;
}
</style>