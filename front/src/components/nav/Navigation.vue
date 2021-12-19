<template>
    <div>
        
        <nav>
            <div>
                <div class="circle"></div>
            </div>
            <div class="navbar">
                <ul>
                    <li><a href="#">User</a></li>
                    <li><a href="#">Student</a></li>
                    <li><a href="#">Permission</a></li>
                    <li><a href="#">Disciple</a></li>
                </ul>
                <div class="navbar-right">
                    <div class="blog">
                        <v-btn icon class="btn-Signout">
                            <v-icon style="font-size:35px;color: white;">mdi-import</v-icon>
                        </v-btn>
                    </div>
                    
                </div>
            </div>
        </nav>
    </div>


    
</template>

<script>
    export default {
        
    }
</script>

<style scoped>
    body {
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }
    nav {
        background-color: #2196f3;
        
    }
    .navbar {
        display: flex;
        justify-content: space-between;
    }
    ul {
        display: flex;
    }
    ul li {
        list-style: none;
        margin: 20px;
    }
    li a {
        /* margin-left: 10px; */
        color: #fff;
        text-decoration: none;
        padding: 1rem;
        text-transform: uppercase;
    }
    .navbar-right {
        /* margin-right: -50px; */
        /* background-color: purple; */
        padding: 0px;
        width: 400px;
    }
    .navbar-right:before {
        content: '';
        position: absolute;
        /* bottom: 0; */
        height: 64px;
        z-index: 1;
        right: -50px;
        width: 30%;
        transform: skew(-40deg);
        background-color: #1562a1fd;
    }
    .navbar-right:after {
        content: '';
        position: absolute;
        /* bottom: 0; */
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
        /* font-weight: 700; */
        text-transform: uppercase; 
        text-decoration: none;
        /* margin:  20px; */
        cursor: pointer;
        margin-top: 12px;
        margin-right: 20px;
    }
    .circle {
        float: left;
        background: rgb(218, 198, 198);
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin: 10px;
        margin-right: 30px;
      
    }
    
</style>