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
          <h2>Add Permission</h2>
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

            <v-row>
              <v-col cols="6" sm="12">
                <v-combobox
                  prepend-inner-icon="mdi-card-account-details-outline"
                  v-model="leavetype"
                  :items="[
                    'sick',
                    'have a task to do',
                    'sick too',
                    'sick three',
                  ]"
                  label="Choose leave type"
                  required
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
                <label for="endDate" style="margin-left: 15%">End date: </label>
                <input type="date" name="date" v-model="endDate" />
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" sm="12">
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
      if (this.studentId !== "" || this.teacher !== "") {
        this.$emit("add-per", addpermission);
        this.dialog = false;
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
.text-center {
  margin-left: 9.5%;
  margin-bottom: -50px;
}
.dates {
  background: #e1f5fe;
  border-radius: 10px;
}
input[type="date"] {
  outline: none;
}
select {
  width: 50%;
  outline: none;
  border: none;
  border-bottom: 1px solid gray;
  margin-top: 9px;
  margin-left: 9%;
}
.para2 {
  padding: 2px;
  color: #fff;
  background: rgb(108, 185, 226);
}
h2 {
  margin-left: 30%;
}
.date {
  font-size: 14.1px;
}
</style>