<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-add-product-main" data-widget-editbutton="false" data-widget-deletebutton="false">
        <header>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <span class="widget-icon"> <i class="fa fa-building"></i> </span>
            <h2>{{ $f_name }} Product</h2>
        </header>
        <!-- widget div-->
        <div>


{{-- test git is working or not --}}

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
                        @include("nptl-admin.common.common.title_n_slug", ['isEnabledSlug'=>true, 'table'=>'products'])

                        <div class="form-group {{ $errors->has('product_english_title') ? ' has-error' : '' }}">
                            {!! Form::label('English Title','English Title')!!}
                           {!! Form::text('product_english_title', null,['class'=>'form-control', 'placeholder'=>'English Title']) !!}

 @if ($errors->has('product_english_title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('product_english_title') }}</strong>
                                 </span>
                            @endif

                        </div>


                        
                        <div class="form-group {{ $errors->has('sku') ? ' has-error' : '' }}">
                            {{ Form::label('sku', 'SKU', array('class' => 'requiredStar')) }}
                            {!! Form::text('sku', null,['class'=>'form-control', 'placeholder'=>'SKU','readonly']) !!}
                            @if ($errors->has('sku'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sku') }}</strong>
                                 </span>
                            @endif
                             <!--<span class="help-block" style="color: red">-->
                             <!--       <strong id="skuid"> </strong>-->
                             <!--</span>-->
                        </div>
                        <div class="form-group">
                            {!! Form::label('stock_status','Stock status')!!}
                            {{ Form::select('stock_status', ['in_stock'=>'In stock', 'out_of_stock'=>'Out of stock', 'on_backorder'=>'On backorder'], null, array('class'=>'select2')) }}
                        </div>
                        <div class="form-group">
                            {!! Form::label('product_qty','Products Quantity')!!}
                            {!! Form::text('product_qty', null,['class'=>'form-control', 'placeholder'=>'Products Quantity']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('alert_quantity','Alert quantity')!!}
                            {!! Form::text('alert_quantity', null,['class'=>'form-control', 'placeholder'=>'Alert quantity']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('product_type','Variable Product')!!}
                            <!--{{ Form::select('product_type', ['1'=>'Simple product', '2'=>'Variable product'], null, array('class'=>'form-control product_type')) }}-->
                             {{ Form::select('product_type', ['1'=>'Simple product'], null, array('class'=>'form-control product_type')) }}
                            @if ($errors->has('product_type'))
                                <span class="help-block">
                                     <strong>{{ $errors->first('product_type') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                    <!--                        <div class="form-group">
                            {!! Form::label('is_special','Special')!!}
                    {{ Form::select('is_special', ['No'=>'No', 'Yes'=>'Yes'], null, array('class'=>'select2')) }}
                            </div>-->
                        <div class="form-group">
                            {!! Form::label('tax_class','Tax Class')!!}
                            {{ Form::select('tax_class', ['Sale Tax'=>'Sale Tax'], null, array('class'=>'select2', 'placeholder'=>'Please Select...')) }}
                        </div>
                        <div class="form-group{{ $errors->has('regular_price') ? ' has-error' : '' }}">
                            {{ Form::label('regular_price', 'Regular price', array('class' => 'requiredStar')) }}
                            {!! Form::number('regular_price', null,['class'=>'form-control', 'placeholder'=>'Regular price']) !!}
                            @if ($errors->has('regular_price'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('regular_price') }}</strong>
                                 </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {!! Form::label('sale_price','Sale price')!!}
                            {!! Form::number('sale_price', null,['class'=>'form-control', 'placeholder'=>'Sale price']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('product_weight','Products Weight')!!}
                            {!! Form::number('product_weight', null,['class'=>'form-control', 'placeholder'=>'Products Weight']) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('unit_id', 'Product Unit', array('class' => 'requiredStar')) }}
                            {!! Form::select('unit_id', $all_units, null, ['id'=>'unit_id', 'class' => ' form-control', 'required']); !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('product_model','Products Model')!!}
                            {!! Form::number('product_model', null,['class'=>'form-control', 'placeholder'=>'Products Model']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('product_video','Products Video')!!}
                            {!! Form::text('product_video', null,['class'=>'form-control', 'placeholder'=>'Products Video Embeded Link']) !!}
                        </div>

                    </div>
                    <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('short_description') ? ' has-error' : '' }}">
                            {!! Form::label('short_description','Product Short Description')!!}
                            {!! Form::textarea('short_description', null,['class'=>'form-control',
                            'rows'=>'2']) !!}
                            @if ($errors->has('short_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('short_description') }}</strong>
                                 </span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group{{ $errors->has('long_description') ? ' has-error' : '' }}">
                            {!! Form::label('long_description','Product Description')!!}
                            {!! Form::textarea('long_description', null,['class'=>'form-control ckeditor']) !!}
                            @if ($errors->has('long_description'))
                                <span class="help-block">
                        <strong>{{ $errors->first('long_description') }}</strong>
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
    <div class="jarviswidget" id="wid-id-product-publish" data-widget-editbutton="false"
         data-widget-deletebutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-save"></i> </span>
            <h2>Product Publish</h2>
        </header>
        <!-- widget div-->
        <div>


            <!-- widget edit box -->
            <div class="jarviswidget-editbox">
                <!-- This area used as dropdown edit box -->
                <input class="form-control" type="text">
            </div>
            <?php
                $permission = SM::current_user_permission_array();
                if (SM::is_admin() || isset($permission) && isset($permission['products']['product_status_update']) && $permission['products']['product_status_update'] == 1)
                {
                ?>
                <div class="form-group smart-form">
                    <label class="toggle">
                        {!! Form::checkbox('is_featured', null) !!}
                        <i data-swchon-text="Yes" data-swchoff-text="No"></i>Is featured?
                    </label>
                </div>
            <?php } ?>
            <!-- end widget edit box -->
            <!-- widget content -->
            <div class="widget-body padding-10">
                <?php
                $permission = SM::current_user_permission_array();
                if (SM::is_admin() || isset($permission) && isset($permission['products']['product_status_update']) && $permission['products']['product_status_update'] == 1)
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
                        {{ $btn_name }} Product
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
<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-add-product-book-specification" data-widget-editbutton="false"
         data-widget-deletebutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-tags"></i> </span>
            <h2>Book Specification</h2>
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


            
                <div class="sm-form form-group {{ $errors->has('type_id') ? ' has-error' : '' }}">
                    {{ Form::label('type_id', 'Product Type', array('class' => 'requiredStar')) }}
                     <select class="select2 productType" name="type_id">
                            <option @if($product_info->type_id == 1) selected @endif value="1">Books</option>
                            <option  @if($product_info->type_id == 2) selected @endif value="2">Others</option>
                     </select>
                    @if ($errors->has('author_id'))
                        <span class="help-block dark-red">
                          <strong>{{ $errors->first('author_id') }}</strong>
                       </span>
                    @endif
                </div>


                <div class="bookinfo" >
                <div class="sm-form form-group {{ $errors->has('author_id') ? ' has-error' : '' }}">
                    {{ Form::label('author_id', 'Author', array('class' => 'requiredStar')) }}
                    <?php
                    if(!empty($selected_authors))
                    {  ?>
                        
                       <select class="select2" name="author_id[]"  multiple >
                                    <?php
                                   
                                    

                                  
                                    foreach ($author_lists as $key => $parent_value) {
                                        if (in_array($key, $selected_authors)) {
                                                $selected='selected';
                                            } else {
                                                $selected='';
                                            }
                                        ?>

                                        <option value="<?= $key ?>" <?php echo $selected?>> <?= $parent_value ?></option>
                                        
                    <?php }  ?>
                    </select>
                        
                   <?php  } ?>
                    
                    @if ($errors->has('author_id'))
                        <span class="help-block dark-red">
                          <strong>{{ $errors->first('author_id') }}</strong>
                       </span>
                    @endif
                </div>


                <div class="sm-form form-group {{ $errors->has('translator_id') ? ' has-error' : '' }}">
                    {{ Form::label('translator_id', 'Translator', array('class' => '')) }}
                    <?php
                    if(!empty($selected_translator))
                    {  ?>
                        
                       <select class="select2" name="translator_id[]"  multiple >
                                    <?php
                                    foreach ($author_lists as $key => $parent_value) {
                                        if (in_array($key, $selected_translator)) {
                                                $selected='selected';
                                            } else {
                                                $selected='';
                                            }
                                        ?>
                                        <option value="<?= $key ?>" <?php echo $selected?>> <?= $parent_value ?></option>
                                        
                    <?php }  ?>
                    </select>
                        
                   <?php  } ?>
                    
                    @if ($errors->has('translator_id'))
                        <span class="help-block dark-red">
                          <strong>{{ $errors->first('translator_id') }}</strong>
                       </span>
                    @endif
                </div>
                <div class="sm-form form-group {{ $errors->has('publisher_id') ? ' has-error' : '' }}">
                    {{ Form::label('publisher_id', 'Publisher', array('class' => 'requiredStar')) }}
                    {!! Form::select('publisher_id', $publisher_lists, null, ['class'=>'select2', 'placeholder'=>'Please select...']) !!}
                    @if ($errors->has('publisher_id'))
                        <span class="help-block dark-red">
                          <strong>{{ $errors->first('publisher_id') }}</strong>
                       </span>
                    @endif
                </div>
                <div class="sm-form form-group">
                    {{ Form::label('editor', 'Editor', array('class' => '')) }}
                    {!! Form::text('editor', null, ['class'=>'form-control', 'placeholder'=>'Editor']) !!}
                </div>
                <div class="sm-form form-group">
                    {{ Form::label('isbn', 'ISBN', array('class' => '')) }}
                    {!! Form::text('isbn', null, ['class'=>'form-control', 'placeholder'=>'ISBN']) !!}
                </div>
                <!--<div class="form-group">-->
                <!--    {!! Form::label('edition_date','Edition Date')!!}-->
                <!--    {!! Form::text('edition_date', null,['class'=>'form-control datepicker', 'autocomplete'=>'off', 'placeholder'=>'Expiry Date']) !!}-->
                <!--</div>-->
                 <div class="form-group">
                    {!! Form::label('edition_date','Edition Year')!!}
                    {!! Form::text('edition_date', null,['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>'Edition Year']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('number_of_pages','Number of Pages')!!}
                    {!! Form::text('number_of_pages', null,['class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>'Number of Pages']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('country_id','Country')!!}
                    {!! Form::select('country_id', $country_lists, null, ['placeholder'=>'Bangladesh','class'=>'select2']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('language','Language')!!}
                    {!! Form::select('language', ['বাংলা'=>'বাংলা', 'English'=>'English','Arabic '=>'Arabic '], null, ['autocomplete'=>'off', 'class'=>'form-control']) !!}

                    <!--{!! Form::select('language', ['বাংলা'=>'বাংলা', 'English'=>'English'], null, ['autocomplete'=>'off', 'class'=>'form-control']) !!}-->
                </div>
                </div>
            </div>
            <!-- end widget content -->

        </div>
        <!-- end widget div -->

    </div>
    <!-- end widget -->

</article>
<article class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" id="wid-id-add-product-category" data-widget-editbutton="false"
         data-widget-deletebutton="false">
        <header>
            <span class="widget-icon"> <i class="fa fa-tags"></i> </span>
            <h2>Product Categories & Tags</h2>
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
                <div class="sm-form form-group {{ $errors->has('parent_id') ? ' has-error' : '' }}">
                    {{ Form::label('categories', 'Product Categories', array('class' => 'requiredStar')) }}
                    <?php
                    if (isset($all_categories) && count($all_categories) > 0) {
                        foreach ($all_categories as $category) {
                            $cat_select_array[$category->id] = $category->title;
                            $return_val = SM::category_tree_for_select_option($category->id, 0);
                            $cat_select_array = SM::sm_multi_array_to_sangle_array($cat_select_array, $return_val);
                        }
                    } else {
                        $cat_select_array[0] = 'Select Category';
                    }
                    ?>

                    {!! Form::select('categories[]', $cat_select_array, null, ['class'=>'select2', 'required', 'multiple'=>'']) !!}
                    @if ($errors->has('categories'))
                        <span class="help-block dark-red">
                          <strong>{{ $errors->first('categories') }}</strong>
                       </span>
                    @endif
                </div>
                <div class="form-group">
                    {!! Form::label('tags','Product tags')!!}
                    {!! Form::text('tags', null,['placeholder'=>'Type and enter your tag','class'=>'form-control', 'data-role'=>'tagsinput']) !!}
                </div>
                {{--<div class="sm-form form-group {{ $errors->has('attributes123') ? ' has-error' : '' }}">--}}
                {{--{{ Form::label('attributes123', 'Product Attributes', array('class' => 'requiredStar')) }}--}}
                {{--{!! Form::select('attributes123[]', $all_attributes, null, ['class'=>'select2', 'required', 'multiple'=>'']) !!}--}}
                {{--@if ($errors->has('attributes123'))--}}
                {{--<span class="help-block dark-red">--}}
                {{--<strong>{{ $errors->first('attributes123') }}</strong>--}}
                {{--</span>--}}
                {{--@endif--}}
                {{--</div>--}}
                <div class="hidden sm-form form-group {{ $errors->has('brand_id') ? ' has-error' : '' }}">
                    {{ Form::label('brand_id', 'Product Brand', array('class' => 'requiredStar')) }}
                    {!! Form::select('brand_id', $all_brands, null, ['class'=>'select2']) !!}
                    @if ($errors->has('brand_id'))
                        <span class="help-block dark-red">
                          <strong>{{ $errors->first('brand_id') }}</strong>
                       </span>
                    @endif
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
} elseif (isset($product_info->image)) {
    $image = $product_info->image;
} else {
    $image = '';
}
if (old('image_gallery')) {
    $image_gallery = old('image_gallery');
} elseif (isset($product_info->image_gallery)) {
    $image_gallery = $product_info->image_gallery;
} else {
    $image_gallery = '';
}
if (isset($product_info->product_type)) {
    $product_type = $product_info->product_type;
} else {
    $product_type = '';

}

?>
@include('nptl-admin.common.common.image_form',['header_name'=>'Product', 'image' => $image, 'flag' => 1])
<?php
$input_holder = 'image_gallery';
$img_holder = 'gallery_first_ph';?>
{{--@include('nptl-admin.common.common.gallary_form',['header_name'=>'Product', 'image' => $image_gallery,'input_holder'=>$input_holder,'img_holder'=>$img_holder])--}}

@include('nptl-admin.common.product.product_add_read_more', ['header_name'=>'Product', 'width'=>'col-lg-8'])
{{--@include('nptl-admin.common.product.product_attribute', ['header_name'=>'Product', 'width'=>'col-lg-8','product_type'=>$product_type])--}}
@include('nptl-admin.common.common.meta_info', ['header_name'=>'Product', 'width'=>'col-lg-8'])

<!-- <div id="viewUnitModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-lebel="Colse">
                    <span aria-hidden="true"> &times;</span>
                </button>
                <h3 class="modal-title">Add Unit</h3>
            </div>
            <div class="modal-body">
                <form class="modal-body form" data-toggle="validator">
                    <div class="form-group">
                        {{ Form::label('title', 'Name', array('class' => 'requiredStar')) }}
{!! Form::text('title', null, ['class' => 'form-control title', 'required', 'placeholder' =>'Name']); !!}
        <input type="text" name="title" class="form-control title">
    </div>
    <div class="form-group">
{{ Form::label('actual_name', 'Actual Name', array('class' => 'requiredStar')) }}
        <input type="text" name="actual_name" class="form-control actual_name">
    </div>

</form>
</div>
<div class="modal-footer">
{!! Form::submit('Save', ['class' => 'btn btn-success', 'id' => 'unit_submit'])!!}
        <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Cancel</button>
    </div>
</div>
</div>
</div>
<script>
$(document).ready(function () {
$("#clickUnitBtn").click(function () {
    $("#viewUnitModal ").modal();
});
});
// hospital_submit
$("#unit_submit").click(function () {
var title = $(".title").val();
var actual_name = $(".actual_name").val();
$.ajax({
    type: 'POST',
    url: '{{ URL::route('unit_store')}}',
            data: {
                'title': title,
                'actual_name': actual_name,
                '_token': '{{ csrf_token() }}'
            },
            success: function (e) {
                $('#viewUnitModal').modal('hide');
                $("#unit_id").html(e);
                $('.modal-body form')[0].reset();
                swal({
                    title: 'Success',
                    text: 'Your request has been Success',
                    type: 'success',
                    timer: '1500'
                })
            }
        });
    });
</script>-->
<script type="text/javascript">
    $(document).ready(function () {
        $('.product_type').on('change', function () {
            var product_type = $(this).val();
            if (product_type == 2) {
                $("#wid-id-add-prod-attributes").removeClass("hidden");
            } else {
                $("#wid-id-add-prod-attributes").addClass("hidden");
            }

        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function () {
        
 var typeid = '<?php echo $product_info->type_id?>';

        if (typeid ==1 ) {
                $(".bookinfo").show();
            } else {
                $(".bookinfo").hide();
            }



        $('.productType').on('change', function () {
            var product_type = $(this).val();
            if (product_type == 1) {
                $(".bookinfo").show();
            } else {
                $(".bookinfo").hide();
            }

        });

    });
</script>




<script type="text/javascript">

    // $('body').on('.sm_media_modal_show').on('click', function(){
    //     //do some code here i.e
    //     alert("ok");
    // });
    // $('body').on('click', '.sm_media_modal_show', function () {
    //     $("#sm_media_modal").modal();
    //
    // });
    // $('body').delegate('.sm_media_modal_show', 'change', function () {
    // $(document).ready(function(){
    //     $(".sm_media_modal_show").click(function(){
    //         $("#sm_media_modal").modal();
    //     });
    // });
    
//     $(document).ready(function(){
//     $(".sku").blur(function(){
//         var skuValue = $(".sku").val();
//       $.ajax({
//             type: 'GET',
//             url: '{!!URL::route('searchSku')!!}',
//             dataType: 'json',
//             // data: dataId,
//             data: {sku: skuValue},
//             success: function (data) {
//             if(data.status==null){

//             }
//             else{
//               var skualert='sku already exists' ;
//               $('#skuid').html(skualert);
//               $('.sku').val('');
//              }
//             }
//         });
// });
// });
    
    
    $('.addRow').on('click', function () {
        var transactioncategory_id = 1;
        $.ajax({
            type: 'GET',
            url: '{!!URL::route('productAttributeAddMore')!!}',
            dataType: 'json',
            // data: dataId,
            data: {transactioncategory_id: transactioncategory_id},
            success: function (data) {
                // alert('fasfd');
                $('#customersDataShow').append(data);
                $('select').select2();
            }

        });
        // addRow();
        // $('select').select2();
    });
    $('.addRowReadALittle').on('click', function () {
        var transactioncategory_id = 1;
        $.ajax({
            type: 'GET',
            url: '{!!URL::route('productReadALittleAddMore')!!}',
            dataType: 'json',
            // data: dataId,
            data: {transactioncategory_id: transactioncategory_id},
            success: function (data) {
                // alert('fasfd');
                $('#productReadALittleAddMoreDataShow').append(data);
                $('select').select2();
            }

        });
        // addRow();
        // $('select').select2();
    });

    //==============End Format Number============
    $('body').on('click', '.remove', function () {
        var l = $('#customersDataShow tr').length;
        if (l == 1) {
            alert('You can not Remove last one');
        } else {
            $(this).parent().parent().remove();
        }
    });

</script>
