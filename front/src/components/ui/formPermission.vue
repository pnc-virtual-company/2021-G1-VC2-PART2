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
          Create new Permission
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
                 
                  required
                ></v-text-field>
              </v-col>
              <!-- <v-col
                cols="12"
                sm="6"
                md="4"
              >
                <v-text-field
                  label="Legal middle name"
                  hint="example of helper text only on focus"
                   persistent-hint
                ></v-text-field>
              </v-col> -->
              <v-col
                cols="12"
                sm="6"
                md="6"
              >
                <v-text-field
                  label="last name"
                  hint="input your lastname"
                  required
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                sm="12"
              >
                <v-select
                  :items="['0-17', '18-29', '30-54', '54+']"
                  label="Choose students"
                  required
                ></v-select>
              </v-col>
              <v-col
                cols="12"
                sm="12"
              >
                <v-autocomplete
                filled
                >
                </v-autocomplete>
              </v-col>
              
             <v-col
                cols="12"
                sm="12"
             >
                <v-row >
                    <v-col
                    cols="12"
                    sm="6"
                    >
                        <v-date-picker
                            v-model="dates"
                            range
                        ></v-date-picker>
                    </v-col>
                    <v-col
                    cols="12"
                    sm="6"
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
                sm="6"
              >
                <v-select
                  :items="['sick', 'have a task to do', '30-54', '54+']"
                  label="Choose leave type"
                  required
                ></v-select>
              </v-col>
              <v-col
                cols="12"
                sm="6"
              >
                <v-autocomplete
                  :items="['Sokhom', 'Ice hockey', 'Soccer', 'Basketball', 'Hockey', 'Reading', 'Writing', 'Coding', 'Basejump']"
                  label="Teachers"
                  multiple
                ></v-autocomplete>
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
            @click="dialog = false"
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
    }),
  }
</script>