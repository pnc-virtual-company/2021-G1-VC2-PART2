<template>
  <v-app>
    <app-nav  app v-if="isSignin" @sign-out="Signout"></app-nav>
  
    <v-main>
      <router-view @sign-in="Signin"/>
    </v-main>
  </v-app>
</template>

<script>
  import Navigation from './components/nav/Navigation.vue';
  export default {
    name: 'App',
    components: {
      "app-nav": Navigation,
    },
    data: () => ({
      isSignin: false,
    }),
    methods: {
      Signin(signin){
       this.isSignin = signin;
      },
      Signout(signout){
        this.isSignin = signout;
      }
    },
    mounted() {
      let userid = localStorage.getItem('userid');
      if(userid !== null){
        this.isSignin = true;
        // this.$router.push('/user');
      }
    },
  };
</script>
<style scoped>
  *{
    background-color: rgb(205, 227, 255);
  }
</style>
