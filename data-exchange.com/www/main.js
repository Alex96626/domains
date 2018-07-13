import Vue from 'vue'
import VueRouter from 'vue-router';

import App from './App.vue'

import Index from "./pages/Index.vue"
import Profile from "./pages/Profile.vue"
import Products from "./pages/Products.vue";
import User from "./pages/User.vue";
import Lot from "./pages/Lot.vue";

Vue.use(VueRouter);

const router = new VueRouter({
  routes: [
    { path: "/", component: Index },
    { path: "/profile", component: Profile },
    {path: "/products", component: Products},
    {path: "/user/:id", name: "idUser",  component: User},
    {path: "/lot/:id", name: "idProd",  component: Lot}
  ]
});

new Vue({
  el: '#app',
  router,
  components: {
    App
  }
  //render: h => h(App)
})
