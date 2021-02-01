<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Change Currency
        $('.currency_button').click(function () {
            var this_element = $(this),
                code = this_element.data('code');
            if(typeof(code) != "undefined") {
                $.ajax({
                    url: "{{route('front.currencySwitch')}}",
                    data: {"_token": "{{csrf_token()}}", "code": code},
                    type: 'POST',
                    success: function (data) {
                        var return_data = JSON.parse(data);
                        if (typeof (return_data.status) != "undefined" && return_data.status != 0) {
                            window.location.href = "{{url()->current()}}";
                        } else {
                            return false;
                        }
                    }
                });
            }
            return false;
        });
    });
</script>
