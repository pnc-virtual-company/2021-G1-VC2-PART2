<template>
        <nav>
            <div class="navbar">
               
                <ul>
                    <div class="circle">
                        <img v-if="userInfo.role == 'Admin' " src="../../assets/icon.png" alt="">
                        <img v-else :src="url + userInfo.profile" alt="">
                    </div>
                    <p>{{userInfo.username}}</p>

                    <v-list-item color='green' v-if="isRole" :to="{ path: '/user' }">
                        <v-icon>mdi-account-circle-outline</v-icon>
                        <v-list-item-title>Users</v-list-item-title>
                    </v-list-item>

                    <v-list-item color='green' :to="{ path: '/student' }">                     
                        <v-icon>mdi-account-group-outline</v-icon> 
                        <v-list-item-title>Students</v-list-item-title>                
                    </v-list-item>

                    <v-list-item color='green' :to="{ path: '/permission' }">                      
                        <v-icon>mdi-comment-account-outline</v-icon>
                        <v-list-item-title>Permission</v-list-item-title>                
                    </v-list-item>

                    <v-list-item color='green' :to="{ path: '/disciple' }">                      
                        <v-icon>mdi-account-multiple-outline</v-icon> 
                        <v-list-item-title class="white-text">Disciple</v-list-item-title>                
                    </v-list-item>

                </ul>
                <div class="navbar-right">
                    <div class="blog">
                        <span>{{userInfo.role}}</span>
                        <v-btn icon class="btn-Signout">
                            <v-icon @click="Signout" style="font-size:35px;color: white;">mdi-import</v-icon>
                        </v-btn>
                    </div>
                    
                </div>
            </div>
        </nav>
    
</template>

<script>
    import axios from '../../axios-http.js';
    export default {
        emits: ['sign-out'],
        data(){
            return{
                isSignout: false,
                isRole: false,
                userid: '',
                userInfo: '',
                token: null,
                url: "http://127.0.0.1:8000/storage/imageUser/",
            }
        },
        methods: {
            Signout(){
                this.$emit('sign-out', this.isSignout);
                this.$router.push('/');
                localStorage.clear();
            }
        },
        mounted() {
            this.token = localStorage.getItem('token');
            this.userid = localStorage.getItem('user_id');
            
            axios.get('/users').then(res => {
                if(this.token !== null && this.token !== null){
                    for(let user of res.data){
                        if(user.id == this.userid){
                            this.userInfo = user
                            
                            if(user.role == "Admin"){
                                this.isRole = true;
                            }
                        }
                    }
                }
            })
        },
    
    }
</script>

<style scoped>
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }
    img{
        width: 40px;
        height: 40px;
        margin-top: 8px;
        border-radius: 360px;
    }
   
    .navbar {
        display: flex;
        justify-content: space-between;
        background-color: white;
    }
    nav{
        position: sticky;
        top: 0;
        box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
    }
    ul {
        display: flex;
        padding:0px 10px;
        margin: 0px 15px;
    }
    .navbar-right {
        padding: 0px;
        width: 400px;
    }
    .navbar-right:before {
        content: '';
        position: absolute;
        height: 100%;
        margin: 0;
        right: -50px;
        width: 30%;
        transform: skew(-40deg);
        background-color: #4397dbfd;
    }
    .navbar-right:after {
        content: '';
        position: absolute;
        height: 10%;
        z-index: -1;
        right: 10%;
        width: 200px;
        background-color: rgb(107, 97, 238);
    }
    .blog {
        display: flex;
        float: right;
        position: relative;
        z-index: 9;
    }
    .btn-Signout {
        color: rgb(252, 248, 248);
        font-size: 30px;
        text-transform: uppercase; 
        text-decoration: none;
        cursor: pointer;
        margin-top: 10px;
        margin-right: 20px;
    }
    .circle {
        float: left;
        border-radius: 50%;
        margin: 0px 3px;
        margin-right: 10px;
    }
    p{
        margin-top: 16px;
        margin-right: 10px;
    }
    span{
        margin-right: 200px;
        margin-top: 5%;
        color: #fff;
    }
    
</style>
