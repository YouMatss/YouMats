<script>
let xhr,
    timer,
    timeoutVal = 300,
    searchDiv = $("#searchDiv"),
    searchRegionGrid = $('#searchRegionGrid');

function doTheMagic(url) {
    url += '&include=tags,tagsCount,category,categoryCount';
    if(xhr && xhr.readyState != 4) {
        xhr.abort();
    }
    xhr = $.ajax({
        url: url,
        type: 'GET',
        beforeSend: function () {
            searchRegionGrid.html(`<div class="mx-auto mt-8" style="margin-left: auto!important;"><i class="fa fa-spin fa-spinner fa-6x"></i></div>`);
            searchDiv.removeClass('d-none');
        },
        success: function (response) {
            searchDiv.html(response);
            searchDiv.removeClass('d-none');
            $.HSCore.components.HSRangeSlider.init('.js-range-slider');
            $.HSCore.components.HSQantityCounter.init('.js-quantity');
        }
    });
}

$(document).on('ready', function () {
    //HANDLE SEARCH HERE
    $(document).on('click', '#searchProductBtnMobile', function(e) {
        e.preventDefault();
        let searchTextMobile = $("#searchProductInputMobile").val();

        {{--doTheMagic("{{ route('products.search') }}?filter[name]=" + searchTextMobile);--}}

        window.location.href = "{{ route('front.product.all') }}?search=" + searchTextMobile;
    });

    $(document).on('click', '#searchProductBtn', function () {
        let searchText = $("#searchProductInput").val();
        doTheMagic("{{ route('products.search') }}?filter[name]=" + searchText);
    });

    $(document).on('click', '#searchFilterBtn', function() {
        let priceFrom = $("#rangeSliderExample3MinResult").html(),
            priceTo = $("#rangeSliderExample3MaxResult").html(),
            searchText = $("#searchProductInput").val(),
            tagsCheckboxes = $(".tag:checkbox"),
            checkedTags = '',
            categoryCheckBoxes = $(".category:checkbox"),
            checkedCategories = '';

        tagsCheckboxes.each(function() {
            let checkBoxItem = (this.checked ? $(this).val() : "");

            if(checkBoxItem.length > 0)
                checkedTags += checkBoxItem + ',';
        })
        categoryCheckBoxes.each(function() {
            let checkBoxItem = (this.checked ? $(this).val() : "");

            if(checkBoxItem.length > 0)
                checkedCategories += checkBoxItem + ',';
        })

        checkedTags.replace(/, \s*$/, "");
        checkedCategories.replace(/, \s*$/, "");

        doTheMagic(`{{ route('products.search') }}?filter[name]=${searchText}&filter[price]=${priceFrom};${priceTo}&filter[has_tags]=${checkedTags}&filter[has_categories]=${checkedCategories}`);
    });

    $(document).on('keyup', '#searchProductInput', function(e) {
        window.clearTimeout(timer);
        let searchText = $("#searchProductInput").val();
        if (e.keyCode == 13 || (searchText.length > 2 && ((e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 97 && e.keyCode <= 122) || e.keyCode == 8))) {
            timer = window.setTimeout(() => {
                doTheMagic("{{ route('products.search') }}?filter[name]=" + searchText);
            }, timeoutVal);
        }
    });

    $(document).on('click', '.close_search', function() {
        searchDiv.addClass('d-none');
    })

    $("#searchClassicInvoker").on('click', function() {
        $("#searchAndCartDiv").removeClass('d-none');
    })
});
</script>
