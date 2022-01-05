<template>
  <v-dialog persistent width="700" v-model="dialog">
    <v-card>
      <h3>Update Student</h3>
      <v-form @submit.prevent="Update" ref="form">
        <v-card-text>
          <v-row>
            <v-col cols="6" sm="6">
              <v-text-field
                prepend-inner-icon="mdi-account-plus"
                v-model="firstName"
                label="First Name"
                color="cyan"
                dense
              ></v-text-field>
            </v-col>

            <v-col cols="6" sm="6">
              <v-text-field
                prepend-inner-icon="mdi-account-tie"
                v-model="lastName"
                label="Last Name"
                color="cyan"
                dense
              ></v-text-field>
            </v-col>
          </v-row>

          <v-row>
            <v-col cols="6" sm="6">
              <v-combobox
                prepend-inner-icon="mdi-folder-plus"
                :items="classes"
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
                <v-radio color="secondary" label="Male" value="Male"></v-radio>
              </v-radio-group>
            </v-col>
          </v-row>

          <!-- <v-file-input
            prepend-inner-icon="mdi-image-area"
            counter
            show-size
            small-chips
            v-model="picture"
            truncate-length="50"
            dense
            color="cyan"
          ></v-file-input> -->

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
          <v-btn type="submit" @click="Cancel" color="gray" text>Cancel</v-btn>
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
              ngo === '' 
            
            "
            color="green"
            text
            disabled
            >Update</v-btn
          >
          <v-btn type="submit" v-else color="green" text>Update</v-btn>
        </v-card-actions>
      </v-form>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["studentData"],
  emits: ["Update", "Cancel"],

  data() {
    return {
      classes: [
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
      dialog: true,

      firstName: "",
      lastName: "",
      Class: "",
      batch: "",
      major: "",
      gender: "",
      phoneNumber: "",
      ngo: "",
      picture: null,
    };
  },

  methods: {
    Update() {
      let updatedStudent = {
        firstName: this.firstName,
        lastName: this.lastName,
        class: this.Class,
        batch: this.batch,
        major: this.major,
        gender: this.gender,
        phone: this.phoneNumber,
        ngo: this.ngo,
      };

      this.$emit("Update", this.studentData.id, updatedStudent, false);
    },
    Cancel() {
      this.$emit("Cancel", false);
    },
  },
  mounted() {
    this.firstName = this.studentData.firstName;
    this.lastName = this.studentData.lastName;
    this.Class = this.studentData.class;
    this.batch = this.studentData.batch;
    this.major = this.studentData.major;
    this.gender = this.studentData.gender;
    this.phoneNumber = this.studentData.phone;
    this.ngo = this.studentData.ngo;
  },
};
</script>

<style scoped>
h3 {
  text-align: center;
  padding: 2px;
  color: #fff;
  background: rgb(108, 185, 226);
}
.gender {
  margin-top: -3%;
}
</style>
