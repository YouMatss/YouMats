@extends('front.layouts.master')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cart Items') }}</div>

                    <div class="card-body">
                        @if($cart)
                            We have cart items
                        @else
                            <h4>{{ __('Cart is empty') }}</h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
