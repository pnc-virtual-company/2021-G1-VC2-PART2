<template>
  <nav>
    <div class="navbar">
      <div class="mainImg">
        <img class="image" src="../../assets/pn-logo.png" alt="">

        <div class="title">
          <p id="student">Students life</p>
          <p id="management">Management</p>
        </div>
      </div>
      
      <ul>
        <v-list-item color="green" v-if="isRole" :to="{ path: '/user' }">
          <v-icon>mdi-account-circle-outline</v-icon>
          <v-list-item-title>Users</v-list-item-title>
        </v-list-item>

        <v-list-item color="green" :to="{ path: '/student' }">
          <v-icon>mdi-account-group-outline</v-icon>
          <v-list-item-title>Students</v-list-item-title>
        </v-list-item>

        <v-list-item color="green" :to="{ path: '/permission' }">
          <v-icon>mdi-comment-account-outline</v-icon>
          <v-list-item-title>Permission</v-list-item-title>
        </v-list-item>

        <v-list-item color="green" :to="{ path: '/disciple' }">
          <v-icon>mdi-account-multiple-outline</v-icon>
          <v-list-item-title class="white-text">discipline</v-list-item-title>
        </v-list-item>
      </ul>
      
      <div class="navbar-right">
        <div class="blog">
          <span>{{ userInfo.role }}</span>

          <div class="circle">
            <button @click="Signout">
              <img
                class="profileImg"
                v-if="userInfo.role !== 'Student'"
                :src="url + userInfo.profile"
                alt=""
              />
              <img  class="profileImg" v-else :src="student_url + userInfo.student.picture" alt="" />

            </button>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
import axios from "../../axios-http.js";
export default {
  emits: ["sign-out"],
  data() {
    return {
      showbtn: false,
      show: false,
      isRole: false,
      userid: "",
      userInfo: "",
      token: null,
      url: "http://127.0.0.1:8000/storage/imageUser/",
      student_url: "http://127.0.0.1:8000/storage/imagestudent/",
    };
  },
  methods: {
    Signout() {
      this.show = !this.show;
      this.$emit("sign-out", this.userInfo, this.show);
    },
  },
  mounted() {
    this.token = localStorage.getItem("token");
    this.userid = localStorage.getItem("user_id");

    axios.get("/users").then((res) => {
      if (this.token !== null && this.token !== null) {
        for (let user of res.data) {
          if (user.id == this.userid) {
            this.userInfo = user;
            console.log(this.userInfo);

            if (user.role == "Admin") {
              this.isRole = true;
            }
          }
        }
      }
    });

    
  },
};
</script>

<style scoped>
body {
  margin: 0;
  padding: 0;
  font-family: sans-serif;
}
.title{
  height: 7vh;
  margin-left: 5%;
}
#management{
  margin-top: -30%;
  font-style: italic;
}
#student{
  margin-top: -1%;
  font-style: italic;
}
.mainImg{
  display: flex;
  margin-left: 2%; 
  margin-top: 6px;
}
.image{
  width: 45px;
  height: 45px;
 
}
.profileImg {
  width: 40px;
  height: 40px;
  margin-top: 8px;
  border-radius: 360px;
  margin-left: -95px;
}

.navbar {
  display: flex;
  /* justify-content: space-between; */
  background-color: white;
}
nav {
  position: sticky;
  top: 0;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px,
    rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
}
ul {
  display: flex;
  padding: 0px 10px;
  margin: 0px 15px;
}
.navbar-right {
  display: flex;
  justify-content: flex-end;
  padding: 0px;
  width: 800px;
}
.navbar-right:before {
  content: "";
  position: absolute;
  height: 100%;
  margin: 0;
  right: -50px;
  width: 30%;
  transform: skew(-40deg);
  background-color: #4397dbfd;
}
.navbar-right:after {
  content: "";
  position: absolute;
  height: 10%;
  z-index: -1;
  right: 10%;
  width: 200px;
  background-color: rgb(107, 97, 238);
}
.blog {
  display: flex;
  float: right;
  position: relative;
}
.btn-Signout {
  color: rgb(252, 248, 248);
  font-size: 30px;
  text-transform: uppercase;
  text-decoration: none;
  cursor: pointer;
  margin-top: 10px;
  margin-right: 20px;
}
.circle {
  float: left;
  border-radius: 50%;
  margin: 0px 3px;
  margin-right: 10px;
}
span {
  margin-right: 200px;
  margin-top: 6%;
  color: #fff;
}
p{
  font-size: 16px;
}

</style>
