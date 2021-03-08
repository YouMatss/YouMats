@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | {{$user->name}} Profile</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta property="og:url" content="{{url()->current()}}" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="og:image" content="" />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@YouMats">
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <meta name="twitter:image" content="">
@endsection
@section('content')
    <div class="bg-gray-13 bg-md-transparent">
        <div class="container">
            <!-- breadcrumb -->
            <div class="my-md-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-3 flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble">
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{$user->name}} Profile</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="img_vendor">
                    <img src="{{ $user->getFirstMediaUrlOrDefault(USER_COVER)['url'] }}" class="photo_cover_vendor">
                </div>
                <img src="{{ $user->getFirstMediaUrlOrDefault(USER_PROFILE)['url'] }}" class="photo_profile_vendor">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="info_main_vendor">
                    <h3>{{$user->name}}</h3>
                    <p>Join at <b>{{$user->created_at->format('d F Y')}}</b></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="position-relative position-md-static px-md-6">
                    <ul class="nav nav-classic nav-tab nav-tab-lg justify-content-xl-center flex-nowrap flex-xl-wrap overflow-auto overflow-xl-visble border-0 pb-1 pb-xl-0 mb-n1 mb-xl-0" id="pills-tab-8" role="tablist">
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link active" id="Jpills-one-example1-tab" data-toggle="pill" href="#Jpills-one-example1" role="tab" aria-controls="Jpills-one-example1" aria-selected="true">Main Info</a>
                        </li>
                        <li class="nav-item flex-shrink-0 flex-xl-shrink-1 z-index-2">
                            <a class="nav-link" id="Jpills-four-example1-tab" data-toggle="pill" href="#Jpills-four-example1" role="tab" aria-controls="Jpills-four-example1" aria-selected="false"> {{ $user->type == 'company' ? __('Quotes') : __('Orders') }} </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-12">
                <div class="borders-radius-17 border p-4 mt-4 mt-md-0 px-lg-10 py-lg-9 mb-5">
                    <div class="tab-content" id="Jpills-tabContent">
                        <div class="tab-pane fade active show" id="Jpills-one-example1" role="tabpanel" aria-labelledby="Jpills-one-example1-tab">
                            <div class="block_info_vendor">
                                @if(Session::has('message'))
                                    <div class="alert alert-success">
                                        {{ Session::get('message') }}
                                    </div>
                                @endif
                                <form method="post" action="{{route('front.user.updateProfile')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="box_img_v">
                                                <img src="{{ $user->getFirstMediaUrlOrDefault(USER_COVER)['url'] }}" class="photo_cover_vendor">
                                            </div>
                                        </div>
                                        <div class="col-md-3 ml-auto">
                                            <div class="box_img_profile">
                                                <img src="{{ $user->getFirstMediaUrlOrDefault(USER_PROFILE)['url'] }}" class="photo_cover_vendor">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Cover</label>
                                                <div class="box">
                                                    <input type="file" name="cover" id="cover" class="inputfile inputfile-6 @error('cover') is-invalid @enderror" />
                                                    <label for="cover">
                                                        <span></span>
                                                        <strong>Choose a file&hellip;</strong>
                                                    </label>
                                                    @error('cover')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Profile</label>
                                                <div class="box">
                                                    <input type="file" name="profile" id="profile" class="inputfile inputfile-6 @error('profile') is-invalid @enderror" />
                                                    <label for="profile">
                                                        <span></span>
                                                        <strong>Choose a file&hellip;</strong>
                                                    </label>
                                                    @error('profile')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" required value="{{$user->name}}">
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" disabled value="{{$user->email}}">
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" required value="{{$user->phone}}">
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="phone2" class="form-label">Phone 2</label>
                                                <input type="text" class="form-control @error('phone2') is-invalid @enderror" name="phone2" id="phone2" value="{{$user->phone2}}">
                                                @error('phone2')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" id="address" required value="{{$user->address}}">
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="address2" class="form-label">Address 2</label>
                                                <input type="text" class="form-control @error('address2') is-invalid @enderror" name="address2" id="address2" value="{{$user->address2}}">
                                                @error('address2')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        @if($user->type == 'company')
                                        <div class="col-md-12">
                                            <div class="js-form-message form-group mb-5">
                                                <label class="form-label">Licenses</label>
                                                <div class="box">
                                                    <input type="file" name="licenses" id="licenses" class="inputfile inputfile-6 @error('licenses') is-invalid @enderror" multiple />
                                                    <label for="licenses">
                                                        <span></span>
                                                        <strong>Choose a files&hellip;</strong>
                                                    </label>
                                                    @error('licenses')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                                                @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="js-form-message form-group mb-5">
                                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation">
                                                @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="mb-6">
                                                <button type="submit" class="btn btn-primary-dark-w px-5 text-white mr-2"> <i class="fas fa-save"></i> Save Change</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="Jpills-four-example1" role="tabpanel" aria-labelledby="Jpills-four-example1-tab">
                            <div class="container">
                                <div class="row">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">{{ $user->type == 'company' ? __('Quote #') : __('Order #') }}</th>
                                                <th scope="col">Date</th>
                                                @if($user->type != 'company')
                                                    <th scope="col">Total Price</th>
                                                    <th scope="col">Payment Status</th>
                                                @endif
                                                <th scope="col">Status</th>
                                                <th scope="col">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $order)
                                            <tr>
                                                <th scope="row">{{ $user->type == 'company' ? $order->quote_no : $order->order_id }}</th>
                                                <td>{{$order->created_at->format('l, F d, Y h:i A')}}</td>
                                                @if($user->type != 'company')
                                                    <td>{{getCurrency('code')}} {{$order->total_price}}</td>
                                                    <td>{{$order->payment_status}}</td>
                                                @endif
                                                <td>{{$order->status}}</td>
                                                <td class="text-center">
                                                    <a href="#" data-toggle="modal" data-target="#order{{$order->id}}"> View <i class="far fa-eye"></i></a>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="order{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Order #<b>{{$order->order_id}}</b></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12 col-xl-12">
                                                                    <div class="">
                                                                        <ul class="list-unstyled-branches list_order_vendor mb-6">
                                                                            <li class="row">
                                                                                <div class="col-md-4">
                                                                                    <b>Date:</b>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <span class="">{{$order->created_at->format('l, F d, Y h:i A')}}</span>
                                                                                </div>
                                                                            </li>
                                                                            <li class="row">
                                                                                <div class="col-md-4">
                                                                                    <b>Name</b>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <span class="">{{$order->name}}</span>
                                                                                </div>
                                                                            </li>
                                                                            <li class="row">
                                                                                <div class="col-md-4">
                                                                                    <b>Email:</b>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <span class="">{{$order->email}}</span>
                                                                                </div>
                                                                            </li>
                                                                            <li class="row">
                                                                                <div class="col-md-4">
                                                                                    <b>Phone:</b>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <span class="">{{$order->phone}}</span>
                                                                                </div>
                                                                            </li>
                                                                            @if(isset($order->phone2))
                                                                                <li class="row">
                                                                                    <div class="col-md-4">
                                                                                        <b>phone2:</b>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <span class="">{{$order->phone2}}</span>
                                                                                    </div>
                                                                                </li>
                                                                            @endif
                                                                            <li class="row">
                                                                                <div class="col-md-4">
                                                                                    <b>Address:</b>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <span class="">{{$order->address}}</span>
                                                                                </div>
                                                                            </li>
                                                                            @if(isset($order->building_number))
                                                                                <li class="row">
                                                                                    <div class="col-md-4">
                                                                                        <b>Building Number:</b>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <span class="">{{$order->building_number}}</span>
                                                                                    </div>
                                                                                </li>
                                                                            @endif
                                                                            @if(isset($order->street))
                                                                                <li class="row">
                                                                                    <div class="col-md-4">
                                                                                        <b>Street:</b>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <span class="">{{$order->street}}</span>
                                                                                    </div>
                                                                                </li>
                                                                            @endif
                                                                            @if(isset($order->district))
                                                                                <li class="row">
                                                                                    <div class="col-md-4">
                                                                                        <b>District:</b>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <span class="">{{$order->district}}</span>
                                                                                    </div>
                                                                                </li>
                                                                            @endif
                                                                            @if(isset($order->city))
                                                                                <li class="row">
                                                                                    <div class="col-md-4">
                                                                                        <b>City:</b>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <span class="">{{$order->city}}</span>
                                                                                    </div>
                                                                                </li>
                                                                            @endif
                                                                            @if($user->type != 'company')
                                                                            <li class="row">
                                                                                <div class="col-md-4">
                                                                                    <b>Payment Method:</b>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <span class="">{{$order->payment_method}}</span>
                                                                                </div>
                                                                            </li>
                                                                            <li class="row">
                                                                                <div class="col-md-4">
                                                                                    <b>Payment Status:</b>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <span>{{$order->payment_status}}</span>
                                                                                </div>
                                                                            </li>
                                                                            @endif
                                                                            <li class="row">
                                                                                <div class="col-md-4">
                                                                                    <b>{{ __('Status') }}</b>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <span>{{$order->status}}</span>
                                                                                </div>
                                                                            </li>
                                                                            <li class="row">
                                                                                <div class="col-md-4">
                                                                                    <b>Notes:</b>
                                                                                </div>
                                                                                <div class="col-md-8">
                                                                                    <span class="">{{$order->notes}}</span>
                                                                                </div>
                                                                            </li>
                                                                            @if($user->type != 'company')
                                                                                <li class="row">
                                                                                    <div class="col-md-4">
                                                                                        <b>Total Price:</b>
                                                                                    </div>
                                                                                    <div class="col-md-8">
                                                                                        <span class="">{{getCurrency('code')}} {{$order->total_price}}</span>
                                                                                    </div>
                                                                                </li>
                                                                            @endif
                                                                            @if(count($order->items) > 0)
                                                                                <h4>{{ __('Order Items') }}</h4>
                                                                                @foreach($order->items as $item)
                                                                                    <li class="row">
                                                                                        <div class="col-md-4">
                                                                                            <b>Item Name</b>
                                                                                        </div>
                                                                                        <div class="col-md-8">
                                                                                            <span class="">{{ $item->product->name }}</span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li class="row">
                                                                                        <div class="col-md-4">
                                                                                            <b>Quantity</b>
                                                                                        </div>
                                                                                        <div class="col-md-8">
                                                                                            <span class="">{{ $item->quantity }}</span>
                                                                                        </div>
                                                                                    </li>
                                                                                @if($user->type != 'company')
                                                                                    <li class="row">
                                                                                        <div class="col-md-4">
                                                                                            <b>Price</b>
                                                                                        </div>
                                                                                        <div class="col-md-8">
                                                                                            <span class="">{{ $item->price }}</span>
                                                                                        </div>
                                                                                    </li>
                                                                                    <li class="row">
                                                                                        <div class="col-md-4">
                                                                                            <b>Status</b>
                                                                                        </div>
                                                                                        <div class="col-md-8">
                                                                                            <span class="">{{ $item->status }}</span>
                                                                                        </div>
                                                                                    </li>
                                                                                    @if($item->status == 'refused')
                                                                                        <li class="row">
                                                                                            <div class="col-md-4">
                                                                                                <b>{{ __('Refused note') }}:</b>
                                                                                            </div>
                                                                                            <div class="col-md-8">
                                                                                                <span class="">{{$item->refused_note}}</span>
                                                                                            </div>
                                                                                        </li>
                                                                                    @endif
                                                                                    <li class="row">
                                                                                        <div class="col-md-4">
                                                                                            <b>Payment Status</b>
                                                                                        </div>
                                                                                        <div class="col-md-8">
                                                                                            <span class="">{{ $item->payment_status }}</span>
                                                                                        </div>
                                                                                    </li>
                                                                                    @endif
                                                                                    <hr />
                                                                                    @endforeach
                                                                            @endif
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Modal -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
