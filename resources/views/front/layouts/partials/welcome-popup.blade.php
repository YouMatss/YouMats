<div class="modal fade" id="myModal">
    <div class="modal-dialog" role="document" style="max-width: 600px">
        <div class="modal-content st_model_new">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{__('general.welcome_message')}}</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="select_reg">
                            <a href="{{route('front.introduce', ['individual'])}}">{{__('general.continue_as_individual')}}</a>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="select_reg">
                            <a href="{{route('front.introduce', ['company'])}}">{{__('general.continue_as_company')}}</a>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(!\Illuminate\Support\Facades\Session::get('userType'))
<script type="text/javascript">
    $(document).ready(function() {
        $('#myModal').modal({backdrop: 'static', keyboard: false});
    });
</script>
@endif
