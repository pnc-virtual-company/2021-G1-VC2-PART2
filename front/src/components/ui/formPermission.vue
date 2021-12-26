<template>
  <div class="text-center">
    <v-dialog
      v-model="dialog"
      width="600"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="blue lighten-2"
          dark
          v-bind="attrs"
          v-on="on"
        >
        New permission
        </v-btn>
      </template>

      <v-card>
        
        <v-card-title class="text-h5 grey lighten-2">
          Add Permission
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              
              <v-col cols="12" sm="6">
                <v-autocomplete
                  v-model="studentId"
                  :items="studentlist"
                  dense
                  label="Choose Students"
                ></v-autocomplete>
              </v-col>

              <v-col cols="12" sm="6">
                <v-autocomplete
                  v-model="teacher"
                  :items="teacherlist"
                  dense
                  label="Choose Teacher"
                ></v-autocomplete>
              </v-col>

              <v-col cols="12" sm="12">
                <v-select
                  v-model="leavetype"
                  :items="['sick', 'have a task to do', 'sick too', 'sick three']"
                  label="Choose leave type"
                  required
                ></v-select>
              </v-col>
        
              <v-col cols="6" sm="12">
                <label for="startDate">Start date: </label>
                <input type="date" name="date" v-model="startDate">
                <label for="endDate" style="margin-left:15%">End date: </label>
                <input type="date" name="date" v-model="endDate">
              </v-col>

              <v-col cols="12" sm="12">
                <v-text-field
                  label="Description"
                  hint="input your description"
                  v-model="description"
                  required
                ></v-text-field>
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
            @click="createPermission"
          >
            Save
          </v-btn>
        </v-card-actions>

      </v-card>
    </v-dialog>
  </div>
</template>

<script>
  export default {
    emits: ['add-per'],
    data: () => ({
      dialog: false,
      studentlist:['chanthy', 'chanthea', 'sreytouch', 'srey vun'],
      teacherlist:['Sim', 'Vandy', 'Davy', 'Thaina', 'Phuty', 'Somkhan'],
      value: null,
      
      studentId:'',
      teacher:'',
      leavetype:'',
      startDate: '',
      endDate: '',
      description: '',

    }),
    methods: {
      createPermission (){
        this.dialog = false;
        let addpermission = {
          student_id: this.studentId,
          teacher: this.teacher,
          leavetype: this.leavetype,
          startDate: this.startDate,
          endDate: this.endDate,
          description: this.description,
        }
        this.$emit('add-per', addpermission);
        console.log(addpermission);
      
      }
    },
    
  }
</script>
<style scoped>
  .text-center{
    margin-left: 76%;
    margin-bottom: -50px;
  }
  .dates {
  background:#E1F5FE;
  border-radius: 10px;
  }
  input[type=date]{
    outline: none;
  }
</style>