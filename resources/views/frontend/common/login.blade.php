@extends('frontend.master')

@section('title', '')

@section('content')
{!! NoCaptcha::renderJs() !!}
<section class="login-register-page">
    <div class="container">
        <div class="login_section_information">
            <div class="row">
                <div class="col-md-12">
                    <div class="section_title">
                        <h4> Create Your Account :) </h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="login_section_area">
                        <div class="section_title">
                            <h4>Sing In</h4>
                        </div>
                        <form id="login-form" action="{{ url('/login') }}" method="post"
                        class="login-form-wraper smAuthHide smAuthForm"
                        style="display: block;">
                        {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="emailPhone">Email / Phone :</label>
                                {!! Form::text('username', null, ['class' => 'form-control only-border', 'required', 'autocomplete'=>'off', 'id'=>'username', 'tabindex' => '1', 'placeholder'=> 'Username']) !!}
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                            </div>
                            <div class="google_capchar">
                                <div  class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                    {!! app('captcha')->display() !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn">Login</button>
                        </form>
                        <div class="outher_login_system">
                            <div class="login_social_media">
                             
                                @include('frontend.common.register_social')
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="logout_section_area">
                        <div class="section_title">
                            <h4>Registration</h4>
                        </div>
                        {{ Form::open(['url' => ['/register'], 'id' => 'register-form', 'class'=>'smAuthForm form', 'method'=>'post',]) }}
                            <div class="form-group">
                                <label for="userName">Name :</label>
                                <input type="text" class="form-control" id="userName" name="name" aria-describedby="emailHelp" placeholder="Name ">
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">Phone Number :</label>
                                <input type="number" class="form-control" id="phoneNumber" name="mobile" placeholder="Phone Number">
                            </div>
                            <div class="form-group">
                                <label for="Email">Email :</label>
                                <input type="email" class="form-control" name="email" id="Email" placeholder="Email ">
                            </div>
                            <div class="form-group">
                                <label for="password">Password :</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="conformPassword">Conform Password :</label>
                                <input type="password" class="form-control" name="password_confirmation" id="conformPassword" placeholder="Conform Password">
                            </div>
                            <div class="google_capchar">
                                <div  class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                    {!! app('captcha')->display() !!}
                                        @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <button type="submit" class="btn">Registration</button>
                            @include('frontend.common.register_social')
                            {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@php /* @endphp
<div class="row">
    <div class="col-md-4" style="padding: 0px;">
        <div class="banar-login">
            <div>
                <img src="/storage/uploads/slide1.jpg">
            </div>
            <div>
                <img src="/storage/uploads/slide.jpg">
            </div>
        </div>
    </div>
    <div class="col-md-8" style="padding: 0px;">
        <div class="panel panel-login" id="login_and_registration_section"
            style="background-image: url(https://cdn4.vectorstock.com/i/1000x1000/67/48/library-book-shelf-seamless-pattern-of-vector-17656748.jpg);">
            <div class="background_overlay_login">
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="login_and_registration">
                            <ul class="nav nav-tabs nav-pills">
                                <li class="active"><a data-toggle="tab" href="#home">Login</a></li>
                                <li><a data-toggle="tab" href="#menu1">Register</a></li>
                            </ul>

                            <div class="tab-content">
                                <div id="home" class="tab-pane fade in active">
                                    <div class="login-section">
                                        <form id="login-form" action="{{ url('/login') }}" method="post"
                                            class="login-form-wraper smAuthHide smAuthForm"
                                            style="display: block;">
                                            {!! csrf_field() !!}
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-user-circle-o"></i></span>
                                                <!--<input type="text" autocomplete="off" name="username" id="username" tabindex="1" class="form-control only-border" placeholder="Username" value="">-->
                                                {!! Form::text('username', null, ['class' =>
                                                'form-control only-border', 'required',
                                                'autocomplete'=>'off', 'id'=>'username', 'tabindex' =>
                                                '1', 'placeholder'=> 'Username']) !!}
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon"><i
                                                        class="fa fa-lock"></i></span>
                                                <!--<input type="password" autocomplete="off" name="password" id="password" tabindex="2" class="form-control only-border" placeholder="Password">-->
                                                <input required name="password" autocomplete="off"
                                                    id="password" tabindex="2" type="password"
                                                    class="form-control only-border"
                                                    placeholder="********">
                                            </div>
                                            <div class="google_capchar">
                                                <div
                                                    class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                                    <div class="col-md-12">
                                                        {!! app('captcha')->display() !!}
                                                        @if ($errors->has('g-recaptcha-response'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                        </span>

                                                        @endif


                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="checkbox" tabindex="3" class=""
                                                    name="remember" id="remember">
                                                <label for="remember"> Remember Me</label>
                                            </div>
                                            <div class="submit_section">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <!--<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">-->
                                                            <button type="submit" name="login-submit"
                                                                id="login-submit" tabindex="4"
                                                                class="form-control btn btn-login">Log
                                                                In</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="text-center">
                                                            <a href="https://phpoll.com/recover"
                                                                tabindex="5"
                                                                class="forgot-password">Forgot
                                                                Password?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="menu1" class="tab-pane fade">
                                    <div class="register-section">
                                        {{ Form::open(['url' => ['/register'], 'id' => 'register-form', 'class'=>'smAuthForm form', 'method'=>'post',]) }}
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-user-circle-o"></i></span>
                                            <input type="text" name="name" id="username"
                                                autocomplete="off" tabindex="1"
                                                class="form-control only-border" required
                                                placeholder="Full Name" value="">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-envelope-o"></i></span>
                                            <input type="email" name="email" id="email"
                                                autocomplete="off" tabindex="1"
                                                class="form-control only-border" required
                                                placeholder="Email Address" value="">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-mobile"></i></span>
                                            <input type="text" name="mobile" id="mobile" tabindex="1"
                                                autocomplete="off" class="form-control only-border"
                                                required placeholder="Phone" value="">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-lock"></i></span>
                                            <input type="password" name="password" id="password"
                                                autocomplete="off" tabindex="2"
                                                class="form-control only-border" required
                                                placeholder="Password">
                                        </div>
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="fa fa-lock"></i></span>
                                            <input type="password" name="password_confirmation"
                                                autocomplete="off" id="confirm-password" tabindex="2"
                                                class="form-control only-border"
                                                placeholder="Confirm Password">
                                        </div>
                                        <div class="google_capchar">
                                            <div
                                                class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                                <div class="col-md-12">
                                                    {!! app('captcha')->display() !!}
                                                    @if ($errors->has('g-recaptcha-response'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                    </span>

                                                    @endif
                                                    <p>error please captchar</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12 ">
                                                    <div class="submit_button">
                                                        <input type="submit" name="register-submit"
                                                            id="register-submit" tabindex="4"
                                                            class="form-control btn btn-register"
                                                            value="Register Now">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {!! Form::close() !!}
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    @include('frontend.common.register_social')
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-md-12">
                        <div class="login_informaion_des">
                            <p>Don’t have an account? <a href="">Sign Up Now!</a></p>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>

                @php */ @endphp

@endsection