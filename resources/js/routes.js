import Signup from "./components/Signup.vue";
import Signin from "./components/Signin.vue";
import Admin from "./components/admin/Admin.vue";
//import Dashboard from "./components/admin/Dashboard.vue";
import Create_survey from "./components/admin/Create_survey.vue";
import Survey_list from "./components/admin/Survey_list.vue";
import Admin_login from "./components/admin/Login.vue";
import Create_question from "./components/admin/Questionier.vue";
import Survey from "./components/Survey.vue";
import Result from "./components/Result.vue";
// import main from "/components/main.vue";
// import main_admin from "/components/admin/main_admin.vue";

export default {
    mode: 'history',

    routes: [

        {
            path: '/signin',
            name: 'signin',
            component: Signin,
        },
        {
            path: '/signup',
            name: 'signup',
            component: Signup,
        },
        {
            path: '/survey',
            name: 'survey',
            component: Survey,
        },
        {
            path: '/result',
            name: 'Result',
            component: Result,
        },
        {
            path: '/admin',
            name: 'admin',
            component: Admin,

            children: [
                // {
                //     path: '/dashboard',
                //     name: 'dashboard',
                //     component: Dashboard,
                // },
                {
                    path: '/create_survey',
                    name: 'create_survey',
                    component: Create_survey,
                },
                {
                    path: '/survey_list',
                    name: 'survey_list',
                    component: Survey_list,
                },
                {
                    path: '/admin/login',
                    name: 'admin_login',
                    component: Admin_login,
                    meta: { disallowAuthed: true }
                },
                {
                    path: '/create_questionier/:id',
                    name: 'create_questionier',
                    component: Create_question,

                },
            ]
        }

    ]

}
