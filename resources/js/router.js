import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// import About from './pages/About.vue'
import Home from './pages/Home.vue'
// import Blog from './pages/Blog.vue'
import SingleDoctor from './pages/SingleDoctor.vue'
import NotFound from './pages/NotFound.vue'

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        // {
        //     path: "/about",
        //     name: "about",
        //     component: About
        // },
        // {
        //     path: "/blog",
        //     name: "blog",
        //     component: Blog
        // },
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