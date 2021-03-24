<script>
    $(document).on('ready', function () {
        $(document).on('change', '.filter-checkboxes', function() {
            let priceFrom = $("#rangeSliderExample3MinResult").html(),
                priceTo = $("#rangeSliderExample3MaxResult").html(),
                attributesCheckboxes = $(".filter-checkboxes:checkbox"),
                checkedAttributes = [];

            attributesCheckboxes.each(function() {
                let checkBoxItem = (this.checked ? $(this).val() : "");

                if(checkBoxItem.length > 0)
                    checkedAttributes.push(parseInt(checkBoxItem));
            })
{{--            doTheMagic(`{{ route('products.search') }}?filter[price_from]=${priceFrom}&filter[price_to]=${priceTo}&filter[has_attributes]=${checkedAttributes}`, 'filter');--}}
        });
    });

</script>
