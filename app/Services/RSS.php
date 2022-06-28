<?php

namespace App\Services;

use App\Interfaces\Parser;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use willvincent\Feeds\Facades\FeedsFacade;

class RSS implements Parser
{

    public function parse() : void
    {
        $feed = FeedsFacade::make('https://lifehacker.com/rss', true);
        $items = $feed->get_items();

        foreach ($items as $item) {

            //Для того, щоб дані не перезаписувались
            $isRecordExist = Post::where('guid',$item->data['child'][""]['guid'][0]['data'])->first();

            if(!$isRecordExist) {
                $post = Post::create([
                    'title' => $item->data['child'][""]['title'][0]['data'],
                    'creator' => $item->data['child']["http://purl.org/dc/elements/1.1/"]['creator'][0]['data'],
                    'link' => $item->data['child'][""]['link'][0]['data'],
                    'description' => $item->data['child'][""]['description'][0]['data'],
                    'pub_date' => $item->data['child'][""]['pubDate'][0]['data'],
                    'guid' => $item->data['child'][""]['guid'][0]['data']
                ]);

                foreach ($item->data['child'][""]['category'] as $category) {
                    PostCategory::create([
                        'name' => $category['data'],
                        'post_id' => $post->id
                    ]);
                }
            }
        }
    }
}
