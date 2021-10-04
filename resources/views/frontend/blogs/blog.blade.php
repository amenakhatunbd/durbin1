@extends("frontend.master")
@section("title", "Blog")
@section("content")
    <?php
    $blog_sliders = SM::smGetThemeOption("blog_sliders", array());
    ?>
    @if(count($blog_sliders)>0)
        <section class="slider-section">
            <div class="container">
                <div id="myCarousel1" class="carousel slide carousel-fade" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        @foreach($blog_sliders as $key=> $blog_slider)
                            <li data-target="#myCarousel1" data-slide-to="{{$key}}"
                                class="{{ $key==0?'active' : '' }}"></li>
                        @endforeach
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @foreach($blog_sliders as $key=> $blog_slider)
                            <div class="item {{ $key==0?'active' : '' }}">
                                <img src="{!! SM::sm_get_the_src($blog_slider["image"], 1140, 433) !!}"
                                     class="img-responsive" alt="{{ $blog_slider["title"] }}">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="blog-content-section">
        <div class="container">
            <div class="blog-contentabs">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#latest">সর্বশেষ</a></li>
                    <li><a data-toggle="tab" href="#popular">জনপ্রিয় </a></li>
                </ul>

                <div class="tab-content">
                    <div id="latest" class="tab-pane fade in active">
                        <div class="row">
                        @include('frontend.blogs.blog_list_item', ['blogs'=>$blogPost])
                        <!-- ----------------------- -->
                            <div class="clearfix"></div>
                            <div class="view-all-btn text-center">
                                <a href="" class="btn btn-warning">View All</a>
                            </div>
                        </div>
                    </div>
                    <div id="popular" class="tab-pane fade">
                        <div class="row">
                        @include('frontend.blogs.blog_list_item', ['blogs'=>$popularPost])
                        <!-- ====================== -->
                            <div class="clearfix"></div>
                            <div class="view-all-btn text-center hidden">
                                <a href="" class="btn btn-warning">View All</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection