<?php

Route::get('/mailable', function () {
    $contactInfo = $extra = new \stdClass();
    $contactInfo->email = "nextpagetl@gmail.com";
    $contactInfo->message = "All Next Page Technology Ltd.   Products<br/>
                                Up To 30% Off";
    $contactInfo->discount_title = "30% off all products";
    $contactInfo->available_title = "offer available only 5 day";
    $contactInfo->btn_title = "Order now";
    $contactInfo->btn_link = "#";
    $contactInfo->image = "header-text1.png";


    $extra->message = 'Gsjfhasdfasdfasdf';

    return new App\Mail\Offer($contactInfo);
//	return new \App\Mail\InvoiceMail( 4, $extra );
});


Route::group(['namespace' => "Debug"], function () {
    Route::get("maintenance", "Debug@maintenance");
//	Route::get( "optimize-image", "Debug@optimizeImage" );
//	Route::get( "regenerate-image", "Debug@regenerateAndOptimizeImage" );
//	Route::get( "plan-success", "Debug@planSuccess" );
//	Route::get( "backlink", "Debug@backlink" );
//	Route::get( '/test', 'Debug@test' );
//	Route::get( '/mail/{type}/{id}/{email?}', 'Debug@testMail' );
//
//	Route::get( "options", "Debug@options" );
//	Route::post( "options", "Debug@optionsRequest" );
});

Route::get('{url?}', 'Front\Page@page');
// Display all SQL executed in Eloquent
//\Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
//    echo '<pre>';
//    echo'Query: ';
//    var_dump($query->sql);
//    echo'<br>Bindings: ';
//    var_dump($query->bindings);
//    echo'<br>Time: ';
//    var_dump($query->time);
//    echo '</pre>';
//});