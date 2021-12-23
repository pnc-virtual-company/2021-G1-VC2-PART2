<template>
  <v-row justify="center" class="mt-4 mr-10 float-right">
    <v-dialog
      v-model="dialog"
      persistent
      max-width="600px"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="primary"
          dark
          v-bind="attrs"
          v-on="on"
        >
          Create
        </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">Permission</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col
                cols="12"
                sm="6"
                md="6"
              >
                <v-text-field
                  label="first name"
                  hint="input your firstname"
                  v-model="firstname"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
                md="6"
              >
                <v-text-field
                  label="last name"
                  hint="input your lastname"
                  v-model="lastName"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="6"
              >
                <v-autocomplete
                  v-model="student"
                  :items="studentlist"
                  dense
                  filled
                  label="Choose Students"
                ></v-autocomplete>
              </v-col>
              <v-col
                cols="12"
                sm="6"
              >
                  <v-autocomplete
                    v-model="teacher"
                    :items="teacherlist"
                    dense
                    filled
                    label="Choose Teacher"
                  ></v-autocomplete>
              </v-col>
          
            <!-- Date picker -->
              <v-col
                cols="12"
                sm="12"
                class="dates"
                
              >
                <v-row>
                  <v-col
                    cols="12"
                    sm="7"
                  >
                    <v-date-picker
                      v-model="dates"
                      range
                      class="color"
                    ></v-date-picker>
                  </v-col>
                  <v-col
                    cols="12"
                    sm="5"
                  >
                    <v-text-field
                      v-model="dateRangeText"
                      label="Date range"
                      prepend-icon="mdi-calendar"
                      readonly
                    ></v-text-field>
                    model: {{ dates }}
                  </v-col>
                </v-row>
              </v-col>
              

              <v-col
                cols="12"
                sm="12"
              >
                <v-select
                  v-model="leavetype"
                  :items="['sick', 'have a task to do', 'sick too', 'sick three']"
                  label="Choose leave type"
                  required
                ></v-select>
              </v-col>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
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
            @click="createPermission"
          >
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
  export default {
    data: () => ({
      dialog: false,
      dates: [],
      items: ['foo', 'bar', 'fizz', 'buzz'],
      studentlist:['chanthy', 'chanthea', 'sreytouch', 'srey vun'],
      teacherlist:['Sim', 'Vandy', 'Davy', 'Thaina', 'Phuty', 'Somkhan'],
      values: ['foo', 'bar'],
      value: null,

      
      firstname: '',
      lastName: '',
      student:'',
      teacher:'',
      leavetype:''

    }),
    methods: {
      createPermission (){
        this.dialog = false;
        console.log(this.firstname);
        console.log(this.lastName);
        console.log(this.student);
        console.log(this.teacher);
        console.log(this.leavetype);
        console.log(this.dates);
      
      }
    },
    computed: {
      dateRangeText () {
        return this.dates.join(' ~ ')
      },
    },
  }
</script>
<style scoped>
  .dates {
  background:#E1F5FE;
  border-radius: 10px;
  }
</style>