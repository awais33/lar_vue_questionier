<template>
    <div class="wrapper-page">
    <div class="card">
        <div class="card-body"><h3 class="text-center m-0">

                <a href="index.html" class="logo logo-admin"><img
                        src="" height="30" alt="logo"></a></h3>
            <div class="p-3"><h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                <p class="text-muted text-center">Sign in to continue to Dashboard.</p>
                <form class="form-horizontal m-t-30" action="/api/user/login" method="post"
                v-on:submit.prevent="submit_login">

                <span v-if="errors[0]" class="alert-danger p-2 text-center">{{ errors }}</span>

                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            v-model="email"
                            placeholder="Enter Email">

                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            v-model="password"
                            placeholder="Enter password">

                    </div>
                    <div class="form-group row">
                        <div class="col-6">
                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="m-t-40 text-center"><p class="text-grey">Don't have an account ?
        <router-link to="/signup" class="text-primary"> SignupNow </router-link>
        </p>

    </div>

</div><!-- END wrapper --><!-- jQuery  -->

</template>

<script>
const axios = require("axios").default;
export default {
    props: {
    source: String
  },
   beforeCreate() {
        //localStorage.setItem("access_token", '');
        if (!localStorage.getItem('login_token') == null || !localStorage.getItem('login_token') == ""){
        this.$router.push('/survey')
     }

   },
data() {
    return {
        email: "",
        password: "",
        errors: [],
    }
},

methods: {
    submit_login: async function(){

axios.post('/api/user/login', {
    email: this.email,
    password: this.password,
    })
    .then(response => {
        if(response.status === 200){
        localStorage.setItem('login_token', response.data.token);
        this.$router.push({name: 'survey'})
        }
    })
    .catch(error => {
        if (error.response.status == 400) {
        //this.$router.push({path: '/signup'})
        this.errors = error.response.data.error;
        }
        });

    }
},
}
</script>

<style scoped>

</style>
