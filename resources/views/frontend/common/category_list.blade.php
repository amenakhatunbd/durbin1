<?php $is_featureds = SM::getIsFeaturedCategories(); ?>
@if(count($is_featureds)>0)
    <section class="site-content">
        <div class="container-fluid">
            <div class="products-area">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-spacial p-0">
                        <div class="paanel custom-panel-style">
                            <div class="panel-heading">
                                <h2 class="custom-panel-heading">Product Category</h2>
                            </div>
                            <div class="panel-body">
                                @foreach($is_featureds as $is_featured)
                                    <div class="product col-6 col-sm-4 col-md-3 col-lg-2 p-0">
                                        <div class="box-style">
                                            <a href="{{url('/category/'.$is_featured->slug)}}" class="product-effect">
                                                @if($is_featured->image)
                                                    <img class="category-active-img"
                                                         src="{!! SM::sm_get_the_src($is_featured->image, 112,112) !!}"
                                                         alt="{{$is_featured->title}}">
                                                @else
                                                    <img class="category-default-img"
                                                         src="{{ SM::sm_get_the_src(SM::sm_get_site_logo(), 112,112) }}"
                                                         alt="{{$is_featured->title}}">
                                                @endif

                                                <div class="box-content">
                                                    <h3 class="category-title-style">{{$is_featured->title}}</h3>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif