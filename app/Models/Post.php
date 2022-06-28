<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = ['title','creator'];
    protected $hidden = ['deleted_at','created_at','updated_at'];
    protected $guarded = [];

    public function categories(): HasMany
    {
        return $this->hasMany(PostCategory::class);
    }

    public function createRecord($data){
        $categories = $data['category'];
        unset($data['category']);
        $post = Post::create($data);
        $post->createPostCategory($categories);
    }

    public function updateRecord($data){

        $categories = $data['category'];
        unset($data['category']);
        $this->update($data);
        PostCategory::where('post_id', $this->id)->delete();
        $this->createPostCategory($categories);
    }

    private function createPostCategory($categories){
        $categoryArray = [];

        foreach ($categories as $category) {
            $categoryArray[] = [
                'name' => $category,
                'post_id' => $this->id
            ];
        }
        PostCategory::createMany($categoryArray);
    }
}
