<script>
    function attributesFilter(url) {
        $.ajax({
            url: url,
            type: 'GET'
        }).done(function(response) {
            $("#productsContainer").html(response);
        });
    }
    function arrangeData() {
        let priceFrom, priceTo, attributesCheckboxes, checkedAttributes, categoryId, url;

        priceFrom = parseInt($("#rangeSliderExample3MinResultCategory").html());
        priceTo = parseInt($("#rangeSliderExample3MaxResultCategory").html());
        attributesCheckboxes = $(".filter-checkboxes:checkbox");
        categoryId = $("#categoryIdContainer").val();
        checkedAttributes = [];

        attributesCheckboxes.each(function() {
            let checkBoxItem = (this.checked ? $(this).val() : "");

            if(checkBoxItem.length > 0)
                checkedAttributes.push(parseInt(checkBoxItem));
        })

        url = `{{ env('APP_URL')}}/filter/${categoryId}?filter[attributes]=${checkedAttributes}`;

        if(priceFrom > 0)
            url += `&filter[price_from]=${priceFrom}`;
        
        if(priceTo > 0)
            url += `&filter[price_to]=${priceTo}`;

        attributesFilter(url);
    }
    $(document).on('ready', function () {
        $(document).on('change', '.filter-checkboxes', function() { arrangeData(); });
        $(document).on('click', '#priceFilterBtn', function() { arrangeData(); });
    });
</script>
