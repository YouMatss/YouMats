@extends('front.layouts.master')
@section('metaTags')

    <title>{{getMetaTag($category, 'meta_title', $category->title . ' | ' . nova_get_setting_translate('site_name'))}}</title>
    <meta name="description" content="{{getMetaTag($category, 'meta_desc', nova_get_setting_translate('categories_additional_word') . ' ' . strip_tags($category->short_desc))}}">
    <meta name="keywords" content="{{getMetaTag($category, 'meta_keywords', '')}}">

    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="{{getMetaTag($category, 'meta_title', $category->title . ' | ' . nova_get_setting_translate('site_name'))}}" />
    <meta property="og:description" content="{{getMetaTag($category, 'meta_desc', nova_get_setting_translate('categories_additional_word') . ' ' . strip_tags($category->short_desc))}}" />
    <meta property="og:image" content="{{$category->getFirstMediaUrlOrDefault(CATEGORY_PATH, 'size_350_350')['url']}}" />

    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="{{getMetaTag($category, 'meta_title', $category->title . ' | ' . nova_get_setting_translate('site_name'))}}">
    <meta name="twitter:description" content="{{getMetaTag($category, 'meta_desc', nova_get_setting_translate('categories_additional_word') . ' ' . strip_tags($category->short_desc))}}">
    <meta name="twitter:image" content="{{$category->getFirstMediaUrlOrDefault(CATEGORY_PATH, 'size_350_350')['url']}}">

    <link rel="canonical" href="{{url()->current()}}" />

    <script type="application/ld+json">
          {
            "@context": "https://schema.org",
            "@type": "Store",
            "image": [
              "https://www.youmats.sa/storage/35545/Highcompressed_410811867.webp",
              "https://www.youmats.sa/storage/169/conversions/se_7-cropper.jpg",
              "https://www.youmats.sa/storage/35565/Highcompressed_1076776512.webp"
             ],
            "name": "YouMats Building Materials",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "Hamzah Ibn Abdul Muttalib Dhahrat Al Badi'ah Building No 6249, Riyadh",
              "addressLocality": "Riyadh",
              "addressRegion": "Dhahrat Al Badi'ah",
              "postalCode": "12981",
              "addressCountry": "SA"
            },
            "review": {
              "@type": "Review",
              "reviewRating": {
                "@type": "Rating",
                "ratingValue": "4",
                "bestRating": "5"
              },
              "author": {
                "@type": "Person",
                "name": "YouMats"
              }
            },
            "geo": {
              "@type": "GeoCoordinates",
              "latitude": 24.5827648,
              "longitude": -46.6285563
            },
            "url": "https://www.youmats.sa/contact-us",
            "telephone": "+9660502111754",
            "servesCuisine": "Saudi Arabia",
            "priceRange": "SAR",
            "openingHoursSpecification": [
              {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": [
                  "Monday",
                  "Tuesday",
                  "Wednesday",
                  "Thursday",
                  "Saturday",
                  "Sunday"
                ],
                "opens": "9:30",
                "closes": "17:00"
              },
              {
                "@type": "OpeningHoursSpecification",
                "dayOfWeek": [
                  "Saturday"
                ],
                "opens": "10:00",
                "closes": "17:00"
              }
            ]
          }
    </script>

    {!! $category->schema !!}
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble" itemscope itemtype="https://schema.org/BreadcrumbList">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"  itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                            <a itemprop="item" href="{{route('home')}}"><span itemprop="name">{{__('general.home')}}</span></a>
                            <meta itemprop="position" content="1" />
                        </li>
                        <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem" class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page"><span itemprop="name">{{$category->name}}</span>
                            <meta itemprop="position" content="2" />
                        </li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <div class="mb-6 bg-gray-7 py-6">
        <div class="container mb-8">
            <div class="d-flex justify-content-between border-bottom border-color-1 flex-lg-nowrap flex-wrap border-md-down-top-0 border-md-down-bottom-0 mb-3 rtl">
                <h1 class="section-title section-title__full mb-0 pb-2 font-size-22">{{(!empty($category->title)) ? $category->title : $category->name}}</h1>
            </div>
        </div>
        <div class="container">
            <div class="row flex-nowrap flex-md-wrap overflow-auto overflow-md-visble rtl">
                @foreach($children as $child)
                <div class="col-md-4 col-lg-3 col-xl-4 col-xl-2gdot4 mb-3 flex-shrink-0 flex-md-shrink-1">
                    <div class="bg-white overflow-hidden shadow-on-hover h-100 d-flex align-items-center">
                        <a href="{{route('front.category', [generatedNestedSlug($child->ancestors()->pluck('slug')->toArray(), $child->slug)])}}" class="d-block pr-2 pr-wd-6">
                            <div class="media align-items-center">
                                <div>
                                    <img loading="lazy" class="img-fluid img_category_page" src="{{$child->getFirstMediaUrlOrDefault(CATEGORY_PATH, 'size_100_100')['url']}}" alt="{{$child->getFirstMediaUrlOrDefault(CATEGORY_PATH)['alt']}}" title="{{$child->getFirstMediaUrlOrDefault(CATEGORY_PATH)['title']}}">
                                </div>
                                <div class="ml-3 media-body">
                                    <h2 class="mb-0 text-gray-90" style="font-size: 1rem;">{{$child->name}}</h2>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="mb-6 bg-md-transparent py-0">
        <div class="container">
            <div class="row mb-8">
                <div class="col-xl-12">
                    <div id="productsContainer">
                        @include('front.category.productsContainer', ['category' => $category, 'products' => $products])
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(is_individual())
        @include('front.layouts.partials.change_city')
    @endif
@endsection
