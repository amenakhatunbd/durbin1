@extends("frontend.master")
@section("title", $blog->title)
@section("content")
    <?php
    if ($blog->comments == 1) {
        $commentTitle = '1 Comment';
    } elseif ($blog->comments > 1) {
        $commentTitle = $blog->comments . ' Comments';
    } else {
        $commentTitle = 'No Comments';
    }
    if ($blog->views == 1) {
        $viewsTitle = '1 View';
    } elseif ($blog->views > 1) {
        $viewsTitle = $blog->views . ' Views';
    } else {
        $viewsTitle = 'No View';
    }
    if ($blog->likes == 1) {
        $likesTitle = '1 Like';
    } elseif ($blog->likes > 1) {
        $likesTitle = $blog->likes . ' Likes';
    } else {
        $likesTitle = 'No Likes';
    }

    $blogUrl = (url("blog/$blog->slug"));
    $bannerImage = SM::smGetThemeOption("blog_detail_banner_image");
    ?>
    <section class="blog-content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="blog-content-box">
                        <img src="{!! SM::sm_get_the_src( $blog->image , 1140, 433) !!}" class="img-responsive">
                        <div class="blog-cont-details">
                            <h3>{{$blog->title}}</h3>
                            <p class="blog-tagline">Category:
                                @foreach($blog->categories as $category)
                                    <span>{{ $category->title }}, </span>
                                @endforeach
                            </p>
                            <p class="published-date"><span>Published:</span> 20 jan 2020</p>
                            <p class="blog-pra">
                                {!! stripslashes($blog->long_description) !!}
                            </p>
                            <hr>
                         </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection