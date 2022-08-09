<?php

namespace App\Console\Commands;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Crawler\Crawler;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        for ($skip = 0; $skip >= 5; $skip++) {
//            echo $skip . ' - ';
//            die();
//        }
//        $sitemap = SitemapGenerator::create(public_path('sitemap_products.xml'))->getSitemap();

//            $products = Product::skip($skip)->take(1000)->get();
//            foreach ($products as $product) {
//                try {
//                    $categories = generatedNestedSlug(optional(optional(optional($product->category)->ancestors())->pluck('slug'))->toArray(), $product->category->slug);
//                } catch (\Exception $e) {
//                    continue;
//                }
//                $route = route('front.product', [$categories, $product->slug]);
//                $sitemap->add(Url::create($route)
//                    ->setLastModificationDate(Carbon::now())
//                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
//                    ->setPriority(0.8));
//                $route_en = str_replace('https://www.youmats.sa/', 'https://www.youmats.sa/en/', $route);
//                $sitemap->add(Url::create($route_en)
//                    ->setLastModificationDate(Carbon::now())
//                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
//                    ->setPriority(0.8));
//            }

//        $sitemap->writeToFile(public_path('sitemap_products.xml'));


        // modify this to your own needs
        SitemapGenerator::create(config('app.url'))
            ->configureCrawler(function (Crawler $crawler) {
                $crawler->setMaximumDepth(2);
            })
            ->writeToFile(public_path('sitemap.xml'));
    }
}
