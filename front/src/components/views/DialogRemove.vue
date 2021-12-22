<template>
  <v-container>
    <v-layout row justify-center>
      <v-dialog v-model="dialog" max-width="500">
       
        <template v-slot:activator="{ on }">
          <v-btn color="error" dark v-on="on">
            <v-icon small left>mdi-delete</v-icon>
            <span>remove</span>
          </v-btn>
        </template>
      
        <v-card>
          <v-card-top class="d-flex" id="dialog_remove">
            <v-card-img>
              <v-img
                lazy-src="../../assets/pn-logo.png"
                height="80"
                width="80"
                src="../../assets/pn-logo.png"
                class="pa-2 ma-2"
              ></v-img>
            </v-card-img>
            <v-card-sub>
              <v-card-title class="headline">Remove User</v-card-title>
              <v-card-text>
                Are you sure that you want to remove this user?
              </v-card-text>
            </v-card-sub>
          </v-card-top>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn @click="dialog = false" color="info">No</v-btn>
            <v-btn @click="DeleteStudent" color="error">Yes</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-layout>
  </v-container>
</template>

<script>
import axios from '../../axios-http.js';
export default {
    props: ['delete'],
    data(){
        return{
            dialog: false,
        }
    },
    methods: {
        DeleteUser() {
            console.log(this.delete);
            axios.delete('/users/' + this.delete).then(res => {
                console.log(res.data);
                this.dialog = false;
                this.getUsers();
            })
        },
    },
};
</script>

<style scoped>
#dialog_remove {
  border-top: 7px solid rgb(0, 195, 255);
}
</style>