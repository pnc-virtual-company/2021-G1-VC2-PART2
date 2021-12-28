<template> 
   <v-dialog persistent width="600" v-model="dialog" class="overlay">
      <v-card>
        <h2 id="edit">Do you want to update?</h2>
        <v-card-text>
          <v-col
            cols="12"
            sm="12"
          >
              <div>
                <v-text-field 
                v-model="username"
                label="Username"  
                outlined 
                dense>
                </v-text-field>
              </div>
          </v-col>
          <v-col
            cols="12"
            sm="12"
          >
            <div>
              <v-text-field 
              v-model="email"
              label="Email"  
              outlined 
              dense>
              </v-text-field>
            </div>
          </v-col>
          
          <v-col
            cols="12"
            sm="12"
          >
            <v-select
              v-model="role"
              :items="items"
              label="Role"
              dense
              outlined
            ></v-select>
          </v-col>

           <v-col
            cols="12"
            sm="12"
            >
                <v-file-input
                  chips
                  counter
                  show-size
                  small-chips
                  v-model="image"
                  color="deep-purple accent-4"
                  truncate-length="32"
                ></v-file-input>
            </v-col>
          
          </v-card-text>
    
         <v-divider></v-divider>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn @click="cancel" color="primary " text >Cancel</v-btn>
            <v-btn @click="Update" color="success" text >Update</v-btn>
        </v-card-actions>
      
      </v-card>
   </v-dialog>
</template>

<script>
export default {
    props: ['data'],
    emits:['update', 'cancel'],

    data(){
      
      return{
        items: ['Admin', 'Social Affair', 'Student'],
        dialog: true,
        username: '',
        email: '',
        role: '',
        image: '',
      }
    },

    methods:{
      Update(){
        let user = {
          username: this.username,
          email: this.email,
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
