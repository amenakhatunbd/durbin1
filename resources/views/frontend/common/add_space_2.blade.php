<section class="add-content-2">
    <!----Banner Ads--------->
    <?php
    $features = SM::smGetThemeOption("features", array());
    ?>
    @if(count($features)>0)
        <div class="container-fluid">
            <div class="row">
                @foreach($features as $key=>$feature)
                    @if($key>3 && $key<7)
                        <div class="col-12 col-sm-4">
                            <figure class="swing">
                                <div class="banner-image">
                                    <a title="Banner Image" href="{{ $feature["feature_link"] }}">
                                        <img class="img-fluid" src="{!! SM::sm_get_the_src($feature["feature_image"], 540,277) !!}" alt="{{ $feature["feature_title"] }}"></a>
                                </div>
                            </figure>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
    <!----Banner Ads--------->
</section>