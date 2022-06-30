require('./bootstrap');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/PostsList'
import Post from './components/Post'
import CreatePost from "./components/CreatePost";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/post/:id',
            component: Post
        },
        {
            path: '/create',
            component: CreatePost
        }
    ],
});

window.onload = function () {
    const app = new Vue({
        el: '#app',
        components: {App},
        router,
    });

}

