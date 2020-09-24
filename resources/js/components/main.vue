<template>
<div v-if="$route.path === '/admin/login'">
    <Login />
</div>
<div v-else>
<div class="bs-example">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <a href="#" class="navbar-brand">Brand</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
            <div class="navbar-nav">
                <router-link to="/" class="nav-item nav-link active">Home</router-link>

            </div>
            <!-- <form class="form-inline">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </form> -->
            <div class="navbar-nav">
                <button
                class="btn btn-primary" @click="login"
                v-show="is_login"> Login</button>
                <button class="btn btn-primary"
                @click="logout" v-show="!is_login"> Logout </button>

            </div>
        </div>
        </nav>
        <div v-if="$route.path ==='/'" class="row mt-2">
            <div class="col-md-8 m-auto text-center">
                <router-link to="/survey" class="btn btn-primary h4 align-items-center"> Take Test </router-link>
            </div>
        </div>
        <div v-else>
        <router-view></router-view>
        </div>
</div>
</div>
</template>

<script>
import Login from './admin/Login'
    export default {
        data(){
            return{
                is_login: true,
            }
        },
        components:{
            Login
        },
        beforeCreate(){

        },

        methods:{
            logout(){
                localStorage.removeItem('login_token')
                //this.logout_state = true
                 this.$router.push({name: 'signin'})
            },

            login(){
               // this.logout_state = false
                this.$router.push({name: 'signin'})
            },
            check_login(){
                if(localStorage.getItem('login_token') === null){
                this.is_login = true
            }
            else{
                this.is_login = false
            }
            }
        },
        mounted(){
            this.check_login()
        },
        updated(){
            this.check_login()
        }

    }
</script>

<style scoped>

</style>
