@extends('nptl-admin/master')
@section('title','Admin Slider list')
@section('content')

    <?php
    $edit = SM::check_this_method_access('sliders', 'edit') ? 1 : 0;
    $status_update = SM::check_this_method_access('sliders', 'status_update') ? 1 : 0;
    $delete = SM::check_this_method_access('sliders', 'destroy') ? 1 : 0;
    $per = $edit + $delete;
    ?>
    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="slider_list_wid">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-comments"></i> </span>
                        <h2>{{__("common.slider")}}</h2>

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
                        <div class="widget-body">
                            <!-- this is what the user will see -->
                            <div class="table-responsive">
                                <table id="example" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Menu Title</th>
                                        <th>Page Title</th>
                                        <th>Image</th>
                                        {{--<th>Icon</th>--}}
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
                "url": "{{ route('dataProcessingSlider') }}",
                "dataType": "json",
                "type": "GET",
                "data": {"_token": "<?= csrf_token() ?>"}
            },
            "columns": [
                {"data": "id"},
                {"data": "title"},
                {"data": "image", "orderable": false},
                {"data": "background_image"},
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

