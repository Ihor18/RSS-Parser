<template>
    <div class="container">
        <h2 class="mt-4 text-center">Create post</h2>
        <div class="row ">
            <form @submit="create" method="post">
                <div class="text-center offset-2 col-8 row">
                    <div class="col-12 mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" @input="post.title = $event.target.value">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="creator" class="form-label">Creator</label>
                        <input type="text" class="form-control" @input="post.creator= $event.target.value" name="creator">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="link" class="form-label">Link</label>
                        <input type="text" class="form-control" @input="post.link = $event.target.value" name="link">
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea type="text" rows="6" class="form-control" @input="post.description = $event.target.value"
                                  name="description"></textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Categories</label>
                        <div  v-for="i in count" >
                            <input type="text" class="form-control mt-3 mb-3"  @input="post.categories.push($event.target.value)"
                                   name="category">
                        </div>

                            <button @click="increment" class="btn btn-secondary mb-5">Add category</button>
                        </div>
                    <button class="btn btn-info mb-5 offset-5 col-2" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "CreatePost",

    data() {
        return {
            post: {
                id: Number,
                title: String,
                creator: String,
                link: String,
                description: String,
                pub_date: String,
                categories: []
            },
            count:1
        }
    },
    methods: {

        create(e) {
            e.preventDefault()
            axios.post(window.location.origin + '/api/post/', this.post)
                .then(function (response) {
                    if (response.status === 200) {
                        window.location.href = window.location.origin
                    } else {
                        alert('Something wrong')
                    }
                })
        },
        increment(){
          this.count++
        }
    }
}
</script>

<style scoped>

</style>
