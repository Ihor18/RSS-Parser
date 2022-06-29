<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\PostCategory;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return PostResource::collection(Post::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {
            $data = $request->validated();
            (new Post)->createRecord($data);

            return response('Created!', 201);
        } catch (\Exception $ex) {
            return response('Something wrong', 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post->load('categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        try {
            $data = $request->validated();
            $post->updateRecord($data);

            return response('Updated!', 200);
        } catch (\Exception $ex) {
            return response('Something wrong', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            PostCategory::where('post_id', $post->id)->delete();
            $post->delete();
        }

        return response()->noContent();
    }

    public function find(string $name): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $posts = Post::where('title', 'like', "%$name%")->orWhere('creator', 'like', "%$name%")->paginate(10);

        return PostResource::collection($posts);
    }

    public function filter(FilterRequest $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $categories = PostCategory::where('name', $request->category)->pluck('id')->toArray();
        $posts = Post::find($categories);

        return PostResource::collection($posts->load('categories'));
    }

    public function sort(string $field)
    {
        $posts = Post::orderBy($field)->paginate(10);

        return PostResource::collection($posts);
    }
}
