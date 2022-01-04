<template>
  <v-app>
    <app-nav app v-if="isSignin" @sign-out="ShowCard"></app-nav>
    <profile v-if="profile" :userinfo="userInfo" @signOut='Signout'></profile>
    <v-main>
      <router-view v-if="isMenu" @sign-in="Signin" />
    </v-main>
   
  </v-app>

</template>

<script>
import Navigation from "./components/nav/Navigation.vue";
import Profile from './components/views/Profile.vue';
export default {
  name: "App",
  components: {
    "app-nav": Navigation,
    "profile": Profile,
  },
  data: () => ({
    profile: false,
    isSignin: false,
    isMenu: true,
    userInfo: '',
  }),

  methods: {
    Signin(signin) {
      this.isSignin = signin;
    },
    ShowCard(userInfo,show) {
      this.userInfo = userInfo;
      this.profile = show;
    },

    Signout(isFalse){
      localStorage.clear();
      this.isSignin = isFalse;
      this.$router.push('/');
      this.profile = false;
    }
  },
  mounted() {
    let userToken = localStorage.getItem("token");
    let userid = localStorage.getItem("user_id");
    let userRole = localStorage.getItem("role");

    if (userToken !== null && userid !== null) {
      this.isSignin = true;
      if (userRole == "Admin") {
        this.$router.push("/user");
      } else {
        this.$router.push("/student");
      }
    }
  },
};
</script>
<style scoped>
* {
  background-color: #fff;
}
</style>
