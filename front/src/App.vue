<template>
  <v-app>
    <sign-in></sign-in>
    <v-main>
      <router-view/>
    </v-main>
  </v-app>
</template>

<script>
import Signin from './components/signin/signin.vue'
export default {
  name: 'App',
  components: {"sign-in":Signin,},
  data: () => ({
    //
  }),
};
</script>
