<?php
$fb_api_enable = SM::get_setting_value('fb_api_enable') == 'on' ? true : false;
$gp_api_enable = SM::get_setting_value('gp_api_enable') == 'on' ? true : false;
$tt_api_enable = SM::get_setting_value('tt_api_enable') == 'on' ? true : false;
$li_api_enable = SM::get_setting_value('li_api_enable') == 'on' ? true : false;
?>
    <div class="registration_outher_section">
        <p>Login with your social media account</p>
        <div class=" social-btn">
            <a href="{{url('/login/facebook')}}" class="btn btn-primary">
                <i class="fa fa-facebook"></i>&nbsp;Facebook
            </a>
            <a href="{{url('/login/google')}}" class="btn btn-danger">
                <i class="fa fa-google"></i>&nbsp; Google
            </a>
        </div>
    </div>



