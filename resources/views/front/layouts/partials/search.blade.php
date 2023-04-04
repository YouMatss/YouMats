<script>

    document.addEventListener('DOMContentLoaded', function() {
        let xhr,
            timer1,
            timeoutVal = 300,
            searchDiv = $("#searchDiv");

        function AdjustWidth(){

                let one = document.getElementById("SearchBar");
                    let two = document.getElementById("SearchInnerDiv");
                    style = window.getComputedStyle(one);
                    wdt = style.getPropertyValue('width');
                    two.style.width = wdt;

            }

        function doTheSuggestion(url) {
            let searchRegionGrid = $('#searchRegionGrid');
            url += '&include=category,categoryCount';
            if(xhr && xhr.readyState != 4) {
                xhr.abort();
            }
            xhr = $.ajax({
                url: url,
                type: 'GET',
                beforeSend: function () {

                    AdjustWidth();
                    //searchRegionGrid.html(`<div class="mx-auto mt-8" style="margin-left: auto!important;"><i class="fa fa-spin fa-spinner fa-6x"></i></div>`);

                },
                success: function (response) {

                    searchDiv.removeClass('d-none');
                    searchDiv.html(response);
                    AdjustWidth();
                    $.HSCore.components.HSRangeSlider.init('.js-range-slider');
                    $.HSCore.components.HSQantityCounter.init('.js-quantity');

                }
                
            });
        }
        function doTheMagic(url) {

                url += '&include=tags,tagsCount,category,categoryCount';
                if(xhr && xhr.readyState != 4) {
                    xhr.abort();
                }
                window.location = url;
        }

        $(document).on('ready', function () {
            //HANDLE SEARCH HERE

            $("#searchProductInput, #searchProductInputMobile").keyup( function(e) {

                let searchText = $("#searchProductInput").val(),
                    codes = [9, 16, 17, 18, 19, 20, 27, 33, 35, 36, 37, 38, 39, 40, 44, 45, 91, 92, 93, 112,
                            113, 114, 115, 116, 117, 118, 119, 120, 121, 122, 123, 144, 145, 182, 183];
                if (e.keyCode == 13 || $.inArray(e.keyCode, codes) == -1) {
                    timer = window.setTimeout(() => {
                        let CategoriesSearchBar = $("#CategoriesSearchBar").val();
                        if(CategoriesSearchBar > 0){
                            doTheSuggestion("{{ route('products.suggest') }}?filter[name]=" + searchText + "&filter[has_categories]=" + CategoriesSearchBar + ",");
                        }else{
                            doTheSuggestion("{{ route('products.suggest') }}?filter[name]=" + searchText + "&filter[has_categories]=");
                        }
                        
                    }, timeoutVal);
                }
            });
            $("#searchProductInput, #searchProductInputMobile").click( function(e) {

                document.getElementById("u-header__section").style.position = "static";
                document.getElementById("header").style.position = "static";
                document.getElementById("SearchBar").style.zIndex = "99999";
                document.getElementById("SearchBarMoblie").style.zIndex = "99999";
                document.getElementById("SearchFace").style.cssText = "width:100%;height:1000vh;background:black;position:absolute;z-index:1005;opacity:0.5;";

            });
            $(document).on('click', '#SearchFace', function(e) {

                document.getElementById("u-header__section").style.position = "relative";
                document.getElementById("header").style.position = "relative";
                document.getElementById("SearchBar").style.zIndex = "relative";
                document.getElementById("SearchBarMoblie").style.zIndex = "relative";
                document.getElementById("SearchFace").style.cssText = "";
                searchDiv.addClass('d-none');
            });


           //HANDLE SEARCH HERE
            $(document).on('click', '#searchProductBtnMobile', function(e) {
                //e.preventDefault();
                let searchTextMobile = $("#searchProductInputMobile").val();
                doTheMagic("{{ route('products.search') }}?filter[name]=" + searchTextMobile + "&filter[has_categories]=,");

            });

            $(document).on('click', '#searchProductBtn', function () {
                let searchText = $("#searchProductInput").val();
                doTheMagic("{{ route('products.search') }}?filter[name]=" + searchText + "&filter[has_categories]=" + CategoriesSearchBar + ",");
            });

            let input = document.getElementById("searchProductInput");
            input.addEventListener("keypress", function(event) {
                if (event.key === "Enter") {
                    event.preventDefault();
                    document.getElementById("searchProductBtn").click();
                }
            });

        });

    });


</script>
