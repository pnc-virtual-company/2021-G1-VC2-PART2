<template> 
    <div class="overlay">
      <v-card>
        <h2 id="edit">Do you want to update?</h2>
        <v-card-text>
          <input type="text" placeholder="Username" v-model="username">
          <input type="email" placeholder="Email" v-model="email">
          <input type="password" placeholder="Password" v-model="password">
          <label for="role">Role :</label>
          <select name="role" v-model="role">
              <option value="Select role" disabled>select role</option>
              <option value="Admin">Admin</option>
              <option value="Social Affair">Social Affair</option>
              <option value="Student">Student</option>
          </select>
          <input type="file" >
          </v-card-text>
    
         <v-divider></v-divider>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn @click="cancel" color="primary " text >Cancel</v-btn>
            <v-btn @click="Update" color="success" text >Update</v-btn>
        </v-card-actions>
      
      </v-card>
  </div>
</template>

<script>
export default {
    props: ['data'],
    emits:['update', 'cancel'],

    data(){
      return{
        username: '',
        email: '',
        password: '',
        role: '',
      }
    },

    methods:{
      Update(){
        let user = {
          username: this.username,
          email: this.email,
          password: this.password,
          role: this.role,
        }

        this.$emit('update',this.data.id, user, false);
      },
      cancel(){
        this.$emit('cancel', false);
      }
    },
    mounted() {
      this.username = this.data.username;
      this.email = this.data.email;
      this.password = this.data.password;
      this.role = this.data.role;
      console.log(this.data);
    },
}
</script>

<style scoped>

   .overlay {
      position: fixed;
      background: #fff;
      top: 5%;
      left: 35%;
      width: 35%;
      z-index: 100;
      border-radius: 10px;
      box-shadow: rgba(50, 74, 85, 0.26) 0px 2px 4px 0px, rgba(70, 97, 109, 0.178) 0px 2px 16px 0px;
  }
   h2{
    text-align: center;
    padding: 10px;
    color: #fff;
    background: rgb(108, 185, 226);
  }
  h3{
    text-align: center;
    padding: 10px;
    color: #fff;
    background: rgb(108, 185, 226);
  }
  input[type=text],
  input[type=email],
  input[type=password]
  {
      width: 100%;
      margin-top: 3%;
      padding: 5px;
      outline: none;
        border: 1px solid rgb(194, 193, 193);
      border-radius: 5px;
  }
  select{
      width: 30%;
      margin-top: 2%;
      margin-left: 2%;
      padding: 2px;
      outline: none;
      border: 1px solid rgb(194, 193, 193);
      border-radius: 5px;
  }
  input[type=password]{
      margin-bottom: 2%;
  }
  input[type=file]{
      width: 100%;
      margin-top: 3%;
      padding: 5px 0;
      outline: none;
  }
</style>
