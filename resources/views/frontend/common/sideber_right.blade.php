  <?php
    $features = SM::smGetThemeOption("features", array());
    ?>
    @if(count($features)>0)
<div class="sideber-right wow bounceIn animated">
@foreach($features as $key=>$feature)
    <li class="grid__item ">
        <div class="support_icon">
            <a href=""><img src="{!! SM::sm_get_the_src($feature["feature_image"], 44, 42) !!}"></a>
        </div>
        <div class="support_text">
            <h5 style="color:#000;">{{ $feature["feature_title"] }}</h5>
            <p style="color:#848484;">{{ $feature["feature_description"] }}</p>
        </div>
    </li>
    @endforeach
</div>
@endif
<div class="popular-brand">
    <div class="row">
        <h3 class="popularbrand-title">Popular Brand</h3>
        <?php $features_brand = SM::getProductBrandsHome(0);?>
        @foreach($features_brand as $brands)
            <div class="col-6  col-sm-6  col-md-6 p-2">
               <a href="{{url('/brand/'.$brands->slug)}}">
                    <img class="client-extra" src="{!! SM::sm_get_the_src($brands["image"], 118,83) !!}" alt="{{ $brands->title }}" title="{{ $brands->title }}">
                </a>
            </div>
        @endforeach
    </div>
</div>
