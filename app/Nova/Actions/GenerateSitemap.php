<?php

namespace App\Nova\Actions;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $category = $models[0];

        $path = public_path('sitemap-' . $category->slug . '.xml');

        $sitemap = SitemapGenerator::create($path)->getSitemap();

        $children_categories = Category::descendantsAndSelf($category->id);

        foreach ($children_categories as $children_category) {
            try {
                $route = route('front.category', [generatedNestedSlug(optional(optional(optional($children_category)->ancestors())->pluck('slug'))->toArray(), $children_category->slug)]);
            } catch (\Exception $e) {
                continue;
            }
            $sitemap->add(Url::create($route)
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8));
            $route_en = str_replace('https://www.youmats.com/', 'https://www.youmats.com/en/', $route);
            $sitemap->add(Url::create($route_en)
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8));
        }

        $products = Product::whereIn('category_id', $children_categories->pluck('id'))->get();

        foreach ($products as $product) {
            try {
                $categories = generatedNestedSlug(optional(optional(optional($product->category)->ancestors())->pluck('slug'))->toArray(), $product->category->slug);
                $route = route('front.product', [$categories, $product->slug]);
            } catch (\Exception $e) {
                continue;
            }
            $sitemap->add(Url::create($route)
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8));
            $route_en = str_replace('https://www.youmats.com/', 'https://www.youmats.com/en/', $route);
            $sitemap->add(Url::create($route_en)
                ->setLastModificationDate(Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.8));
        }

        $sitemap->writeToFile($path);
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
