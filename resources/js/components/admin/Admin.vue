<template>
<div v-if="$route.name==='admin_login'">
    {{this.$router.name}}
    <router-view />
</div>

<div v-else>
    <div id="wrapper">
        <!-- Top Bar Start -->
        <div class="topbar">
            <!-- LOGO -->
            <div class="topbar-left">
                <a href="" class="logo"><span
                            ><img
                                src=""
                                alt=""
                                width="95px"
                                height="50px"
                            /> </span
                        ><i
                            ><img
                                src=""
                                alt=""
                                width="60px"
                                height="25px"
                                /></i
                    ></a>
            </div>
            <nav class="navbar-custom">
                <ul class="navbar-right d-flex list-inline float-right mb-0">
                    <li class="dropdown notification-list d-none d-sm-block">
                        <form role="search" class="app-search">
                            <div class="form-group mb-0">
                                <input type="text" class="form-control" placeholder="Search.." />
                                <button type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                            </div>
                        </form>
                    </li>
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false"><i class="mdi mdi-bell noti-icon"></i>
                                <span
                                    class="badge badge-pill badge-info noti-icon-badge">

                                </span>

                        </a>
                            <div
                                class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
                                <!-- item-->
                                <h6 class="dropdown-item-text show-notifications">

                                </h6>

                                <!-- All-->
                                <a
                                    href="javascript:void(0);"
                                    class="dropdown-item text-center text-primary"
                                    >View all <i class="fi-arrow-right"></i
                                ></a>
        </div>
        </li>
        <li class="dropdown notification-list">
            <div class="dropdown notification-list nav-pro-img">
                <a class="dropdown-toggle nav-link arrow-none waves-effect text-white nav-user waves-light" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">Admin</a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                    <!-- item-->

                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:0"
                                        class="dropdown-item text-danger"
                                        type="submit"
                                        @click.prevent="admin_logout"><i
                                            class="mdi mdi-power text-danger"
                                        ></i>
                                        Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button
                                class="button-menu-mobile open-left waves-effect waves-light"
                            >
                                <i class="mdi mdi-menu"></i>
                            </button>
                        </li>

                    </ul>

                </nav>

            </div>

            <!-- Sidebar -left -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Main</li>

                             <li>
                                <router-link to="/survey_list" class="waves-effect">
                                <i class="mdi mdi-clipboard"></i>
                                    <span>
                                        Tests List
                                    </span>
                                </router-link>

                            </li>


                        </ul>

                </div>
                <!-- Sidebar -->
                <div class="clearfix"></div>
            </div>
            <!-- end Sidebar -left -->
        </div>
        <!-- content starts here -->
        <div class="content-page">
            <div class="content">

            <router-view></router-view>
            </div>
            <footer class="footer">© 2018 IT Genesis <span class="d-none d-sm-inline-block">- Crafted with <i
                        class="mdi mdi-heart text-danger"></i> IT GENESIS</span>
            </footer>
        </div>

</div>
</div>
</template>

<script>
// const token = localStorage.getItem("admin_token");
export default
{

  data(){
      return{
          admin_token: "",
      }
  },


methods:{
    admin_logout: function(){

         const url = "/api/admin/logout";
      axios
        .get(url, {
             headers: {
                  Authorization: "Bearer " + this.admin_token
              }
        })
        .then((response) => {
          if (response.status === 200) {
            localStorage.removeItem('admin_token');
            this.$router.replace({name: 'admin_login'})
          }
        })
        .catch((error) => {});

        //window.location.href = "/admin/login";
    },
    get_token(){
        var token = localStorage.getItem("admin_token")
        this.admin_token = token
    }
},
 beforeCreate() {
        if (localStorage.getItem('admin_token') == null || localStorage.getItem('login_token') == ""){
        this.$router.replace({name: 'admin_login'});
     }
},
mounted(){
    this.get_token()
},
updated(){
    this.get_token()
},

}
</script>

<style scoped>

</style>
