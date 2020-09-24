"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports["default"] = void 0;

var _Signup = _interopRequireDefault(require("./components/Signup.vue"));

var _Signin = _interopRequireDefault(require("./components/Signin.vue"));

var _Admin = _interopRequireDefault(require("./components/admin/Admin.vue"));

var _Dashboard = _interopRequireDefault(require("./components/admin/Dashboard.vue"));

var _Create_survey = _interopRequireDefault(require("./components/admin/Create_survey.vue"));

var _Survey_list = _interopRequireDefault(require("./components/admin/Survey_list.vue"));

var _Login = _interopRequireDefault(require("./components/admin/Login.vue"));

var _Questionier = _interopRequireDefault(require("./components/admin/Questionier.vue"));

var _Survey = _interopRequireDefault(require("./components/Survey.vue"));

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { "default": obj }; }

// import main from "/components/main.vue";
// import main_admin from "/components/admin/main_admin.vue";
var _default = {
  mode: 'history',
  routes: [{
    path: '/signin',
    name: 'signin',
    component: _Signin["default"]
  }, {
    path: '/signup',
    name: 'signup',
    component: _Signup["default"]
  }, {
    path: '/survey',
    name: 'survey',
    component: _Survey["default"]
  }, {
    path: '/admin',
    name: 'admin',
    component: _Admin["default"],
    children: [{
      path: '/dashboard',
      name: 'dashboard',
      component: _Dashboard["default"]
    }, {
      path: '/create_survey',
      name: 'create_survey',
      component: _Create_survey["default"]
    }, {
      path: '/survey_list',
      name: 'survey_list',
      component: _Survey_list["default"]
    }, {
      path: '/admin/login',
      name: 'admin_login',
      component: _Login["default"],
      meta: {
        disallowAuthed: true
      }
    }, {
      path: '/create_questionier/:id',
      name: 'create_questionier',
      component: _Questionier["default"]
    }]
  }]
};
exports["default"] = _default;