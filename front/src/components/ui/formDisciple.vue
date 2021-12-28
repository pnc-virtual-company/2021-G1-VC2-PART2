<template>
    <v-row justify="center">
        <v-dialog
        v-model="dialog"
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
                                sm="12"
                            >
                                <v-autocomplete
                                    v-model="student_id"
                                    :items="studentLists"
                                    label="Choose student"
                                    rows='1'
                                    prepend-icon='mdi-account'
                                ></v-autocomplete>
                            </v-col>

                            <v-col
                                cols="12"
                                sm="12"
                            >
                                <v-autocomplete
                                v-model="leave"
                                :items="leavelist"
                                label="Choose discipline notice type"
                                multiple
                                rows='1'
                                prepend-icon='mdi-alert-outline'
                                ></v-autocomplete>
                            </v-col>

                             <v-col
                                cols="12"
                                sm="12"
                                >
                                <v-textarea
                                v-model="description"
                                class="mx-2"
                                label="Description"
                                rows="1"
                                prepend-icon="mdi-comment-processing-outline"
                            ></v-textarea>
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
                        color="green darken-1"
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

  import axios from '../../axios-http.js';

  export default {
    data: () => ({
      emits: ['add-user'],
      dialog: false,
      classlist:['WEB 2021A', 'WEB 2021B', 'SNA 2021', 'WEB 2022A','WEB 2022B','SNA 2022'],
      leavelist:['leavelist', 'Oral warning', 'Warning letter', 'Termination'],
      studentLists: ['A', 'B','C','D'],
      
      student_id: '',
      leave:'',
      description:''
    }),

    methods: {
        createDisciple (){
            let newDiscipline = {
                student_id: this.student_id,
                leaveList_discipline:this.leave,
                description: this.description
            }
            axios.post('/disciples', newDiscipline ).then(res => {
                console.log(this.student_id = res.data);
                this.$emit('add-user', res.data);
                this.dialog = false;
            })
            console.log(newDiscipline);
        }
    }
  }
</script>