@extends('frontend.master')
@section("title", "Dashboard")
@section("content")
{!! NoCaptcha::renderJs() !!}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://durbiin.com/nptl-admin/js/plugin/bootstrap-tags/bootstrap-tagsinput.min.js"></script>
{!! NoCaptcha::renderJs() !!}

<section class="common-section bg-black">
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                @include("customer.left-sidebar")
                <div class="mobile_dashboard_menus">
                    <div id="mySidepanel" class="sidepanel">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                        @include("customer.left-sidebar")
                    </div>
                    <button class="openbtn" onclick="openNav()">☰</button>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="account-panel">
                    <h2 class="product_add_title">Add New Book</h2>
                    <a class="product_add_botton" href="{{route('books')}}"><i class="fa fa-book"></i>Books List</a>
                    <div class="account-panel-inner">
                        <form class="" action="{{route('store_product')}}" method="POST" enctype="multipart/form-data"
                            id="choice_form">

                            <!-- Equivalent to... -->
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="added_by" value="seller">
                            <input type="hidden" name="status" value="1">
                            <div class="form-box bg-white mt-4">

                                <div class="form-box-content p-3">
                                    </br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Book Bangla Name<span class="required-star"
                                                    style="color:red!important;">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input id="name" value="{{old('title')}}" type="text"
                                                class="form-control mb-3" name="title" placeholder="Book Name" required>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Book English Name<span class="required-star"
                                                    style="color:red!important;">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input id="product_english_title" value="{{old('product_english_title')}}"
                                                type="text" class="form-control mb-3" name="product_english_title"
                                                placeholder="Book English Name" required>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Author <span class="required-star"
                                                    style="color:red!important;">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <select placeholder="Choose country(s)*" multiple="multiple"
                                                class="form-control" name="author_id[]" id="author_id" required>
                                                @foreach($author_lists as $author_list)
                                                <option value="{{$author_list->id}}">{{$author_list->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    </br>
                                    

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Translator </label>
                                        </div>
                                        <div class="col-md-8">
                                            <select multiple class="form-control demo-select2-placeholder"
                                                name="translator_id[]" id="translator_id">
                                                @foreach($author_lists as $author_list)
                                                <option value="{{$author_list->id}}">{{$author_list->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    </br>

                                    <?php
                                    $slug = Auth::user()->username;
                                    $publisher_info = \App\Model\Common\Publisher::where('slug', $slug)->first();
                                    ?>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Product Category <span class="required-star"
                                                    style="color:red!important;">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <select multiple class="form-control demo-select2-placeholder"
                                                name="categories[]" id="categories" required>
                                                @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Editor <span class="required-star" style="color:red!important;"></span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control mb-3" value="{{old('editor')}}" name="editor" placeholder="Editor">
                                        </div>

                                    </div>
                                    </br>
                                </div>
                            </div>
                            <div class="form-box bg-white mt-4">
                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Printing Price <span class="required-star"
                                                    style="color:red!important;">*</span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" class="form-control mb-3"
                                                value="{{old('regular_price')}}" name="regular_price"
                                                placeholder="Printing Price" required>
                                        </div>

                                    </div>
                                    </br>

                                    <div class="row" id="isbn">
                                        <div class="col-md-4">
                                            <label>Durbiin Discount % <span class="required-star"></span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" max="100" value="{{old('vendor_discount')}}"
                                                title="Numbers only" class="form-control mb-3 discount"
                                                name="vendor_discount" placeholder="Durbiin Discount %">
                                        </div>
                                    </div>
                                    </br>


                                    <div class="row" id="isbn">
                                        <div class="col-md-4">
                                            <label>ISBN <span class="required-star"></span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" value="{{old('isbn')}}" class="form-control mb-3 "
                                                name="isbn" placeholder="ISBN">
                                        </div>
                                    </div>
                                    </br>
                                    <div class="row" id="edition_year">
                                        <div class="col-md-4">
                                            <label>Edition Year <span class="required-star"></span></label>
                                        </div>
                                        <div class="col-md-8">

                                            <input type="text" value="{{old('edition_date')}}"
                                                class="form-control mb-3" name="edition_date"
                                                placeholder="Edition Year">

                                            <!-- <select name="edition_date" class="select2 form-control">
                                                @for($i=date('Y');$i>date('Y')-100;$i--)
                                                <option @if($i==date('Y')) selected @endif value="{{$i}}">{{$i}}
                                                </option>
                                                @endfor
                                            </select> -->

                                        </div>
                                    </div>
                                    </br>

                                    <div class="row" id="pages">
                                        <div class="col-md-4">
                                            <label>Number Of Pages<span class="required-star"></span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="number" value="{{old('number_of_pages')}}"
                                                class="form-control mb-3" name="number_of_pages"
                                                placeholder="Number of pages">
                                        </div>
                                    </div>
                                    </br>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Country<span class="required-star"></span></label>
                                        </div>
                                        <div class="col-md-8">

                                            <div class="mb-3">
                                                <select class="form-control mb-3 selectpicker"
                                                    data-placeholder="Select a unit" id="units" name="country_id">
                                                    <option value="">Select Counttry</option>
                                                    @foreach ($country_lists as $country_list)
                                                    <?php
                                                    if ($country_list->id == 19) {
                                                        $select = "selected";
                                                    } else {
                                                        $select = "";
                                                    }
                                                    ?>
                                                    <option {{$select}} value="{{ $country_list->id }}">
                                                        {{ $country_list->name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    </br>


                                    <div class="row" id="image">
                                        <div class="col-md-4">
                                            <label>Image<span class="required-star"></span></label>
                                        </div>
                                        <div class="col-md-8">
                                            <input type="file" class="form-control mb-3" name="image"
                                                placeholder="Image" required>
                                        </div>
                                    </div>
                                    </br>
                                    <div class="row">
                                        <div class="col-12" id="sku_combination">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-box bg-white mt-4">

                                <div class="form-box-content p-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Description</label>
                                        </div>
                                        <div class="col-md-8">
                                            <textarea placeholder="Type description here..." style="width:100%"
                                                class="editor"
                                                name="long_description">{{old('number_of_pages')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <div class="form-box mt-4 text-right product_add_form">

                               
                                    <div class="row">
                                        <div class="col-md-4">
                                           
                                        </div>
                                        <div class="col-md-5">
                                            <div class="google_capchar">
                                    <div
                                        class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        <div class="col-md-7">
                                            {!! app('captcha')->display() !!}
                                            @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                        </div>

                                        <div class="col-md-3">
                                            <br>
                                            <button type="submit" id="submit" class="btn btn-styled btn-base-1">Save</button>
                                        </div>

                                         
                                    </div>
                               
                            </div>














                            <div class="form-box mt-4 text-right product_add_form">
                                <!-- @include("customer.back") -->

                                
                               
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- <div class="row">
                    <div class="col-sm-3">
                       
                    </div>
                </div> -->
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $(".discount").keyup(function() {
        if ($(this).val() > 100) {
            $(this).val(100);
        }
    });
});
</script>


<script type="text/javascript">
$("#author_id").select2({
    tags: true,
    placeholder: {
        id: '-1', // the value of the option
        text: 'Search author name or save new author'
    }
});

$("#translator_id").select2({
    tags: true,
    placeholder: {
        id: '-1', // the value of the option
        text: 'Search translator name or save new translator'
    }
});

$("#categories").select2({
    tags: true,
    placeholder: {
        id: '-1', // the value of the option
        text: 'Search category name or save new category'
    }
});
</script>
@endsection