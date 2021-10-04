@if(count($featured_categories)>0)
    <section class="important-button-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="important-button-box">
                        @foreach($featured_categories as $key=> $featured_category)
                        <a href="{{ url('category', $featured_category->slug) }}" class="btn btn-default important-box-btn">{{ $featured_category->title }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif