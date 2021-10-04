@extends("nptl-admin/master")
@section("title","Posts")
@section("content")
    <?php
    $edit = SM::check_this_method_access('Posts', 'edit') ? 1 : 0;

    $update = SM::check_this_method_access('Posts', 'update') ? 1 : 0;
    $destroy = SM::check_this_method_access('Posts', 'destroy') ? 1 : 0;
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
                        <h2>Posts list </h2>

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
                                <table id="" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    <?php $i=0?>
                                    @foreach ($posts as $post)
                                        <tr>
                                            <td>{{$i+=1}}</td>
                                            <td>{{$post->title}}</td>
                                            <td>{{$post->description}}</td>
                                           <td> 
                                               <a href="{{ route('post_edit', $post->id) }}" class="btn btn-xs btn-primary">Edit</a>
                                               <a href="{{ route('post_delete', $post->id) }}" class="btn btn-xs btn-danger">Delete</a>

                                            </td>
                                        </tr>

                                    @endforeach
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
                "url": "{{ route('dataProcessingCategory') }}",
                "dataType": "json",
                "type": "GET",
                "data": {"_token": "<?= csrf_token() ?>"}
            },
            "columns": [
                {"data": "title"},
                {"data": "color_code", "orderable": false},
                {"data": "priority", "orderable": false},
                {"data": "image", "orderable": false},
                {"data": "fav_icon", "orderable": false},
                {"data": "total_products", "orderable": false},
                {"data": "status", "orderable": false},
                {"data": "action", "searchable": false, "orderable": false}
                
            ]
        });
    </script>
@endsection
@endsection