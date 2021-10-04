@extends('nptl-admin/master')
@section('title','Admin Blog')
@section('content')
    <section id="widget-grid" class="">
    <?php
    $edit = SM::check_this_method_access('blogs', 'edit') ? 1 : 0;
    $status_update = SM::check_this_method_access('blogs', 'status_update') ? 1 : 0;
    $delete = SM::check_this_method_access('blogs', 'delete') ? 1 : 0;
    $per = $edit + $delete;
    ?>
    <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="list_wid">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                        <h2>Blog list </h2>

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
                                        <th>Title</th>
                                        <th>Categories</th>
                                        <th>Image</th>
                                        {{--<th>Is Sticky?</th>--}}
                                        {{--<th>Author</th>--}}
                                        <th>Views</th>
                                        <th>Likes</th>
                                        <th>Comments</th>
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
@section('footer_script')
    <script type="text/javascript">
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('dataProcessingBlog') }}",
                "dataType": "json",
                "type": "GET",
                "data": {"_token": "<?= csrf_token() ?>"}
            },
            "columns": [
                {"data": "id"},
                {"data": "title"},
                {"data": "categories"},
                {"data": "image", "orderable": false},
                {"data": "views", "orderable": false},
                {"data": "likes", "orderable": false},
                {"data": "comments", "orderable": false},
                    @if ($status_update != 0)
                {
                    "data": "status", "orderable": false
                },
                    @endif
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
