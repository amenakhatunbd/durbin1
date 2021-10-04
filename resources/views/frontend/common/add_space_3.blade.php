<section class="add-content-3">
    <!----Banner Ads--------->
    <?php
    $features = SM::smGetThemeOption("features", array());
    ?>
    @if(count($features)>0)
        <div class="container-fluid">
            <div class="row">
                @foreach($features as $key=>$feature)
                    @if($key>6 && $key<10)
                        <div class="col-12 col-sm-4">
                            <div class="banner-image box-img">
                                <a title="Banner Image" href="{{ $feature["feature_link"] }}">
                                    <img class="img-fluid" src="{!! SM::sm_get_the_src($feature["feature_image"], 540,277) !!}" alt="{{ $feature["feature_title"] }}"></a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif
    <!----Banner Ads--------->
</section>