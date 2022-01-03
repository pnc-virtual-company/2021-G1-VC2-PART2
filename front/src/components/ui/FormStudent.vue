<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="500">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="blue lighten" dark v-bind="attrs" v-on="on"
          >+ Add student</v-btn
        >
      </template>

      <v-card>
        <h2>Create new Student</h2>
        <v-card-text>
          <v-row>
            <v-col cols="6" sm="6">
              <v-text-field
                prepend-inner-icon="mdi-account-details-outline"
                v-model="username"
                :rules="nameRules"
                :counter="10"
                label="First Name"
              ></v-text-field>
            </v-col>

            <v-col cols="6" sm="6">
              <v-text-field
                prepend-inner-icon="mdi-account-details-outline"
                v-model="email"
                :rules="emailRules"
                :counter="10"
                label="Last Name"
              ></v-text-field>
            </v-col>
            <v-col cols="12" sm="12">
              <v-select
                :items="items"
                prepend-inner-icon="mdi-select-group"
                label="Choose Class"
                style="width: 100%"
                dense
              ></v-select>
            </v-col>
          </v-row>
          <v-radio-group v-model="row" row>
            <v-radio
              label="Female"
              name="fav_language"
              value="Female"
              v-model="gender"
            ></v-radio>
            <v-radio
              label="Male"
              type="radio"
              name="fav_language"
              value="Male"
              v-model="gender"
            ></v-radio>
          </v-radio-group>

          <v-text-field
            type="number"
            prepend-inner-icon="mdi-phone-forward-outline"
            placeholder="Phone number"
            v-model="phoneNumber"
          />
          <v-text-field
            prepend-inner-icon="mdi-message-processing-outline"
            v-model="ngo"
            :counter="20"
            label="NGO"
          ></v-text-field>
          <v-file-input
            name="picture"
            label="Upload image"
            @change="Image"
            style="width: 100%"
          ></v-file-input>
        </v-card-text>

        <v-divider></v-divider>

        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" text @click="Addstudent">Create</v-btn>
        </v-card-actions>
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
      items: [
        "WEB 2021A",
        "WEB 2021B",
        "SNA 2021",
        "WEB 2022A",
        "WEB 2022B",
        "SNA 2022",
      ],
      dialog: false,
      firstName: "",
      lastName: "",
      Class: "",
      phoneNumber: "0",
      gender: "",
      ngo: "",
      picture: "",
    };
  },
  methods: {
    Image(event) {
      this.picture = event.target.files[0];
    },
    Addstudent() {
      let addStudent = new FormData();
      addStudent.append("firstName", this.firstName);
      addStudent.append("lastName", this.lastName);
      addStudent.append("class", this.Class);
      addStudent.append("phone", this.phoneNumber);
      addStudent.append("gender", this.gender);
      addStudent.append("ngo", this.ngo);
      addStudent.append("picture", this.picture);

      axios.post("/students", addStudent).then((res) => {
        console.log(res.data);
        this.$emit("add-user", res.data);
        this.dialog = false;
      });
    },
  },
};
</script>

<style  scoped>
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

input[type="text"] {
  width: 50%;
  margin-top: 3%;
  padding: 3px;
  padding-left: 10px;
  outline: none;
  border: 1px solid rgb(194, 193, 193);
  border-radius: 5px;
}
input[type="number"] {
  width: 100%;
  margin-top: 3%;
  padding: 3px;
  padding-left: 10px;
  outline: none;
  border: 1px solid rgb(194, 193, 193);
  border-radius: 5px;
}
select {
  width: 100%;
  margin-top: 2%;
  padding: 3px;
  padding-left: 10px;
  outline: none;
  border: 1px solid rgb(194, 193, 193);
  border-radius: 5px;
}
input[type="radio"] {
  margin-left: 10px;
  margin-top: 3%;
}
input[type="file"] {
  width: 100%;
  margin-top: 3%;
  padding: 5px 0;
  outline: none;
}
</style>