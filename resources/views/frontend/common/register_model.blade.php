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

<div class="modal fade" id="onlyRegisterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
         
            <div class="modal-body model-body-padding">
                <?php
                $authCheck = Auth::check();
                ?>
                <div class="row">
        
                        <div class="col-md-6 border-right-log padding-model" >
                              <h2 class="text-center">POP IN YOUR DETAILS TO SAVE 30% ON GROCERIES!</h2>
                            {{ Form::open(['url' => ['/register'], 'id' => 'registrationForm', 'class'=>'smAuthForm']) }}
                            <div class="form-group">
                                <label for="username" class="col-form-label">Your Name:</label>
                                {!! Form::text('username', null, ['class' => 'form-control', 'required', 'id'=>'username', 'placeholder'=> 'Your Name . . .']) !!}
                                <span class="error-notice"></span>
                            </div>
                            <div class="form-group">
                                <label for="emmail_login" class="col-form-label">Email address:</label>
                                {!! Form::email('email', null, ['class' => 'form-control', 'required', 'id'=>'emmail_login', 'placeholder'=> 'Email Address . . .']) !!}
                                <span class="error-notice"></span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="col-form-label">Password: (Minimum 6 charecters)</label>
                                <input id="password" minlength="6" type="password" name="password" required
                                       class="form-control input-lg m-log"
                                       placeholder="Password">
                                <span class="error-notice"></span>
    
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation" minlength="6" class="col-form-label">Conform Password:</label>
                                <input id="password_confirmation" required name="password_confirmation" type="password"
                                       class="form-control"
                                       placeholder="Conform Password . . .">
                                <span class="error-notice"></span>
    
                            </div>
                            <!-- <div class="form-group">
                                <label for="g-recaptcha-response" minlength="6" class="col-form-label">Recaptcha:</label>
                                {!! app('captcha')->display() !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                                <span class="error-notice"></span>
                            </div> -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-user"></i> Create an account
                                </button>
                            </div>
                            {!! Form::close() !!}
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
                               <img src="{{asset('images/carts_generic.png')}}" style="width:100%">
                       </div>
                    </div>
                </div>
            </div>
           
        </div>
    </div>
</div>