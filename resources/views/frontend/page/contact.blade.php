@extends('frontend.master')
@section("title", "Contact")
@section('content')
    <!-- page wapper-->
    <?php
    $contact_form_title = SM::smGetThemeOption("contact_form_title");
    $contact_title = SM::smGetThemeOption("contact_title");
    $contact_subtitle = SM::smGetThemeOption("contact_subtitle");
    $contact_des_title = SM::smGetThemeOption("contact_des_title");
    $contact_description = SM::smGetThemeOption("contact_description");
    $title = SM::smGetThemeOption("contact_banner_title");
    $subtitle = SM::smGetThemeOption("contact_banner_subtitle");
    $bannerImage = SM::smGetThemeOption("contact_banner_image");

    $contact_location_title = SM::smGetThemeOption("contact_location_title");
    $contact_location_subtitle = SM::smGetThemeOption("contact_location_subtitle");

    $mobile = SM::get_setting_value('mobile');
    $email = SM::get_setting_value('email');
    $address = SM::get_setting_value('address');
    ?>
    <div class="columns-container">
        <div class="container-fluid" id="columns">
            <!-- breadcrumb -->
        @include('frontend.common.breadcrumb', ['bannerImage'=>$bannerImage])
        <!-- ./breadcrumb -->
            <div class="row">
                <!-- Left colunm -->
                <div class="column col-xs-12 col-sm-12" id="left_column">
                    <!-- block category -->
                    <div class="block left-module">
                        <p class="title_block">{{$title}}</p>
                        <div class="block_content">
                            <!-- layered -->
                            <div class="layered layered-category">
                                <div class="layered-content">
                                    <div id="contact" class="page-content page-contact">
                                        <div id="message-box-conact"></div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 class="page-subheading">CONTACT FORM</h3>
                                                <div class="contact-form-box">
                                                    {!! Form::open(['method'=>'post', 'action'=>'Front\HomeController@send_mail', 'id'=>'contactMail']) !!}
                                                    <div class="form-selector">
                                                        <label>Your Name</label>
                                                        <input type="text" class="form-control input-sm" required
                                                               name="fullname"
                                                               placeholder="Your Name*" id="fullname"/>
                                                    </div>
                                                    <div class="form-selector">
                                                        <label>Email address</label>
                                                        <input type="email" class="form-control input-sm" required
                                                               name="email"
                                                               placeholder="Your E-mail*" id="contact_email"/>
                                                    </div>
                                                    <div class="form-selector">
                                                        <label>Subject</label>
                                                        <input name="subject" class="form-control input-sm" required
                                                               type="text"
                                                               placeholder="Subject">
                                                    </div>
                                                    <div class="form-selector">
                                                        <label>Message</label>
                                                        <textarea name="message" required id="contact_message"
                                                                  placeholder="Your massage"
                                                                  class="form-control input-sm" rows="10"></textarea>
                                                    </div>
                                                    <div class="form-selector">
                                                        <label>Captcha</label>
                                                        {!! app('captcha')->display() !!}
                                                        @if ($errors->has('g-recaptcha-response'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-selector">
                                                        <button type="submit" id="btn-send-contact" class="btn">
                                      <span class="loading" style="display: none;"><i
                                                  class="fa fa-refresh fa-spin"></i></span> Submit
                                                        </button>

                                                    </div>
                                                    <ul class="serviceMailErrors mailErrorList concatMailErrors">
                                                    </ul>
                                                    {!! Form::close() !!}
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-6" id="contact_form_map">
                                                @empty(!$contact_des_title)
                                                    <h3 class="page-subheading">{{ $contact_des_title }}</h3>

                                                @endempty
                                                @empty(!$contact_description)
                                                    <p>{!! $contact_description  !!}</p>
                                                @endempty

                                                <ul class="store_info">
                                                    <li><i class="fa fa-home"></i>{{ $address }}
                                                    </li>
                                                    <li><i class="fa fa-phone"></i><span>{{ $mobile }}</span></li>
                                                    <li><i class="fa fa-envelope"></i>Email: <span><a
                                                                    style="color:tomato"
                                                                    href="mailto:{{ $email }}">{{ $email }}</a></span>
                                                    </li>
                                                </ul>
                                                 <div style="margin-top: 20px;">
                                                    @empty(!$contact_location_title)
                                                        <h3 class="page-subheading">{{ $contact_location_title }}</h3>

                                                    @endempty
                                                    @empty(!$contact_location_subtitle)
                                                        <p>{!! $contact_location_subtitle  !!}</p>
                                                    @endempty
                                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7302.107045055476!2d90.39090247503894!3d23.7811083382969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c76a25b04c17%3A0xc32fd7eaacd36446!2sMohakhali+DOHS%2C+Dhaka!5e0!3m2!1sen!2sbd!4v1564815479680!5m2!1sen!2sbd"
                                                            width="800" height="350" frameborder="0" style="border:0"
                                                            allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ./layered -->
                        </div>
                    </div>
                    <!-- page heading-->
                </div>
            </div>


        </div>
    </div>
    <!-- ./page wapper-->
@endsection