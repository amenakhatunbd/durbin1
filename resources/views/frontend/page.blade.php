@extends('frontend.master')
@section("title",$page->page_title)
@section("content")
    <!-- page wapper-->
    <div class="columns-container">
        <div class="container-fluid" id="columns">
            <!-- breadcrumb -->
        @include('frontend.common.breadcrumb', ['bannerImage'=>$page->banner_image])
        <!-- ./breadcrumb -->
            <div class="row">
                <!-- Left colunm -->
                <div class="column col-xs-12 col-sm-12" id="left_column">
                    <!-- block category -->
                    <div class="block left-module">
                        <p class="title_block">{{ $page->page_title }}</p>
                        <div class="block_content">
                            <!-- layered -->
                            <div class="layered layered-category">
                                <div class="layered-content">
                                    <p>{!! stripslashes( $page->content ) !!}</p>
                                </div>
                            </div>
                            <!-- ./layered -->
                        </div>
                    </div>
                    <!-- page heading-->
                </div>
            </div>
        </div>
    </div>
    <!-- ./page wapper-->
@endsection
