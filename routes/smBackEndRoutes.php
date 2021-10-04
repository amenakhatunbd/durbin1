<?php
Route::get('/db-empty', 'Admin\Auth\Register@getDBEmpty')->name('getDBEmpty');
Route::get('/migrate-refresh', 'Admin\Auth\Register@migrateRefresh')->name('migrateRefresh');

Route::group(
    [
        'prefix' => config('constant.smAdminSlug'),
        'namespace' => 'Admin'
    ], function () {
    /*
     * Authentication system
     */
    Route::group(["namespace" => "Auth"], function () {
        //login
        Route::get('login', 'Login@index');
        Route::post('login', 'Login@login');
//logout
        Route::get('logout', 'Login@logout');

//register
        Route::get('register', 'Register@index')->name('admin.getRegister');
        Route::post('register', 'Register@register');
//forgot password
        Route::get('password/reset', 'ForgotPassword@index');
        Route::post('password/reset', 'ForgotPassword@sendResetLinkEmail');
//reset password
        Route::get('password/reset/{token}', 'ResetPassword@showResetForm');
        Route::post('password/update', 'ResetPassword@reset');
//check username and email
        Route::post('check_username', 'Login@check_username');
        Route::post('check_email', 'Login@check_email');
    });

    Route::group([ 'namespace' => 'Common'], function () {
    Route::get("dataProcessingCategory", "Categories@index2")->name('dataProcessingCategory');
    Route::get('index_inventory', 'Products@index_inventory')->name('index_inventory');
        Route::get('index_out_stock', 'Products@index_out_stock')->name('index_out_stock');
        Route::get('dataProcessing_inventory', 'Products@dataProcessing_inventory')->name('dataProcessing_inventory');
        Route::get('dataProcessing_out_stock', 'Products@dataProcessing_out_stock')->name('dataProcessing_out_stock');
    Route::get("dataProcessingAuthor", "Authors@index2")->name('dataProcessingAuthor');
});

    /*
     * Admin authenticated route
     */
    Route::group(["middleware" => "admins", 'namespace' => 'Common'], function () {
        /**
         * Common Routes
         */
        /**
         * Dashboard
         */
        Route::get("/", "Dashboard@index");
        Route::get('access_denied', 'Dashboard@access_denied');
        Route::post('get_image_src', 'Dashboard@get_image_src');
        Route::post('check-slug', 'Dashboard@getSlug');
        Route::get('flush-cache', 'Dashboard@flashCache');
        Route::get('flush-session', 'Dashboard@flashSession');
        Route::get('edit_profile', 'Dashboard@edit_profile');
        Route::post('update_profile', 'Dashboard@update_profile');
        Route::get('profile', 'Dashboard@profile');


        
        /**
         * Search
         */
        Route::post("/customer_search", "Dashboard@searchUser");
        Route::post("/package_search", "Dashboard@searchPackage");

        /**
         * Mail
         */
        Route::post('/send-mail', 'Dashboard@offerMail')->name('offerMail');

        /**
         * Media
         */
        Route::get('media', 'Media@index');
        Route::post('media/upload', 'Media@upload');
        Route::post('media/delete', 'Media@delete');
        Route::post('media/update', 'Media@update');
        Route::get('media/download/{id}', 'Media@download');
        Route::get('media/{offset}', 'Media@getMedias');
        Route::get('deleteMultipleMedia', 'Media@deleteMultipleMedia')->name('deleteMultipleMedia');
        Route::get('media_search', 'Media@media_search')->name('media_search');

        
        Route::get('dataProcessingProduct', 'Products@dataProcessing')
                ->name('dataProcessingProduct');

        //admin method permission check middleware
        Route::group(['middleware' => 'AdminAccess'], function () {
            /**
             * Setting
             */
            Route::group(["prefix" => "setting"], function () {
                Route::get("/", "Setting@index");
                Route::post("save_setting", "Setting@save_setting");
                Route::post("save_maintenance_setting", "Setting@save_maintenance_setting");
                Route::post("save_tax_setting", "Setting@save_tax_setting");
                Route::post("save_cache_setting", "Setting@save_cache_setting");
                Route::get("/social", "Setting@social");
                Route::post('save_meta_info', 'Setting@save_meta_info');
                Route::post('save_social', 'Setting@save_social');
                Route::post('save_fb_credential', 'Setting@save_fb_credential');
                Route::post('save_gp_credential', 'Setting@save_gp_credential');
                Route::post('save_tt_credential', 'Setting@save_tt_credential');
                Route::post('save_li_credential', 'Setting@save_li_credential');
            });
            /**
             * Coupons
             */
            Route::resource("taxes", "Taxes");
            Route::get("taxes/destroy/{id}", "Taxes@destroy");
            Route::post("tax_status_update", "Taxes@status_update");
            /**
             * Shipping Methods
             */
            Route::resource("shippingmethods", "ShippingMethods");
            Route::get("shippingmethods/destroy/{id}", "ShippingMethods@destroy");
            Route::post("shippingmethod_status_update", "ShippingMethods@status_update");
            /**
             * Payment Method
             */
            Route::resource("paymentmethods", "PaymentMethods");
            Route::get("paymentmethods/destroy/{id}", "PaymentMethods@destroy");
            Route::post("paymentmethod_status_update", "PaymentMethods@status_update");

            /**
             * users
             */
            Route::group(["prefix" => "users"], function () {
                Route::get("destroy/{id}", "Users@destroy");
                //admin user role
                Route::get('roles', 'Users@roles');
                Route::get('add_role', 'Users@add_role');
                Route::post('save_role', 'Users@save_role');
                Route::get('edit_role/{id}', 'Users@edit_role');
                Route::post('update_role', 'Users@update_role');
                Route::get('delete_role/{id}', 'Users@delete_role');
                Route::get('publisher_user', 'Users@publisher_user')->name('publisher_user');
           
                
            });
            Route::resource("users", "Users");
            Route::post('user_status_update', 'Users@status_update');
            Route::get("dataProcessingUser", "Users@index2")->name('dataProcessingUser');


            /**
             * customers
             */
            Route::group(["prefix" => "customers"], function () {
                Route::post('/check_username', 'Customers@check_customer');
                Route::post('/check_email', 'Customers@check_email');
                Route::get("/destroy/{id}", "Customers@destroy");
            });
            Route::resource("customers", "Customers");
            Route::post('/customer_status_update', 'Customers@status_update');
            Route::get("dataProcessingCustomer", "Customers@index2")->name('dataProcessingCustomer');

            /**
             * Sliders
             */
            Route::resource("sliders", "Sliders");
            Route::get("sliders/destroy/{id}", "Sliders@destroy");
            Route::post("slider_status_update", "Sliders@status_update");
            Route::get("dataProcessingSlider", "Sliders@index2")->name('dataProcessingSlider');
            /**
             * Appearance
             */
            Route::group(["prefix" => "appearance"], function () {
                Route::get("smthemeoptions", "Appearance@smThemeOptions");
                Route::post("save-sm-theme-options", "Appearance@saveSmThemeOptions")
                    ->name("saveThemeOption");
                Route::get('menus', 'Appearance@menus');
                Route::post('save_menus', 'Appearance@save_menus');
                /**
                 * editor
                 */
                Route::group(['prefix' => 'editor'], function () {
                    Route::any("/", "Appearance@editor");
                    Route::post("update-file", "Appearance@updateFile");
                });
            });


           
// Route::resource('/posts', [PostController::class, 'index']);

            /**
             * page
             */
            Route::resource("pages", "Pages");
            Route::get("pages/destroy/{id}", "Pages@destroy");
            Route::post("page_status_update", "Pages@status_update");
            Route::get("dataProcessingPage", "Pages@index2")->name('dataProcessingPage');

            /**
             * Categories
             */
            Route::resource("categories", "Categories");
            Route::get("categories/destroy/{id}", "Categories@destroy");
            Route::post("category_status_update", "Categories@status_update");


            Route::resource("schools", "SchoolController");
            Route::get("dataProcessingSchool", "SchoolController@index2")->name('dataProcessingSchool');
            Route::get("schools/destroy/{id}", "SchoolController@destroy");
            Route::post("school_status_update", "SchoolController@status_update");






            
            /**
             * Tags
             */
            Route::resource("tags", "Tags");
            Route::get("tags/destroy/{id}", "Tags@destroy");
            Route::post("tag_status_update", "Tags@status_update");
            Route::get("dataProcessingTag", "Tags@index2")->name('dataProcessingTag');

            /**
             * Brands
             */
            Route::resource("brands", "Brands");
            Route::get("brands/destroy/{id}", "Brands@destroy");
            Route::post("brand_status_update", "Brands@status_update");
            Route::get("dataProcessingBrand", "Brands@index2")->name('dataProcessingBrand');
            /**
             * Authors
             */
            Route::resource("authors", "Authors");
            Route::get("authors/destroy/{id}", "Authors@destroy");
            Route::post("author_status_update", "Authors@status_update");
            

            /**
             * Publishers
             */
            Route::resource("publishers", "Publishers");
            Route::get("publishers/destroy/{id}", "Publishers@destroy");
            Route::post("publisher_status_update", "Publishers@status_update");
            Route::get("dataProcessingPublisher", "Publishers@index2")->name('dataProcessingPublisher');
            /**
             * Attribute
             */
            Route::resource("attributetitles", "Attributetitles");
            Route::get("attributetitles/destroy/{id}", "Attributetitles@destroy");
            Route::post("attributetitles/attributetitle_status_update", "Attributetitles@attributetitle_status_update");
//            Attribute Value
            Route::get('get_attribute_data', 'Attributetitles@get_attribute_data');
            Route::post('store_attribute_data', 'Attributetitles@store_attribute_data')
                ->name('store_attribute_data');
            Route::get('edit_attribute_data', 'Attributetitles@edit_attribute_data');
            Route::post('update_attribute_data', 'Attributetitles@update_attribute_data')
                ->name('update_attribute_data');
            Route::get("delete_attribute_data/{id}", "Attributetitles@delete_attribute_data");

            /**
             * Brands
             */
            Route::resource("units", "Units");
            Route::get("units/destroy/{id}", "Units@destroy");
            Route::post("unit_status_update", "Units@status_update");
            Route::post('unit_store', 'Units@unit_store')->name('unit_store');
            Route::get("dataProcessingUnit", "Units@index2")->name('dataProcessingUnit');
            /**
             * Blogs
             */
            Route::group(["prefix" => "blogs"], function () {
                Route::get("/comments", "Blogs@comments");
                Route::get("/edit_comment/{id}", "Blogs@edit_comment");
                Route::patch("/update_comment/{id}", "Blogs@update_comment");
                Route::get("/reply_comment/{id}", "Blogs@reply_comment");
                Route::post("/save_reply", "Blogs@save_reply");
                Route::get("/delete_comment/{id}", "Blogs@delete_comment");
                Route::post("/comment_status_update", "Blogs@comment_status_update");
            });




            Route::group(["prefix" => "posts"], function () {
                Route::get('/postsall', 'PostController@index')->name('postsall');
                Route::get('/addposts', 'PostController@create');
                Route::post('/saveposts', 'PostController@store');
                Route::get('/post_edit/{id}', 'PostController@edit')->name('post_edit');
                Route::post('/update', 'PostController@update');
                Route::get('/post_delete/{id}', 'PostController@destroy')->name('post_delete');

            });




            Route::group(["prefix" => "teachers"], function () {
                Route::get('/allteacher', 'TeacherController@index');
                Route::get('/teacherajex', 'TeacherController@index2')->name('teacherajex');
                Route::get('/addteacher', 'TeacherController@create');
                Route::post('/saveteacher', 'TeacherController@store');
                Route::get('/destroy/{id}', 'TeacherController@destroy')->name('deleteTeacher');                
                Route::get('/teacher/{id}', 'TeacherController@edit')->name('editTeacher');
                Route::get("dataProcessingTeacher", "TeacherController@index2")->name('dataProcessingTeacher');
                
                Route::post('teacher_status_update/{id}', 'TeacherController@update');
            });



            Route::group(["prefix" => "hostels"], function () {
                Route::get('/allhostel', 'Hostels@index');
                Route::get('/addhostel', 'Hostels@create');
                Route::post('/savehostel', 'Hostels@store');
                Route::get("hostelajax", "Hostels@index2")->name('hostelajax');
                Route::get('/hostel/{id}', 'Hostels@edit')->name('editHostel');
                Route::post('hostel_status_update/{id}', 'Hostels@update');
                Route::get('/destroy/{id}', 'Hostels@destroy')->name('deleteHostel');                

            });



            Route::group(["prefix" => "phones"], function () {
                Route::get('/allphone', 'Phones@index');
                Route::get('/addphone', 'Phones@create');
                Route::post('/savephone', 'Phones@store');
                Route::get('/phoneajax', "Phones@index2")->name('phoneajax');
                Route::get('/phone/{id}', 'Phones@edit')->name('editPhone');
                Route::post('/phone_status_update/{id}', 'Phones@update');
                Route::get('/destroy/{id}', 'Phones@destroy')->name('deletePhone');                

            });



            


            Route::group(["prefix" => "shops"], function () {
                Route::get('/allshop', 'ShopController@index');
                Route::get('/addshop', 'ShopController@create');
                Route::post('/saveshop', 'ShopController@store');
                Route::get('/shopajax', 'ShopController@index2')->name('shopajax');                
                Route::get('/destroy/{id}', 'ShopController@destroy')->name('deleteShop'); 
                Route::get('/shop/{id}', 'ShopController@edit')->name('editShop');
                Route::post('shop_status_update/{id}', 'ShopController@update');
            });

            Route::group(["prefix" => "gests"], function () {
                Route::get('/allgest', 'GestController@index');
                Route::get('/addgest', 'GestController@create');
                Route::post('/savegest', 'GestController@store');
                Route::get('/gestajax', 'GestController@index2')->name('gestajax'); 
                Route::get('/destroy/{id}', 'GestController@destroy')->name('deletegest'); 
                Route::get('/gest/{id}', 'GestController@edit')->name('editgest');
                Route::post('gest_status_update/{id}', 'GestController@update');               

                
            });


            Route::group(["prefix" => "students"], function () {
                Route::get('/allstudent', 'StudentController@index');
                Route::get('/addstudent', 'StudentController@create');
                Route::post('/savestudent', 'StudentController@store');
                Route::get('/studentajax', 'StudentController@index2')->name('studentajax'); 

                Route::get('/destroy/{id}', 'StudentController@destroy')->name('deletestudent'); 
                Route::get('/student/{id}', 'StudentController@edit')->name('editstudent');
                Route::post('student_status_update/{id}', 'StudentController@update');
            });




            Route::group(["prefix" => "samples"], function () {
                Route::get('/allshop', 'ShopController@index');
                Route::get('/addshop', 'ShopController@create');
                Route::post('/saveshop', 'ShopController@store');
                Route::get('/shopajax', 'ShopController@index2')->name('shopajax');                
                Route::get('/destroy/{id}', 'ShopController@destroy')->name('deleteShop'); 
                Route::get('/shop/{id}', 'ShopController@edit')->name('editShop');
                Route::post('shop_status_update/{id}', 'ShopController@update');
            });



            Route::group(["prefix" => "users"], function () {
                Route::get("destroy/{id}", "Users@destroy");
                //admin user role
                Route::get('roles', 'Users@roles');
                Route::get('add_role', 'Users@add_role');
                Route::post('save_role', 'Users@save_role');
                Route::get('edit_role/{id}', 'Users@edit_role');
                Route::post('update_role', 'Users@update_role');
                Route::get('delete_role/{id}', 'Users@delete_role');
                Route::get('publisher_user', 'Users@publisher_user')->name('publisher_user');          
                
            });



            Route::resource("blogs", "Blogs");
            Route::post("/blog_status_update", "Blogs@status_update");
            Route::get("blogs/destroy/{id}", "Blogs@destroy");
            Route::get("dataProcessingBlog", "Blogs@index2")->name('dataProcessingBlog');

            /**
             * Products
             */
            Route::group(["prefix" => "products"], function () {
                Route::get("/export", "Products@export");
                Route::get("/importproducts", "Products@importproducts");
                Route::post("/import_csv", "Products@import_csv")->name('import_csv');

                Route::get("/reviews", "Products@reviews");
                Route::get("/edit_review/{id}", "Products@edit_review");
                Route::patch("/update_review/{id}", "Products@update_review");
                Route::get("/reply_review/{id}", "Products@reply_review");
                Route::post("/save_reply", "Products@save_reply");
                Route::get("/delete_review/{id}", "Products@delete_review");
                Route::post("/review_status_update", "Products@review_status_update");

                Route::get("/delete/{id}", "Products@destroy");
                Route::post("/blog_status_update", "Products@blog_status_update");
            });

            Route::resource("products", "Products");
            
            Route::post("product_status_update", "Products@product_status_update")
                ->name('product_status_update');
            Route::get('productAttributeAddMore', 'Products@productAttributeAddMore')
                ->name('productAttributeAddMore');
            Route::get('productReadALittleAddMore', 'Products@productReadALittleAddMore')
                ->name('productReadALittleAddMore');
            Route::get('deleteMultipleProduct', 'Products@deleteMultiple')->name('deleteMultipleProduct');
            Route::get('searchSku', 'Products@searchSku')
                ->name('searchSku');

            /**
             * Coupons
             */
            Route::resource("coupons", "Coupons");
            Route::get("coupons/destroy/{id}", "Coupons@destroy");
            Route::post("coupon_status_update", "Coupons@coupon_status_update");
            Route::get("dataProcessingCoupon", "Coupons@index2")->name('dataProcessingCoupon');


            /**
             * orders
             */
            Route::resource("orders", "Orders");
            Route::get("/order/{type}", "Orders@ordersType");
            Route::get("orders/destroy/{id}", "Orders@destroy");
            Route::get("orders/download/{id}", "Orders@download");
            Route::post("orders/order_status_update", "Orders@order_status_update");
            Route::post("orders/order_info_update", "Orders@order_info_update")
                ->name('order_info_update');
            Route::post("orders/order_mail", "Orders@order_mail")
                ->name('order_mail');
            Route::post("orders/payment_status_update", "Orders@payment_status_update");
            Route::post("orders/payment_info_update", "Orders@payment_info_update")
                ->name('payment_info_update');
            Route::get("dataProcessingOrder", "Orders@index2")->name('dataProcessingOrder');
            Route::get("orders-sales", "Orders@sales");
            Route::get("phone_number", "Orders@phone_number")->name('phone_number');
            Route::get("sales", "Orders@index3")->name('dataProcessingSale');
            /**
             * contact
             */
            Route::resource("contacts", "Contacts");
            Route::get("dataProcessingContact", "Contacts@index2")->name('dataProcessingContact');
            Route::get("contacts/destroy/{id}", "Contacts@destroy");
            Route::post("contacts/status_update", "Contacts@status_update");

            /**
             * subscriber
             */
            Route::resource("subscribers", "Subscribers");
            Route::get("subscribers/destroy/{id}", "Subscribers@destroy");
            Route::post("subscriber_status_update", "Subscribers@status_update");


            /**
             * Reports
             */
            Route::group(["prefix" => "reports"], function () {
                Route::get("/orders", "Reports@orders");
                //order_reports
                Route::get("/order-reports", "Reports@order_reports");
                Route::get("order_reports_data", "Reports@order_reports_data")->name('order_reports_data');
                //order_details
                Route::get("/order-details", "Reports@order_details");
                Route::get("order_details_data", "Reports@order_details_data")->name('order_details_data');
                //stock-alert
                Route::get("stock-report", "Reports@stock_report")->name('stockReport');
                Route::get("stock-alert", "Reports@stock_alert")->name('stockAlert');
                Route::get("stock-expiry", "Reports@stock_expiry")->name('stockExpiry');
                //Slow_motion
                Route::get("/slow-motion", "Reports@slow_motion");
                Route::get("slow_motion_data", "Reports@slow_motion_data")->name('slow_motion_data');
            });

        });
    });
});

