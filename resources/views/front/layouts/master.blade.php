<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="all" />
    @yield('metaTags')
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-58Q2BVQ');</script>
        <!-- End Google Tag Manager -->
        

        <!-- Google Analytics -->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-J03ZH2LNSG"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-J03ZH2LNSG');
        </script>

        <!-- Google web master -->
        <meta name="google-site-verification" content="42jgsTk384G-j5A58b0eoyX-aR9ozjFnnLeymC27O2c" />
        
        
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


        @include('front.layouts.partials.assets')
    </head>
    <body>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-58Q2BVQ"
                          height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        @include('front.layouts.partials.header')
        <main id="content" role="main">
            @yield('content')
            @if(\Request::route()->getName() != 'cart.show' && \Request::route()->getName() != 'home')
                @include('front.layouts.partials.partners')
            @endif
            @if(\Request::route()->getName() != 'cart.show' && \Request::route()->getName() != 'front.faqs.page')
                @include('front.layouts.partials.faqs')
            @endif
        </main>
        @include('front.layouts.partials.footer')
        @include('front.layouts.partials.welcome-popup')
        @include('front.layouts.partials.search')
        @include('front.layouts.partials.assets_js')
        @stack('chat')
    </body>
</html>
