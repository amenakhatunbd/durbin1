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
                    <div class="title">
                        <h4> Durbiin.com is an online book and gift shop. </h4>
                    </div>
                    <ul class="footer-adress-bar">
                        <li>
                            <p><span><i class="icofont-headphone-alt"></i><a href="tel:{{ $hotline }}"> {{ $hotline }}</a></span></p>
                        </li>
                        <li>
                            <p><span><i class="fa fa-whatsapp"></i><a href="tel:{{ $mobile }}"> {{ $mobile }}</a></span></p>
                        </li>
                        <li>
                            <p><i class="icofont-envelope"></i> {{ $email }} </p>
                        </li>
                        <li>
                            <p><i class="icofont-google-map"></i> {{ $address }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6">
                <div class="footer-content-box">
                    <h3 class="footer-title">{{ $footer_widget4_title }}</h3>
                    {!! stripslashes($footer_widget4_description) !!}
                </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6">
                <div class="footer_social_media_icon">
                    <h3 class="footer-title">Stay Connected</h3>
                    <ul class="social-network social-circle">
                        @empty(!SM::smGetThemeOption("social_facebook"))
                            <li>
                                <a href="{{ SM::smGetThemeOption("social_facebook") }}" class="icoFacebook" title="Facebook">
                                    <i class="fa fa-facebook"></i>
                                    Facebook
                                </a>
                            </li>
                        @endempty
                        @empty(!SM::smGetThemeOption("social_youtube"))
                            <li>
                                <a href="{{ SM::smGetThemeOption("social_youtube") }}" class="icoYoutube" title="Youtube">
                                   <i class="fa fa-youtube-play"></i>
                                   Youtube
                                </a>
                            </li>
                        @endempty
                        @empty(!SM::smGetThemeOption("social_youtube"))
                            <li>
                                <a href="{{ SM::smGetThemeOption("social_instagram") }}" class="icoInstagram" title="Instagram">
                                   <i class="fa fa-instagram"></i>
                                   Instagram
                                </a>
                            </li>
                        @endempty
                        @empty(!SM::smGetThemeOption("social_twitter"))
                            <li>
                                <a href="{{ SM::smGetThemeOption("social_twitter") }}" class="icoTwitter" title="Twitter">
                                    <i class="fa fa-twitter"></i>
                                    Twitter
                                </a>
                            </li>
                        @endempty
                        @empty(!SM::smGetThemeOption("social_google_plus"))
                            <li>
                                <a href="{{ SM::smGetThemeOption("social_google_plus") }}" class="icoGoogle" title="Google +">
                                   <i class="fa fa-google-plus"></i>
                                   Google Plus
                                </a>
                            </li>
                        @endempty
                        @empty(!SM::smGetThemeOption("social_linkedin"))
                            <li>
                                <a href="{{ SM::smGetThemeOption("social_linkedin") }}" class="icoLinkedin" title="Linkedin">
                                   <i class="fa fa-linkedin"></i>
                                   Linkedin
                                </a>
                            </li>
                        @endempty
                    </ul>
                </div>
            </div>
            <div class="col-md-3 col-xs-12">
                <div class="facebook_page_add-section">
                    <h3 class="footer-title">Stay Connected</h3>
                    <div class="fb-page"
                        data-href="https://www.facebook.com/durbiin.com.bd/" 
                        data-width="340"
                        data-hide-cover="false"
                        data-show-facepile="true">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="stcky-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>{{ SM::smGetThemeOption("copyright") }} © 2020 <a href="www.durbiin.com"> Durbiin.com</a></p>
            </div>
            <div class="col-md-6">
                <p class="development_information">Design & Developed By <a href="http://nextpagetl.com" target="blank_">Next Page Technology Ltd.</a></p>
            </div>
        </div>
    </div>
</footer>