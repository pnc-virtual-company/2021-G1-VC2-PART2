<template>
  <v-app>
    <div class="backgruond"></div>
    <v-main class="d-flex justify-center align-center">
      <v-col cols="10" lg="4" class="mx-auto">
        <v-card class="pa-4">
          <!-- =============logo/header======== -->
          <div class="text-center">
            <v-avatar size="100" color="indigo lighten-4">
              <img src="https://www.passerellesnumeriques.org/wp-content/uploads/2016/03/pn-logo.png" alt="">
            </v-avatar>
            <h2 class="indigo--text">STUDENT LIFE</h2>
          </div>
            <!-- =============form login======== -->
          <v-form @submit.prevent="submitHandler" ref="form">
            <v-card-text>
              <v-text-field
                v-model="email"
                :rules="emailRules"
                type="email"
                label="Email"
                placeholder="Email"
                prepend-inner-icon="mdi-account"
                required
              />
              <v-text-field
                      v-model="password"
                      :rules="passwordRules"
                      :type="passwordShow?'text':'password'"
                      label="Password"
                      placeholder="Password"
                      prepend-inner-icon="mdi-key"
                      :append-icon="passwordShow ? 'mdi-eye':'mdi-eye-off'"
                      @click:append="passwordShow = !passwordShow"
                      required
              />
              <!-- <v-switch label="Remember me" color="#E65100"></v-switch> -->
            </v-card-text>
            <v-card-actions class="justify-center">
               <!-- =============button submit signin======== -->
              <v-btn :loading="loading" type="submit" color="#E65100">
                <span class="white--text px-8">Login</span>
              </v-btn>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-col>
    </v-main>
     <!-- =============Message when we signin success======== -->
    <v-snackbar top color="green" v-model="snackbar">
      Login success
    </v-snackbar>
  </v-app>
</template>

<script>

export default {
  name: 'signin',


  data: () => ({
    loading:false,
    snackbar:false,
    passwordShow:false,
    email: '',
    emailRules: [
      v => !!v || 'E-mail is required',
      v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
    ],
    password: '',
    passwordRules: [
      v => !!v || 'Password is required',
      v => (v && v.length >= 8) || 'Password must be 8  characters or more!',
    ],
  }),
  methods:{
    submitHandler(){
      if (this.$refs.form.validate()){
          this.loading = true
        setTimeout(()=> {
          this.loading = false
          this.snackbar = true
        },3000)
      }
    }
  }
};
</script>
<style>
  .backgruond{
    background-image: url(https://www.passerellesnumeriques.org/wp-content/uploads/2020/04/template-image-news-website-1080x400.png) !important;
    height: 300px;
    width: 100%;
    display: block;
    position: absolute;
    top: 0;
    background-size: cover;
  }
</style>