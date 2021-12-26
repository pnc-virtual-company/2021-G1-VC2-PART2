<template>
        <nav>
            <div class="navbar">
               
                <ul>
                    <div class="circle">
                        <img :src="url + userInfo.profile" alt="">
                    </div>
                    <p>{{userInfo.username}}</p>

                    <v-list-item v-if="isRole" :to="{ path: '/user' }">
                        <v-list-item-icon>
                            <v-icon>mdi-account-circle-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Users</v-list-item-title>
                    </v-list-item>

                    <v-list-item :to="{ path: '/student' }">
                        <v-list-item-icon>
                            <v-icon>mdi-account-group-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Students</v-list-item-title>
                    </v-list-item>

                    <v-list-item :to="{ path: '/permission' }">
                        <v-list-item-icon>
                            <v-icon>mdi-comment-account-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>Permission</v-list-item-title>
                    </v-list-item>

                    <v-list-item :to="{ path: '/disciple' }">
                        <v-list-item-icon>
                            <v-icon>mdi-account-multiple-outline</v-icon>
                        </v-list-item-icon>
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
                userID: '',
                userInfo: null,
                profile: '',
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
            this.username = localStorage.getItem('username');
            this.profile = localStorage.getItem('profile');
            axios.get('/users').then(res => {
                for(let user of res.data){
                    if(user.username == this.username && user.profile == this.profile && this.token !== null){
                        this.userInfo = {username: user.username, role: user.role, profile: user.profile}
                        
                        if(user.role == "Admin"){
                            this.isRole = true;
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
        width: 100%;
        height: 100%;
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
        /* z-index: 1; */
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
        width: 260px;
        height: 50px;
        border-radius: 50%;
        margin: 3px;
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
