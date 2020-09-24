<template>
   <div class="wrapper-page">
      <div class="card">
        <div class="card-body">

          <div class="p-3">
            <h4 class="text-muted font-18 m-b-5 text-center">Free Register</h4>
            <p class="text-muted text-center">
              Get your free Account now.
            </p>
            <form
              class="form-horizontal m-t-30"
              method="post"

              v-on:submit.prevent = "submit_register"
            >
             <div class="form-group">
                <label for="name">Name</label>
                <input
                  type="text"
                  class="form-control"
                  id="name"
                  name="name"
                  v-model="name"
                  placeholder="Enter Name"
                />
                <span v-if="errors.name" class="text-danger">{{
                errors.name[0]}}</span>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  v-model="email"
                  placeholder="Enter email"
                />
                <span v-if="errors.email" class="text-danger">{{
                errors.email[0]}}</span>
              </div>

              <div class="form-group">
                <label for="password">Password</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  name="password"
                  v-model="password"
                  placeholder="Enter password"
                />
                <span v-if="errors.password" class="text-danger">{{
                errors.password[0]}}</span>
              </div>

              <div class="form-group">
                <label for="password">Confirm Password</label>
                <input
                  type="password"
                  class="form-control"
                  name="password_confirmation"
                  v-model="password_confirmation"
                  id="password"
                  placeholder="Confirm Password"
                />
                <span v-if="errors.password" class="text-danger">{{
                errors.password[0]}}</span>
              </div>

              <div class="form-group row m-t-20">
                <div class="col-12 text-right">
                  <button
                    class="btn btn-primary w-md waves-effect waves-light"
                    type="submit"
                  >
                    Register
                  </button>
                </div>
              </div>
              <div class="form-group m-t-10 mb-0 row">
                <div class="col-12 m-t-20">
                  <p class="font-14 text-muted mb-0">
                    By registering you agree to the Agroxa
                    <a href="#" class="text-primary">Terms of Use</a>
                  </p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="m-t-40 text-center">
        <p class="text-muted">
          Already have an account ?
          <a href="pages-login.html" class="text-white">Login</a>
        </p>
      </div>
    </div>
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
        name: "",
        email: "",
        password: "",
        password_confirmation: "",
        errors: [],
    }
},

methods: {
    submit_register: async function(){
axios.post('/api/user/register', {
    name: this.name,
    email: this.email,
    password: this.password,
    password_confirmation: this.password_confirmation,
    })
    .then(response => {
        localStorage.setItem('login_token', response.data.token)
    })
    .catch(error => {
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
