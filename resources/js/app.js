require('./bootstrap');
window.Vue = require('vue');


import main from './components/main.vue';
import VueRouter from 'vue-router';
import routes from './routes';

Vue.use(VueRouter);

export const serverBus = new Vue();
new Vue({
    el: '#app',
    router: new VueRouter(routes),
    components: {
        'main-component': main
    },
    // render: h => h(main),
});
