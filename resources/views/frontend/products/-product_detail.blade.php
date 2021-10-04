@extends('frontend.master')
@section("title", $product->title)
@section("content")
<?php
$mobile = SM::get_setting_value('mobile');
$email = SM::get_setting_value('email');
$address = SM::get_setting_value('address');
?>
<div class="bottomMenu">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="books-content-details">

                    <h3 class="pre-title">{{ $product->title }} </h3>

                    <p class="Author_Title">Author :

                        <?php
                        // $list = json_decode($product->author_id);
                        $list = explode(",", $product->author_id);
                        $count = sizeof($list) - 1;
                        // dump($count);
                        foreach ($list as $key => $author) {
                            $auhtor_info = DB::table('authors')->where('id', $author)->first();

                        ?>

                        @if($key==$count)

                        <a target="_blank" href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }}</a>
                        @else

                        <a target="_blank" href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }} </a>
                        @endif

                        <?php }

                        ?>



                    </p>

                    @if(!empty($product->translator_id))
                    <p class="">Translate by

                        <?php
                        // $list = json_decode($product->author_id);
                        $list = explode(",", $product->translator_id);
                        $count = sizeof($list) - 1;
                        // dump($count);
                        foreach ($list as $key => $author) {
                            $auhtor_info = DB::table('authors')->where('id', $author)->first();

                        ?>

                        @if($key==$count)

                        <a target="_blank" href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }}</a>
                        @else

                        <a target="_blank" href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }} </a>
                        @endif

                        <?php }

                        ?>



                    </p>
                    @endif
                </div>

            </div>

            <div class="col-md-4">
                <div class="books-content-details">
                    <p>
                    </p>
                    @if($product->sale_price>0)

                    <h3 class="price">List Price:

                        <strike>{{ SM::currency_price_value($product->regular_price) }}</strike>

                    </h3>

                    <h4 class="sale-price">{{ SM::currency_price_value($product->sale_price) }}

                        <span>You Save {{ SM::currency_price_value($product->regular_price-$product->sale_price) }}
                            ({{ SM::productDiscount($product->id) }}%)</span>

                    </h4>

                    @else

                    <h4 class="sale-price">{{ SM::currency_price_value($product->regular_price) }}</h4>

                    @endif


                </div>
            </div>
            <div class="col-md-4">
                <div class="books-content-details stcky-cuntiti">

                    <a href="javascript:void(0)" data-product_id="{{$product->id}}" title="Add to cart"
                        class="addToCart btn btn-warning">Add to cart </a>

                </div>
            </div>
        </div>
    </div>
</div>
<section class="book-details-section">

    <div class="container">

        <div class="books-details-content wow fadeInDown">

            <div class="row">

                <div class="col-md-9">

                    <div class="row">

                        <div class="col-md-5">

                            <div class="books-preview-box">
                                {{-- data-toggle="modal" data-target="#myModal" --}}
                                <a href="#">
                                    <?php
                                    $flag =   SM::sm_get_the_src($product->image, 250, 400);

                                    $mamun = explode(".", $flag);
                                    $mamun = explode("/storage/uploads/", $mamun[0]);
                                    $mamun = explode("_1", $mamun[1]);
                                    if (empty($mamun[1])) {
                                        $img = explode(".", $product->image);
                                        $image_name = $img[0] . '_250x400.' . $img[1];
                                        $x = "/storage/uploads/" . $image_name;
                                    } else {
                                        $image_name = $product->image;
                                        $x = SM::sm_get_the_src($image_name, 250, 400);
                                    }

                                    ?>

                                    <img src="{{ $x }}" class="img-responsive">

                                </a>

                            </div>

                        </div>

                        <div class="col-md-7">

                            <div class="books-content-details">

                                <h3 class="pre-title">{{ $product->title }} </h3>
                                @if(!empty($product->short_description))
                                <p class="author">

                                    {{ $product->short_description }}

                                </p><br>
                                @endif

                                <p class="Author_name">Author :

                                    <?php
                                    // $list = json_decode($product->author_id);
                                    $list = explode(",", $product->author_id);
                                    $count = sizeof($list) - 1;

                                    foreach ($list as $key => $author) {
                                        $auhtor_info = DB::table('authors')->where('id', $author)->first();

                                    ?>
                                    @if($key==$count)
                                    <a target="_blank"
                                        href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }}</a>
                                    @else

                                    <a target="_blank"
                                        href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }} ,</a>
                                    @endif


                                    <?php } ?>

                                </p>

                                @if(!empty($product->translator_id))
                                <p class="">Translate by

                                    <?php
                                    // $list = json_decode($product->author_id);
                                    $list = explode(",", $product->translator_id);
                                    $count = sizeof($list) - 1;

                                    foreach ($list as $key => $author) {
                                        $auhtor_info = DB::table('authors')->where('id', $author)->first();

                                    ?>
                                    @if($key==$count)
                                    <a target="_blank"
                                        href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }}</a>
                                    @else

                                    <a target="_blank"
                                        href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }} ,</a>
                                    @endif


                                    <?php } ?>

                                </p>
                                @endif
                                <p class="category" style="font-size:15px;">ক্যাটাগরি:


                                    @foreach($product->categories as $category)
                                    <a href="{{ url('/category',$category->slug) }}">{{ $category->title }}</a>
                                    @endforeach
                                </p>


                                <p class="rattings hidden">

                                    <span>

                                        <i class="fa fa-star"></i>

                                        <i class="fa fa-star"></i>

                                        <i class="fa fa-star"></i>

                                        <i class="fa fa-star"></i>

                                        <i class="fa fa-star"></i>

                                    </span>

                                    <span>45 Rattings</span>

                                    <a href="">/ 30 Review</a>

                                <p>

                                    @if($product->sale_price>0)

                                <h3 class="price">List Price:

                                    <strike>{{ SM::currency_price_value($product->regular_price) }}</strike>

                                </h3>

                                <h4 class="sale-price">{{ SM::currency_price_value($product->sale_price) }}

                                    <span>You Save
                                        {{ SM::currency_price_value($product->regular_price-$product->sale_price) }}
                                        ({{ SM::productDiscount($product->id) }}%)</span>

                                </h4>

                                @else

                                <h4 class="sale-price">{{ SM::currency_price_value($product->regular_price) }}</h4>

                                @endif



                                <a href="#" data-toggle="modal" data-target="#myModal" class="btn btn-default">একটু

                                    পড়ে নিন </a>

                                @if ($product->product_qty > 0)

                                <a href="javascript:void(0)" data-product_id="{{$product->id}}" title="Add to cart"
                                    class="addToCart btn btn-warning">Add to cart</a>

                                @else

                                <a href="javascript:void(0)" data-product_id="{{$product->id}}" title="Add to cart"
                                    class="addToCart btn btn-warning">Out Of Stock</a>

                                @endif

                                <div class="wish-list-share">

                                    @if(Auth::check())

                                    <a class="addToWishlist" data-product_id="{{$product->id}}"
                                        href="javascript:void(0)"><i class="fa fa-heart"></i> Add to Booklist</a>

                                    @else

                                    <a class="addToWishlist" data-product_id="{{$product->id}}"
                                        href="{{ url('/login_signin_new') }}"><i class="fa fa-heart"></i> Add to
                                        Booklist</a>

                                    @endif

                                    <a href="javascript:void(0)" data-toggle="dropdown"><i class="fa fa-share-alt"></i>
                                        Share This Book</a>



                                    <ul class="dropdown-menu socila-share ">
                                        @empty(!SM::smGetThemeOption("social_facebook"))
                                        <li>

                                            <a data-original-title="Facebook" rel="tooltip" target="_blank"
                                                href="https://www.facebook.com/sharer/sharer.php?u={{url('book/'.$product->slug)}}&display=popup"
                                                class="btn-facebook" data-placement="left">
                                                <i class="fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        @endempty

                                        @empty(!SM::smGetThemeOption("social_youtube"))
                                        <li>

                                            <a data-original-title="Twitter" rel="tooltip" target="_blank"
                                                href="http://twitter.com/share?text={{url('book/'.$product->slug)}}"
                                                class="btn-twitter" data-placement="left">
                                                <i class="fa fa-twitter"></i>
                                            </a>
                                        </li>
                                        @endempty
                                        @empty(!SM::smGetThemeOption("social_linkedin"))
                                        <li>


                                            <a data-original-title="LinkedIn" rel="tooltip" target="_blank"
                                                href="https://www.linkedin.com/sharing/share-offsite/?url={{url('book/'.$product->slug)}}"
                                                class="btn-linkedin" data-placement="left">
                                                <i class="fa fa-linkedin"></i>
                                            </a>
                                        </li>
                                        @endempty
                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="col-md-3">
                    <div class="product_details_right_section">
                        <ul class="footer-adress-bar">

                            <li>
                                <p><span><i class="icofont-headphone-alt"></i><a
                                            href="tel:{{ SM::get_setting_value('hotline') }}">
                                            {{ SM::get_setting_value('hotline') }}</a></span></p>
                            </li>

                            <li>
                                <p><span><i class="icofont-users"></i><a href="tel:{{ $mobile }}">
                                            {{ $mobile }}</a></span></p>
                            </li>

                            <li>
                                <p><i class="icofont-envelope"></i> {{ $email }}</p>

                            </li>

                            <li>
                                <p><i class="icofont-google-map"></i> {{ $address }}</p>

                            </li>

                        </ul>

                        @if(!empty($relatedProduct) && count($relatedProduct) > 0)

                        <h5 style="margin-bottom:10px;">Similar Books:</h5>
                        <div class="nahid_carousel">

                            @foreach($relatedProduct as $key=> $relatedProducts)

                            <div class="col-md-2 pad-no">

                                <div class=" wow fadeInUp" data-wow-duration="2s" data-wow-delay="1s">

                                    <a href="{{ url('book/'.$relatedProducts->slug) }}">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6">
                                                <img src="{{ SM::sm_get_the_src($relatedProducts->image, 130, 186) }}">
                                            </div>
                                            <div class="col-md-6 col-xs-6">
                                                <div class="book-text-area">

                                                    <p class="book-title">{{ $relatedProducts->title }}</p>

                                                    <p class="book-author">
                                                        {{ isset($relatedProducts->author->title) ? $relatedProducts->author->title : '' }}
                                                    </p>


                                                    <p class="book-price">

                                                        @if($relatedProducts->sale_price>0)

                                                        <strike
                                                            class="original-price">{{ SM::currency_price_value($relatedProducts->regular_price) }}</strike>

                                                        {{ SM::currency_price_value($relatedProducts->sale_price) }}

                                                        @else

                                                        {{ SM::currency_price_value($relatedProducts->regular_price) }}

                                                        @endif

                                                    </p>


                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                </div>

                            </div>

                            @endforeach
                        </div>


                        @endif


                    </div>
                </div>

            </div>

        </div>

    </div>

</section>

<section>

    <div class="container">
        <div class="single_box_summary">
            <div class="books-spcication-summary custom-navtabs float-left-tabs wow fadeInUp">

                <ul class="nav nav-tabs">

                    <li class="active"><a data-toggle="tab" href="#summary">Summary</a></li>

                    <li><a data-toggle="tab" href="#Specification">Specification</a></li>

                    <li><a data-toggle="tab" href="#Author">Author</a></li>
                    @if(!empty($product->translator_id))
                    <li><a data-toggle="tab" href="#Translator">Translator</a></li>
                    @endif

                </ul>



                <div class="tab-content">

                    <div id="summary" class="tab-pane fade in active">

                        @if(!empty($product->product_video))
                        <div class="row">
                            <div class="col-md-7">
                                {!! $product->long_description !!}
                            </div>
                            <div class="col-md-5">
                                <iframe width="100%" height="250" src="{!! $product->product_video !!}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>

                            </div>
                        </div>
                        @else
                        <div>
                            {!! $product->long_description !!}
                        </div>
                        @endif

                    </div>

                    <div id="Specification" class="tab-pane fade">

                        <table class="table table-bordered">

                            <tbody>
                                @if(!empty($product->title))
                                <tr>



                                    <th class="col-md-3">Title</th>

                                    <td>{{ $product->title }}</td>

                                </tr>
                                @endif
                                @if(!empty($product->author_id))
                                <tr>

                                    <th class="col-md-3">Author</th>
                                    <td><?php
                                        // $list = json_decode($product->author_id);
                                        $list = explode(",", $product->author_id);
                                        $count = sizeof($list) - 1;
                                        foreach ($list as $key => $author) {
                                            $auhtor_info = DB::table('authors')->where('id', $author)->first();
                                            // dd($auhtor_info->slug);
                                        ?>
                                        @if($key == $count)
                                        <a target="_blank"
                                            href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }}</a>
                                        @else
                                        <a target="_blank"
                                            href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }},
                                        </a>
                                        @endif


                                        <?php } ?>
                                    </td>
                                </tr>
                                @endif


                                @if(!empty($product->translator_id))
                                <tr>

                                    <th class="col-md-3">Translator</th>
                                    <td><?php
                                        // $list = json_decode($product->author_id);
                                        $list = explode(",", $product->translator_id);
                                        $count = sizeof($list) - 1;
                                        foreach ($list as $key => $author) {
                                            $auhtor_info = DB::table('authors')->where('id', $author)->first();
                                            // dd($auhtor_info->slug);
                                        ?>
                                        @if($key == $count)
                                        <a target="_blank"
                                            href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }}</a>
                                        @else
                                        <a target="_blank"
                                            href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }},
                                        </a>
                                        @endif


                                        <?php } ?>
                                    </td>
                                </tr>
                                @endif
                                @if(!empty($product->publisher->slug))
                                <tr>

                                    <th class="col-md-3">Publisher</th>
                                    <td><a target="_blank"
                                            href="{{ url('/publisher',$product->publisher->slug) }}">{{ $product->publisher->title }}</a>
                                    </td>

                                    <!--<td>{{ $product->publisher->title }}</td>-->

                                </tr>
                                @endif
                                @if(!empty($product->isbn))
                                <tr>

                                    <th class="col-md-3">ISBN</th>

                                    <td>{{ $product->isbn }}</td>

                                </tr>
                                @endif
                                @if(!empty($product->edition_date))
                                <tr>

                                    <th class="col-md-3">Edition</th>

                                    <td>{{ $product->edition_date }}</td>

                                </tr>
                                @endif
                                @if(!empty($product->number_of_pages))
                                <tr>

                                    <th class="col-md-3">Number of Pages</th>

                                    <td> {{ $product->number_of_pages }}</td>

                                </tr>
                                @endif
                                @if(!empty($product->country->name))
                                <tr>

                                    <th class="col-md-3">Country</th>
                                    <td> <?php if (!empty($product->country->name)) {
                                                echo $product->country->name;
                                            } else if ($product->country) {
                                                echo $product->country;
                                            } ?>
                                    </td>


                                </tr>
                                @else
                                <tr>

                                    <th class="col-md-3">Country</th>
                                    <td> <?php
                                            echo "Bangladesh" ?>
                                    </td>


                                </tr>
                                @endif


                                @if(!empty($product->language))
                                <tr>

                                    <th class="col-md-3">Language</th>

                                    <td>{{ $product->language }}</td>

                                </tr>
                                @endif

                            </tbody>

                        </table>

                    </div>


                    <div id="Author" class="tab-pane fade">
                        <?php
                        // $list = json_decode($product->author_id);
                        $list = explode(",", $product->author_id);
                        $count = sizeof($list);
                        foreach ($list as $key => $author) {
                            $auhtor_info = DB::table('authors')->where('id', $author)->first();

                        ?>

                        <div class="row">
                            <div class="col-md-2">
                                @if($auhtor_info->image)
                                <img src="{{ SM::sm_get_the_src($auhtor_info->image) }}" alt="{{ $auhtor_info->image }}"
                                    class="mr-3 mt-3 rounded-circle" style="width:140px; height: 140px;">

                                @else
                                <img src="{{asset('public/images/author.jpg')}}" alt="author_avater"
                                    class="mr-3 mt-3 rounded-circle" style="width:140px; height: 140px;">

                                @endif
                            </div>
                            <div class="col-md-10">
                                <div class="single_author_discription">
                                    <h3>{{ $auhtor_info->title }}</h3>

                                    <p>

                                        {!! $auhtor_info->description !!}

                                    </p>
                                </div>

                            </div>
                        </div>




                        <?php } ?>

                    </div>
                    @if(!empty($product->translator_id))
                    <div id="Translator" class="tab-pane fade">

                        <?php
                        // $list = json_decode($product->author_id);
                        $list = explode(",", $product->translator_id);
                        $count = sizeof($list);
                        foreach ($list as $key => $author) {
                            $auhtor_info = DB::table('authors')->where('id', $author)->first();

                        ?>
                        @if($auhtor_info->image)
                        <img src="{{ SM::sm_get_the_src($auhtor_info->image) }}" alt="{{ $auhtor_info->image }}"
                            class="mr-3 mt-3 rounded-circle" style="width:140px; height: 140px;">

                        @else
                        <img src="{{asset('public/images/author.jpg')}}" alt="author_avater"
                            class="mr-3 mt-3 rounded-circle" style="width:140px; height: 140px;">

                        @endif
                        <h3>{{ $auhtor_info->title }}</h3>

                        <p>

                            {!! $auhtor_info->description !!}

                        </p>

                        <?php } ?>

                    </div>
                    @endif

                </div>

                <!-- ------------------------------- -->

                <hr>
                <br>
            </div>


        </div>

    </div>
    <div class="container">
        @include('frontend.products.product_review')
    </div>

</section>

@include('frontend.common.getBestSaleProduct', ['products' =>$relatedProduct, 'title'=>'Related Products',
'class'=>'all-sell-intem-box', 'view_all'=>'View All', 'view_all_link'=>'#'])

<!-- ---------------------------------------------- -->

<div id="myModal" class="modal fade" role="dialog">

    <div class="modal-dialog">



        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title" style="font-weight: 400;">একটু পড়ে দেখুন</h4>

            </div>

            <div class="modal-body">

                <?php

                $read_a_little = SM::sm_unserialize($product->read_a_little);

                ?>

                <div class="book-section">

                    <div class="book-container">

                        @if(isset($read_a_little))

                        @foreach($read_a_little["front"] as $key=>$front)

                        <?php

                        $back = isset($read_a_little["back"][$key]) ? $read_a_little["back"][$key] : "";

                        ?>



                        <div class="right">

                            <figure class="back" id="{{ $key == 0 ? 'back-cover': '' }}"
                                style="background-image: url({{ SM::sm_get_the_src($back, 250, 400) }})"></figure>

                            <figure class="front" id="{{ $front === end($read_a_little["front"]) ? 'cover': '' }}"
                                style="background-image: url({{ SM::sm_get_the_src($front, 250, 400) }});"></figure>

                        </div>

                        @endforeach

                        @endif

                        {{-- <div class="right">--}}

                        {{-- <figure class="back" id="back-cover" style="background-image: url({{ asset('frontend/assets/images/') }}/book-back.jpg)">
                        </figure>--}}

                        {{-- <figure class="front" style="background-image: url({{ asset('frontend/assets/images/') }}/book-view-1.png);">
                        </figure>--}}

                        {{-- </div>--}}

                        {{-- <div class="right">--}}

                        {{-- <figure class="back" style="background-image: url({{ asset('frontend/assets/images/') }}/book-view-2.png);">
                        </figure>--}}

                        {{-- <figure class="front" style="background-image: url({{ asset('frontend/assets/images/') }}/book-view-1.png);">
                        </figure>--}}

                        {{-- </div>--}}

                        {{-- <div class="right">--}}

                        {{-- <figure class="back" style="background-image: url({{ asset('frontend/assets/images/') }}/book-view-2.png);">
                        </figure>--}}

                        {{-- <figure class="front" style="background-image: url({{ asset('frontend/assets/images/') }}/book-view-1.png);">
                        </figure>--}}

                        {{-- </div>--}}

                        {{-- <div class="right">--}}

                        {{-- <figure class="back" style="background-image: url({{ asset('frontend/assets/images/') }}/book-view-2.png);">
                        </figure>--}}

                        {{-- <figure class="front" style="background-image: url({{ asset('frontend/assets/images/') }}/book-view-1.png);">
                        </figure>--}}

                        {{-- </div>--}}

                        {{-- <div class="right">--}}

                        {{-- <figure class="back" style="background-image: url({{ asset('frontend/assets/images/') }}/book-view-2.png);">
                        </figure>--}}

                        {{-- <figure class="front" id="cover" style="background-image: url({{ asset('frontend/assets/images/') }}/book-font.jpg);">
                        </figure>--}}

                        {{-- </div>--}}

                    </div>

                    <button onclick="turnLeft()">Prev</button>

                    <button onclick="turnRight()">Next</button>

                    <br />

                </div>



            </div>

        </div>



    </div>

</div>

@endsection