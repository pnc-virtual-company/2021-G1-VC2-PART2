<template>
  <div class="overlay">
    <div class="mainCard">

      <!-- ===================Display profile==================== -->

      <img v-if="userinfo.role == 'Admin' " src="../../assets/icon.png" alt="">
      <img v-else-if="userinfo.role == 'Student' " :src="student_url + userinfo.student.picture" alt="">
      <img v-else :src="url + userinfo.profile" alt="">

      <p class="username">{{userinfo.username}}</p>
      <p class="email">{{userinfo.email}}</p>
      <p class="account">Manage your Account</p>
      <hr>
      <button @click="Signout">Sign out</button>
      <hr>
      <p class="privacy">Privacy Policy • Terms of Service</p>
    </div>
  </div>
</template>

<script>
export default {
  props: ['userinfo'],
  emits: ['signOut'],
  data(){
    return{
      student_url: "http://127.0.0.1:8000/storage/imagestudent/",
      url: "http://127.0.0.1:8000/storage/imageUser/",
    }
  },
  methods: {
    Signout(){
      this.$emit('signOut',false);
    }
  },
};
</script>

<style scoped>
.overlay {
  position: fixed;
  background: #fff;
  top: 55px;
  right: 0px;
  left:71.8%;
  width: 28%;
  z-index: 10;
  border-radius: 10px;
  box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;
}
.mainCard{
  margin: auto;
}
img{
  width: 80px;
  height: 80px;
  margin-left: 39%;
  margin-top: 10%;
  border-radius: 360px;
}
p{
  text-align: center;

}
.username{
  text-transform: uppercase;
  font-size: 19px;
}
.account{
  width: 70%;
  margin-left: 15%;
  padding: 4px;
  border-radius: 20px;
  border: 1px solid rgb(201, 195, 195);
}
.email{
  margin-bottom: 30px;
}
.privacy{
  padding: 10px;
  margin-top: 2%;
  color: gray;
}
button{
  border: 1px solid rgba(128, 128, 128, 0.61);
  padding:4px 10px;
  border-radius: 5px;
  margin-left: 40%;
  margin-top: 5%;
  margin-bottom: 5%;
}
button:hover{
  background: rgba(209, 199, 199, 0.253);
}
/* hr{
  border: 1px solid rgb(221, 221, 221);
} */
</style>
