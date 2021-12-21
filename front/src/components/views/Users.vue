<template>
  <div class="main">
    <div class="text-center">
      <v-dialog v-model="dialog" width="500">
          <template v-slot:activator="{ on, attrs }">
              <v-btn color="blue lighten" dark v-bind="attrs" v-on="on">+ Create user</v-btn>
          </template>

          <v-card>
              <h3>Create new user</h3>
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


      <div class="userLists">
          <h2>List of users</h2>
          <v-simple-table>
              <template v-slot:default>
              <thead>
                  <tr>
                      <th class="text-left">Username</th>
                      <th class="text-left">Email</th>
                      <th class="text-left">Role</th>
                      <th class="text-left">Action</th>
                  </tr>
              </thead>
              <tbody>
                  <tr v-for="item in desserts" :key="item.username">
                      <td>{{ item.username }}</td>
                      <td>{{ item.email }}</td>
                      <td>{{ item.role }}</td>
                      
                      <td><v-list-item-icon>
                          <v-icon>mdi-pencil-box-multiple-outline</v-icon>
                      </v-list-item-icon>

                      <v-list-item-icon>
                          <v-icon>mdi-delete</v-icon>
                      </v-list-item-icon></td>
                  
                  </tr>
              </tbody>
              </template>
          </v-simple-table>
      </div>

      
    </div>
</template>

<script>
export default {
  data() {
    return {
      desserts: [
        {
          username: 'Chanthy tha',
          email: 'chanthy@gmail.com',
          role: 'Admin',
        },
        {
          username: 'Vun yin',
          email: 'vun@gmail.com',
          role: 'Social Affair',
        },
        {
          username: 'Chanthea',
          email: 'chanthea@gmail.com',
          role: 'Social Affair',
        },
      
      ],
      dialog: false,
      role: 'Role',
    };
  },
};
</script>

<style scoped>
    .userLists{
        width: 90%;
        margin-left: 5%;
    }

    h2{
      margin-top: 2%;
      text-align: center;
      padding: 10px;
      color: #fff;
      background: rgb(108, 185, 226);
    }
    h3{
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
      margin-left: 84%;
      width: 10%;
      margin-top: 4%;
    }
</style>