@extends("nptl-admin/master")
@section('title','Front User')
@section("content")
    <?php
    $edit = SM::check_this_method_access('customers', 'edit') ? 1 : 0;
    $status_update = SM::check_this_method_access('customers', 'status_update') ? 1 : 0;
    $delete = SM::check_this_method_access('customers', 'destroy') ? 1 : 0;
    $per = $edit + $delete;
    ?>
    {{--    @include(('nptl-admin/common/media/media_pop_up'))--}}

    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="cat_list_wid">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                        <h2>Customer list </h2>
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
                        <div class="widget-body table-responsive">
                            <div class="row">
                                <form method="get" action="">

                                    <div class="col-md-2 form-group text-left">

                                        <button type="button" name="submit" value="submit" id="showOfferMailPopUp"
                                                class="btn btn-success margin-bottom-5 margin-top-22"><i
                                                    class="fa fa-envelope"></i> Send Mail
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- this is what the user will see -->
                            <div class="table-responsive">
                                <table id="example" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Image</th>
                                        <th>Full Name</th>
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <?php if ($status_update != 0): ?>
                                        <th class="text-center">Status</th>
                                        <?php endif; ?>
                                        <?php if ($per != 0): ?>
                                        <th class="text-center">Action</th>
                                        <?php endif; ?>
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
    <div class="modal fade" id="sm_mail_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                {!! Form::open(["method"=>"post", "route"=>"offerMail", "id"=>"mailForm"]) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span>
                    </button>
                    <h2 class="modal-title" id="myModalLabel">{{SM::sm_get_site_name()}} Mail Service</h2>
                </div>
                <div class="modal-body">
                    <h5>Mail to</h5>
                    <ul id="mailTo">
                    </ul>
                    <div class="form-group">
                        <label for="discount_title">Discount Title</label>
                        <input type="text" class="form-control" id="discount_title" name="discount_title"
                               value="30% OFF ALL SERVICES PACKAGES"/>
                    </div>
                    <div class="form-group">
                        <label for="available_title">Available Title</label>
                        <input type="text" class="form-control" id="available_title" name="available_title"
                               value="OFFER AVAILABLE ONLY 5 DAY"/>
                    </div>
                    <div class="form-group">
                        <label for="of_message">Mail Message</label>
                        <textarea class="form-control" rows="4" id="of_message" name="message">ALL {{SM::sm_get_site_name()}} SERVICES PACKAGES
UP TO 30% OFF</textarea>
                    </div>
                    <div class="form-group">
                        <label for="of_btn_title">Button Title</label>
                        <input type="text" class="form-control" id="of_btn_title" name="btn_title" value="Order Now"/>
                    </div>
                    <div class="form-group">
                        <label for="of_btn_link">Button Link</label>
                        <input type="text" class="form-control" id="of_btn_link" name="btn_link"
                               value="{{ url('/') }}"/>
                    </div>
                    <div class="row">
{{--                        @include('nptl-admin/common/common/image_form',['header_name'=>'Offer Title', 'image'=>'', 'grid'=>'col-xs-12 col-sm-12 col-md-12'])--}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true"><i class="fa fa-times"></i> Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary sendOfferMain" id="sendOfferMain"><i
                                class="fa fa-envelope-o"></i>
                        Send Mail
                    </button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@section('footer_script')
    <script type="text/javascript">
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('dataProcessingCustomer') }}",
                "dataType": "json",
                "type": "GET",
                "data": {"_token": "<?= csrf_token() ?>"}
            },
            "columns": [
                {"data": "select"},
                {"data": "image", "orderable": false},
                {"data": "name"},
                {"data": "username"},
                {"data": "email", "orderable": false},
                {"data": "date", "orderable": false},
                {"data": "status", "orderable": false},
                {"data": "action", "searchable": false, "orderable": false}
            ]
        });
    </script>
@endsection
@endsection
