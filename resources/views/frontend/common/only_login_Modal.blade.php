<style>
.model-body-padding{
    padding:0;
}
  .border-right-log {
	border-right: 1px solid #cecece;
}
.padding-model{
    padding: 50px 30px;
}
.login-cross-btn {
	position: absolute;
	right: 7px;
	border: 2px solid #134203;
	height: 25px;
	width: 25px;
	border-radius: 25px;
	background: #fff;
	top: 5px;
	font-size: 15px;
	padding: 0px;
}
.log-right-padding{
    padding: 30px;
   text-align: center;
}
.login-logo-style {
	padding: 25px;
}
</style>

<div class="modal fade" id="onlyloginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
         
            <div class="modal-body model-body-padding">
                <?php
                $authCheck = Auth::check();
                ?>
                <div class="row">
                    <div class="col-md-6 border-right-log padding-model" >
                        <h2 class="text-center">SIGN IN</h1>
                        <form id="loginForm1" method="post" action="{{ url('/login') }}"
                              class="login-form-wraper smAuthHide smAuthForm {{ SM::current_controller()=="LoginController" && SM::current_method()=="index" ? ' active' : '' }}"
                              style="display: {{ !$authCheck && SM::current_controller()=="LoginController" && SM::current_method()=="index" ? 'block' : 'block' }}">
                            <?php
                            $isLoginController = SM::current_controller() == "LoginController" ? true : false;
                            ?>
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="emmail_login" class="col-form-label">Email address:</label>
                                {!! Form::email('username', null, ['class' => 'form-control', 'required', 'id'=>'emmail_login', 'placeholder'=> 'Email Address . . .']) !!}

                                <span class="error-notice"></span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Password:</label>
                                <input id="password_login" required name="password" type="password"
                                       class="form-control input-lg m-log"
                                       placeholder="Password . . .">
                                <span class="error-notice"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-lock"></i>
                                    LOGIN NOW
                                </button>
                            </div>
                        </form>
                        <p class="">
                            <a style="color: #134303;"
                               href="{{ url('/forgot-password')}}">Forgot your
                                password?</a>
                        </p>
                        @include("frontend.common.register_social")
                    </div>
                     <div class="col-md-6">
                           <button type="button" class="login-cross-btn" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="hidden-xs log-right-padding">
                                 <a href="{{URL('/')}}" class="logo">
                                    <img class="logo-style login-logo-style" alt="{{ SM::get_setting_value('site_name') }}" src="{{ SM::sm_get_the_src(SM::sm_get_site_logo(), 294, 90) }}" style="width:100%"/>
                                </a>
                                <h2>We can help you save on your grocery shop</h2> 
                               <img src="{{asset('images/carts_generic.png')}}"  style="width:100%">
                       </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>


