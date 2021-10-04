<?php
$blogPost = SM::getHomePopularBlog();
?>
<div class="new-products-area">
    <div class="row">
        <div class="col-md-12 p-0">
            <div class="paanel custom-panel-style">
                <div class="panel-heading">
                    <h2 class="custom-panel-heading">Latest Blog
                        <a href="{{url('/blog')}}"
                           class="btn btn-xs btn-success active pull-right">View All</a>
                    </h2>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        @foreach($blogPost as $blog)
                            <div class="col-12 col-md-4">
                                <div class="blog-item">
                                    <div class="blog-top">
                                        <?php
                                        $sdTitle = strip_tags(stripslashes($blog->title), "<br><span><i><b>");
                                        $sdSubTitle = substr($sdTitle, 0, 50);
                                        $sdTitle = (strlen($sdTitle) > 50) ? $sdSubTitle . " ....." : $sdSubTitle;
                                        $likeInfo['id'] = $blog->id;
                                        $likeInfo['type'] = 'blog';

                                        $blogUrl = url("blog/" . $blog->slug);
                                        ?>
                                        <div class="blog-img">
                                            <a href="{!! $blogUrl !!}">
                                                <img src="{!! SM::sm_get_the_src($blog->image, 369, 258) !!}"
                                                     alt=" {{ $sdTitle }}">
                                            </a>
                                        </div>
                                        <div class="home-blog-meta">
                                            <a href="javascript:0" class="nptl_like"
                                               data-id="{{ urlencode(base64_encode($blog->id)) }}"
                                               data-type="blog">
                                                <i class="fa fa-heart"></i>
                                                {{ SM::getCountTitle($blog->likes, 'Like') }}
                                            </a>
                                            <a href="{{ $blogUrl }}">
                                                <i class="fa fa-comments"></i>
                                                {{ SM::getCountTitle($blog->comments, 'Comment') }}
                                            </a>
                                            <a href="{{ $blogUrl }}">
                                                <i class="fa fa-eye"></i>
                                                {{ SM::getCountTitle($blog->views, 'View') }}
                                            </a>
                                            <div class="b-date">
                                                <strong>{{ date("d", strtotime($blog->created_at)) }}</strong>
                                                <b>{{ date("F-y", strtotime($blog->created_at)) }}</b>
                                            </div>
                                        </div>
                                        <h2 class="blog-title"><a
                                                    href="{!! $blogUrl !!}">
                                                {!! $sdTitle  !!}
                                            </a>
                                        </h2>
                                        <?php
                                        $des = $blog->short_description;
                                        $des = ($des != '') ? $des : $blog->long_description;
                                        $sd = strip_tags(stripslashes($des), "<br><b>");
                                        $sdSub = substr($sd, 0, 125);
                                        $sd = (strlen($sd) > 125) ? $sdSub . " ....." : $sdSub;
                                        ?>
                                        <p>{{ $sd }}</p>
                                    </div>
                                    <div class="blog-author pull-left">
                                        <img src="{!! SM::sm_get_the_src($blog->user->image, 80, 80) !!}"
                                             alt="{{ $blog->user->username }}">
                                        <p>Posted by</p>
                                        <?php
                                        $fname = $blog->user->firstname . ' ' . $blog->user->lastname;
                                        $fname = ($fname != '') ? $fname : $blog->user->username;
                                        ?>
                                        <p class="name">{{ $fname }}</p>
                                    </div>
                                    <a href="{!! $blogUrl !!}" class="pull-right b_readMore">Read
                                        More</a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>