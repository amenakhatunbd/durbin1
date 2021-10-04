@if(count($featured_authors)>0)
    <section>
        <div class="container">
            <div class="all-sell-intem-box wow fadeInRight">
                <div class="title-header">
                    <h3>Top Rated Author</h3>
                </div>
                <div class="author-pro-slide all-caro-btn">
                    @foreach($featured_authors as $key=> $featured_author)
                    <div class="col-md-2 col-xs-6">
                        <a href="{{ url('/author', $featured_author->slug) }}">
                            <div class="author-profile  wow fadeInDown">
                                <img src="{{ SM::sm_get_the_src($featured_author->image, 140, 140) }}" alt="{{ $featured_author->title }}">
                                <p>{{ $featured_author->title }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
@endif

