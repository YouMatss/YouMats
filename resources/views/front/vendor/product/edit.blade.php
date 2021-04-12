@extends('front.layouts.master')
@section('metaTags')
    <title>YouMats | {{ __('Edit') . $product->name }}</title>
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
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1"><a href="#">{{ __('Home') }}</a></li>
                        <li class="breadcrumb-item flex-shrink-0 flex-xl-shrink-1 active" aria-current="page">{{ $product->name }}</li>
                    </ol>
                </nav>
            </div>
            <!-- End breadcrumb -->
        </div>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <div class="tit_page_add_pro">
                    <h3 class="font-size-18 font-weight-semi-bold text-gray-39 mb-4">{{ __('Edit Product') . ' ' . $product->name }}</h3>
                    <p class="text-gray-90">{{ __('Donec libero dolor, tincidunt id laoreet vitae, ullamcorper eu tortor. Maecenas pellentesque, dui vitae iaculis mattis, tortor nisi faucibus magna, vitae ultrices lacus purus vitae metus. Ut nec odio facilisis, ultricies nunc eget, fringilla orci.') }}</p>
                </div>
            </div>

            <form action="{{ route('vendor.updateProduct', ['product' => $product]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="col-lg-12">
                    <div class="block_add_products">
                        <!-- Billing Form -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="js-form-message mb-6">
                                    <label class="form-label">name (en):</label>
                                    <input type="text" class="form-control st_input @error('name_en') is-invalid @enderror" value="{{ $product->getTranslation('name', 'en') }}" name="name_en" placeholder="">
                                    @error('name_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="js-form-message mb-6">
                                    <label class="form-label">name (ar):</label>
                                    <input type="text" class="form-control st_input @error('name_ar') is-invalid @enderror" value="{{ $product->getTranslation('name', 'ar') }}" name="name_ar" placeholder="">
                                    @error('name_ar')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">Sub Gategory</label>
                                    <select class="form-control js-select selectpicker dropdown-select st_input @error('subCategory_id') is-invalid @enderror" name="subCategory_id" required="" data-live-search="true" data-style="form-control border-color-1 font-weight-normal">
                                        @foreach($subCategories as $sub)
                                            <option value="{{ $sub->id }}" {{ $product->subCategory_id == $sub->id ? 'selected' : '' }}>{{ $sub->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subCategory_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-4">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">Type</label>
                                    <select id="typeDropdown" class="form-control js-select selectpicker dropdown-select st_input @error('type') is-invalid @enderror" name="type" required="" data-live-search="true" data-style="form-control border-color-1 font-weight-normal">
                                        <option value="product" {{ $product->type == 'product' ? 'selected' : '' }}>{{ __('Product') }}</option>
                                        <option value="service" {{ $product->type == 'service' ? 'selected' : '' }}>{{ __('Service') }}</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-4">
                                <div class="js-form-message mb-6">
                                    <label class="form-label"> {{ __('SKU') }} </label>
                                    <input type="text" class="form-control st_input @error('sku') is-invalid @enderror" value="{{ $product->SKU }}" name="sku" placeholder="">
                                    @error('sku')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div style="display: contents;" id="productRegion">
                                <div class="w-100"></div>
                                <div class="col-md-4">
                                    <div class="js-form-message mb-6">
                                        <label class="form-label"> {{ __('Cost') }} </label>
                                        <input type="number" class="form-control st_input @error('cost') is-invalid @enderror" value="{{ $product->cost }}" name="cost">
                                        @error('cost')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-4">
                                    <div class="js-form-message mb-6">
                                        <label class="form-label"> {{ __('Price') }} </label>
                                        <input type="number" class="form-control st_input @error('price') is-invalid @enderror" value="{{ $product->price }}" name="price">
                                        @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="w-100"></div>
                                <div class="col-md-4">
                                    <div class="js-form-message mb-6">
                                        <label class="form-label"> {{ __('Stock') }} </label>
                                        <input type="number" class="form-control st_input @error('stock') is-invalid @enderror" value="{{ $product->stock }}" name="stock" placeholder="">
                                        @error('stock')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="w-100"></div>
                            <div class="col-md-4">
                                <!-- Input -->
                                <div class="js-form-message mb-6">
                                    <label class="form-label">{{ __('Unit') }}</label>
                                    <select class="form-control js-select selectpicker dropdown-select st_input @error('unit_id') is-invalid @enderror" name="unit_id" data-live-search="true" data-style="form-control border-color-1 font-weight-normal">
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}" {{ $product->unit_id == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <!-- End Input -->
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12 mb-5 pt-4">
                                <hr>
                                <div class="js-form-message mb-6">
                                    <label class="form-label"> Rate </label>
                                    <div class="starrating risingstar d-flex flex-row-reverse">
                                        <input type="radio" @if($product->rate == 5) checked @endif id="star5" name="rate" value="5" /><label for="star5" title="5 star"><i class="fa fa-star"></i></label>
                                        <input type="radio" @if($product->rate == 4) checked @endif id="star4" name="rate" value="4" /><label for="star4" title="4 star"><i class="fa fa-star"></i></label>
                                        <input type="radio" @if($product->rate == 3) checked @endif id="star3" name="rate" value="3" /><label for="star3" title="3 star"><i class="fa fa-star"></i></label>
                                        <input type="radio" @if($product->rate == 2) checked @endif id="star2" name="rate" value="2" /><label for="star2" title="2 star"><i class="fa fa-star"></i></label>
                                        <input type="radio" @if($product->rate == 1) checked @endif id="star1" name="rate" value="1" /><label for="star1" title="1 star"><i class="fa fa-star"></i></label>
                                    </div>
                                    @error('rate')
                                    <span class="invalid-feedback" style="float: right" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    <br>
                                </div>
                                <hr>
                            </div>

                            <div class="col-md-6">
                                <div class="js-form-message mb-6">
                                    <label class="form-label">
                                        Short Description (en)
                                    </label>

                                    <div class="input-group">
                                        <input type="text" class="form-control st_input @error('short_desc_en') is-invalid @enderror" value="{{ $product->getTranslation('short_desc', 'en') }}" name="short_desc_en" placeholder="{{ __('Short description about your product (will be displayed in small product cards)') }}">
                                        @error('short_desc_en')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="js-form-message mb-6">
                                    <label class="form-label"> Short Description (ar) </label>

                                    <div class="input-group">
                                        <input type="text" class="form-control st_input @error('short_desc_ar') is-invalid @enderror" value="{{ $product->getTranslation('short_desc', 'ar') }}" name="short_desc_ar" placeholder="{{ __('Short description about your product (will be displayed in small product cards)') }}">
                                        @error('short_desc_ar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="js-form-message mb-3">
                                    <label class="form-label">
                                        Description (en)
                                    </label>

                                    <div class="input-group">
                                        <div class="form-group @error('desc_en') is-invalid @enderror">
                                            <textarea id="editor" name="desc_en">{{ $product->getTranslation('desc', 'en') }}</textarea>
                                            @error('desc_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="js-form-message mb-3">
                                    <label class="form-label"> Description (ar) </label>

                                    <div class="input-group">
                                        <div class="form-group @error('desc_ar') is-invalid @enderror">
                                            <textarea id="editor_2" name="desc_ar">{{ $product->getTranslation('desc', 'ar') }}</textarea>
                                            @error('desc_en')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <hr>
                                <div class="js-form-message mb-3">
                                    <label class="form-label mb-3">
                                        Add Gallery*
                                    </label>

                                    <div class="row">
                                        @if(!count($product->getMedia(PRODUCT_PATH)))
                                            <div class="col-sm-2 imgUp">
                                                <div class="imagePreview"></div>
                                                <label class="btn btn-primary">
                                                    Upload <input type="file" name="gallery[]" class="uploadFile img" value="Upload Photo" style="width: 0px;height: 0px;overflow: hidden;">
                                                </label>
                                            </div><!-- col-2 -->
                                        @endif

                                        @foreach($product->getMedia(PRODUCT_PATH) as $image)
                                            <div class="col-sm-2 imgUp">
                                                <div class="imagePreview" style="background-image: url('{{ $image->getFullUrl() }}')"></div>
                                                <i class="fa fa-times deleteImg" style="position: absolute;top: 0px;right: 15px;width: 30px; height: 30px;text-align: center;line-height: 30px;background-color: rgba(255,255,255,0.6);cursor: pointer;" data-url="{{route('vendor.deleteImage', ['product' => $product, 'media' => $image])}}"></i>
                                            </div>
                                        @endforeach
                                        <i class="fa fa-plus imgAdd"></i>
                                    </div><!-- row -->
                                    @if ($errors->has('gallery.*') || $errors->has('gallery'))
                                        <div class="alert alert-danger">
                                            <ul role="alert" style="list-unstyled">
                                                @if($errors->has('gallery.*'))
                                                    <li>{{ $errors->first('gallery.*') }}</li>
                                                @else
                                                    <li>{{ $errors->first('gallery') }}</li>
                                                @endif
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="js-form-message mb-3">
                                    <hr />
                                    <label class="form-label"> Shipping Prices: </label>
                                    <hr />
                                    <div class="clone_container">
                                        @if(isset($product->shipping_prices))
                                            @foreach(json_decode($product->shipping_prices, true) as $shipping_price)
                                                <div class="row clone_item">
                                                    <div class="col-md-3">
                                                        <div class="js-form-message form-group mb-5">
                                                            <label class="form-label">Cities <span class="text-danger">*</span></label>
                                                            <select name="cities[]" class="form-control @error("cities[]") is-invalid @enderror" required>
                                                                @foreach($product->vendor->cities as $city)
                                                                    <option value="{{$city->id}}" @if($shipping_price['cities'] == $city->id) selected @endif>{{$city->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            @error("cities[]")
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="js-form-message form-group mb-5">
                                                            <label class="form-label">Price <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control @error("price_shipping[]") is-invalid @enderror" name="price_shipping[]" value="{{$shipping_price['price']}}" required>
                                                            @error("price_shipping[]")
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="js-form-message form-group mb-5">
                                                            <label class="form-label">Time <span class="text-danger">*</span></label>
                                                            <input type="number" class="form-control @error("time[]") is-invalid @enderror" name="time[]" value="{{$shipping_price['time']}}" required>
                                                            @error("time[]")
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="js-form-message form-group mb-5">
                                                            <label class="form-label">Format <span class="text-danger">*</span></label>
                                                            <select name="format[]" class="form-control @error("format[]") is-invalid @enderror" required>
                                                                <option value="hour" @if($shipping_price['format'] == 'hour') selected @endif>Hour</option>
                                                                <option value="day" @if($shipping_price['format'] == 'day') selected @endif>Day</option>
                                                            </select>
                                                            @error("format[]")
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="mt-4">
                                                            <button type="button" class="btn btn-danger px-5 text-white mr-2 btn_clone_remove">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <h4>{{ __('You do not have any prices') }}</h4>
                                        @endif
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <button type="button" class="btn btn-primary-dark-w px-5 text-white mr-2 btn_clone_add"> <i class="fas fa-plus"></i> Add Price</button>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-6">
                                            <button type="submit" class="btn btn-primary-dark-w px-5 text-white mr-2"> <i class="fas fa-save"></i> Save Change</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 ml-auto">
                                <hr>
                                <button type="submit" class="btn btn-primary-dark-w btn-block btn-pill font-size-20 mb-3 py-3 w-25 ml-auto">Submit</button>
                            </div>
                        </div>
                        <!-- End Billing Form -->
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('extraScripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#editor,textarea#editor_2',
            menubar: false
        });
    </script>
    <script>
        $(".imgAdd").click(function(){
            $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input name="gallery[]" type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
        });
        $(document).on("click", "i.del" , function() {
            $(this).parent().remove();
        });
        $(function() {
            $(document).on("change",".uploadFile", function()
            {
                var uploadFile = $(this);
                var files = !!this.files ? this.files : [];
                if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support

                if (/^image/.test( files[0].type)){ // only image file
                    var reader = new FileReader(); // instance of the FileReader
                    reader.readAsDataURL(files[0]); // read the local file

                    reader.onloadend = function(){ // set image data as background of div
                        //alert(uploadFile.closest(".upimage").find('.imagePreview').length);
                        uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
                    }
                }
            });
        });
        $("#typeDropdown").on('change', function() {
            let type = $(this).val();

            if(type === 'product')
                $('#productRegion').html(`<div class="w-100"></div>
                                <div class="col-md-4">
                                    <div class="js-form-message mb-6">
                                        <label class="form-label"> {{ __('Cost') }} </label>
                                        <input type="number" class="form-control st_input @error('cost') is-invalid @enderror" name="cost" placeholder="">
                                        @error('cost')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                </div>
             </div>
            <div class="w-100"></div>
                                <div class="col-md-4">
                                    <div class="js-form-message mb-6">
                                        <label class="form-label"> {{ __('Price') }} </label>
                                        <input type="number" class="form-control st_input @error('price') is-invalid @enderror" name="price" placeholder="">
                                        @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                </div>
             </div>
            <div class="w-100"></div>
            <div class="col-md-4">
                <div class="js-form-message mb-6">
                    <label class="form-label"> {{ __('Stock') }} </label>
                                        <input type="number" class="form-control st_input @error('stock') is-invalid @enderror" name="stock" placeholder="">
                                        @error('stock')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                </div>
            </div>`);
            else
                $('#productRegion').empty();
        });

        $(document).ready(function() {
            if($("#typeDropdown").val() === 'service')
                $("#productRegion").empty();
        });
        $('.deleteImg').on('click', function() {
            let url = $(this).data('url'),
                btn = $(this);

            $.ajax({
                type: 'DELETE',
                url: url,
                data: { _token: '{{ csrf_token() }}' }
            })
            .done(function(response) {
                if(response.status) {
                    toastr.success(response.message);
                    btn.parent().remove();
                }
                else
                    toastr.error(response.message)
            })
            .fail(function(response) {
                toastr.error(response.responseJSON.message);
            })
        })
    </script>
    <script>
        $(document).ready(function () {
            $(".btn_clone_add").click(function(){
                var clone_item = `<div class="row clone_item">
                                                <div class="col-md-3">
                                                    <div class="js-form-message form-group mb-5">
                                                        <label class="form-label">Cities <span class="text-danger">*</span></label>
                                                        <select name="cities[]" class="form-control @error("cities[]") is-invalid @enderror" required>
                                                            @foreach($product->vendor->cities as $city)
                <option value="{{$city->id}}">{{$city->name}}</option>
                                                            @endforeach
                </select>
@error("cities[]")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="js-form-message form-group mb-5">
                    <label class="form-label">Price <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error("price_shipping[]") is-invalid @enderror" name="price_shipping[]" required>
                                                        @error("price_shipping[]")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="js-form-message form-group mb-5">
                    <label class="form-label">Time <span class="text-danger">*</span></label>
                    <input type="number" class="form-control @error("time[]") is-invalid @enderror" name="time[]" required>
                                                        @error("time[]")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                </div>
            </div>
            <div class="col-md-3">
                <div class="js-form-message form-group mb-5">
                    <label class="form-label">Format <span class="text-danger">*</span></label>
                    <select name="format[]" class="form-control @error("format[]") is-invalid @enderror" required>
                                                            <option value="hour">Hour</option>
                                                            <option value="day">Day</option>
                                                        </select>
                                                        @error("format[]")
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                </div>
            </div>
            <div class="col-md-2">
                <div class="mt-4">
                    <button type="button" class="btn btn-danger px-5 text-white mr-2 btn_clone_remove">Delete</button>
                </div>
            </div>
        </div>`;
                // var new_item = $(".clone_item").first().clone();
                $(".clone_container").append(clone_item);
                return false;
            });
            $(document).on('click', '.btn_clone_remove', function () {
                $(this).closest('.clone_item').remove();
            });
        });
    </script>
@endsection
