<?php
$blogSecondLoop = 1;
$countBlogPost = count($blogs);
?>
@if($countBlogPost > 0)
    @foreach($blogs as $blog)
        <?php
        $sdTitle = strip_tags(stripslashes($blog->title), "<br><span><i><b>");
        $sdSubTitle = substr($sdTitle, 0, 50);
        $sdTitle = (strlen($sdTitle) > 50) ? $sdSubTitle . " ....." : $sdSubTitle;
        $likeInfo['id'] = $blog->id;
        $likeInfo['type'] = 'blog';

        $blogUrl = url("blog/" . $blog->slug);
        ?>
        <div class="col-md-4">
            <div class="blog-content-box wow fadeInUp">
                <a href="{!! $blogUrl !!}">
                    <img src="{!! SM::sm_get_the_src($blog->image, 360, 147) !!}"
                         class="img-responsive">
                </a>
                <div class="blog-cont-details">
                    <div class="edit-file-box-ab">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    </div>
                    <a href="{!! $blogUrl !!}">
                        <h3>{{ $sdTitle }}</h3>
                        <p class="blog-tagline">Category:
                            @foreach($blog->categories as $category)
                                <span>{{ $category->title }}, </span>
                            @endforeach
                        </p>
                        <?php
                        $des = $blog->short_description;
                        $des = ($des != '') ? $des : $blog->long_description;
                        $sd = strip_tags(stripslashes($des), "<br><b>");
                        $sdSub = substr($sd, 0, 125);
                        $sd = (strlen($sd) > 125) ? $sdSub . " ....." : $sdSub;


                        ?>

                        @if(empty($blog->short_description))
                        
                        <p class="blog-pra">{{ str_limit($blog->long_description, $limit = 120, $end = '........')  }}</p>
                        @else
                        <p class="blog-pra">{{ str_limit($blog->short_description, $limit = 120, $end = '.......') }}</p>
                        @endif
                        

                        <p class="published-date">
                            <span>Published:</span> {{ date("d-F-y", strtotime($blog->created_at)) }}</p>
                    </a>
                </div>
            </div>
        </div>
        @if($loop->iteration %3==0)
            <div class="clearfix"></div>
        @endif
    @endforeach
    <div class="col-lg-12">
        {!! $blogPost->links('common.pagination') !!}
    </div>
@else
    <div class="alert alert-info"><i class="fa fa-info"></i> No Blog Post Found!</div>
@endif
