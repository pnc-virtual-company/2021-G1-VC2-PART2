<template>
  <v-dialog persistent width="700" v-model="dialog" class="overlay">
    <v-card>
      <h2 id="edit">Do you want to update?</h2>
      <!-- ===================Form input user==================== -->
      <v-form @submit.prevent="Update" ref="form">
        <v-card-text>
          <v-row>
            <v-col cols="6" sm="6">
              <v-text-field
                prepend-inner-icon="mdi-account-plus"
                v-model="username"
                :rules="nameRules"
                :counter="20"
                label="Username"
                color="cyan"
              ></v-text-field>
            </v-col>

            <v-col cols="6" sm="6">
              <v-text-field
                prepend-inner-icon="mdi-email-plus"
                v-model="email"
                :rules="emailRules"
                :counter="20"
                label="E-mail"
                color="cyan"
              ></v-text-field>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="6" sm="6">
              <v-combobox
                prepend-inner-icon="mdi-account-cog"
                v-model="role"
                :items="items"
                label="Select role"
                outlined
                dense
                color="cyan"
              ></v-combobox>
            </v-col>

            <v-col cols="6" sm="6">
              <v-combobox
                v-if="role === 'Student'"
                prepend-inner-icon="mdi-account-box-multiple"
                v-model="studentId"
                :items="studentList"
                label="Select role"
                item-text="firstName"
                item-value="id"
                outlined
                dense
                color="cyan"
              ></v-combobox>
            </v-col>
          </v-row>

          <!-- <v-col cols="12" sm="12">
            <v-file-input
              chips
              counter
              show-size
              small-chips
              v-model="image"
              color="deep-purple accent-4"
              truncate-length="32"
            ></v-file-input>
          </v-col> -->

        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn @click="cancel" color="gray " text>Cancel</v-btn>
          <v-btn
            v-if="
            this.username == '' || 
            this.email == '' || 
            this.role == '' ||
            this.studentId == ''
            "
            disabled
            >Update</v-btn
          >
          <v-btn type="submit" color="success" text v-else>Update</v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </v-dialog>
</template>

<script>
import axios from "../../axios-http.js";
export default {
  props: ["userinfo"],
  emits: ["update", "cancel"],

  data() {
    return {
      items: ["Admin", "Social Affair", "Student"],
      dialog: true,
      username: "",
      email: "",
      role: "",
      studentId: '',
      studentList: [],

      nameRules: [
        (v) => !!v || "Username is required",
        (v) =>
          v.length <= 20 || "Username must be less than or equal 20 characters",
      ],

      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+/.test(v) || "E-mail must be valid",
        (v) =>
          v.length <= 20 || "Email must be less than or equal 20 characters",
      ],
    };
  },

  methods: {
    Update() {
      if (this.$refs.form.validate()) {

        let studentid = "";
        if (this.studentId == undefined) {
          studentid = "";
        } else {
          studentid = this.studentId.id;
        }

        let user = {
          username: this.username,
          email: this.email,
          role: this.role,
          student_id: studentid,
        };
        console.log(user);
        this.$emit("update", this.userinfo.id, user, false);
      }
    },

    cancel() {
      this.$emit("cancel", false);
    },

    getStudent() {
      axios.get("/students").then((res) => {
        this.studentList = res.data;
      });
    },
  },
  mounted() {
    this.getStudent();
    this.username = this.userinfo.username;
    this.email = this.userinfo.email;
    this.role = this.userinfo.role;
    this.studentId = this.userinfo.Student_id;
  },
};
</script>

<style scoped>
.overlay {
  position: fixed;
  background: #fff;
  top: 5%;
  left: 35%;
  width: 35%;
  z-index: 100;
  border-radius: 10px;
  box-shadow: rgba(50, 74, 85, 0.26) 0px 2px 4px 0px,
    rgba(70, 97, 109, 0.178) 0px 2px 16px 0px;
}
h2 {
  text-align: center;
  padding: 10px;
  color: #fff;
  background: rgb(108, 185, 226);
}
h3 {
  text-align: center;
  padding: 10px;
  color: #fff;
  background: rgb(108, 185, 226);
}
input[type="text"],
input[type="email"],
input[type="password"] {
  width: 100%;
  margin-top: 3%;
  padding: 5px;
  outline: none;
  border: 1px solid rgb(194, 193, 193);
  border-radius: 5px;
}
select {
  width: 30%;
  margin-top: 2%;
  margin-left: 2%;
  padding: 2px;
  outline: none;
  border: 1px solid rgb(194, 193, 193);
  border-radius: 5px;
}
input[type="password"] {
  margin-bottom: 2%;
}
input[type="file"] {
  width: 100%;
  margin-top: 3%;
  padding: 5px 0;
  outline: none;
}
</style>
