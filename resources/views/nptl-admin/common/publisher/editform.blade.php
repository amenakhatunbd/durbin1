<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-add-publisher-main" data-widget-editbutton="false"
         data-widget-deletebutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-building"></i> </span>
            <h2>{{ $f_name }} Publisher</h2>
        </header>
        <!-- widget div-->
        <div>
            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->
                <input class="form-control" type="text">
            </div>
            <!-- end widget edit box -->
            <!-- widget content -->
            <div class="widget-body padding-10">
                <div class="row">

                    <div class="col-sm-6">
                        <div class="sm-form {{ $errors->has('username') ? ' has-error' : '' }}">
                            {!! Form::label('username',__("Username"))!!}
                            {!! Form::text('username', $user_info->username,['required'=>'','class'=>'form-control', 'placeholder'=>__("user.username")]) !!}
                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                 </span>
                            @endif
                          
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="sm-form{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email',__("user.email"))!!}
                            {!! Form::text('email', $user_info->email,['required'=>'','class'=>'form-control', 'placeholder'=>__("user.email")]) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                            @endif
                           
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-sm-6">
                        <div class="sm-form {{ $errors->has('fullname') ? ' has-error' : '' }}">
                            {!! Form::label('username',__("Fullname "))!!}
                            {!! Form::text('fullname', $user_info->firstname,['required'=>'','class'=>'form-control', 'placeholder'=>__("fullname")]) !!}
                            @if ($errors->has('fullname'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                 </span>
                            @endif
                           
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="sm-form{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            {!! Form::label('mobile',__("user.mobile"))!!}
                            {!! Form::text('mobile', $user_info->mobile,['required'=>'','class'=>'form-control', 'placeholder'=>__("mobile")]) !!}
                            @if ($errors->has('mobile'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('mobile') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-sm-6">
                        <div class="sm-form{{ $errors->has('password') ? ' has-error' : '' }}">
                            {!! Form::label('password',__("user.password"))!!}
                            {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>__("user.password")]) !!}
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                 </span>
                            @endif
                            <i>Please leave empty if you don't want to change password.</i>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="sm-form{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            {!! Form::label('password_confirmation',__("user.passwordConfirmation"))!!}
                            {!! Form::password('password_confirmation', ['class'=>'form-control', 'placeholder'=>__("user.passwordConfirmation")]) !!}
                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>
                   
                
                    <div class="col-sm-12">
                        {{-- @include("nptl-admin.common.common.title_n_slug", ['isEnabledSlug'=>true, 'table'=>'publishers', 'title'=>'Publisher Name']) --}}
                    </div>
                    {{-- <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            {!! Form::label('description','Publisher Description')!!}
                            {!! Form::textarea('description', null,['class'=>'form-control ckeditor']) !!}
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- end widget content -->
        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>
<!-- WIDGET END -->
<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-publisher-publish" data-widget-editbutton="false"
         data-widget-deletebutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-save"></i> </span>
            <h2>Publisher Publish</h2>

        </header>

        <!-- widget div-->
        <div>

            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->
                <input class="form-control" type="text">
            </div>
            <!-- end widget edit box -->

            <!-- widget content -->
            <div class="widget-body padding-10">
                <br>
                <?php
                $permission = SM::current_user_permission_array();
                if (SM::is_admin() || isset($permission) && isset($permission['publishers']['publisher_status_update']) && $permission['publishers']['publisher_status_update'] == 1)
                {
                ?>
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    {!! Form::label('status', 'Publication Status') !!}
                    <select class="form-control" name="status" required>
                        <option @if($user_info->status == 1)  selected @endif value="1">Publish</option>
                        <option  @if($user_info->status ==2)  selected @endif  value="2">Pending / Draft</option>
                        <option  @if($user_info->status == 3)  selected @endif  value="3">Cancel</option>
                    </select>
                    @if ($errors->has('status'))
                        <span class="help-block">
                             <strong>{{ $errors->first('status') }}</strong>
                          </span>
                    @endif
                </div>
                <?php
                }
                ?>
                <div class="form-group">
                    <button class="btn btn-success btn-block" type="submit">
                        <i class="fa fa-save"></i>
                        {{ $btn_name }} Publisher
                    </button>
                </div>

            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>
<!-- WIDGET END -->
<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-addCustomer-contact" data-widget-editbutton="false"
         data-widget-deletebutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-user"></i> </span>
            <h2>Customer Billing Info</h2>
        </header>
        <!-- widget div-->
        <div>
            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->
                <input class="form-control" type="text">
            </div>
            <!-- end widget edit box -->
            <!-- widget content -->
            <div class="widget-body padding-10">
                <div class="col-sm-6">
                    <div class="sm-form{{ $errors->has('street') ? ' has-error' : '' }}">
                        {!! Form::label('street',__("user.street"))!!}
                        {!! Form::text('street', $user_info->state,['class'=>'form-control', 'placeholder'=>__("user.street")]) !!}
                        @if ($errors->has('street'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('street') }}</strong>
                                 </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="sm-form{{ $errors->has('zip') ? ' has-error' : '' }}">
                        {!! Form::label('zip',__("user.zip"))!!}
                        {!! Form::number('zip',  $user_info->zip,['class'=>'form-control','maxlength'=>'5', 'placeholder'=>__("user.zip")]) !!}
                        @if ($errors->has('zip'))
                            <span class="help-block">
                                    <strong>{{ $errors->first('zip') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <?php
                    $cn = array();
                    $countries = SM::$countries;
                    $i = 1;
                    foreach ($countries as $country_name) {
                        //                                 if (in_array($i, array(17, 18, 19, 20)))
                        //                                 {
                        $cn[$country_name] = $country_name;
                        //                                 }
                        $i++;
                    }
                    ?>
                    <div class="form-group {{ $errors->has('country') ? ' has-error' : '' }}">
                        {!! Form::label('country', __("user.country")) !!}
                        <select name="country" id="country" class="form-control country p_complete" data-state="state"  data-onload="<?php echo isset($country) ? $country : "" ?>">
                            <option value="">Select Your Country</option>
                            <?php
                            $countries = SM::$countries;
                            $i = 1;
                            foreach ($countries as $country_name)
                            {
                            //                                 if (in_array($i, array(17, 18, 19, 20)))
                            //                                 {
                            ?>
                            <option @if($user_info->country == $country_name) selected @endif value="<?php echo $country_name; ?>"
                                    data-id="<?php echo $i; ?>"><?php echo $country_name; ?></option>
                            <?php
                            //                                 }
                            $i++;
                            }
                            ?>
                        </select>
                        @if ($errors->has('country'))
                            <span class="help-block">
                             <strong>{{ $errors->first('country') }}</strong>
                          </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="sm-form{{ $errors->has('city') ? ' has-error' : '' }}">
                        {!! Form::label('city',__("user.city"))!!}
                        {!! Form::text('city', $user_info->city,['class'=>'form-control', 'placeholder'=>__("user.city")]) !!}
                        @if ($errors->has('city'))
                            <span class="help-block">
                                <strong>{{ $errors->first('city') }}</strong>
                             </span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
                        {!! Form::label('state', __("user.state")) !!}
                        <select name="state" id="state" class="form-control state p_complete"   data-onload="<?php echo isset($state) ? $state : ""; ?>">
                            <option value="#">Select State / Province</option>
                        </select>
                        @if ($errors->has('state'))
                            <span class="help-block">
                             <strong>{{ $errors->first('state') }}</strong>
                          </span>
                        @endif
                    </div>

                    <?php
                  
                    $country =$user_info->country;
                    $state = $user_info->state;
                    ?>
                        <script>
                            $("#country").val('<?php echo $country; ?>');
                                <?php if($country != ''): ?>
                            var selectedCountryIndex = $("#country").find('option:selected').attr('data-id');
                            var state = $("#country").attr('data-state');
                            change_state(selectedCountryIndex, state);
                            <?php endif; ?>
                            $("#state").val('<?php echo $state; ?>');
                        </script>
                   


                </div>
                <div class="col-sm-12">
                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        {!! Form::label('extra_note',__("Description"))!!}
                        {!! Form::textarea('description', $publisher_info->description,['class'=>'form-control ckeditor']) !!}
                        @if ($errors->has('description'))
                            <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                     </span>
                        @endif
                    </div>
                </div>


            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>

<?php
if (old('image')) {
    $image = old('image');
} elseif (isset($publisher_info->image)) {
    $image = $publisher_info->image;
} else {
    $image = '';
}
?>
@include('nptl-admin/common/common/image_form',['header_name'=>'Publisher',
'image'=>$image])
@include('nptl-admin/common/common/meta_info',['header_name'=>'Publisher',
'width'=>'col-lg-12'])