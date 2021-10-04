@extends('frontend.master')
@section("title", "Blog")
@section('content')
    <?php

    $title = SM::smGetThemeOption( "blog_banner_title" );
    $subtitle = SM::smGetThemeOption( "blog_banner_subtitle" );
    $bannerImage = SM::smGetThemeOption( "blog_banner_image" );
    ?>
    <!-- page wapper-->
    <div class="columns-container">
        <div class="container-fluid" id="columns">
            <!-- breadcrumb -->
        @include('frontend.common.breadcrumb', ['bannerImage'=>$bannerImage])
        <!-- ./breadcrumb -->
            <!-- row -->
            <div class="row">
                <!-- Left colunm -->
                <div class="column col-xs-12 col-sm-3" id="left_column">
                    @include("frontend.blogs.blog_sidebar")
                </div>
                <!-- Center colunm-->
                <div class="center_column col-xs-12 col-sm-9" id="center_column">
                    <h2 class="page-heading">
                        <span class="page-heading-title2">Blog post</span>
                    </h2>
                    <div class="sortPagiBar clearfix">
                        <span class="page-noite">Showing 1 to 7 of 45 (15 Pages)</span>
                        <div class="bottom-pagination">
                            <nav>
                                <ul class="pagination">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li>
                                        <a href="#" aria-label="Next">
                                            <span aria-hidden="true">Next &raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <ul class="blog-posts">
                        @include('frontend.blogs.blog_list_item')
                    </ul>
                </div>
                <!-- ./ Center colunm -->
            </div>
            <!-- ./row-->
        </div>
    </div>
    <!-- ./page wapper-->
@endsection