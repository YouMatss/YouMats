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
        let priceFrom, priceTo, attributesCheckboxes, checkedAttributes, categoryId;
        priceFrom = $("#rangeSliderExample3MinResultCategory").html();
        priceTo = $("#rangeSliderExample3MaxResultCategory").html();
        attributesCheckboxes = $(".filter-checkboxes:checkbox");
        categoryId = $("#categoryIdContainer").val();
        checkedAttributes = [];

        attributesCheckboxes.each(function() {
            let checkBoxItem = (this.checked ? $(this).val() : "");

            if(checkBoxItem.length > 0)
                checkedAttributes.push(parseInt(checkBoxItem));
        })
        attributesFilter(`{{env('APP_URL')}}/filter/${categoryId}?filter[price_from]=${priceFrom}&filter[price_to]=${priceTo}&filter[attributes]=${checkedAttributes}`);
    }
    $(document).on('ready', function () {
        $(document).on('change', '.filter-checkboxes', function() { arrangeData(); });
        $(document).on('click', '#priceFilterBtn', function() { arrangeData(); });
    });
</script>
