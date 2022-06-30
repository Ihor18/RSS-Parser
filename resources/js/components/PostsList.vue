<template>

    <div class="ml-5 mt-4 mr-5 row" v-if="$route.path==='/'">
        <h1 class="text-center col-12">Admin</h1>
        <div class="text-center mt-3 mb-4 col-6 offset-3 offset-md-4 col-md-4">
            <input class="form-control" type="text" ref="newItem" placeholder="Search by title or author"
                   @keydown.stop="findPosts">
        </div>

        <div class="text-center mt-3 mb-4 col-6 offset-3 offset-md-4 col-md-4">
            <select @change="sort($event)" class="form-select w-100">
                <option selected disabled>Sort by</option>
                <option value="title">Title</option>
                <option value="creator">Creator</option>
                <option value="pub_date">Date</option>
            </select>
        </div>
        <div class="text-center mt-3 mb-4 offset-2 col-2">
            <router-link :to="'/create'">
                <button class="btn btn-success self-offset col-8" type="submit">Create post</button>
            </router-link>
        </div>
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th class="text-center" scope="col">Title</th>
                <th class="text-center" scope="col">Author</th>
                <th class="text-center col-3" scope="col">Link</th>
                <th class="text-center" scope="col">Publish date</th>
                <th class="text-center" scope="col">Action</th>
            </tr>
            </thead>
            <tr v-for="(item,key) in list">
                <th v-html="item.title"></th>
                <td><b>{{ item.creator }}</b></td>
                <td><b>{{ item.link }}</b></td>
                <td><b>{{ item.pub_date }}</b></td>
                <td>
                    <router-link :to="'/post/'+item.id">
                        <button class="btn action-btn btn-warning">Update
                        </button>
                    </router-link>

                    <button class="btn mt-1 action-btn btn-danger" @click="removePost(item.id)">Delete</button>
                </td>
            </tr>
        </table>
        <div class="text-center row">
            <div class="w-auto m-2" v-for="(item) in pagination">
                <button class="url" v-bind:style="item.active ? 'active' :''" @click="getPosts(item.url)"
                        v-html="item.label"></button>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../api";

export default {
    name: "App",
    mounted() {
        console.log(this.getCookie('access_token'))

        this.getPosts('/api/post/');
    },
    computed: {},
    data() {
        return {
            list: [],
            response: [],
            pagination: [],
            currentUrl: String
        }
    },
    methods: {
        async getPosts(url) {
            this.currentUrl = url
            await api
                .get(url)
                .then(response => (this.response = response.data));
            this.list = this.response.data
            this.pagination = this.list.length === 10 ? this.response.meta.links : null
        },

        removePost(id) {
            api.delete('/api/post/' + id);
            this.getPosts(this.currentUrl);
        },
        findPosts() {
            let url
            if (this.$refs.newItem.value) {
                url = 'api/post/find/' + this.$refs.newItem.value
            } else {
                url = 'api/post/'
            }

            this.getPosts(url)
        },
        sort(event) {
            let url = 'api/post/sort/' + event.target.value
            this.getPosts(url)
        },
        getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

    }
}
</script>
<style>
.action-btn {
    width: 100%;
}

.active {
    font-weight: 600;
}

.url {
    background: none !important;
    border: none;
    padding: 0 !important;
    /*optional*/
    font-family: arial, sans-serif;
    /*input has OS specific font-family*/
    color: #069;
    text-decoration: underline;
    cursor: pointer;
    font-size: 16px;
}

.form-select {
    font-size: 16px;
    height: 34px;
    border-radius: 5px;
    background-color: white;
}

.self-offset {
    margin-left: 41%;
}
</style>
