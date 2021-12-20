<template>
  <div class="text-center">
    <v-dialog v-model="dialog" width="500">
        <template v-slot:activator="{ on, attrs }">
            <v-btn color="blue lighten" dark v-bind="attrs" v-on="on">+ Create user</v-btn>
        </template>

        <v-card>
            <h2>Create new user</h2>
            <v-card-text>
                <input type="text" placeholder="Username">
                <input type="email" placeholder="Email">
                <input type="password" placeholder="Password">
                <label for="role">Role</label>
                <select name="role" id="role" >
                    <option value="0">Admin</option>
                    <option value="1">Social Affair</option>
                    <option value="2">Student</option>
                </select>
                <input type="file" >
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" text @click="dialog = false">Create</v-btn>
            </v-card-actions>

        </v-card>
        
    </v-dialog>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        dialog: false,
        role: 'Role',
      }
    },
  }
</script>
<style scoped>
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
    .text-center{
        background: teal;
        margin-left: 70%;
        width: 10%;
    }
</style>