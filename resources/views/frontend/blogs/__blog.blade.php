@extends('frontend.master')
@section("title", "Blog")
@section('content')
    <style>
        a {
            color: #363637;
        }
    </style>
    <!-- page wapper-->
    <div class="columns-container">
        <div class="container-fluid" id="columns">
            <!-- breadcrumb -->
        @include('frontend.common.breadcrumb')
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
                        <span class="page-noite">Showing {{ $blogPost->firstItem() }} to {{ $blogPost->lastItem() }} of {{ $blogPost->total() }}</span>

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