@extends("nptl-admin/master")
@section("title","students")
@section("content")

    <?php
    $edit = SM::check_this_method_access('students', 'edit') ? 1 : 0;

    $update = SM::check_this_method_access('students', 'update') ? 1 : 0;
    $destroy = SM::check_this_method_access('students', 'destroy') ? 1 : 0;
    $post = $edit + $destroy;
    
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
                        <h2>students list </h2>

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
                                        <th>Gmail</th>
                                        <th>Description</th>                                        
                                        <th class="text-center">Action</th>
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
                "url": "{{ route('studentajax') }}",
                "dataType": "json",
                "type": "GET",
                "data": {"_token": "<?= csrf_token() ?>"}
            },
            "columns": [
                {"data": "id"},
                {"data": "title"},
                {"data": "email"},
                {"data": "description", "orderable": false},
                {"data": "action", "searchable": false, "orderable": false}
                
            ]
        });
    </script>
@endsection
@endsection