@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.edit_product')}}</title>
@endsection
@section('content')
    <section class="content pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4>{{__('vendorAdmin.edit_product')}}</h4>
                    <form action="{{route('vendor.product.update', [$product->id])}}" method="post" enctype="multipart/form-data">
                        <div class="card">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="category">{{__('vendorAdmin.category')}}</label>
                                    <select class="form-control" id="category">
                                        <option value="" selected disabled>{{__('vendorAdmin.category_placeholder')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($selected_category == $category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="subCategory">{{__('vendorAdmin.subCategory')}}</label>
                                    <select class="form-control" name="category_id" id="subCategory">
                                        <option value="" selected disabled>{{__('vendorAdmin.subCategory_placeholder')}}</option>
                                    </select>
                                </div>
                                <nav>
                                    <div class="nav nav-languages" id="nav-tab" role="tablist">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <a class="nav-link @if($loop->first) active @endif" id="nav-{{$localeCode}}-tab-name"
                                               data-toggle="tab" href="#nav-{{$localeCode}}-name" role="tab" aria-controls="nav-{{$localeCode}}-name" aria-selected="false">{{ $properties['native'] }}</a>
                                        @endforeach
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <div class="tab-pane fade @if($loop->first) show active @endif"
                                             id="nav-{{$localeCode}}-name" role="tabpanel" aria-labelledby="nav-{{$localeCode}}-tab-name">
                                            <div class="form-group">
                                                <label for="name-{{$localeCode}}">{{__('vendorAdmin.name')}}</label>
                                                <div id="template-{{$localeCode}}"></div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <nav>
                                    <div class="nav nav-languages" id="nav-tab" role="tablist">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <a class="nav-link @if($loop->first) active @endif" id="nav-{{$localeCode}}-tab-short-desc"
                                               data-toggle="tab" href="#nav-{{$localeCode}}-short-desc" role="tab" aria-controls="nav-{{$localeCode}}-short-desc" aria-selected="false">{{ $properties['native'] }}</a>
                                        @endforeach
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <div class="tab-pane fade @if($loop->first) show active @endif" id="nav-{{$localeCode}}-short-desc"
                                             role="tabpanel" aria-labelledby="nav-{{$localeCode}}-tab-short-desc">
                                            <div class="form-group">
                                                <label for="short_desc_{{$localeCode}}">{{__('vendorAdmin.short_desc')}}</label>
                                                <textarea id="short_desc_{{$localeCode}}" class="form-control ckeditor" name="short_desc_{{$localeCode}}">
                                                {{$product->getTranslation('short_desc',$localeCode)}}
                                            </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <nav>
                                    <div class="nav nav-languages" id="nav-tab" role="tablist">
                                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <a class="nav-link @if($loop->first) active @endif" id="nav-{{$localeCode}}-tab-desc"
                                               data-toggle="tab" href="#nav-{{$localeCode}}-desc" role="tab" aria-controls="nav-{{$localeCode}}-desc" aria-selected="false">{{ $properties['native'] }}</a>
                                        @endforeach
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                        <div class="tab-pane fade @if($loop->first) show active @endif" id="nav-{{$localeCode}}-desc"
                                             role="tabpanel" aria-labelledby="nav-{{$localeCode}}-tab-desc">
                                            <div class="form-group">
                                                <label for="desc_{{$localeCode}}">{{__('vendorAdmin.desc')}}</label>
                                                <textarea id="desc_{{$localeCode}}" rows="5" class="form-control ckeditor" name="desc_{{$localeCode}}">
                                                {{$product->getTranslation('desc',$localeCode)}}
                                            </textarea>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    <label for="type">{{__('vendorAdmin.type')}}</label>
                                    <select class="form-control" name="type" id="type">
                                        <option selected disabled>{{__('vendorAdmin.type_placeholder')}}</option>
                                        <option value="product" @if($product->type == 'product') selected @endif>{{__('vendorAdmin.type_product')}}</option>
                                        <option value="service" @if($product->type == 'service') selected @endif>{{__('vendorAdmin.type_service')}}</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="cost">{{__('vendorAdmin.cost')}}</label>
                                    <input type="number" class="form-control" name="cost" id="cost" min="0" step="0.01" value="{{$product->cost}}">
                                </div>
                                <div class="form-group">
                                    <label for="price">{{__('vendorAdmin.price')}}</label>
                                    <input type="number" class="form-control" name="price" id="price" min="0" step="0.01" value="{{$product->price}}">
                                </div>
                                <div class="form-group">
                                    <label for="stock">{{__('vendorAdmin.stock')}}</label>
                                    <input type="number" class="form-control" name="stock" id="stock" min="0" step="1" value="{{$product->stock}}">
                                </div>
                                <div class="form-group">
                                    <label for="unit">{{__('vendorAdmin.unit')}}</label>
                                    <select class="form-control" name="unit_id" id="unit">
                                        <option selected disabled>{{__('vendorAdmin.unit_placeholder')}}</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}" @if($product->unit_id == $unit->id) selected @endif>{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="min_quantity">{{__('vendorAdmin.min_quantity')}}</label>
                                    <input type="number" class="form-control" name="min_quantity" id="min_quantity" min="1" step="1" value="{{$product->min_quantity}}">
                                </div>
                                <div class="form-group">
                                    <label for="sku">{{__('vendorAdmin.sku')}}</label>
                                    <input type="text" class="form-control" name="SKU" id="sku" value="{{$product->SKU}}">
                                </div>
                            </div>
                        </div>
                        <h4>{{__('vendorAdmin.gallery')}}</h4>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="gallery">{{__('vendorAdmin.gallery')}}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" multiple name="gallery[]" class="custom-file-input" id="gallery">
                                            <label class="custom-file-label">{{__('vendorAdmin.choose_images')}}</label>
                                        </div>
                                    </div>
                                    <div class="mt-1 temp-img-container"></div>
                                    <div class="mt-1">
                                        <div class="row">
                                        @foreach($product->getMedia(PRODUCT_PATH) as $image)
                                            <div class="col-md-2 image-container">
                                                <a href="{{route('vendor.product.deleteImage', [$product, $image])}}">
                                                    <i class="absolute-image fas fa-times"></i>
                                                </a>
                                                <img class="img-thumbnail" width="100%" src="{{ $image->getUrl() }}">
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4>{{__('vendorAdmin.attributes')}}</h4>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <select id="attributes" multiple name="attributes[]">
                                        @foreach($attributes as $attribute)
                                            <optgroup label="{{$attribute->key}}">
                                            @foreach($attribute->values as $value)
                                                <option value="{{$value->id}}" @if(in_array($value->id, json_decode($product->attributes))) selected @endif>{{$value->value . ' (' . $attribute->key . ')'}}</option>
                                            @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <h4>{{__('vendorAdmin.shipping')}}</h4>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="shipping">{{__('vendorAdmin.shipping')}}</label>
                                    <select id="shipping" class="form-control" name="shipping_id">
                                        <option value="" selected disabled>{{__('vendorAdmin.shipping_placeholder')}}</option>
                                        @foreach($vendor->shippings as $shipping)
                                            <option value="{{$shipping->id}}" @if($shipping->id == $product->shipping_id) selected @endif>{{$shipping->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="specific">{{__('vendorAdmin.specific_shipping')}}</label>
                                    <input type="checkbox" class="form-control" id="specific" name="specific_shipping" @if($product->specific_shipping) checked @endif>
                                </div>
                                <div class="card" id="specific_shipping">
                                    <div class="card-header card-youmats">
                                        <h3 class="card-title">{{__('vendorAdmin.specific_shipping')}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <label>{{__('vendorAdmin.specific_shipping_terms')}}</label>
                                        <div class="row">
                                            <div class="col-md-12" id="clone-container">
                                            @if(json_decode($product->shipping_prices))
                                                @foreach(json_decode($product->shipping_prices) as $shipping_price)
                                                    <div class="clone-element">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="cities">{{__('vendorAdmin.cities')}}</label>
                                                                    <select class="form-control" id="cities" name="shipping_cities[]">
                                                                        <option value="" disabled selected>{{__('vendorAdmin.cities_placeholder')}}</option>
                                                                        @foreach($cities as $city)
                                                                            <option value="{{$city->id}}" @if($shipping_price->cities == $city->id) selected @endif>{{$city->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="price">{{__('vendorAdmin.price')}}</label>
                                                                    <input type="number" class="form-control" id="price" name="shipping_price[]" min="0" step="0.05" value="{{$shipping_price->price}}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <label for="time">{{__('vendorAdmin.time')}}</label>
                                                                    <input type="number" class="form-control" id="time" name="shipping_time[]" min="1" step="1" value="{{$shipping_price->time}}" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group">
                                                                    <label for="format">{{__('vendorAdmin.format')}}</label>
                                                                    <select class="form-control" id="format" name="shipping_format[]">
                                                                        <option value="" disabled selected>{{__('vendorAdmin.format_placeholder')}}</option>
                                                                        <option value="hour" @if($shipping_price->format == 'hour') selected @endif>{{__('vendorAdmin.hour')}}</option>
                                                                        <option value="day" @if($shipping_price->format == 'day') selected @endif>{{__('vendorAdmin.day')}}</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div class="form-group">
                                                                    <label>{{__('vendorAdmin.remove')}}</label>
                                                                    <button class="form-control btn btn-danger btn-xs clone-remove">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                @endif
                                            </div>
                                            <div class="col-md-12">
                                                <button type="button" id="clone-add" class="btn btn-youmats btn-block">{{__('vendorAdmin.add')}}</button>
                                            </div>
                                        </div>

                                        <hr/>
                                        <div class="card">
                                            <div class="card-header card-youmats">
                                                <h3 class="card-title">{{__('vendorAdmin.default_for_all_cities') . ' ' . __('vendorAdmin.optional')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="price">{{__('vendorAdmin.default_format')}}</label>
                                                    <input type="number" class="form-control" id="price" name="default_price" min="0" step="0.05" value="{{$product->default_price}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="time">{{__('vendorAdmin.default_time')}}</label>
                                                    <input type="number" class="form-control" id="time" name="default_time" min="1" step="1" value="{{$product->default_time}}" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="format">{{__('vendorAdmin.default_format')}}</label>
                                                    <select class="form-control" id="format" name="default_format">
                                                        <option value="" disabled selected>{{__('vendorAdmin.format_placeholder')}}</option>
                                                        <option value="hour" @if($product->default_format == 'hour') selected @endif>{{__('vendorAdmin.hour')}}</option>
                                                        <option value="day" @if($product->default_format == 'day') selected @endif>{{__('vendorAdmin.day')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-youmats">{{__('vendorAdmin.submit')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js_additional')
    <script>
        $(document).ready(function() {
            var clone_element = `<div class="clone-element">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="cities">{{__('vendorAdmin.cities')}}</label>
                            <select class="form-control" id="cities" name="shipping_cities[]">
                                <option value="" disabled selected>{{__('vendorAdmin.cities_placeholder')}}</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="price">{{__('vendorAdmin.price')}}</label>
                            <input type="number" class="form-control" id="price" name="shipping_price[]" min="0" step="0.05" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="time">{{__('vendorAdmin.time')}}</label>
                            <input type="number" class="form-control" id="time" name="shipping_time[]" min="1" step="1" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="format">{{__('vendorAdmin.format')}}</label>
                            <select class="form-control" id="format" name="shipping_format[]">
                                <option value="" disabled selected>{{__('vendorAdmin.format_placeholder')}}</option>
                                <option value="hour">{{__('vendorAdmin.hour')}}</option>
                                <option value="day">{{__('vendorAdmin.day')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-1">
                <div class="form-group">
                    <label>{{__('vendorAdmin.remove')}}</label>
                    <button class="form-control btn btn-danger btn-xs clone-remove">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
                </div>
            </div>`;
            $('#clone-add').on('click', function () {
                $('#clone-container').append(clone_element);
            });
            $(document).on('click', '.clone-remove', function () {
                $(this).closest('.clone-element').remove();
            });
            @if(!$product->specific_shipping)
                $('#specific_shipping').hide();
            @endif
            $('#specific').on('change', function () {
                $('#specific_shipping').toggle();
            });

            $('#attributes').select2({
                theme: 'classic',
                width: '100%',
                placeholder: "{{__('vendorAdmin.attributes_placeholder')}}"
            });

            getSubCategories({{$selected_category}});
            getTemplateForTitle({{$product->category_id}});

            $('#category').change(function () {
                getSubCategories($(this).val());
            });

            $('#subCategory').change(function () {
                getAttributes($(this).val());
                getTemplateForTitle($(this).val());
            });

            $('.absolute-image').click(function() {
                $(this).parent('.image-container').remove();
            });

            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    // $('div.temp-img-container').html('');
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img style="border-color: #F00;" class="img-thumbnail" width="200">')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };
            $('#gallery').on('change', function() {
                imagesPreview(this, 'div.temp-img-container');
            });

        });
        function getSubCategories(category_id) {
            var subCategoryElement = $('#subCategory'),
                selected_subCategory = "{{$product->category_id}}";
            $.ajax({
                type: 'GET',
                url: "{{route('vendor.category.getSub')}}",
                data: { category_id: category_id }
            }).done(function(response) {
                subCategoryElement.html('');
                subCategoryElement.append(`<option value="" selected disabled>{{__('vendorAdmin.subCategory_placeholder')}}</option>`);
                $.each(response, function(key, value){
                    if(key != selected_subCategory) {
                        subCategoryElement.append(`<option value="`+key+`">`+value+`</option>`);
                    } else {
                        subCategoryElement.append(`<option value="`+key+`" selected>`+value+`</option>`);
                    }
                });
            });
        }
        function getAttributes(subCategory_id) {
            var attributes = $('#attributes'),
                locale = "{{\Mcamara\LaravelLocalization\Facades\LaravelLocalization::getCurrentLocale()}}";
            $.ajax({
                type: 'GET',
                url: "{{route('vendor.category.getAttr')}}",
                data: { subCategory_id: subCategory_id }
            }).done(function(response){
                attributes.html('');
                $.each(response, function(i, attr){
                    if(locale == 'ar') {
                        attributes.append(`<optgroup label="`+attr.key.ar+`">`);
                        $.each(attr.values, function(i, value) {
                            attributes.append(`<option value="`+value.id+`">`+value.value.ar+`</option>`);
                        });
                        attributes.append(`</optgroup>`);
                    } else if(locale == 'en') {
                        attributes.append(`<optgroup label="`+attr.key.en+`">`);
                        $.each(attr.values, function(i, value) {
                            attributes.append(`<option value="`+value.id+`">`+value.value.en+`</option>`);
                        });
                        attributes.append(`</optgroup>`);
                    }
                });
            });
        }
        function getTemplateForTitle(subCategory_id) {
            $.ajax({
                type: 'GET',
                url: "{{route('vendor.category.getTemplate')}}",
                data: { subCategory_id: subCategory_id }
            }).done(function(response){
                if(response.length == 0 || response[0] == null) {
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        $('#template-{{$localeCode}}').html(`<input type="text" class="form-control" name="name_{{$localeCode}}" id="name-{{$localeCode}}" value="{{$product->getTranslation('name', $localeCode)}}">`);
                    @endforeach
                } else {
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    var template = $('#template-{{$localeCode}}');
                    template.html('');
                    response.forEach(function (value, index) {
                        var word = value.word.{{$localeCode}},
                            firstLetter = word.split('')[0],
                            name = '{{$product->getTranslation('temp_name', $localeCode)}}',
                            splitName = name.split('-');
                        if(word == '') return;

                        console.log(name);

                        if(firstLetter == '+') {
                            if(splitName[index] == undefined) {
                                splitName[index] = '';
                            }
                            template.append(`<input type="text" class="form-control d-inline-block w-auto mx-1"
                                    name="name_{{$localeCode}}[`+index+`]" value="`+splitName[index]+`"
                                    placeholder="`+word.substr(1)+`">`
                            );
                        } else if(firstLetter == '-') {
                            var split = word.substr(1).split('-'),
                                options = '';
                            split.splice(1).forEach(function (value) {
                                if(splitName[index] == value) {
                                    options += `<option value="`+value+`" selected>`+value+`</option>`;
                                } else {
                                    options += `<option value="`+value+`">`+value+`</option>`;
                                }
                            });
                            template.append(`<select class="form-control d-inline-block w-auto mx-1" name="name_{{$localeCode}}[`+index+`]">
                                        <option value="" disabled selected>`+split[0]+`</option>`+options+`</select>`);
                        } else {
                            template.append(`
                                <input type="hidden" name="name_{{$localeCode}}[`+index+`]" value="`+word+`" >
                                <label class="mx-1">`+word+`</label>
                            `);
                        }
                    });
                    @endforeach
                }
            });
        }
    </script>
@endsection
