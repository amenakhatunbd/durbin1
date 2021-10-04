<?php

$asset = (PHP_SAPI === 'cli') ? false : asset('/');
$site = (PHP_SAPI === 'cli') ? false : url('/');
return [
    'smSite' => $site,
//admin slug and url
    'smAdminSlug' => 'geeksadmin',
    'smAdminUrl' => $site . '/geeksadmin/',
//pagination
    'smPagination' => 10,
    'smPaginationMedia' => 49,
    'smAuthorPaginateMedia' => 30,
    'smFrontPagination' => 10,
    'cachingTimeInMinutes' => 10,
    'popupHideTimeInMinutes' => 24 * 60,
    'popupHideTimeInMinutesForSubscriber' => 30 * 24 * 60,
//image upload directory and url
    'smUploadsDir' => 'uploads/',
    'smUploads' => $asset . 'uploads/',
    'smUploadsUrl' => $asset . 'uploads/',
//image size: width and height
//1: logo
//2-4:gallery
//5:manage page
//6:manage page
//7:author small
//8-10:blog
//11-11: sliders
//12 team
//13 testimonial logo
    'smPostMaxInMb' => 5,
//galary (600x400, 112x112 not crop resized)
    'smImgWidth' => [
        30, // fav icon-
        230, //header logo-
        1140, //slider image
        360, //slider bottom
        130, //home product image
        555, //home add image
        140, //author image
        222, //product details image
        250, //some read product details image
        160, //shop product image
        60, //cart product image
        1140, //product page slider image
        360, //blog image
        //        -------admin panel-----
        165, //featured-image
        112, //media small image
        80, //lists image
        600,
        750
    ],
    'smImgHeight' => [
        30, // fav icon-
        50, //header logo-
        433, //slider image
        83, //slider bottom
        186, //home product image
        275, //home add image
        140, //author image
        319, //product details image
        400, //some read product details image
        200, //shop product image
        80, //cart product image
        280, //product page slider image
        147, //blog image
//        //        -------admin panel-----
        165, //featured-image-
        112, //media small image-
        80, //lists image-
        400,
        560
    ],
    //               1    2    3    4     5   6   7    8    9    10  11  12    13   14   15   16  17
];
