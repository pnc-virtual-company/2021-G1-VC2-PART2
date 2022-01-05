<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="700">
      <template v-slot:activator="{ on, attrs }">
        <v-btn  color="blue lighten" dark v-bind="attrs" v-on="on"
          >+ Add student</v-btn
        >
      </template>

      <v-card>
        <h2>Create new Student</h2>

        <v-form @submit.prevent="Addstudent" ref="form">
          <v-card-text>
            <v-row>
              <v-col cols="6" sm="6">
                <v-text-field
                  prepend-inner-icon="mdi-account-plus"
                  v-model="firstName"
                  label="First Name"
                  color="cyan"
                ></v-text-field>
              </v-col>

              <v-col cols="6" sm="6">
                <v-text-field
                  prepend-inner-icon="mdi-account-tie"
                  v-model="lastName"
                  label="Last Name"
                  color="cyan"
                ></v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="6" sm="6">
                <v-combobox
                  prepend-inner-icon="mdi-folder-plus"
                  :items="Classroom"
                  v-model="Class"
                  label="Class"
                  color="cyan"
                  dense
                ></v-combobox>
              </v-col>

              <v-col cols="6" sm="6">
                <v-combobox
                  v-model="batch"
                  prepend-inner-icon="mdi-account-box-multiple"
                  :items="batchs"
                  label="Choose Batch"
                  color="cyan"
                  dense
                ></v-combobox>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="6" sm="6">
                <v-text-field
                  prepend-inner-icon="mdi-chart-line-stacked"
                  v-model="major"
                  label="Major"
                  dense
                  color="cyan"
                ></v-text-field>
              </v-col>

              <v-col cols="12" sm="6">
                <v-text-field
                  prepend-inner-icon="mdi-phone-plus"
                  label="Phone number"
                  v-model="phoneNumber"
                  dense
                  color="cyan"
                ></v-text-field>
              </v-col>
            </v-row>

            <v-row>
              <v-col cols="6" sm="6">
                <v-text-field
                  prepend-inner-icon="mdi-microsoft-azure"
                  v-model="ngo"
                  label="NGO"
                  dense
                  color="cyan"
                ></v-text-field>
              </v-col>

              <v-col cols="6" sm="6">
                <v-radio-group class="gender" v-model="gender" row>
                  <v-list-item-icon>
                    <v-icon>mdi-gender-transgender</v-icon>
                  </v-list-item-icon>
                  <v-radio color="cyan" label="Female" value="Female"></v-radio>
                  <v-radio
                    color="secondary"
                    label="Male"
                    value="Male"
                  ></v-radio>
                </v-radio-group>
              </v-col>
            </v-row>

            <v-file-input
              prepend-inner-icon="mdi-image-area"
              counter
              show-size
              small-chips
              v-model="picture"
              truncate-length="50"
              dense
              color="cyan"
            ></v-file-input>

            <!-- ===================Create Successfull========================= -->
            <v-alert
              v-model="alert"
              v-if="success"
              dense
              dismissible
              text
              type="success"
              style="top: 15px"
            >
              The student is have been <strong>created</strong>
            </v-alert>

            <!-- =========================Message error============================= -->
            <v-alert
              v-model="alert"
              v-else
              dense
              outlined
              dismissible
              type="error"
              style="top: 15px"
            >
              Create student is <strong>failed</strong> , please try again !
            </v-alert>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn type="submit" @click="dialog = false" color="gray" text
              >Cancel</v-btn
            >
            <v-btn
              type="submit"
              v-if="
                firstName === '' ||
                lastName === '' ||
                Class === '' ||
                batch === '' ||
                major === '' ||
                phoneNumber === '' ||
                gender === '' ||
                ngo === '' ||
                picture === null
              "
              color="green"
              text
              disabled
              >Create</v-btn
            >
            <v-btn type="submit" v-else color="green" text>Create</v-btn>
          </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import axios from "../../axios-http.js";
export default {
  emits: ["add-user"],
  data() {
    return {
      Classroom: [
        "WEB 2021A",
        "WEB 2021B",
        "SNA 2021",
        "WEB 2022A",
        "WEB 2022B",
        "SNA 2022",
      ],
      batchs: [
        "BATCH 2020",
        "BATCH 2021",
        "BATCH 2022",
        "BATCH 2023",
        "BATCH 2024",
        "BATCH 2025",
      ],
      success: false,
      alert: false,
      hidden: false,
      dialog: false,
      firstName: "",
      lastName: "",
      Class: "",
      batch: "",
      major: "",
      phoneNumber: "",
      gender: "",
      ngo: "",
      picture: null,
    };
  },
  methods: {
    Addstudent() {
      let addStudent = new FormData();
      addStudent.append("firstName", this.firstName);
      addStudent.append("lastName", this.lastName);
      addStudent.append("class", this.Class);
      addStudent.append("batch", this.batch);
      addStudent.append("major", this.major);
      addStudent.append("phone", this.phoneNumber);
      addStudent.append("gender", this.gender);
      addStudent.append("ngo", this.ngo);
      addStudent.append("picture", this.picture);

      axios
        .post("/students", addStudent)
        .then((res) => {
          this.$emit("add-user", res.data);
          this.alert = true;
          this.success = true;
          this.hidden = true;

          setInterval(() => {
            if (this.hidden) {
              this.dialog = false;
              this.firstName = "";
              this.lastName = "";
              this.Class = "";
              this.batch = "";
              this.major = "";
              this.phoneNumber = "";
              this.ngo = "";
              this.gender = "";
              this.picture = null;
              this.hidden = false;
              this.alert = false;
            }
          }, 2000);
        })
        .catch((error) => {
          this.alert = true;
          this.success = false;
          setInterval(() => {
            this.alert = false;
          }, 3000);
          return error;
        });
    },
  },
};
</script>

<style  scoped>
.text-center{
  margin-left: 24%;
}
.gender {
  margin-top: -3%;
}
h2 {
  text-align: center;
  padding: 2px;
  color: #fff;
  background: rgb(108, 185, 226);
}
</style>