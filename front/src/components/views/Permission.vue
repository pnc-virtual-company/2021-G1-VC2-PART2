<template>
<div class="card">
  <!-- ==========search button=============== -->
   <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
        class="search"
      ></v-text-field>
    <!-- ================================== -->
    <!-- ==========card======================== -->
  <v-expansion-panels class="main">
    <v-expansion-panel
      v-for="(item,i) in 2"
      :key="i">
      <v-expansion-panel-header class="header">
        <v-img
          lazy-src="https://picsum.photos/id/11/10/6"
          max-height="150"
          max-width="50"
          src="https://icons-for-free.com/iconfiles/png/512/doctors+health+hospital+medical+medicine+icon-1320184696812504400.png"></v-img>
        <div>
        <p>12-12-2021 / Morning</p>
        <p>0.5 day</p>
        </div>
        <v-img
          lazy-src="https://picsum.photos/id/11/10/6"
          max-height="100"
          max-width="100"
          src="https://i.pinimg.com/originals/3a/74/5d/3a745d3dcba72feb73e44e399ec97bea.jpg"
        ></v-img>
        <div>
        <h3>PHAKACHAN PHON</h3>
        <br>
        <p>2021WEB</p>
        </div>
         <v-row class="btn" align="center" justify="space-around">
        <v-btn tile color="#81D4FA">
          <v-icon>mdi-pencil</v-icon>
        </v-btn>
        <v-btn tile color="#EF9A9A">
          <v-icon>mdi-delete </v-icon>
        </v-btn>
      </v-row>
      </v-expansion-panel-header>
      <!-- ======space================== -->
      <v-expansion-panel-content>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
      </v-expansion-panel-content>

    </v-expansion-panel>
  </v-expansion-panels>
  </div>
 
</template>
<style scoped>
  .card-row{
    background:rgb(248, 253, 253);
    padding: 20px;
    margin: 50px;
    width: 90%;
    margin-left: 5%;
  }
  .header{
    margin-right: 5%;
    background: #d0e9fc;
  }
  .main{
    width: 90%;
    margin-left: 5%;
    margin-top: 2%;
  }
   .card{
      margin-top: 2%;
      width: 80%;
      margin-left: 10%;
    }
    h3 ,p{
      text-align: center;
    }
   .search{
     width: 40%;
     margin-left: 5%;
   }
</style>