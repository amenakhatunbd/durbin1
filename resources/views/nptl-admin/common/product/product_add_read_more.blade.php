@if(!isset($width))
    <?php $width = "col-md-8 col-lg-8"; ?>
@endif
<!-- NEW WIDGET START -->
<article class="col-xs-12 col-sm-12 {{$width}}">
    <!-- Widget ID (each widget will need unique ID)-->
    <div class="jarviswidget" style="" id="wid-id-add-prod-read-a-little" data-widget-editbutton="false"
         data-widget-deletebutton="false">

        <header>
            <span class="widget-icon"> <i class="fa fa-search"></i> </span>
            <h2>READ A LITTLE</h2>

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
                    <div class="col-md-12">
                        <table class="table table-bordered table-responsive table-hover" id="dynamic_field">
                            <thead>
                            <th>Front</th>
                            <th>Back</th>
                            <th>
                                <button type="button" class="btn btn-success addRowReadALittle"><i
                                            class="glyphicon glyphicon-plus"></i></button>
                            </th>
                            </thead>
                            <tbody id="productReadALittleAddMoreDataShow">
                            <?php
                            $front_input_holder = 'front_input_holder' . rand(500, 99999);
                            $back_input_holder = 'back_input_holder' . rand(500, 99999);
                            $front_input_name = 'read_a_little[front][]';
                            $back_input_name = 'read_a_little[back][]';
                            $front_img_holder = 'front_first_ph2' . rand(500, 99999);
                            $back_img_holder = 'back_first_ph2' . rand(500, 99999);
                            ?>
                            @if(isset($product_info->read_a_little))
                                @foreach($product_info->read_a_little->front as $key=>$front)
                                    <?php
                                    $back = isset($product_info->read_a_little->back[$key]) ? $product_info->read_a_little->back[$key] : "";
                                    ?>
                                    <tr>
                                        <td>
                                            @include("nptl-admin.common.common.small_image_form", array('header_name' => 'Product', 'image' => $front,  'input_name' => $front_input_name,  'input_holder' => $front_input_holder, 'img_holder' => $front_img_holder))
                                        </td>
                                        <td>
                                            @include("nptl-admin.common.common.small_image_form", array('header_name' => 'Product', 'image' => $back,  'input_name' => $back_input_name,  'input_holder' => $back_input_holder, 'img_holder' => $back_img_holder))
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger remove"><i
                                                        class="glyphicon glyphicon-remove"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>
                                        @include("nptl-admin.common.common.small_image_form", array('header_name' => 'Product', 'image' => '',  'input_name' => $front_input_name,  'input_holder' => $front_input_holder, 'img_holder' => $front_img_holder))
                                    </td>
                                    <td>
                                        @include("nptl-admin.common.common.small_image_form", array('header_name' => 'Product', 'image' => '',  'input_name' => $back_input_name,  'input_holder' => $back_input_holder, 'img_holder' => $back_img_holder))
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger remove"><i
                                                    class="glyphicon glyphicon-remove"></i></button>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <button type="button" class="btn btn-success addRowReadALittle"><i
                                                class="glyphicon glyphicon-plus"></i></button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
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