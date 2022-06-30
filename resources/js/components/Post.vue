<template>
    <div class="container">
        <h2 class="mt-4 text-center">Update post</h2>
        <div class="row ">
            <form @submit="update" method="post">
                <div class="text-center offset-2 col-8 row">
                    <div class="col-12 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" v-model="post.title">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="creator" class="form-label">Creator</label>
                        <input type="text" class="form-control" v-model="post.creator" name="creator">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input type="text" class="form-control" v-model="post.link" name="link">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" rows="6" class="form-control" v-model="post.description"
                                  name="description"></textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Categories</label>
                        <div v-for="(item) in post.categories">
                            <input type="text" class="form-control mt-3 mb-3" v-model="item.name" name="category">
                        </div>
                    </div>
                    <button class="btn btn-info mb-5 offset-5 col-2" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import api from "../api";

export default {
    name: "App",
    mounted() {
        this.getPost()
    },

    computed: {},
    data() {
        return {
            post: {
                id: Number,
                title: String,
                creator: String,
                link: String,
                description: String,
                pub_date: String,
                categories: Array
            },

        }
    },
    methods: {
        async getPost() {
            await api
                .get(window.location.origin + '/api/post/' + this.$route.params.id)
                .then(response => (this.post = response.data.data));
        },
        update(e) {
            e.preventDefault()
            api.put(window.location.origin + '/api/post/' + this.$route.params.id, this.post)
                .then(function (response) {
                        if (response.status === 200){
                            window.location.href = window.location.origin
                        }else{
                            alert('Something wrong')
                        }
                })


        }
    }
}
</script>

