<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">

    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-add-category-main" data-widget-editbutton="false"
         data-widget-deletebutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-building"></i> </span>
            <h2>{{ $f_name }}gests</h2>

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
                <div class="col-sm-12">
                        @include("nptl-admin.common.common.title_n_slug", ['isEnabledSlug'=>true, 'table'=>'gests'])
                    </div>
                <div class="col-sm-12">
                        <div class="sm-form{{ $errors->has('email') ? ' has-error' : '' }}">
                            {!! Form::label('email',__("user.email"))!!}
                            {!! Form::text('email', null,['required'=>'','class'=>'form-control', 'placeholder'=>__("user.email")]) !!}
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                 </span>
                            @endif
                            <span class="displayNone red email_wr">
                                 <!-- <strong>Email already exist!</strong> -->
                            </span>
                        </div>
                </div>
               

                <div class="col-sm-12">
                        <div class="sm-form{{ $errors->has('phone') ? ' has-error' : '' }}">
                            {!! Form::label('phone','phone') !!}
                            {!! Form::text('phone', null,['required'=>'','class'=>'form-control', 'placeholder'=>'Write your phone here']) !!}
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>


                    <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            {!! Form::label('description','Description')!!}
                            {!! Form::textarea('description', null,['class'=>'form-control ckeditor']) !!}
                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>

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
    <div class="jarviswidget" id="wid-id-category-publish" data-widget-editbutton="false"
         data-widget-deletebutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-save"></i> </span>
            <h2> Publish </h2>

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
                <div class="form-group smart-form">
                    <label class="toggle">
                        {!! Form::checkbox('is_featured', null) !!}
                        <i data-swchon-text="Yes" data-swchoff-text="No"></i>Is featured?
                    </label>
                </div>
                <br>
                <div class="form-group smart-form">
                    <label class="toggle">
                        {!! Form::checkbox('is_home_page', null) !!}
                        <i data-swchon-text="Yes" data-swchoff-text="No"></i>Is Home Page?
                    </label>
                </div>
                <br>
                <div class="form-group smart-form">
                    <label class="toggle">
                        {!! Form::checkbox('is_home_menu', null) !!}
                        <i data-swchon-text="Yes" data-swchoff-text="No"></i>Is Home Menu?
                    </label>
                </div>
                <br>
                <?php
                $permission = SM::current_user_permission_array();
                if (SM::is_admin() || isset($permission) && isset($permission['students']['update']) && $permission['students']['update'] == 1)
                {
                ?>
                <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                    {!! Form::label('status', 'Publication Status') !!}
                    {!! Form::select('status',['1'=>'Publish','2'=>'Pending / Draft', '3'=>'Cancel'],null,['required'=>'','class'=>'form-control']) !!}
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
                        {{ $btn_name }} Student
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


<?php
if (old('image')) {
    $image = old('image');
} elseif (isset($category_info->image)) {
    $image = $category_info->image;
} else {
    $image = '';
}
if (old('fav_icon')) {
    $fav_icon = old('fav_icon');
} elseif (isset($category_info->fav_icon)) {
    $fav_icon = $category_info->fav_icon;
} else {
    $fav_icon = '';
}

if (old('image_gallery')) {
    $image_gallery = old('image_gallery');
} elseif (isset($category_info->image_gallery)) {
    $image_gallery = $category_info->image_gallery;
} else {
    $image_gallery = '';
}

?>
@include('nptl-admin/common/common/image_form',['header_name'=>'Category', 'image'=>$image])
@include('nptl-admin/common/common/image_form',['header_name'=>'Category fav icon', 'image'=>$fav_icon, 'input_holder'=>'fav_icon', 'img_holder'=>'second_ph'])
<?php

$input_holder = 'image_gallery';
$img_holder = 'gallery_first_ph';
?>
@include('nptl-admin.common.common.gallary_form',['header_name'=>'Category Gallery', 'image' => $image_gallery,'input_holder'=>$input_holder,'img_holder'=>$img_holder])
@include('nptl-admin/common/common/meta_info',['header_name'=>'Category',
'width'=>'col-lg-12'])
