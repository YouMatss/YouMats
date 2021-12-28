@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.edit_product')}}</title>
@endsection
@section('content')
    <section class="content pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-youmats">
                            <h3 class="card-title">{{__('vendorAdmin.edit_product')}}</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name-ar">{{__('vendorAdmin.name_ar')}}</label>
                                            <input type="text" class="form-control" name="name_ar" id="name-ar" value="{{$product->getTranslation('name','ar')}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name-en">{{__('vendorAdmin.name_en')}}</label>
                                            <input type="text" class="form-control" name="name_en" id="name-en" value="{{$product->getTranslation('name','en')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category">{{__('vendorAdmin.category')}}</label>
                                    <select class="form-control" name="category_id" id="category">
                                        <option value="" selected disabled>{{__('vendorAdmin.category_placeholder')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}" @if($product->category_id == $category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tags">{{__('vendorAdmin.tags')}}</label>
                                    <select class="form-control tags-select" multiple="multiple" name="tags[]" id="tags">
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}" @if(in_array($tag->id, $product->tags->pluck('id')->toArray())) selected @endif>{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="short_desc_ar">{{__('vendorAdmin.short_desc_ar')}}</label>
                                            <textarea id="short_desc_ar" class="form-control ckeditor" name="short_desc_ar">{{ $product->getTranslation('short_desc','ar') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="short_desc_en">{{__('vendorAdmin.short_desc_en')}}</label>
                                            <textarea id="short_desc_en" class="form-control ckeditor" name="short_desc_en">{{ $product->getTranslation('short_desc','en') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="desc_ar">{{__('vendorAdmin.desc_ar')}}</label>
                                            <textarea id="desc_ar" class="form-control ckeditor" name="desc_ar">{{$product->getTranslation('desc','ar')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="desc_en">{{__('vendorAdmin.desc_en')}}</label>
                                            <textarea id="desc_en" class="form-control ckeditor" name="desc_en">{{$product->getTranslation('desc','en')}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="type">{{__('vendorAdmin.type')}}</label>
                                    <select class="form-control" name="type" id="type">
                                        <option selected disabled>{{__('vendorAdmin.type_placeholder')}}</option>
                                        <option value="product" @if($product->type == 'product') selected @endif>{{__('vendorAdmin.type_product')}}</option>
                                        <option value="service" @if($product->type == 'service') selected @endif>{{__('vendorAdmin.type_service')}}</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cost">{{__('vendorAdmin.cost')}}</label>
                                            <input type="number" class="form-control" name="cost" id="cost" min="0" step="0.01" value="{{$product->cost}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">{{__('vendorAdmin.price')}}</label>
                                            <input type="number" class="form-control" name="price" id="price" min="0" step="0.01" value="{{$product->price}}">
                                        </div>
                                    </div>
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

                                <hr/>

                                <div class="form-group">
                                    <label for="gallery">{{__('vendorAdmin.gallery')}}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" multiple name="gallery" class="custom-file-input" id="gallery">
                                            <label class="custom-file-label">{{__('vendorAdmin.choose_images')}}</label>
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        @foreach($product->getMedia(PRODUCT_PATH) as $image)
                                            <img class="img-thumbnail" width="200" src="{{ $image->getUrl() }}">
                                        @endforeach
                                    </div>
                                </div>

                                <hr/>

                                <div class="card">
                                    <div class="card-header card-youmats">
                                        <h3 class="card-title">{{__('vendorAdmin.shipping')}}</h3>
                                    </div>
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
                                                        @foreach(json_decode($product->shipping_prices) as $shipping_price)
                                                            <div class="clone-element">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="cities">{{__('vendorAdmin.cities')}}</label>
                                                                            <select class="form-control" id="cities" name="cities[]">
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
                                                                            <input type="number" class="form-control" id="price" name="price[]" min="0" step="0.05" value="{{$shipping_price->price}}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <div class="form-group">
                                                                            <label for="time">{{__('vendorAdmin.time')}}</label>
                                                                            <input type="number" class="form-control" id="time" name="time[]" min="1" step="1" value="{{$shipping_price->time}}" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="format">{{__('vendorAdmin.format')}}</label>
                                                                            <select class="form-control" id="format" name="format[]">
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

                                <div class="card">
                                    <div class="card-header card-youmats">
                                        <h3 class="card-title">{{__('vendorAdmin.attributes')}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="attributes">{{__('vendorAdmin.attributes')}}</label>
                                            <select class="form-control" multiple="multiple" id="attributes" name="attributes[]">
                                                @foreach($attributes as $attribute)
                                                    <optgroup label="{{$attribute->key}}">
                                                        @foreach($attribute->values as $value)
                                                            <option value="{{$value->value}}" @if(in_array($value->id, json_decode($product->attributes))) selected @endif>{{$value->value}}</option>
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-youmats">Submit</button>
                            </div>
                        </form>
                    </div>
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
                            <select class="form-control" id="cities" name="cities[]">
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
                            <input type="number" class="form-control" id="price" name="price[]" min="0" step="0.05" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="time">{{__('vendorAdmin.time')}}</label>
                            <input type="number" class="form-control" id="time" name="time[]" min="1" step="1" />
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="format">{{__('vendorAdmin.format')}}</label>
                            <select class="form-control" id="format" name="format[]">
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
            $('.tags-select').select2({
                placeholder: "{{__('vendorAdmin.tags_placeholder')}}"
            });
            $('#attributes').select2({
                placeholder: "{{__('vendorAdmin.attributes_placeholder')}}"
            });
            @if(!$product->specific_shipping)
                $('#specific_shipping').hide();
            @endif
            $('#specific').on('change', function () {
                $('#specific_shipping').toggle();
            });
        });
    </script>
@endsection
