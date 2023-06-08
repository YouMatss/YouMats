<script>

    document.addEventListener('DOMContentLoaded', function() {
        let xhr,
            timer1,
            timeoutVal = 300,
            searchDiv = $("#searchDiv");

        function AdjustProperties(){
            if(screen.availWidth > 760){

                let PopupSuggetion = document.getElementById("SearchInnerDiv");
                let SearchBarDiv   = document.getElementById("SearchBar"),
                    eleStyle = window.getComputedStyle(SearchBarDiv);

                const LeftSpace = -(SearchBarDiv.getBoundingClientRect().left.toFixed()-105) + "px";

                PopupSuggetion.setAttribute("style","left:"+ LeftSpace + ";width:" + eleStyle.width + ";position: relative;");

            }
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
                    AdjustProperties();
                },
                success: function (response) {
                    searchDiv.removeClass('d-none');
                    searchDiv.html(response);
                    AdjustProperties();
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

            $("#searchProductInput, #searchProductInputMobile").keyup( function(e) {

                let WebSearchSuggest    = $("#searchProductInput").val();
                let MobileSearchSuggest = $("#searchProductInputMobile").val();
                let CategoriesSearchBar = $("#CategoriesSearchBar").val();
                var searchText = (WebSearchSuggest.length > 0) ? WebSearchSuggest:MobileSearchSuggest;

                if (searchText.length > 3) {
                    timer = window.setTimeout(() => {
                        if(CategoriesSearchBar > 0){
                            doTheSuggestion("{{ route('products.suggest') }}?filter[name]=" + searchText + "&filter[has_categories]=" + CategoriesSearchBar + ",");
                        }else{
                            doTheSuggestion("{{ route('products.suggest') }}?filter[name]=" + searchText + "&filter[has_categories]=");
                        }
                    }, timeoutVal);

                    $("#searchProductBtn, #searchProductBtnMobile").click( function(e) {
                        doTheMagic("{{ route('products.search') }}?filter[name]=" + searchText + "&filter[has_categories]=" + CategoriesSearchBar + ",");
                        console.log(searchText);
                    });
                }
            });

            $("#searchProductInput, #searchProductInputMobile").click( function(e) {

                $("#u-header__section").css({"position":"static"});
                $("#header").css({"position":"static"});
                $("#SearchBar").css({"z-index":"99999"});
                $("#SearchBarMoblie").css({"z-index":"99999"});
                $("#SearchFace").css({"width":"100%","height":"1000vh","background":"black","position":"absolute","z-index":"1005","opacity":"0.5"});

            });
            $(document).on('click', '#SearchFace', function(e) {

                $("#u-header__section").css({"position":"relative"});
                $("#header").css({"position":"relative"});
                $("#SearchBar").css({"z-index":"relative"});
                $("#SearchBarMoblie").css({"z-index":"relative"});
                $("#SearchFace").css({"width":"","height":"","background":"","position":"","z-index":"","opacity":""});
                searchDiv.addClass('d-none');
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
