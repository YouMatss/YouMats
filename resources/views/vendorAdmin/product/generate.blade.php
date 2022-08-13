@extends('vendorAdmin.layouts.master')
@section('title')
    <title>{{__('vendorAdmin.generate_product')}}</title>
@endsection
@section('content')
    <section class="content content-vendor-edit pt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-2">
                    <h4>{{__('vendorAdmin.generate_product')}}</h4>
                    <form action="{{route('vendor.product.request.generate')}}" method="post" enctype="multipart/form-data">
                        <div class="card">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="category">{{__('vendorAdmin.category')}}</label>
                                            <select class="form-control" id="category">
                                                <option value="" selected disabled>{{__('vendorAdmin.category_placeholder')}}</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="subCategory">{{__('vendorAdmin.subCategory')}}</label>
                                            <select class="form-control" name="category_id" id="subCategory">
                                                <option value="" selected disabled>{{__('vendorAdmin.subCategory_placeholder')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <nav>
                                            <div class="nav nav-languages" id="nav-tab" role="tablist">
                                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                    <a class="nav-link @if($loop->first) active @endif" id="nav-{{$localeCode}}-tab-name"
                                                       data-toggle="tab" href="#nav-{{$localeCode}}-name" role="tab" aria-controls="nav-{{$localeCode}}-name" aria-selected="false">{{ $properties['native'] }}</a>
                                                @endforeach
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-lg-12">
                                        <div class="tab-content" id="nav-tabContent">
                                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                <div class="tab-pane fade @if($loop->first) show active @endif"
                                                     id="nav-{{$localeCode}}-name" role="tabpanel" aria-labelledby="nav-{{$localeCode}}-tab-name">
                                                    <div class="form-group">
                                                        <label for="name-{{$localeCode}}">{{__('vendorAdmin.name')}}</label>
                                                        <div id="template-{{$localeCode}}">
                                                            <input type="text" class="form-control" name="name_{{$localeCode}}" id="name-{{$localeCode}}" value="{{old('name-'.$localeCode)}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
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
            $('#category').change(function () {
                getSubCategories($(this).val());
            });

            $('#subCategory').change(function () {
                getTemplateForTitle($(this).val());
            });

        });
        function getSubCategories(category_id) {
            var subCategoryElement = $('#subCategory');
            $.ajax({
                type: 'GET',
                url: "{{route('vendor.category.getSub')}}",
                data: { category_id: category_id }
            }).done(function(response) {
                subCategoryElement.html('');
                subCategoryElement.append(`<option value="" selected disabled>{{__('vendorAdmin.subCategory_placeholder')}}</option>`);
                $.each(response, function(key, value){
                    subCategoryElement.append(`<option value="`+key+`">`+value+`</option>`);
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
                    $('#template-{{$localeCode}}').html(`<input type="text" class="form-control" name="name_{{$localeCode}}" id="name-{{$localeCode}}" value="{{old('name-'.$localeCode)}}">`);
                    @endforeach
                } else {
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    var template = $('#template-{{$localeCode}}');
                    template.html('');
                    response.forEach(function (value, index) {
                        var word = value.word.{{$localeCode}},
                            firstLetter = word.split('')[0];
                        if(firstLetter == '+') {
                            template.append(`<input type="text" class="form-control d-inline-block w-auto mx-1"
                                    name="name_{{$localeCode}}[`+index+`]"
                                    placeholder="`+word.substr(1)+`">`
                            );
                        } else if(firstLetter == '-') {
                            var split = word.substr(1).split('-'),
                                options = '';
                            split.splice(1).forEach(function (value) {
                                options += `<option value="`+value+`">`+value+`</option>`;
                            });
                            template.append(`<select class="form-control d-inline-block w-auto mx-1" name="name_{{$localeCode}}[`+index+`]">
                                        <option value="" disabled selected>`+split[0]+`</option>`+options+`</select>`);
                        } else {
                            template.append(`
                            <input type="hidden" name="name_{{$localeCode}}[`+index+`]" value="`+word+`" >
                            <label class="mx-1 w-auto">`+word+`</label>
                        `);
                        }
                    });
                    @endforeach
                }
            });
        }
    </script>
@endsection
