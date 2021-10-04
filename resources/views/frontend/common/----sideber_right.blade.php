<div class="sideber-right wow bounceIn animated">

    <li class="grid__item ">
        <div class="support_icon">
            <a href=""><img src="images/truck.png"></a>
        </div>
        <div class="support_text">
            <h5 style="color:#000;">Free Shipping</h5>
            <p style="color:#848484;">Deliver to door</p>
        </div>
    </li>
    <li class="grid__item " style="display:none;">
        <div class="support_icon">
            <a href=""><img src="images/24service.png"></a>
        </div>
        <div class="support_text">
            <h5 style="color:#000;">24x7 Support</h5>
            <p style="color:#848484;">in Support Team</p>
        </div>
    </li>
    <li class="grid__item ">
        <div class="support_icon">
            <a href=""><img src="images/saving.png"></a>
        </div>
        <div class="support_text">
            <h5 style="color:#000;">Big Saving</h5>
            <p style="color:#848484;">Chooseable price</p>
        </div>
    </li>
    <li class="grid__item " style="display:none;">
        <div class="support_icon">
            <a href=""><img src="images/monyback.png"></a>
        </div>
        <div class="support_text">
            <h5 style="color:#000;">Money Back</h5>
            <p style="color:#848484;">Easy to return</p>
        </div>
    </li>
    <li class="grid__item ">
        <div class="support_icon">
            <a href=""><img src="images/shop.png"></a>
        </div>
        <div class="support_text">
            <h5 style="color:#000;">Online Shop</h5>
            <p style="color:#848484;">a huge branding</p>
        </div>
    </li>
    <li class="grid__item " style="display:none;">
        <div class="support_icon">
            <a href=""><img src="images/trophy.png"></a>
        </div>
        <div class="support_text">
            <h5 style="color:#000;">Award Winner</h5>
            <p style="color:#848484;">for best services</p>
        </div>
    </li>
</div>

<div class="popular-brand">
    <div class="row">
        <h3 class="popularbrand-title">Popular Brand</h3>
        <?php $features_brand = SM::getProductBrandsHome(0);?>
        @foreach($features_brand as $brands)
            <div class="col-xs-6  col-sm-6  col-md-6 p-2">
               <a href="{{url('/brand/'.$brands->slug)}}">
                    <img class="client-extra" src="{!! SM::sm_get_the_src($brands["image"], 118,83) !!}" alt="{{ $brands->title }}" title="{{ $brands->title }}">
                </a>
            </div>
        @endforeach
    </div>
</div>
