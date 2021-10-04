@extends(('nptl-admin.master'))
@section('title','Slow Motion Details')
@section('content')
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>Slow Motion Details</h2>
                        {{--<a id="printButton" class="btn btn-warning pull-right"><i class="fa fa-print"></i> Print</a>--}}
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
                            <!-- start  -->

                                <div class="printableArea">
                                    @section('header_style')
                                        <link rel="stylesheet" type="text/css" media="print"
                                              href="{{asset('sm-admin/css/bootstrap.min.css')}}">
                                    @endsection
                                    <table id="load_data" class="table table-striped table-bordered display-all"
                                           cellspacing="0" width="100%">

                                    </table>
                                </div>
                            <!-- end -->
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
@endsection
@section('footer_script')
    <script type="text/javascript">
        $(document).ready(function () {
            $('body').on('click', '#slow_motion_pagination a', function (e) {
                e.preventDefault();
                var url = $(this).attr('href');
                search_on_nptl_search(url)
            });
            url = '{{ URL::route('slow_motion_data')}}';
            search_on_nptl_search(url);
        });
            function search_on_nptl_search(url) {
                var product_id = $("#product_id").val();
                $.ajax({
                    url: url,
                    type: 'get',
                    data: {product_id: product_id},
                    success: function (data) {
                        $('#load_data').empty().html(data);

                    },
                    error: function (errors) {
                        var errorRes = errors.responseJSON.errors;
                        $("#load_data").html('Write Something');
                    }
                });
            }



    </script>
@endsection