<template>
    <div class="wrapper-page">
    <div class="card">
        <div class="card-body"><h3 class="text-center m-0">

                <a href="index.html" class="logo logo-admin"><img
                        src="" height="30" alt="logo"></a></h3>
            <div class="p-3"><h4 class="text-muted font-18 m-b-5 text-center">Welcome Back !</h4>
                <p class="text-muted text-center">Sign in to continue to Dashboard.</p>
                <form class="form-horizontal m-t-30" action="/api/admin/login" method="post"
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
                            <span v-if="errors.email" class="text-danger">{{
                errors.email[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            v-model="password"
                            placeholder="Enter password">
                            <span v-if="errors.password" class="text-danger">{{
                errors.password[0]}}</span>

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

</div><!-- END wrapper --><!-- jQuery  -->

</template>

<script>
const axios = require("axios").default;
export default {
    props: {
    source: String
  },
   beforeCreate() {
        if (!localStorage.getItem('admin_token') == null || !localStorage.getItem('admin_token') == ""){
        this.$router.push('/admin')
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

axios.post('/api/admin/login', {
    email: this.email,
    password: this.password,
    })
    .then(response => {
        if(response.status === 200){
        localStorage.setItem('admin_token', response.data.token);
        this.$router.push('/admin');
        }
    })
    .catch(error => {
        if (error.response.status == 400) {
        //this.$router.push({path: '/signup'})
        this.errors = error.response.data.error;
        }

        if (error.response.status == 422) {
        //this.$router.push({path: '/signup'})
        this.errors = error.response.data;
        }
        });

    }
},
}
</script>

<style scoped>

</style>
