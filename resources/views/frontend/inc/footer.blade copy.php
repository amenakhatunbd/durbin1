<?php
    $site_name = SM::sm_get_site_name();
    $site_name = SM::sm_string($site_name) ? $site_name : 'buckleup-bd';
    $hotline = SM::get_setting_value('hotline');
    $mobile = SM::get_setting_value('mobile');
    $email = SM::get_setting_value('email');
    $address = SM::get_setting_value('address');
    $logo = SM::smGetThemeOption("footer_logo", "");
    if (empty($logo)) {
        $logo = SM::sm_get_site_logo();
    }
    $footer_widget2_title = SM::smGetThemeOption('footer_widget2_title', "Seo Services");
    $footer_widget2_description = SM::smGetThemeOption('footer_widget2_description', "");
    $footer_widget3_title = SM::smGetThemeOption('footer_widget3_title', "Company");
    $footer_widget3_description = SM::smGetThemeOption('footer_widget3_description', "");
    $footer_widget4_title = SM::smGetThemeOption('footer_widget4_title', "Technology");
    $footer_widget4_description = SM::smGetThemeOption('footer_widget4_description', "");
    $contact_branches = SM::smGetThemeOption("contact_branches");
    $newsletter_success_title = SM::smGetThemeOption("newsletter_success_title", "Thank You For Subscribing!");
    $newsletter_success_description = SM::smGetThemeOption("newsletter_success_description", "You're just one step away from being one of our dear susbcribers.Please check the Email provided and confirm your susbcription.");
    $payment_method_image = SM::smGetThemeOption("payment_method_image", "");
?>

<section class="big-footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <div class="footer-content-box">
                    <img alt="{{ $site_name }}" src="{{ SM::sm_get_the_src($logo, 230, 50) }}" class="img-responsive">
                    <ul class="footer-adress-bar">
                        <li>
                            <p><span><i class="icofont-headphone-alt"></i><a href="tel:{{ $hotline }}"> {{ $hotline }}</a></span></p>
                        </li>
                        <li>
                            <p><span><i class="icofont-users"></i><a href="tel:{{ $mobile }}"> {{ $mobile }}</a></span></p>
                        </li>
                        <li>
                            <p><i class="icofont-envelope"></i> {{ $email }} </p>
                        </li>
                        <li>
                            <p><i class="icofont-google-map"></i> {{ $address }}</p>
                        </li>
                    </ul>
                    <h3 class="footer-title">Stay Connected</h3>
                    <ul class="social-network social-circle">
                        @empty(!SM::smGetThemeOption("social_facebook"))
                            <li><a href="{{ SM::smGetThemeOption("social_facebook") }}" class="icoFacebook"
                                   title="Facebook"><i class="fa fa-facebook"></i></a></li>

                        @endempty

                        @empty(!SM::smGetThemeOption("social_youtube"))

                            <li><a href="{{ SM::smGetThemeOption("social_youtube") }}" class="icoYoutube"

                                   title="Youtube"><i class="fa fa-youtube-play"></i></a></li>

                        @endempty
                         @empty(!SM::smGetThemeOption("social_youtube"))

                            <li><a href="{{ SM::smGetThemeOption("social_instagram") }}" class="icoInstagram"

                                   title="Instagram"><i class="fa fa-instagram"></i></a></li>

                        @endempty
                        @empty(!SM::smGetThemeOption("social_twitter"))

                            <li><a href="{{ SM::smGetThemeOption("social_twitter") }}" class="icoTwitter"

                                   title="Twitter"><i class="fa fa-twitter"></i></a></li>

                        @endempty

                        @empty(!SM::smGetThemeOption("social_google_plus"))

                            <li><a href="{{ SM::smGetThemeOption("social_google_plus") }}" class="icoGoogle"

                                   title="Google +"><i class="fa fa-google-plus"></i></a>

                            </li>

                        @endempty

                        @empty(!SM::smGetThemeOption("social_linkedin"))

                            <li><a href="{{ SM::smGetThemeOption("social_linkedin") }}" class="icoLinkedin"

                                   title="Linkedin"><i class="fa fa-linkedin"></i></a>

                            </li>

                        @endempty

                    </ul>

                </div>

            </div>

            




            <div class="col-md-6 col-sm-6">

                <div class="row">

                    <div class="col-md-8 col-sm-8">
                        <div class="location-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d1825.9512231564672!2d90.38779740819344!3d23.750857946147338!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1s%20Artisan%20Center%20(8th%20Floor)%2C%2057%2F9%20West%20Panthapath%201205%20Dhaka%2C%20Dhaka%20Division%2C%20Bangladesh!5e0!3m2!1sen!2sbd!4v1600240126808!5m2!1sen!2sbd" style="width: 100%;height: 300px;"  frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                        </div>
                        </div>

                    <div class="col-md-4 col-sm-4">

                        <div class="footer-content-box">

                            <h3 class="footer-title">{{ $footer_widget4_title }}</h3>

                            {!! stripslashes($footer_widget4_description) !!}

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-3 col-sm-3">

                <div class="Facebook">

                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdurbiin.com.bd%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId=313079099415873" style="width:100%; height:350px;border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>

                </div>

            </div>

        </div>

    </div>

</section>

<footer class="stcky-footer">



    <div class="container">



        <div class="row">



            <div class="col-md-12">



                <div class="stiky-par">



                    <p class="pull-left">{{ SM::smGetThemeOption("copyright") }} © 2020 <a href="www.durbiin.com"> Durbiin.com</a></p>

                    <p class="pull-right">Design & Developed By <a href="http://nextpagetl.com" target="blank_">Next Page Technology

                            Ltd.</a></p>



                </div>



            </div>



        </div>



    </div>



</footer>