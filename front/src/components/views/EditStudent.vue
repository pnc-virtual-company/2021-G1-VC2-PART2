<template> 
    <v-dialog width="600" v-model="dialog" class="overlay">
        <v-card>
            <h2>Update Student</h2>
            <v-card-text>
                <input type="text" placeholder="First name" v-model="firstName">
                <input type="text" placeholder="last name" v-model="lastName">
                <select name="class" id="class" v-model="Class">
                    <option selected disabled>Choose class</option>
                    <option value="WEB 2021A">WEB 2021A</option>
                    <option value="WEB 2021B">WEB 2021B</option>
                    <option value="SNA 2021">SNA 2021</option>
                    <option value="WEB 2022A">WEB 2022A</option>
                    <option value="WEB 2022B">WEB 2022B</option>
                    <option value="SNA 2022">SNA 2022</option>
                </select>
            
                <input type="radio" name="fav_language" value="Female" v-model="gender">Female
                <input type="radio" name="fav_language" value="Male" v-model="gender">Male
                <input type="number" placeholder="Phone number" v-model="phoneNumber">
                <input type="text" placeholder="NGO" v-model="ngo">
                <input type="file" name="picture" style="width:100%" >
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
        dialog: true,
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
 
</style>
