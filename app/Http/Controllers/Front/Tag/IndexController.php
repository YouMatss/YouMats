<?php

namespace App\Http\Controllers\Front\Tag;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class IndexController extends Controller
{
    private function getTags($tags_ids) {
        return Tag::whereIn('id', $tags_ids)->get();
    }

    public function index($tag_slug) {
        $data['tag'] = Tag::with('products')->where('slug', $tag_slug)->first();
        abort_if(!$data['tag'], 404);

        $data['products'] = $data['tag']->products()->inRandomOrder()->paginate(20);

        $tags_ids = [];

        foreach ($data['products'] as $product) {
            foreach ($product->tags as $tag) {
                $tags_ids[] = $tag->id;
            }
        }

        $data['tags'] = $this->getTags($tags_ids);

        return view('front.tag.index')->with($data);
    }

    /**
     * @param $search_keyword
     * @return Application|Factory|View
     */
    public function searchKeywordsTags($search_keyword) {
        $data['keyword'] = $search_keyword;
        $data['products'] = Product::where('active', true)
            ->where("search_keywords->" . app()->getLocale(), "LIKE", "%$search_keyword%")
            ->inRandomOrder()->paginate(20);

        return view('front.tag.search_keywords_tags')->with($data);
    }
}
