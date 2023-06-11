@if(!\Illuminate\Support\Facades\Session::get('userType') && !is_company() && !is_individual())
        <div class="container modal-content st_model_new" id="myModal" style="min-width: 100%;margin: 0;bottom: 0;position: fixed;z-index: 10;">
            <div class="container modal-body" style="padding: 0.5rem;">
                <div class="row">
                    <div class="col-md-6" style="padding-bottom: 0.25rem!important;">
                        <h3 class="modal-title" style="text-align: center !important;" id="exampleModalLabel">{{__('general.welcome_message')}}</h3>
                    </div>
                    <div class="col-md-3" style="padding-bottom: 0.25rem!important;">
                        <a class="select_reg typeIntroduceButton" style="margin: 0;" data-url="{{route('front.introduce', ['individual'])}}">
                            {{__('general.continue_as_individual')}}
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a class="select_reg typeIntroduceButton" style="margin: 0;" data-url="{{route('front.introduce', ['company'])}}">
                            {{__('general.continue_as_company')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
@endif

