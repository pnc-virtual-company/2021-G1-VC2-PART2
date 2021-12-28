<template>
  <v-expansion-panels class="main">


    <!-- ========= Dialog Disciple =================-->
    <v-dialog width="600" v-model="showEdit">
        <v-card>
            <v-card-title class="text-h5 grey lighten-2">
                Update Disciple form
            </v-card-title>

            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col
                        cols="12"
                        sm="12"
                        >
                        <v-autocomplete
                            v-model="student"
                            :items="studentlist"
                            dense
                            label="Choose Students"
                        ></v-autocomplete>
                        </v-col>

                        <v-col 
                        cols="12" 
                        sm="12">
                        <v-select
                            v-model="leavetype"
                            :items="['sick', 'have a task to do', 'sick too', 'sick three']"
                            label="Choose leave type"
                            required
                        ></v-select>
                        </v-col>
                        <v-col 
                           cols="12" 
                          sm="12"
                        >
                          <v-menu
                              v-model="menu2"
                              :close-on-content-click="false"
                              transition="scale-transition"
                              offset-y
                              max-width="290px"
                              min-width="auto"
                          >
                            <template v-slot:activator="{ on, attrs }">
                              <v-text-field
                                v-model="computedDateFormatted"
                                label="Date (read only text field)"
                                hint="MM/DD/YYYY format"
                                persistent-hint
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                              ></v-text-field>
                            </template>
                            <v-date-picker
                              v-model="date"
                              no-title
                              @input="menu2 = false"
                            ></v-date-picker>
                          </v-menu>
                        </v-col>

                        <v-col
                        cols="12"
                        sm="12"
                        >
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

            <v-divider></v-divider>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn text @click="showEdit = false">Discard</v-btn>
                <v-btn color="success" text @click="Update(id)">Save change</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>


   
   <v-card-title>
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    
     <form-disciple
      @add-per="Adddisciple"
     ></form-disciple>

    <v-expansion-panel
        v-for="disciple of disciples " :key="disciple.id"
      >
      <v-expansion-panel-header class="header">
        <div
          class="d-flex sm-6"
          style="width: 300px"
        >
          <v-img
            class="mr-5 "
            lazy-src="https://picsum.photos/id/11/10/6"
            max-height="200"
            max-width="120"
            src="data:image/jpeg;base64,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">
          </v-img>
          <p
           class="pt-7"
          >{{disciple.type}}</p>
        </div>
        
        <div
          class="d-flex sm-6"
          style="width: 300px"
        >
          <v-img
            lazy-src="https://picsum.photos/id/11/10/6"
            max-height="200"
            max-width="120"
            src="https://picsum.photos/id/11/500/300">
          </v-img>
          <div class="username" >
            <h3 style="margin-bottom: 10px;">{{disciple.first_name}} {{disciple.last_name}}</h3>
            <p>{{disciple.Class}}</p>
          </div>
        </div>
        
        <div
          style="width: 300px"
        >
           <div class="date" style="margin-left: 58px; margin-bottom: -23px;" >
            <h4 >Date</h4>
           </div>

           <v-img
            lazy-src="https://picsum.photos/id/11/10/6"
            max-height="50"
            max-width="50"
            src="https://i.fbcd.co/products/resized/resized-750-500/fc3968fc479135343c50cdf757ee71fba560b55b90132ac4408f800047aa5e6c.jpg">
          </v-img>
        </div>

        <div
          style="
                 width: 100px;
                 "
        >
          <v-list-item-icon >
            <v-icon @click="ShowEditDialog(disciple)" class="edit">mdi-pencil-box-multiple-outline</v-icon>
          </v-list-item-icon>

          <v-list-item-icon  >
              <v-icon @click="Delete(disciple.id)" class="delete">mdi-delete</v-icon>
          </v-list-item-icon>
        </div>
        
      </v-expansion-panel-header>
      <v-expansion-panel-content>
        {{disciple.description}}
      </v-expansion-panel-content>

    </v-expansion-panel>
  </v-expansion-panels>
</template>
<script>
import axios from '../../axios-http.js';
import formDisciple from '../ui/formDisciple.vue';

export default {
  components: { formDisciple },
  data () {
    return {
      date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
      menu1: false,
      showEdit: false,
      search: '',
      disciples: [
        {
          id:1,
          type:'sick',
          description:'Welcome to me'
        },
        {
          id:2,
          type:'sick',
          description:'Welcome to you'
        },
        {
          id:3,
          type:'sick',
          description:'Welcome to her'
        },
        {
          id:4,
          type:'sick',
          description:'Welcome to his'
        }
      ],
    }
  },
  computed: {
      computedDateFormatted () {
        return this.formatDate(this.date)
      },
    },

    watch: {
      date () {
        this.dateFormatted = this.formatDate(this.date)
      },
    },
  methods: {
    formatDate(date) {
        if (!date) return null

        const [year, month, day] = date.split('-')
        return `${month}/${day}/${year}`
    },
    ShowEditDialog() {
      this.showEdit = true;
    },
    Adddisciple(disciple){
      this.disciples.push(disciple);
    },

    Delete(id){
      axios.delete('/disciples/'+ id).then(res => {
        console.log(res.data);
        this.getDisciple();
      })
    },
    Update(update) {
      console.log(update);
    },
    getDisciple(){
      axios.get('/disciples').then(res => {
        this.disciples = res.data;
      })
    },
    parseDate (date) {
      if (!date) return null

      const [month, day, year] = date.split('/')
      return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`
    }
  },
  
  mounted() {
    // this.getDisciple();
  },

  
}
</script>

<style scoped>
  .card-row{
    background:rgb(76, 231, 231);
    padding: 20px;
    margin: 50px;
    width: 90%;
    margin-left: 5%;
  }
  .username{
    padding: 10px;
    margin: 10px;
    
  }
  .v-icon {
    /* background: cornflowerblue; */
    margin-left: 170%;
    padding: 5px;
 }
 .delete {
    margin-left: 75%;
    padding: 5px;
     margin-top: 11px;
 }
 .edit{
    margin-left: 149%;
    padding: 5px;
    margin-top: 11px;
 }
  img {
    width: 20px;
    height: 50px;
    padding: 40px;
  }
  .header{
    margin-right: 5%;
    /* background: rgb(245, 250, 250); */
  }
  .main{
    width: 90%;
    margin-left: 5%;
    margin-top: 5%;
  }
</style>
