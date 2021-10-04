{!! NoCaptcha::renderJs() !!}

<div class="modal fade loginModal regloginModal" id="loginModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Create an account</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="all-books-content">
                            <div class="total-cat-item">
                                <h3>Create Your Account</h3>
                            </div>
                        </div>
                        <div class="all-books-content">
                            <div class="shipping-address-box">
                                {{ Form::open(['url' => ['/register'], 'id' => 'registrationForm', 'class'=>'smAuthForm form']) }}
                                <div class="form-group">
                                    <label class="control-label">Name</label>
                                    {!! Form::text('name', null, ['class' => 'form-control', 'required', 'placeholder'=> 'Your Name . . .']) !!}
                                </div>
                                <div class="form-group">
                                    <label class="control-label"> Phone Number </label>
                                    {!! Form::text('mobile', null, ['class' => 'form-control', 'required', 'placeholder'=> 'Phone no . . .']) !!}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    {!! Form::email('email', null, ['class' => 'form-control', 'required', 'placeholder'=> 'Email Address . . .']) !!}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="password" name="password" required
                                           class="form-control"
                                           placeholder="password">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Confirm Password</label>
                                    <input required name="password_confirmation"
                                           type="password"
                                           class="form-control"
                                           placeholder="confirm password">
                                </div>

                                <div class="google_capchar">
                                    <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                        {!! app('captcha')->display() !!}
                                            @if ($errors->has('g-recaptcha-response'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="books-tetails-cart">
                                    <button type="submit" class="btn btn-default  pull-left"> Create Account
                                    </button>
                                </div>
                                {!! Form::close() !!}
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="all-books-content">
                            <div class="total-cat-item">
                                <h3>Login Your Dashboard</h3>
                            </div>
                        </div>
                        <div class="all-books-content">
                            <div class="shipping-address-box">
                                <form id="loginForm1" method="post" action="{{ url('/login') }}" class="login-form-wraper smAuthHide smAuthForm" style="">
                                    {!! csrf_field() !!}
                                    <div class="form-group">
                                        <label for="emmail_login" class="control-label">Email / Phone :</label>
                                        {!! Form::email('username', null, ['class' => 'form-control', 'required', 'placeholder'=> 'Email Address . . .']) !!}
                                        <span class="error-notice"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="control-label">Password:</label>
                                        <input required name="password" type="password"
                                               class="form-control"
                                               placeholder="password">
                                        <span class="error-notice"></span>
                                    </div>

                                    <div class="google_capchar">
                                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                            {!! app('captcha')->display() !!}
                                                @if ($errors->has('g-recaptcha-response'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="books-tetails-cart">
                                        <button type="submit" class="btn btn-default pull-left">
                                            Login now
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


