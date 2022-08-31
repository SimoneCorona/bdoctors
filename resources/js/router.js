import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// import About from './pages/About.vue'
import Home from './pages/Home.vue'
import Doctors from './components/Doctors.vue'
import SingleDoctor from './pages/SingleDoctor.vue'
import NotFound from './pages/NotFound.vue'
import AdvancedSearch from './pages/AdvancedSearch.vue'

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/search/:specialty",
            name: "advanced-search",
            component: AdvancedSearch
        },
        {
            path: "/doctors",
            name: "doctors",
            component: Doctors
        },
        {
            path: "/doctor/:slug",
            name: "single-user",
            component: SingleDoctor
        },
        {
            path: "/*",
            name: "not-found",
            component: NotFound,
        }
    ]
 });
  
 export default router;