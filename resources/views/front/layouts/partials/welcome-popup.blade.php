<div class="modal fade" id="myModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Welcome to YouMats</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="select_reg">
                            <a href="{{route('front.introduce', ['individual'])}}">Continue As Individual</a>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="select_reg">
                            <a href="{{route('front.introduce', ['company'])}}">Continue As Company</a>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('extraScripts')
    @if(!\Illuminate\Support\Facades\Session::get('userType'))
    <script type="text/javascript">
        $(window).on('load', function() {
            $('#myModal').modal('show');
        });
    </script>
    @endif
@endsection
