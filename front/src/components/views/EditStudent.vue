<template> 
    <v-dialog persistent width="600" v-model="dialog" class="overlay">
        <v-card>
            <h2>Update Student</h2>
            <v-card-text>
              <v-row class='row'>
                <v-col cols="6" sm="6">
                    <v-text-field 
                    class="firstName"
                    v-model="firstName"
                    label="first name"  
                    outlined 
                    dense>
                    </v-text-field>
                </v-col>

                <v-col cols="6" sm="6">
                    <v-text-field 
                    class="lastName"
                    v-model="lastName"
                    label="last name"  
                    outlined 
                    dense>
                    </v-text-field>
                </v-col>
            </v-row>
            <v-col cols="12" sm="12">
                <input type="radio" id="male" name="gender" v-model="gender" value="Male" placeholder="Male"> Male
                <input type="radio" id="female" name="gender" v-model="gender" value="Female" placeholder="Female"> Female
            </v-col>
            <v-select
                v-model="Class"
                :items="items"
                label="class"
                dense
                outlined
            ></v-select>
            <v-row>
            <v-col cols="12" sm="6">
                <v-text-field 
                    v-model="phoneNumber"
                    label="Phone number"  
                    outlined 
                    dense>
                </v-text-field>
            </v-col>
            <v-col cols="12" sm="6">
                <v-text-field 
                    v-model="ngo"
                    label="Ngo"  
                    outlined 
                    dense>
                </v-text-field>
            </v-col>
            </v-row>

            <v-col
            class="d-flex"
            cols="12"
            sm="12"
            >
                <v-file-input
                  chips
                  counter
                  show-size
                  small-chips
                  v-model="picture"
                  color="deep-purple accent-4"
                  truncate-length="32"
                ></v-file-input>
            </v-col>
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="gray" text @click="Cancel">Cancel</v-btn>
                <v-btn color="green" text @click="Update ">Update</v-btn>
            </v-card-actions>

        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: ['studentData'],
    emits:['Update', 'Cancel'],

    data(){
      return{
        items: ['WEB 2021A', 'WEB 2021B', 'SNA 2021','WEB 2022A','WEB 2022B','SNA 2022'],
        dialog: true,
        row: null,
        firstName: '',
        lastName: '',
        Class: '',
        gender: '',
        phoneNumber: '',
        ngo: '',
        picture: '',
      }
    },

    methods:{
      Update(){
        let updatedStudent = {
            firstName: this.firstName,
            lastName: this.lastName,
            class: this.Class,
            gender: this.gender,
            phone: this.phoneNumber,
            ngo: this.ngo,
        }

        this.$emit('Update',this.studentData.id, updatedStudent, false);
      },
      Cancel(){
        this.$emit('Cancel', false);
      }
    },
    mounted() {
      this.firstName = this.studentData.firstName;
      this.lastName = this.studentData.lastName;
      this.Class = this.studentData.class;
      this.gender = this.studentData.gender;
      this.phoneNumber = this.studentData.phone;
      this.ngo = this.studentData.ngo;
    },
}
</script>

<style scoped>

   .overlay {
      position: fixed;
      background: #fff;
      top: 5px;
      left: 35%;
      width: 30%;
      z-index: 10;
      border-radius: 10px;
      
  }
     h2{
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
        width: 100%;
        margin-top: 2%;
        padding: 5px;
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
    input[type=number]
    {
        width: 100%;
        margin-top: 3%;
        padding: 3px;
        padding-left: 10px;
        outline: none;
         border: 1px solid rgb(194, 193, 193);
        border-radius: 5px;
    }
    .row{
        margin-top: 2%;
    }
    #female{
        margin-left: 3%;
    }
 
</style>
