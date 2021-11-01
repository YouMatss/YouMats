<div class="modal fade change_city_modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form id="city_button">
                {{csrf_field()}}
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{__('general.select_city_title')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <select name="city_id" class="form-control">
                        <option value="" selected disabled>{{__('general.select_city')}}</option>
                        @if(isset($delivery_cities) && $delivery_cities != 'all' && count($delivery_cities))
                            @foreach($delivery_cities as $d_city_loop)
                                <option value="{{$d_city_loop->id}}" @if(Session::has('city') && $d_city_loop->id == Session::get('city')->id) selected @endif>{{$d_city_loop->name}}</option>
                            @endforeach
                        @else
                            @foreach(\App\Models\City::all() as $city_loop)
                                <option value="{{$city_loop->id}}" @if(Session::has('city') && $city_loop->id == Session::get('city')->id) selected @endif>{{$city_loop->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('general.close')}}</button>
                    <button type="submit" class="btn btn-primary" style="border-radius: 25px;margin-top: 0">{{__('general.choose')}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
