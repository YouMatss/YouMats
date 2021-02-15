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
        // subscribeForm Request
        var form = $("#subscribeForm"),
            button = $("#subscribeForm button"),
            buttonContent = button.text();
        form.submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "{{route('front.subscribe.request')}}",
                data: $(this).serialize(),
                dataType: 'json',
                beforeSend: function () {
                    button.attr('disabled', true);
                    button.html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (response) {
                    if (response.status) {
                        toastr.success(response.message);
                        form.find("input, textarea").val("");
                    } else
                        toastr.warning(response.message)

                    button.attr('disabled', false);
                    button.text(buttonContent);
                    // console.log(response);
                },
                error: function (response) {
                    // toastr.error(response.responseJSON.message);
                    let errors = response.responseJSON.errors;

                    $.each(errors, function (key, value) {
                        toastr.error(value, key);
                    })
                    button.attr('disabled', false);
                    button.text(buttonContent);
                }
            });
        });
    });
</script>
