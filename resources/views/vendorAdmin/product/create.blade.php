@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.create_product')}}</title>
@endsection
@section('content')
    <section class="content pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{__('vendorAdmin.create_product')}}</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name-ar">{{__('vendorAdmin.name_ar')}}</label>
                                            <input type="text" class="form-control" name="name_ar" id="name-ar">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name-en">{{__('vendorAdmin.name_en')}}</label>
                                            <input type="text" class="form-control" name="name_en" id="name-en">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="category">{{__('vendorAdmin.category')}}</label>
                                    <select class="form-control" name="category_id" id="category">
                                        <option value="" selected disabled>{{__('vendorAdmin.category_placeholder')}}</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tags">{{__('vendorAdmin.tags')}}</label>
                                    <select class="form-control tags-select" multiple="multiple" name="tags[]" id="tags">
                                        @foreach($tags as $tag)
                                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="short_desc_ar">{{__('vendorAdmin.short_desc_ar')}}</label>
                                            <textarea id="short_desc_ar" class="form-control" name="short_desc_ar"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="short_desc_en">{{__('vendorAdmin.short_desc_en')}}</label>
                                            <textarea id="short_desc_en" class="form-control" name="short_desc_en"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="desc_ar">{{__('vendorAdmin.desc_ar')}}</label>
                                            <textarea id="desc_ar" rows="5" class="form-control" name="desc_ar"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="desc_en">{{__('vendorAdmin.desc_en')}}</label>
                                            <textarea id="desc_en" rows="5" class="form-control" name="desc_en"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="type">{{__('vendorAdmin.type')}}</label>
                                    <select class="form-control" name="type" id="type">
                                        <option selected disabled>{{__('vendorAdmin.type_placeholder')}}</option>
                                        <option value="product">{{__('vendorAdmin.type_product')}}</option>
                                        <option value="service">{{__('vendorAdmin.type_service')}}</option>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cost">{{__('vendorAdmin.cost')}}</label>
                                            <input type="number" class="form-control" name="cost" id="cost" min="0" step="0.01">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="price">{{__('vendorAdmin.price')}}</label>
                                            <input type="number" class="form-control" name="price" id="price" min="0" step="0.01">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="stock">{{__('vendorAdmin.stock')}}</label>
                                    <input type="number" class="form-control" name="stock" id="stock" min="0" step="1">
                                </div>
                                <div class="form-group">
                                    <label for="unit">{{__('vendorAdmin.unit')}}</label>
                                    <select class="form-control" name="unit_id" id="unit">
                                        <option selected disabled>{{__('vendorAdmin.unit_placeholder')}}</option>
                                        @foreach($units as $unit)
                                            <option value="{{$unit->id}}">{{$unit->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="min_quantity">{{__('vendorAdmin.min_quantity')}}</label>
                                    <input type="number" class="form-control" name="min_quantity" id="min_quantity" min="1" step="1">
                                </div>

                                <div class="form-group">
                                    <label for="sku">{{__('vendorAdmin.sku')}}</label>
                                    <input type="text" class="form-control" name="SKU" id="sku">
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
                                </div>

                                <hr/>

                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">{{__('vendorAdmin.shipping')}}</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="shipping">{{__('vendorAdmin.shipping')}}</label>
                                            <select id="shipping" class="form-control" name="shipping_id">
                                                <option value="" selected disabled>{{__('vendorAdmin.shipping_placeholder')}}</option>
                                                @foreach($vendor->shippings as $shipping)
                                                    <option value="{{$shipping->id}}">{{$shipping->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="specific">{{__('vendorAdmin.specific_shipping')}}</label>
                                            <input type="checkbox" class="form-control" id="specific" name="specific_shipping">
                                        </div>
                                        <div class="card card-dark" id="specific_shipping">
                                            <div class="card-header">
                                                <h3 class="card-title">{{__('vendorAdmin.specific_shipping')}}</h3>
                                            </div>
                                            <div class="card-body">
                                                <label>{{__('vendorAdmin.specific_shipping_terms')}}</label>
                                                <div class="row">
                                                    <div class="col-md-12" id="clone-container"></div>
                                                    <div class="col-md-12">
                                                        <button type="button" id="clone-add" class="btn btn-primary btn-block">{{__('vendorAdmin.add')}}</button>
                                                    </div>
                                                </div>

                                                <hr/>
                                                <div class="card card-dark">
                                                    <div class="card-header">
                                                        <h3 class="card-title">{{__('vendorAdmin.default_for_all_cities') . ' ' . __('vendorAdmin.optional')}}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <label for="price">{{__('vendorAdmin.price')}}</label>
                                                            <input type="number" class="form-control" id="price" name="default_price" min="0" step="0.05" />
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="time">{{__('vendorAdmin.time')}}</label>
                                                            <input type="number" class="form-control" id="time" name="default_time" min="1" step="1" />
                                                        </div>
                                                        <div class="form-group">
                                            <label for="format">{{__('vendorAdmin.format')}}</label>
                                            <select class="form-control" id="format" name="default_format">
                                                <option value="" disabled selected>{{__('vendorAdmin.format_placeholder')}}</option>
                                                <option value="hour">{{__('vendorAdmin.hour')}}</option>
                                                <option value="day">{{__('vendorAdmin.day')}}</option>
                                            </select>
                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
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
        $('#specific_shipping').hide();
        $('#specific').on('change', function () {
            $('#specific_shipping').toggle();
        });
    });
</script>
@endsection
