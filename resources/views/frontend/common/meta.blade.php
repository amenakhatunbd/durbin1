<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="_token" content="{{csrf_token()}}"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<?php
$site_name = SM::sm_get_site_name();
$fb_app_id = SM::get_setting_value('fb_app_id');
$fb_app_id = "841096443507787";
$shop_url = SM::get_setting_value('shop_url');

$shop_url1 = SM::get_setting_value('shop_url');


$shop_url = Request::segments();

$image = (isset($image)
    && SM::sm_string($image)) ? $image
    : asset(SM::sm_get_the_src(SM::get_setting_value('site_screenshot')));
    
    
if(!empty($shop_url))
{
    if($shop_url[0] == 'book' )
    {
        $x = $shop_url[1];
        $shop_url = $shop_url1.'/'.$shop_url[0].'/'.$shop_url[1];
        
        $image = SM::get_product_image($x);
        $image = $shop_url1.SM::sm_get_the_src($image);
    }
    elseif($shop_url[0] == 'author')
    {
        $x = $shop_url[1];
        $shop_url = $shop_url1.'/'.$shop_url[0].'/'.$shop_url[1];
        
        $image = SM::get_author_image($x);
        $image = $shop_url1.SM::sm_get_the_src($image);
    }
    else
    {
        $shop_url = $shop_url1;
    }
    
}
else
{
    $shop_url = $shop_url1;
}

$site_name = SM::sm_string($site_name) ? $site_name : 'Next Page Technology Ltd.';

$seo_title = stripslashes(
    (
        isset($seo_title)
        && SM::sm_string($seo_title)
    )
        ? $seo_title
        : SM::get_setting_value('seo_title')
);
$meta_key = stripslashes(
    (
        isset($meta_key)
        && SM::sm_string($meta_key)
    )
        ? $meta_key
        : SM::get_setting_value('site_meta_keywords')
);
$meta_description = stripslashes(
    (
        isset($meta_description)
        && SM::sm_string($meta_description)
    )
        ? $meta_description
        : SM::get_setting_value('site_meta_description')
);
// $image = (isset($image)
//     && SM::sm_string($image)) ? $image
//     : asset(SM::sm_get_the_src(SM::get_setting_value('site_screenshot')));


?><title>{{$site_name}}</title>

<meta name="keywords" content="{!!$meta_key!!}">
<meta name="description" content="{!! $meta_description !!}"/>

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{$seo_title}}">
<meta itemprop="description" content="{!! $meta_description !!}">
<meta itemprop="image" content="{!!$image!!}">

<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="{{$site_name}}">
<meta name="twitter:title" content="{{ $seo_title }}">
<meta name="twitter:description" content="{!! $meta_description !!}">
<meta name="twitter:image:src" content="{!!$image!!}">

<!-- Open Graph data -->
<meta property="og:title" content="{{ $seo_title }}"/>
<meta property="og:type" content="article"/>
<meta property="og:image" content="{!!$image!!}"/>
<meta property="og:description" content="{!! $meta_description !!}"/>
<meta property="og:site_name" content="{{$site_name}}"/>
<meta property="og:url" content="{!! $shop_url !!}"/>
<meta property="fb:app_id" content="{!! $fb_app_id !!}"/>
<link rel="icon" href="<?php echo SM::sm_get_the_src(SM::sm_get_site_favicon(), 30, 30); ?>" type="image/x-icon">
