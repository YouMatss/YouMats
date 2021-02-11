<?php

namespace App\Http\Controllers\Front\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;

class IndexController extends Controller
{
    private function getTags($tags_ids) {
        return Tag::whereIn('id', $tags_ids)->get();
    }

    public function index($tag_slug) {
        $data['tag'] = Tag::with('products')->where('slug', $tag_slug)->first();
        abort_if(!$data['tag'], 404);

        $data['products'] = $data['tag']->products()->paginate(10);

        foreach ($data['products'] as $product) {
            foreach ($product->tags as $tag) {
                $tags_ids[] = $tag->id;
            }
        }

        $data['tags'] = $this->getTags($tags_ids);

        return view('front.tag.index')->with($data);
    }
}
