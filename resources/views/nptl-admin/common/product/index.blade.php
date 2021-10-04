@extends('nptl-admin/master')
@section('title','Product Lists')
@section('content')
    <section id="widget-grid" class="">
    <?php
    $edit_product = SM::check_this_method_access('products', 'edit') ? 1 : 0;
    $product_status_update = SM::check_this_method_access('products', 'product_status_update') ? 1 : 0;
    $delete_product = SM::check_this_method_access('products', 'delete') ? 1 : 0;
    $per = $edit_product + $delete_product;

    $user_role = SM::current_user_role_name();
    $user_name = SM::current_user_username();
    $user_id = SM::current_user_id();


    ?>
    <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="product_list_wid">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                        <h2>Product list </h2>
                        <span class="pull-right">
                        Total Selected =
                        <strong>
                            <span class="media_count" id="media_count">0</span>
                        </strong>
                        <label for="master">
                            <input type="checkbox" class="select_all" id="master">All Select
                        </label>
                        <button style="margin: 5px;" class="btn btn-danger btn-xs delete_all" data-url="">Delete All
                        </button>
                        </span>
                    </header>

                    <!-- widget div-->
                    <div>

                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body table-responsive">
                            <!-- this is what the user will see -->
                            <div class="table-responsive">
                                <table id="example" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th width="5">
                                            <label for="master">
                                                <input type="checkbox" class="select_all" id="master">All
                                            </label></th>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Categories</th>
                                        <th>Author</th>
                                        <th>Image</th>
                                        <th>Reviews</th>
                                        <th>Price</th>
                                        <th class="text-center" style="width:15%!important" nowrap="">Status</th>
                                        <th nowrap style="10%" class="text-center">Action</th>
                                       
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <!-- end widget content -->

                    </div>
                    <!-- end widget div -->

                </div>
                <!-- end widget -->

            </article>
            <!-- WIDGET END -->

        </div>

        <!-- end row -->

    </section>
@section('footer_script')
    <script type="text/javascript">
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('dataProcessingProduct') }}",
                "dataType": "json",
                "type": "GET",
                "data": {"_token": "<?= csrf_token() ?>"}
            },
            "columns": [
                {"data": "checkbox", "searchable": false, "orderable": false},
                {"data": "id"},
                {"data": "title"},
                {"data": "categories", "orderable": false},
                
                {"data": "author", "orderable": false},
                {"data": "image", "orderable": false},
                {"data": "reviews", "orderable": false},
                {"data": "price", "orderable": false},
                {"data": "status", "orderable": false},
                {"data": "action", "searchable": false, "orderable": false}
            ]
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <script type="text/javascript">
        $('.media_count').text('(0)');
        var fnUpdateCount = function () {
            var generallen = $("#example input[name='multi_select_product[]']:checked").length;
            if (generallen > 0) {
                $(".media_count").text('(' + generallen + ')');
            } else {
                $('.media_count').text('(0)');
            }
        };
        $('body').on('click', '#example input:checkbox', function () {
            // $("#example input:checkbox").on("change", function () {
            fnUpdateCount();
        });

        $('.select_all').change(function () {
            var checkthis = $(this);
            var checkboxes = $("#example input:checkbox");

            if (checkthis.is(':checked')) {
                checkboxes.prop('checked', true);
            } else {
                checkboxes.prop('checked', false);
            }
            fnUpdateCount();
        });

        $(document).ready(function () {

            $('#master').on('click', function (e) {
                if ($(this).is(':checked', true)) {
                    $(".sub_chk").prop('checked', true);
                } else {
                    $(".sub_chk").prop('checked', false);
                }
            });
            $('.delete_all').on('click', function (e) {
                var allVals = [];
                $(".sub_chk:checked").each(function () {
                    allVals.push($(this).attr('data-id'));
                });
                if (allVals.length <= 0) {
                    alert("Please select row.");
                } else {
                    var check = confirm("Are you sure you want to delete this row?");
                    if (check == true) {
                        var join_selected_values = allVals.join(",");
                        $.ajax({
                            url: "{{ route('deleteMultipleProduct') }}",
                            // url: $(this).data('url'),
                            type: 'get',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            data: 'ids=' + join_selected_values,
                            success: function (data) {
                                if (data['success']) {
                                    $(".sub_chk:checked").each(function () {
                                        $(this).parents(".superbox-list").remove();
                                    });
                                    // alert(data['success']);
                                    location.reload()
                                } else if (data['error']) {
                                    alert(data['error']);
                                } else {
                                    alert('Whoops Something went wrong!!');
                                }
                            },
                            error: function (data) {
                                alert(data.responseText);
                            }
                        });

                        $.each(allVals, function (index, value) {
                            $('table tr').filter("[data-row-id='" + value + "']").remove();
                        });
                    }
                }
            });
            $('[data-toggle=confirmation]').confirmation({
                rootSelector: '[data-toggle=confirmation]',
                onConfirm: function (event, element) {
                    element.trigger('confirm');
                }
            });
            $(document).on('confirm', function (e) {
                var ele = e.target;
                e.preventDefault();
                $.ajax({
                    url: ele.href,
                    type: 'DELETE',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    success: function (data) {
                        if (data['success']) {
                            $("#" + data['tr']).slideUp("slow");
                            alert(data['success']);
                        } else if (data['error']) {
                            alert(data['error']);
                        } else {
                            alert('Whoops Something went wrong!!');
                        }
                    },
                    error: function (data) {
                        alert(data.responseText);
                    }
                });
                return false;
            });
        });
    </script>
@endsection
@endsection
