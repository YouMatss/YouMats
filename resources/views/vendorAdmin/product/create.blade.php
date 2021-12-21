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
                                    <select class="form-control" multiple name="tags" id="tags">
                                        <option value="" selected disabled>{{__('vendorAdmin.tags_placeholder')}}</option>
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
                                            <label for="logo">{{__('vendorAdmin.logo')}}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="logo" class="custom-file-input" id="logo">
                                                    <label class="custom-file-label">{{__('vendorAdmin.choose_file')}}</label>
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <img class="img-thumbnail" width="200" src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_LOGO)['url'] }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cover">{{__('vendorAdmin.cover')}}</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" name="cover" class="custom-file-input" id="cover">
                                                    <label class="custom-file-label">{{__('vendorAdmin.choose_file')}}</label>
                                                </div>
                                            </div>
                                            <div class="mt-1">
                                                <img class="img-thumbnail" width="200" src="{{ $vendor->getFirstMediaUrlOrDefault(VENDOR_COVER)['url'] }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="licenses">{{__('vendorAdmin.licenses')}}</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" multiple name="licenses" class="custom-file-input" id="licenses">
                                            <label class="custom-file-label">{{__('vendorAdmin.choose_file')}}</label>
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        @foreach($vendor->getMedia(VENDOR_PATH) as $license)
                                            <img class="img-thumbnail" width="200" src="{{ $license->getUrl() }}">
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="location">{{__('vendorAdmin.location')}}</label>
                                    {!! generate_map() !!}
                                    <input type="hidden" class="lat" value="{{$vendor->latitude}}" readonly name="latitude" required>
                                    <input type="hidden" class="lng" value="{{$vendor->longitude}}" readonly name="longitude" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="facebook">{{__('vendorAdmin.facebook')}}</label>
                                            <input type="url" class="form-control" name="facebook"
                                                   id="facebook" value="{{$vendor->facebook}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="twitter">{{__('vendorAdmin.twitter')}}</label>
                                            <input type="url" class="form-control" name="twitter"
                                                   id="twitter" value="{{$vendor->twitter}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="youtube">{{__('vendorAdmin.youtube')}}</label>
                                            <input type="url" class="form-control" name="youtube"
                                                   id="youtube" value="{{$vendor->youtube}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="instagram">{{__('vendorAdmin.instagram')}}</label>
                                            <input type="url" class="form-control" name="instagram"
                                                   id="instagram" value="{{$vendor->instagram}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pinterest">{{__('vendorAdmin.pinterest')}}</label>
                                            <input type="url" class="form-control" name="pinterest"
                                                   id="pinterest" value="{{$vendor->pinterest}}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="website">{{__('vendorAdmin.website')}}</label>
                                            <input type="url" class="form-control" name="website"
                                                   id="website" value="{{$vendor->website}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">{{__('vendorAdmin.password')}}</label>
                                            <input type="password" class="form-control" name="password"
                                                   id="password" placeholder="{{__('vendorAdmin.password_leave_it_blank')}}" ">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password_confirmation">{{__('vendorAdmin.password_confirmation')}}</label>
                                            <input type="password" class="form-control" name="password_confirmation"
                                                   id="password_confirmation">
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
