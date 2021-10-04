@extends('frontend.master')
@section("title", $brandInfo->title)
@section('content')
    @push('style')
        <style>
            #loading {
                text-align: center;
                background: url('loader.gif') no-repeat center;
                height: 150px;
            }
        </style>
    @endpush
    <div class="columns-container">
        <div class="container-fluid" id="columns">
            <!-- breadcrumb -->
        @include('frontend.common.breadcrumb')
        <!-- ./breadcrumb -->
            <!-- row -->
            <div class="row">
                <!-- Left colunm -->
            @include('frontend.products.product_sidebar')
            <!-- ./left colunm -->
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-md-9 col-lg-9 col-sm-8" id="center_column">
                    <!-- view-product-list-->
                    <div class="short-list-style">
                        <div class="toolbar mb-3">
                            <div class="form-inline">
                                <div class="form-group col-12 col-md-8">
                                    <span class="title-style"><i class="fa fa-shopping-cart"></i> {{$brandInfo->title}} </span>
                                </div>
                                <div class="form-group col-md-4 center">
                                    <label class="col-12 col-md-4 col-form-label">Sort</label>
                                    <select data-role="sorter"
                                            class="col-12 col-md-8 form-control sortby onChangeProductFilter form-inline-style orderByPrice">
                                        <option value="">Popularity</option>
                                        <option value="1">Product Name</option>
                                        <option value="2">New</option>
                                        <option value="3">Best Sellers</option>
                                        <option value="4">Most Viewed</option>
                                        <option value="5">Price low to high</option>
                                        <option value="6">Price high to low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                <!-- ./PRODUCT LIST -->
                    <div class="columns-container p-0" id="ajax_view_product_list">
                    </div>
                </div>
                <!-- ./view-product-list-->
            </div>
            <!-- ./ Center colunm -->
        </div>
        <!-- ./row-->
    </div> 
@endsection