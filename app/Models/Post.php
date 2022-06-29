<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $hidden = ['deleted_at', 'created_at', 'updated_at'];
    protected $guarded = [];

    public function categories(): HasMany
    {
        return $this->hasMany(PostCategory::class);
    }

    public function createRecord($data)
    {
        $categories = $data['categories'];
        $data['pub_date'] = Carbon::now();
        $data['guid'] = rand(1000000000,9999999999);
        unset($data['categories']);
        $post = Post::create($data);

        $categoryArray = [];
        foreach ($categories as $category) {
            $categoryArray[] = [
                'name' => $category,
                'post_id' => $post->id
            ];
        }
        PostCategory::insert($categoryArray);
    }

    public function updateRecord($data)
    {
        $categories = $data['categories'];
        unset($data['categories']);
        $this->update($data);
        PostCategory::where('post_id', $this->id)->delete();
        $this->createPostCategory($categories);
        $categoryArray = [];
        foreach ($categories as $category) {
            $categoryArray[] = [
                'name' => $category['name'],
                'post_id' => $this->id
            ];
        }
        PostCategory::insert($categoryArray);
    }

}
