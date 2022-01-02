<template>
    <div class="header">
       <div class="main">
        <div class="content">
            <img src="../../assets/pn-logo.png" alt="">
            <div class="title">
                <span>Cambodia</span>
                <h1>student life</h1>
            </div>
         
        </div>
       
        <v-col cols="4" class="loading">
            <v-progress-linear
                color="green lighten-1"
                indeterminate
                rounded
                height="6"
            ></v-progress-linear>
        </v-col>
        </div> 
    </div>
    
   
</template>

<style scoped>
    .header{
        height: 100vh;
        background-image: url('https://cdn.pixabay.com/photo/2020/02/24/18/05/background-4876988_1280.jpg') !important;
        height: 100vh;
        width: 100%;
        background-size: cover;
    }
    .content{
        margin-left: 34%;
        display: flex;
    }
    .title{
        margin-top: 24%;
        margin-left: 3%;
    }
    img{
        margin-top: 20%;
        width: 150px;
        height: 150px;
    }
    span{
        font-size: 35px;
        text-transform: uppercase;
        color:white;
    }
    h1{
        margin-top: 6%;
        text-transform: uppercase;
        color: orange;
    }
    .loading{
        margin-left: 34%;
        margin-top: 7%;
    }
</style>

