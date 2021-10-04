<?php
$blog_popular_is_enable = SM::smGetThemeOption("blog_popular_is_enable", 1);
$blog_show_category = SM::smGetThemeOption("blog_show_category", 1);
$blog_show_tag = SM::smGetThemeOption("blog_show_tag", 1);
$blog_sidebar_add = SM::smGetThemeOption("blog_sidebar_add", 1);
?>
<!-- Blog category -->
@if($blog_show_category==1)
    <?php
    $getCategories = SM::getCategories(0);
    ?>
    @if(count($getCategories)>0)
        <div class="block left-module">
            <p class="title_block">Blog Categories</p>
            <div class="block_content">
                <!-- layered -->
                <div class="layered layered-category">
                    <div class="layered-content">
                        <ul class="tree-menu">
                            @foreach($getCategories as $cat)
                                <li><span></span><a href="{!! url("blog/category/".$cat->slug) !!}"> {{$cat->title}} <span>( {{count($cat->blogs)}} )</span></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- ./layered -->
            </div>
        </div>
    @endif
@endif
<!-- ./blog category  -->
@if($blog_popular_is_enable==1)
    <?php
    $blog_popular_posts_per_page = SM::smGetThemeOption("blog_popular_posts_per_page", 5);
    $popularPosts = SM::getPopularBlog($blog_popular_posts_per_page);
    ?>
    @if(count($popularPosts)>0)
        <!-- Popular Posts -->
        <div class="block left-module">
            <p class="title_block">Popular Posts</p>
            <div class="block_content">
                <!-- layered -->
                <div class="layered">
                    <div class="layered-content">
                        <ul class="blog-list-sidebar clearfix">
                            @foreach($popularPosts as $blog)
                                <?php
                                $blogUrl = url("blog/$blog->slug");
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
                                ?>
                                <li>
                                    <div class="post-thumb">
                                        @empty(!$blog->image)
                                            <a href="{!! $blogUrl !!}"><img
                                                        src="{!! SM::sm_get_the_src( $blog->image , 112, 112) !!}"
                                                        class="image-style" alt="{{$blog->title}}">
                                            </a>
                                        @endempty
                                    </div>
                                    <div class="post-info">
                                        <h5 class="entry_title"><a href="{!! $blogUrl !!}">{{$blog->title}}</a></h5>
                                        <div class="post-meta">
                                            <span class="date"><i class="fa fa-calendar"></i> {{ date("d, F Y", strtotime($blog->created_at)) }}</span>
                                            <span class="comment-count">
                                                    <i class="fa fa-comment-o"></i> {{ $commentTitle }}
                                                </span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- ./layered -->
            </div>
        </div>
    @endif
@endif
<!-- ./Popular Posts -->
<!-- Banner -->
<div class="block left-module">
    <div class="banner-opacity">
        <a href="#"><img src="{{ asset('frontend/') }}/images/news/news4.png" alt="ads-banner"></a>
    </div>
</div>
<!-- ./Banner -->
<!-- Recent Comments -->
<div class="block left-module">
    <p class="title_block">Recent Comments</p>
    <div class="block_content">
        <!-- layered -->
        <div class="layered">
            <div class="layered-content">
                <ul class="recent-comment-list">
                    <li>
                        <h5><a href="#">Lorem ipsum dolor sit amet</a></h5>
                        <div class="comment">
                            "Consectetuer adipis. Mauris accumsan nulla vel diam. Sed in..."
                        </div>
                        <div class="author">Posted by <a href="#">Admin</a></div>
                    </li>
                    <li>
                        <h5><a href="#">Lorem ipsum dolor sit amet</a></h5>
                        <div class="comment">
                            "Consectetuer adipis. Mauris accumsan nulla vel diam. Sed in..."
                        </div>
                        <div class="author">Posted by <a href="#">Admin</a></div>
                    </li>
                    <li>
                        <h5><a href="#">Lorem ipsum dolor sit amet</a></h5>
                        <div class="comment">
                            "Consectetuer adipis. Mauris accumsan nulla vel diam. Sed in..."
                        </div>
                        <div class="author">Posted by <a href="#">Admin</a></div>
                    </li>
                </ul>
            </div>
        </div>
        <!-- ./layered -->
    </div>
</div>
<!-- ./Recent Comments -->
<!-- tags -->
@if($blog_show_tag==1)
    <?php
    $getTags = SM::getTags();
    ?>
    @if(count($getTags)>0)
        <div class="block left-module">
            <p class="title_block">TAGS</p>
            <div class="block_content">
                <div class="tags">
                    @foreach($getTags as $tag)
                        @if($tag->title == ! '')
                            <a href="{!! url("blog/tag/".$tag->slug) !!}"><span
                                        class="level1">{{$tag->title}}</span></a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endif
<!-- ./tags -->
<!-- Banner -->
<?php
$blog_sidebar_ad_link = SM::smGetThemeOption("blog_sidebar_ad_link", "#");
$blog_sidebar_ad = SM::smGetThemeOption("blog_sidebar_ad");
?>
@empty(!$blog_sidebar_ad)
    <div class="block left-module">
        <div class="banner-opacity">
            <a href="{!! $blog_sidebar_ad_link !!}"><img src="{!! SM::sm_get_the_src( $blog_sidebar_ad ) !!}"
                                                         alt="ads-banner"></a>
        </div>
    </div>
@endempty
<!-- ./Banner -->