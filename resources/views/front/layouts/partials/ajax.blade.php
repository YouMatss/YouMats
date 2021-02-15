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
        {{--$("#subscribeForm").submit(function (e) {--}}
        {{--    e.preventDefault();--}}
        {{--    $.ajax({--}}
        {{--        type: 'POST',--}}
        {{--        url: "{{route('front.form.subscribe')}}",--}}
        {{--        data: $(this).serialize(),--}}
        {{--        dataType: 'json',--}}
        {{--        success: function (data) {--}}
        {{--            if (data.status === 1) {--}}
        {{--                $('#message').html('<i class="fa fa-check"></i> {{site($site, 'subscribe_success_message')}}');--}}
        {{--            } else if (data.status != 1) {--}}
        {{--                $('#message').html(data.msg);--}}
        {{--            }--}}
        {{--        },--}}
        {{--        error: function (err) {--}}
        {{--            if (err.status == 422) {--}}
        {{--                var errors = err.responseJSON.errors;--}}
        {{--                $('#message').html('<i class="fa fa-times"></i> ' + errors.email[0]);--}}
        {{--            }--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    });
</script>
