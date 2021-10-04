@extends("nptl-admin/master")
@section("title","Contacts")
@section("content")
    <?php
    $edit = SM::check_this_method_access('contacts', 'edit') ? 1 : 0;
    $status_update = SM::check_this_method_access('contacts', 'status_update') ? 1 : 0;
    $delete = SM::check_this_method_access('contacts', 'destroy') ? 1 : 0;
    $per = $edit + $delete;
    ?>
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="cat_list_wid">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                        <h2>Contact list </h2>
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
                            <!-- this is what the user will see -->
                            <div class="table-responsive">
                                <table id="example" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Subject</th>
                                        <th>Phone</th>
                                        <th>Message</th>
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
@section('footer_script')
    <script type="text/javascript">
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('dataProcessingContact') }}",
                "dataType": "json",
                "type": "GET",
                "data": {"_token": "<?= csrf_token() ?>"}
            },
            "columns": [
                {"data": "id"},
                {"data": "fullname"},
                {"data": "email"},
                {"data": "subject", "orderable": false},
                {"data": "phone", "orderable": false},
                {"data": "message", "orderable": false},
                     @if ($per != 0)
                {
                    "data": "action", "searchable": false, "orderable": false
                }
                @endif
            ]
        });
    </script>
@endsection
@endsection