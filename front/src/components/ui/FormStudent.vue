<template>
     <div class="text-center">
        <v-dialog v-model="dialog" width="500">
            <template v-slot:activator="{ on, attrs }">
              <v-btn color="blue lighten" dark v-bind="attrs" v-on="on">+ Add student</v-btn>
          </template>

            <v-card>
                <h2>Create new Student</h2>
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
                    <input type="file" name="picture" @change="Image" style="width:100%" >
                </v-card-text>

                <v-divider></v-divider>

                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text @click="Addstudent">Create</v-btn>
                </v-card-actions>
            </v-card>
            
        </v-dialog>
  </div>
</template>

<script>
    import axios from '../../axios-http.js';
    export default {
        emits: ['add-user'],
        data () {
            return {
                dialog: false,
                firstName: '',
                lastName: '',
                Class:'',
                phoneNumber:'',
                gender:'',
                ngo: '',
                picture:'',
            }
        },
        methods: {
            Image(event){
                this.picture = event.target.files[0]
            },
            Addstudent(){
                let addStudent = new FormData();
                addStudent.append('firstName', this.firstName);
                addStudent.append('lastName', this.lastName);
                addStudent.append('class', this.Class);
                addStudent.append('phone', this.phoneNumber);
                addStudent.append('gender', this.gender);
                addStudent.append('ngo', this.ngo);
                addStudent.append('picture', this.picture);

                axios.post('/students', addStudent).then(res => {
                    console.log(res.data);
                    this.$emit('add-user', res.data);
                    this.dialog = false;
                })
            }
           
        },
    }
</script>

<style  scoped>
    .btn-student {
        float: right;
        margin-top: 20px;
        margin-right: -149px;
    }
    h2{
        text-align: center;
        padding: 10px;
        color: #fff;
        background: rgb(108, 185, 226);
    }
    
    input[type=text] {
        width: 50%;
        margin-top: 3%;
        padding: 3px;
        padding-left: 10px;
        outline: none;
        border: 1px solid rgb(194, 193, 193);
        border-radius: 5px;
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
    select{
        width: 100%;
        margin-top: 2%;
        padding: 3px;
        padding-left: 10px;
        outline: none;
        border: 1px solid rgb(194, 193, 193);
        border-radius: 5px;
    }
    input[type=radio]{
        margin-left: 10px;
        margin-top: 3%;
    }
    input[type=file]{
        width: 100%;
        margin-top: 3%;
        padding: 5px 0;
        outline: none;
    }
    .text-center{
        margin-top: 3%;
        margin-left: 79%;
        width: 10%;
    }
</style>