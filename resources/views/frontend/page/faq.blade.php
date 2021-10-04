@extends('frontend.master')
@section("title", "FAQ")
@section('content')
    <!-- page wapper-->
    @push('style')
        <style>
            /*---------- faq acordian ----------*/
            .faq-item .panel-default > .panel-heading {
                color: #fff;
                background-color: #f7f7f7;
                border-color: #e4e5e7;
                padding: 0;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }

            .faq-item .panel-default > .panel-heading a {
                display: block;
                padding: 18px 15px 18px 175px;
                color: #ffffff;
                background-color: #268507;
                font-size: 17px;
                font-weight: 600;
                text-transform: capitalize;
            }

            .faq-item .panel-default > .panel-heading a span {
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                background: #b93d53;
                font-weight: 700;
                color: #ffffff;
                display: inline-block;
                padding: 17px 24px;
                /* vertical-align: middle; */
            }

            .faq-item .panel-default > .panel-heading a:after {
                content: "";
                position: relative;
                top: 1px;
                display: inline-block;
                font-family: 'Glyphicons Halflings';
                font-style: normal;
                line-height: 1;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                float: right;
                transition: transform .25s linear;
                -webkit-transition: -webkit-transform .25s linear;
                background: transparent;
                color: #ffffff;
                font-size: 22px;
                font-weight: bold;
            }

            .faq-item .panel-default > .panel-heading a[aria-expanded="true"] {
                background-color: #268507;
            }

            .faq-item .panel-default > .panel-heading a[aria-expanded="true"]:after {
                content: "\2212";
                -webkit-transform: rotate(180deg);
                transform: rotate(180deg);
                color: #ffffff;
            }

            .faq-item .panel-default > .panel-heading a[aria-expanded="false"]:after {
                content: "\002b";
                -webkit-transform: rotate(90deg);
                transform: rotate(90deg);
            }

            .faq-item .panel-title {
                font-family: 'Raleway', sans-serif;
            }

            .faq-item .accordion-option {
                width: 100%;
                float: left;
                clear: both;
                margin: 15px 0;
            }

            .faq-item .accordion-option .title {
                font-size: 20px;
                font-weight: bold;
                float: left;
                padding: 0;
                margin: 0;
            }

            .faq-item .accordion-option .toggle-accordion {
                float: right;
                font-size: 16px;
                color: #6a6c6f;
            }

            .faq-item .accordion-option .toggle-accordion:before {
                content: "Expand All";
            }

            .faq-item .accordion-option .toggle-accordion.active:before {
                content: "Collapse All";
            }

            .faq-item .panel-default > .panel-heading + .panel-collapse > .panel-body {
                border: medium none;
                padding: 22px 28px;
            }

            .faq-item .panel-group .panel {
                background: #e8eeff none repeat scroll 0 0;
                border: medium none;
                border-radius: 4px;
                margin-bottom: 14px;
            }

            .faq-item .panel-body .tab-content p {
                line-height: 28px;
                margin-bottom: 13px;
                text-align: justify;
            }

            .faq-cat-title {
                /*font-size: 20px;*/
                font-weight: 700;
                color: #ffffff;
                background: #fcb102;
                line-height: 30px;
                padding: 13px 23px;
                /*text-align: center;*/
            }

            .faq-item {
                margin-bottom: 60px;
            }

            .faq-item:last-of-type {
                margin-bottom: 0;
            }

            .faq-page {
                padding: 60px 0;
            }

            .collapse2.in {
                display: block;
            }

            .collapse2.show {
                display: block;
            }

            .collapse2:not(.show) {
                display: none;
            }
        </style>
    @endpush
    <?php
    $bannerImage = SM::smGetThemeOption("faq_banner_image");
    $faq_sections = SM::smGetThemeOption("faq_sections", []);
    $faqLoop = 1;
    ?>
    <div class="columns-container">
        <div class="container-fluid" id="columns">
            <!-- breadcrumb -->
        @include('frontend.common.breadcrumb', ['bannerImage'=>$bannerImage])
        <!-- ./breadcrumb -->
            <!-- row -->
            <div class="row">
                <!-- Left colunm -->
                <div class="column col-xs-12 col-sm-12" id="left_column">
                    <!-- block category -->
                    @if(count($faq_sections)>0)
                        <div class="block left-module">
                            <p class="title_block">FAQ</p>
                            <div class="block_content">
                                <!-- layered -->
                                <div class="layered layered-category">
                                    <div class="layered-content">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @foreach($faq_sections as $section)
                                                        <div class="faq-item">
                                                            <?php
                                                            $faq_section_title = isset($section['faq_section_title']) ? $section['faq_section_title'] : null;
                                                            $faqs = isset($section['faqs']) ? $section['faqs'] : [];
                                                            ?>
                                                            @empty(!$faq_section_title)
                                                                <h3 class="faq-cat-title">{{ $faq_section_title }}</h3>
                                                            @endempty
                                                            <div class="panel-group" id="accordion" role="tablist"
                                                                 aria-multiselectable="true">
                                                                @if(count($faqs)>0)
                                                                    @foreach($faqs as $faqString)
                                                                        <?php
                                                                        $faq = is_string($faqString) ? json_decode($faqString, true) : $faqString;
                                                                        $faq_title = isset($faq['faq_title']) ? $faq['faq_title'] : "";
                                                                        $faq_description = isset($faq['faq_description']) ? $faq['faq_description'] : "";
                                                                        ?>
                                                                        <div class="panel panel-default"
                                                                             id="collapse_cat{{ $faqLoop ==1 ? "true" : "false" }}">
                                                                            <div class="panel-heading" role="tab"
                                                                                 id="heading{{ $faqLoop }}">
                                                                                <h4 class="panel-title">
                                                                                    <a class="{{ $faqLoop ==1 ? "" : "collapsed" }}"
                                                                                       role="button"
                                                                                       data-toggle="collapse"
                                                                                       data-parent="#accordion"
                                                                                       href="#collapse{{ $faqLoop }}"
                                                                                       aria-expanded="{{ $faqLoop ==1 ? "true" : "false" }}"
                                                                                       aria-controls="collapse{{ $faqLoop }}">
                                                                                        <span>Question {{ $loop->iteration }}</span> {{ $faq_title }}
                                                                                    </a>
                                                                                </h4>
                                                                            </div>
                                                                            <div id="collapse{{ $faqLoop }}"
                                                                                 class="panel-collapse collapse {{ $faqLoop ==1 ? "in" : "" }} collapse2"
                                                                                 role="tabpanel"
                                                                                 aria-labelledby="heading{{ $faqLoop }}">
                                                                                <div class="panel-body">
                                                                                    <div class="tab-content">
                                                                                        {!! $faq_description !!}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                        $faqLoop++;
                                                                        ?>
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./layered -->
                            </div>
                        </div>
                @endif
                <!-- ./block category  -->

                </div>
                <!-- ./left colunm -->
            </div>
            <!-- ./row-->
        </div>
    </div>
    <!-- ./page wapper-->
@endsection
