import { createWebHistory, createRouter } from 'vue-router';

import Post from "./components/Post";
import CreatePost from "./components/CreatePost";

const routes = [
    {
        path: '/post/:id',
        component: Post
    },
    {
        path: '/create',
        component: CreatePost
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
