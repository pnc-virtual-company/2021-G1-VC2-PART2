<template>
  <div class="overlay">
    <div class="mainCard">
      <!-- ===================Display profile==================== -->

      <v-badge
        class="imageProfile"
        avatar
        bordered
        overlap
        bottom
        offset-x="25"
        offset-y="25"
        color="black"
      >
        <v-avatar size="80">
          <v-img
            class="image"
            @click="SetImage"
            v-if="userinfo.role !== 'Student'"
            :src="url + userinfo.profile"
          ></v-img>

          <v-img
            v-else
            class="image"
            @click="SetImage"
            :src="student_url + userinfo.student.picture"
          ></v-img>
        </v-avatar>

        <template v-slot:badge>
          <v-avatar>
            <v-icon>mdi-camera-plus-outline</v-icon>
          </v-avatar>
        </template>
      </v-badge>

      <p class="username">{{ userinfo.username }}</p>
      <p class="email">{{ userinfo.email }}</p>
      <p class="account">Manage your user account</p>
      <hr />
      <button id="Signout" @click="Signout">Sign out</button>
      <hr />
      <p class="privacy">Privacy Policy • Terms of Service</p>
    </div>

    <!-- ===================Update image dialog======================== -->

    <v-dialog v-model="Dialog" max-width="500px">
      <v-card class="cardForm">
        <v-card-title id="title">Do you want to change profile?</v-card-title>

        <div class="selectImage">
          <label for="profile">
            <img
              id="displaies"
              :src="imgProfile"
              aria-hidden="true"
              alt="profile"
            />
          </label>
          <input
            id="profile"
            class="d-none"
            accept="image/*"
            type="file"
            prepend-icon="mdi-camera"
            style="margin-bottom: -45px"
            @change="addImg"
            label="Select Your Image here"
            filled
          />
        </div>

        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="gray darken-1" text @click="Cancel">Cancel</v-btn>
          <v-btn
            v-if="userinfo.role == 'Student'"
            color="green darken-1"
            text
            @click="UpdatePicture(userinfo)"
            >OK</v-btn
          >
          <v-btn
            v-else
            color="green darken-1"
            text
            @click="UpdateProfile(userinfo)"
            >OK</v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
    <!-- ==========================End Dialog=================================== -->
  </div>
</template>

<script>
import axios from "../../axios-http.js";
export default {
  props: ["userinfo"],
  emits: ["signOut"],
  data() {
    return {
      image: "",
      imgProfile: "https://www.portal.chat/img/avatar.svg",
      Dialog: false,
      Profile: null,
      student_url: "http://127.0.0.1:8000/storage/imagestudent/",
      url: "http://127.0.0.1:8000/storage/imageUser/",
    };
  },
  methods: {

    UpdatePicture(userinfo) {
  
      let picture = new FormData();
      picture.append("picture", this.image);
      picture.append("_method", "PUT");

      axios
        .post("students/image/" + userinfo.student.id, picture)
        .then(() => {
          this.Dialog = true;
          location.reload();
        })
        .catch((error) => {
          console.log(error.response.data.message);
        });
      this.imageView = "https://www.portal.chat/img/avatar.svg";
    },

    UpdateProfile(userinfo) {
      let profile = new FormData();
      profile.append("profile", this.image);
      profile.append("_method", "PUT");

      axios
        .post("users/images/" + userinfo.id, profile)
        .then(() => {
          this.Dialog = true;
          location.reload();
        })
        .catch((error) => {
          console.log(error.response.data.message);
        });
      this.imageView = "https://www.portal.chat/img/avatar.svg";
    },

    addImg(event) {
      this.image = event.target.files[0];
      this.imgProfile = URL.createObjectURL(this.image);
      console.log(this.image);
    },

    SetImage() {
      this.Dialog = true;
    },

    Cancel() {
      this.Dialog = false;
      this.imgProfile = "https://www.portal.chat/img/avatar.svg";
    },

    Signout() {
      this.$emit("signOut", false);
    },
  },
};
</script>

<style scoped>
.overlay {
  position: fixed;
  background: #fff;
  top: 55px;
  right: 0px;
  left: 71.8%;
  width: 28%;
  z-index: 10;
  border-radius: 10px;
  box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px,
    rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
}
.mainCard {
  margin: auto;
}

p {
  text-align: center;
}
.username {
  text-transform: uppercase;
  font-size: 19px;
}
.account {
  width: 70%;
  margin-left: 15%;
  padding: 4px;
  border-radius: 20px;
  border: 1px solid rgb(201, 195, 195);
}
.email {
  margin-bottom: 30px;
}
.privacy {
  padding: 10px;
  margin-top: 2%;
  color: gray;
}
#Signout {
  border: 1px solid rgba(128, 128, 128, 0.61);
  padding: 4px 10px;
  border-radius: 5px;
  margin-left: 40%;
  margin-top: 5%;
  margin-bottom: 5%;
}
button:hover {
  background: rgba(209, 199, 199, 0.253);
}
.imageProfile {
  margin-left: 39%;
  margin-top: 10%;
}
.image:hover {
  cursor: pointer;
  border: 3px solid white;
}
#displaies {
  width: 100px;
  height: 100px;
  border-radius: 360px;
}
.selectImage {
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 3%;
}
#title {
  padding: 3px;
  padding-left: 23%;
  color: #fff;
  background: rgba(0, 162, 255, 0.829);
  margin-bottom: 5%;
}
</style>
