@extends('frontend.master')
@section('title', 'Shop')
@section('content')
    <?php
    $product_sliders = SM::smGetThemeOption("product_sliders", array());
    ?>
    @if(count($product_sliders)>0)
        <section class="slider-section">
            <div class="container">
                <div id="myCarousel1" class="carousel slide carousel-fade" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        @foreach($product_sliders as $key=> $product_slider)
                            <li data-target="#myCarousel1" data-slide-to="{{$key}}"
                                class="{{ $key==0?'active' : '' }}"></li>
                        @endforeach
                    </ol>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @foreach($product_sliders as $key=> $product_slider)
                            <div class="item {{ $key==0?'active' : '' }}">
                                <img src="{!! SM::sm_get_the_src($product_slider["image"], 1140, 280) !!}"
                                     alt="{{ $product_slider['title'] }}"
                                     class="img-responsive">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="mar-top-20">
        <div class="container">
            <div class="row">
                @include('frontend.products.product_sidebar')
                <div class="col-md-9">
                    <div class="all-books-content">
                        <ol class="breadcrumb hidden">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Books</a></li>
                            <li><a href="#">Categoris</a></li>
                            <li class="active">Books</li>
                        </ol>
                        @if(!empty($type))
                            <input type="hidden" value="{{$type}}" name="get_type" id="get_type">
                        @endif
                        <div id="ajax_view_product_list"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection