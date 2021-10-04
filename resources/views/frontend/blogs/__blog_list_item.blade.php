<?php
$blogSecondLoop = 1;
$countBlogPost = count($blogPost);
?>
@if($countBlogPost > 0)
    @foreach($blogPost as $blog)
        <?php
        $sdTitle = strip_tags(stripslashes($blog->title), "<br><span><i><b>");
        $sdSubTitle = substr($sdTitle, 0, 50);
        $sdTitle = (strlen($sdTitle) > 50) ? $sdSubTitle . " ....." : $sdSubTitle;
        $likeInfo['id'] = $blog->id;
        $likeInfo['type'] = 'blog';

        $blogUrl = url("blog/" . $blog->slug);
        ?>
        <li class="post-item">
            <article class="entry">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="entry-thumb image-hover2">
                            <a href="{!! $blogUrl !!}">
                                <img src="{!! SM::sm_get_the_src($blog->image, 369, 258) !!}"
                                     alt=" {{ $sdTitle }}">
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="entry-ci">
                            <h3 class="entry-title"><a href="{!! $blogUrl !!}">{!! $sdTitle  !!}</a></h3>
                            <?php
                            $fname = $blog->user->firstname . ' ' . $blog->user->lastname;
                            $fname = ($fname != '') ? $fname : $blog->user->username;
                            ?>
                            <div class="entry-meta-data">
                                            <span class="author">
                                            <i class="fa fa-user"></i>
                                            by: <a href="#">{{ $fname }}</a></span>
                                <span class="cat">
                                                <i class="fa fa-folder-o"></i>
                                    @foreach($blog->categories as $category)
                                        <a href="#">{{ $category->title }}, </a>
                                    @endforeach
                                            </span>
                                <span class="comment-count">
                                                <i class="fa fa-comment-o"></i> {{ SM::getCountTitle($blog->comments, 'Comment') }}
                                            </span>
                                <span class="date"><i
                                            class="fa fa-calendar"></i>
                             <strong>{{ date("d", strtotime($blog->created_at)) }}</strong>
                            <b>{{ date("F-y", strtotime($blog->created_at)) }}</b>
                            </span>
                            </div>
                            <div class="post-star">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span>(7 votes)</span>
                            </div>
                            <?php
                            $des = $blog->short_description;
                            $des = ($des != '') ? $des : $blog->long_description;
                            $sd = strip_tags(stripslashes($des), "<br><b>");
                            $sdSub = substr($sd, 0, 125);
                            $sd = (strlen($sd) > 125) ? $sdSub . " ....." : $sdSub;
                            ?>
                            <div class="entry-excerpt">
                                {{ $sd }}
                            </div>
                            <div class="entry-more">
                                <a href="{!! $blogUrl !!}">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </li>
        @if($loop->iteration %2==0)
            <div class="clearfix"></div>
        @endif
    @endforeach
    <div class="sortPagiBar clearfix">
        <div class="bottom-pagination">
            <nav>
                <ul class="pagination">
                    {!! $blogPost->links('common.pagination') !!}
                </ul>
            </nav>
        </div>
    </div>
@else
    <div class="alert alert-info"><i class="fa fa-info"></i> No Blog Post Found!</div>
@endif
