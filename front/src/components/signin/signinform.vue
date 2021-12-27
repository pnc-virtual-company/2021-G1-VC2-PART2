<template>
  <v-app>
        <div class="main">
            <v-col cols="10" lg="4" class="title">
              <v-avatar size="130">
                  <img src="../../assets/pn-logo.png" alt="">
              </v-avatar>
              <div class="head">
                <h2>STUDENT LIFE</h2>
                <p>Cambodia</p>
              </div>
            </v-col>
            <v-col cols="10" lg="4" class="content">
                <!-- =============logo/header======== -->
                <div class="text-center">
                    <v-avatar size="130">
                        <img src="../../assets/icon.png" alt="">
                    </v-avatar>
                </div>
                    <!-- =============form login======== -->
                <v-form @submit.prevent="submitHandler" ref="form">
                    <v-card-text>
                        <v-text-field
                            color="blue lighten-2"
                            class="email"
                            v-model="email"
                            :rules="emailRules"
                            type="email"
                            label="Email"
                            placeholder="Email"
                            prepend-inner-icon="mdi-account"
                            required
                        />
                        <v-text-field
                            color="blue lighten-2"
                            class="password"
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
                   
                    </v-card-text>
                    
                    <v-card-actions class="justify-center">
                    <!-- =============button submit signin======== -->
                    <v-btn :loading="loading" type="submit" color="blue" class="button">
                        <span class="white--text px-8">Login</span>
                    </v-btn>
                    </v-card-actions>
                </v-form>
            
            </v-col>
        </div>
        <!-- =============Message when we signin success======== -->
        <v-snackbar top class="message" color="green" v-model="snackbar">Login success</v-snackbar>
        
  </v-app>
</template>

<script>
import axios from '../../axios-http';
export default {
  emits: ['sign-in'],
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
    message: '',
    Issignin: true,
  }),

  methods:{
    submitHandler(){
      if (this.$refs.form.validate()){
        let signin = {
          email: this.email,
          password: this.password,
        }

       // this.loading = true;
        // setTim eout(()=> {
        //   this.loading = false
        //   this.snackbar = true
        // },3000)
        axios.post('/signin', signin).then(res => {
          localStorage.setItem("token", res.data.token);
          localStorage.setItem("role", res.data.user.role);
          localStorage.setItem("user_id", res.data.user.id);
          localStorage.setItem("studentId", res.data.user.student_id);
          console.log(res.data);
          // this.loading = false;
          this.$emit('sign-in', this.Issignin);
          if(res.data.user.role == 'Admin'){
            this.$router.push('/user');
          }else{
            this.$router.push('/student');
          }
        })
        
      }
    }
  }
};
</script>

<style scoped>
  .main{
    display: flex;
    justify-content: space-evenly;
    align-content: center;
    background-image: url('https://cdn.pixabay.com/photo/2020/02/24/18/05/background-4876988_1280.jpg') !important;
    height: 100vh;
    width: 100%;
    background-size: cover;
  }
  .content{
    height: 70vh;
    margin-top: 7%;
    border-radius: 10px;
    background: rgb(255, 255, 255);
  }
  .title{
    height: 55%;
    margin-top: 10%;
    margin-left: 5%;
    width: 50%;
    border-right:2px solid white;
    display: flex;
    align-items: center;
  }
  .message{
    margin-left: 25%;
  }
  .head{
    margin-top: 7%;
    margin-left: 3%;
  }
  h2{
    color: #fff;
  }
  p{
    color:rgb(30, 236, 236);
  }
  .button:hover{
    background: rgb(60, 60, 240);
  }
 
</style>