<template>
    <v-row justify="center">
        <v-dialog
        v-model="dialog"
        persistent
        max-width="600px"
        >
            <template v-slot:activator="{ on, attrs }">
                <v-btn
                class="mt-5"
                color="primary"
                dark
                v-bind="attrs"
                v-on="on"
                style="margin-left: 90%"
                >
                Create
                </v-btn>
            </template>
            <v-card>
                <v-card-title>
                    <span class="text-h5">DISCIPLE FORM</span>
                </v-card-title>
                <v-card-text>
                    <v-container>
                        <v-row>
                            <v-col
                                cols="12"
                                sm="6"

                            >
                                <v-text-field
                                v-model="firstname"
                                label=" input your first name"
                                hint="input your first name"
                                required
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="6"
                            >
                                <v-text-field
                                v-model="lastName"
                                label="input your last name"
                                hint="input your last name"
                                required
                                ></v-text-field>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="12"
                            >
                                <v-select
                                v-model="Class"
                                :items="classlist"
                                label="Choose Class"
                                required
                                ></v-select>
                            </v-col>
                            <v-col
                                cols="12"
                                sm="12"
                            >
                                <v-autocomplete
                                v-model="leave"
                                :items="leavelist"
                                label="Choose type"
                                multiple
                                ></v-autocomplete>
                            </v-col>
                            <v-col 
                            cols="12"
                            sm="12"
                            >
                                <v-textarea
                                v-model="description"
                                >
                                <template v-slot:label>
                                    <div>
                                    Bio <small>(optional)</small>
                                    </div>
                                </template>
                                </v-textarea>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="dialog = false"
                    >
                        Close
                    </v-btn>
                    <v-btn
                        color="blue darken-1"
                        text
                        @click="createDisciple"
                    >
                        Save
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </v-row>
</template>

<script>
//   import axios from '../../axios-http.js';
  export default {
    data: () => ({
      emits: ['add-user'],
      dialog: false,
      classlist:['WEB 2021A', 'WEB 2021B', 'SNA 2021', 'WEB 2022A','WEB 2022B','SNA 2022'],
      leavelist:['leavelist', 'Oral warning', 'Warning letter', 'Termination'],
      
      firstname: '',
      lastName: '',
      Class:'',
      leave:'',
      description:''
    }),

    methods: {
      createDisciple (){
        this.dialog = false;
        console.log(this.firstname);
        console.log(this.lastName);
        console.log(this.Class);
        console.log(this.leave);
        console.log(this.description);
      }
    }
  }
</script>