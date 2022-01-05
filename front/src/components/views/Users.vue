<template>
  <div class="main">
    <div class="text-center">
      <v-dialog v-model="dialog" width="700">
        <template v-slot:activator="{ on, attrs }">
          <v-btn color="blue lighten" dark v-bind="attrs" v-on="on"
            >+ Create user</v-btn
          >
        </template>
        <v-card>
          <h3>Create new user</h3>

          <!-- ===================Form input user==================== -->
          <v-form @submit.prevent="Adduser" ref="form">
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
                    :counter="30"
                    label="E-mail"
                    color="cyan"
                  ></v-text-field>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12" sm="6">
                  <v-text-field
                    v-model="password"
                    :rules="passwordrules"
                    label="Password"
                    color="cyan"
                    :type="passwordShow ? 'text' : 'password'"
                    prepend-inner-icon="mdi-key"
                    :append-icon="passwordShow ? 'mdi-eye' : 'mdi-eye-off'"
                    @click:append="passwordShow = !passwordShow"
                  ></v-text-field>
                </v-col>
                <v-col cols="12" sm="6">
                  <v-text-field
                    v-model="password_confirmation"
                    :rules="passwordrules"
                    label="confirm password"
                    color="cyan"
                    :type="passwordShowCon ? 'text' : 'password'"
                    prepend-inner-icon="mdi-key"
                    :append-icon="passwordShowCon ? 'mdi-eye' : 'mdi-eye-off'"
                    @click:append="passwordShowCon = !passwordShowCon"
                    
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
                    label="Choose student"
                    item-text="firstName"
                    item-value="id"
                    outlined
                    dense
                    color="cyan"
                  ></v-combobox>
                </v-col>
              </v-row>

              <v-file-input
                prepend-inner-icon="mdi-image-area"
                dense
                counter
                show-size
                small-chips
                v-model="image"
                color="cyan"
                truncate-length="50"
              ></v-file-input>
            </v-card-text>

            <!-- =========================Message error and login successfully============================ -->
            <v-col cols="12" sm="12">
           
              <v-alert
                dismissible
                type="success"
                top
                color="green"
                v-model="alert"
                v-if="success"
                >{{ error }}</v-alert
              >
              <v-alert
                dismissible
                type="error"
                top
                color="error"
                v-model="alert"
                v-else
                >{{ error }}</v-alert
              >
            </v-col>

            <v-divider></v-divider>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="gray" text @click="dialog = false">Cancel</v-btn>
              <v-btn
                type="submit"
                color="green"
                text
                v-if="
                  this.username == '' ||
                  this.email == '' ||
                  this.password == '' ||
                  this.image == null ||
                  this.role == ''
                "
                disabled
                >Create</v-btn
              >

              <v-btn v-else type="submit" color="green" text>Create</v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-dialog>
    </div>

    <!-- ===================Delete disciple dialog======================== -->

    <v-dialog v-model="deleteDialog" max-width="500px">
      <v-card class="cardForm">
        <v-card-title>
          Are you sure you want to delete this user?
        </v-card-title
        >
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="gray darken-1" text @click="deleteDialog = false"
            >Cancel</v-btn
          >
          <v-btn color="primary" text @click="DeleteUser(id)">OK</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- ==========================End Dialog=================================== -->

    <div class="userLists">
      <h3>List of users</h3>
      <v-simple-table>
        <template v-slot:default>
          <thead>
            <tr>
              <th class="text-left">Profile</th>
              <th class="text-left">Username</th>
              <th class="text-left">Email</th>
              <th class="text-left">Role</th>
              <th class="text-left">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user of users" :key="user.id">
              <!-- =============Display image user or student======== -->
              <td v-if="user.role !== 'Student'">
                <img :src=" url + user.profile" alt="" />
              </td>

              <td v-else>
                <img :src="student_url + user.student.picture" alt="" />
              </td>

              <td>{{ user.username }}</td>
              <td>{{ user.email }}</td>
              <td>{{ user.role }}</td>
              <td>
                <v-list-item-icon>
                  <v-icon @click="Show(user)" color="green"
                    >mdi-pencil-box-multiple-outline</v-icon
                  >
                </v-list-item-icon>

                <v-list-item-icon>
                  <v-icon @click="showDeleteUser(user)" color="#EF5350"
                    >mdi-delete</v-icon
                  >
                </v-list-item-icon>
              </td>
            </tr>

            <tr v-if="users === '' ">
              <td></td>
              <td></td>
              <td>NO RESULTS HERE!</td>
              <td></td>
              <td></td>
            </tr>

          </tbody>
        </template>
      </v-simple-table>
    </div>

    <dialog-edit
      v-if="displayEdit"
      :userinfo="userInfo"
      @cancel="cancel"
      @update="EditUser"
    />
  </div>
</template>

<script>
import axios from "../../axios-http.js";
import DialogEdit from "./DialogEdit.vue";

export default {
  components: {
    DialogEdit,
  },
  data() {
    return {
      success: false,
      alert: false,
      hidden: true,
      studentList: "",
      userInfo: "",
      password: "",
      passwordShow: false,
      passwordShowCon: false,
      password_confirmation: "",
      image: null,
      studentId: "",
      users: '',
      dialog: false,
      deleteDialog: false,
      showDialog: false,
      displayEdit: false,
      error: "",
      student_url: "http://127.0.0.1:8000/storage/imagestudent/",
      url: "http://127.0.0.1:8000/storage/imageUser/",
      role: "",
      items: ["Admin", "Student", "Social Affair"],
      id: "",

      valid: false,
      username: "",
      nameRules: [
        (v) => !!v || "Username is required",
        (v) =>
          v.length <= 20 || "Username must be less than or equal 20 characters",
      ],
      email: "",
      emailRules: [
        (v) => !!v || "E-mail is required",
        (v) => /.+@.+/.test(v) || "E-mail must be valid",
        (v) =>
          v.length <= 30 || "Email must be less than or equal 30 characters",
      ],

      passwordrules: [
        (v) => !!v || "Password is required",
        (v) =>
          v.length >= 8 ||
          "Password is must be equal or more than 8 characters",
        (v) => v.length <= 20 || "Password is to long",
      ],
    };
  },
  methods: {
    Adduser() {
      if (this.$refs.form.validate()) {
        let studentid = "";
        if (this.studentId !== "") {
          studentid = this.studentId.id;
        } else {
          studentid = "";
        }

        let newUser = new FormData();
        newUser.append("username", this.username);
        newUser.append("email", this.email);
        newUser.append("password", this.password);
        newUser.append("password_confirmation", this.password_confirmation);
        newUser.append("role", this.role);
        newUser.append("profile", this.image);
        newUser.append("student_id", studentid);

        axios
          .post("/signup", newUser)
          .then((res) => {
            this.alert = true;
            this.success = true;
            this.hidden = true;
            this.getUsers();

            setInterval(() => {
              if (this.hidden) {
                this.dialog = false;
                this.username = "";
                this.email = "";
                this.password = "";
                this.password_confirmation = "";
                this.role = "";
                this.image = null;
                this.studentId = "";
                this.alert = false;
                this.hidden = false;
              }
            }, 4000);

            this.error = "User is created successfully!";
            return res.data;
          })
          .catch((error) => {
            this.error = "User is not found , please try again!";
            this.alert = true;
            this.success = false;
            return error;
          });
      } else {
        this.error = "Create user failed , please try again!";
        this.success = false;
        this.alert = true;
      }

      setInterval(() => {
        this.alert = false;
      }, 4000);
    },

    EditUser(id, userupdated, display) {
      axios.put("/users/" + id, userupdated).then((res) => {
        this.displayEdit = display;
        this.getUsers();
        return res.data;
      });
    },

    Show(user) {
      this.userInfo = user;
      this.displayEdit = true;
    },

    cancel() {
      this.displayEdit = false;
    },

    DeleteUser(id) {
      axios.delete("/users/" + id).then((res) => {
        this.getUsers();
        return res.data;
      });
      this.deleteDialog = false;
    },

    showDeleteUser(user) {
      this.deleteDialog = true;
      this.id = user.id;
    },

    getUsers() {
      axios.get("/users").then((res) => {
        this.users = res.data;
        return res.data;
      });
    },

    getStudent() {
      axios.get("/students").then((res) => {
        this.studentList = res.data;
      });
    },
  },

  mounted() {
    this.getUsers();
    this.getStudent();
  },
};
</script>

<style scoped>
.userLists {
  width: 80%;
  margin-left: 10%;
  margin-bottom: 5%;
  box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
}
.main {
  height: 84vh;
  margin-top: 3%;
  overflow-y: scroll;
}

h3 {
  margin-top: 2%;
  text-align: center;
  padding: 5px;
  color: #fff;
  background: rgb(108, 185, 226);
}

.text-center {
  margin-left: 69%;
}
img {
  width: 70px;
  height: 70px;
  border-radius: 360px;
  margin-top: 5px;
  padding: 5px;
}
.cardForm {
  border-top: 5px solid red;
}
</style>