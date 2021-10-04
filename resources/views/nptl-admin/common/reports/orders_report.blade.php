@extends(('nptl-admin.master'))
@section('title','Orders Reports')
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
                        <h2>Orders Reports</h2>
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
                            <form class="form-horizontal">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="sm-form">
                                            {{ Form::label('user_id', 'Customer') }}
                                            <select class="select2" name="user_id" id="user_id">
                                                <option value="">All Select</option>
                                                @foreach($user_lists as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="sm-form">
                                            {{ Form::label('order_status', 'Order Status') }}
                                            {{ Form::select('order_status', ['1'=>'Completed','2'=>'Progress','3'=>'Pending','4'=>'Canceled'], null, array('class'=>'select2', 'id'=>'order_status', 'placeholder'=>'All Select')) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="sm-form">
                                            {{ Form::label('payment_status', 'Payment Status') }}
                                            {{ Form::select('payment_status', ['1'=>'Completed','2'=>'Pending','3'=>'Canceled'], null, array('class'=>'select2', 'id'=>'payment_status', 'placeholder'=>'All Select')) }}
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="sm-form">
                                            {{ Form::label('from_date', 'From Date') }}
                                            {{ Form::text('from_date', null, array('class'=>'form-control clickDate',  'autocomplete'=>'off', 'id'=>'from_date', 'placeholder'=>'From Date')) }}
                                        </div>

                                    </div>
                                    <div class="col-sm-2">
                                        <div class="sm-form">
                                            {{ Form::label('to_date', 'To / Till Date') }}
                                            {{ Form::text('to_date', null, array('class'=>'form-control clickDate',  'autocomplete'=>'off', 'id'=>'to_date', 'placeholder'=>'To / Till Date')) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="printableArea">
                                    @section('header_style')
                                        <link rel="stylesheet" type="text/css" media="print"
                                              href="{{asset('sm-admin/css/bootstrap.min.css')}}">
                                    @endsection
                                    <table id="load_data" class="table table-striped table-bordered display-all"
                                           cellspacing="0" width="100%">

                                    </table>
                                </div>
                            </form>
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
            $('#user_id').on('change', function () {
                listStudent($('#user_id').val(), $('#order_status').val(), $('#payment_status').val(), $('#from_date').val(), $('#to_date').val());
            });
            $('#order_status').on('change', function () {
                listStudent($('#user_id').val(), $('#order_status').val(), $('#payment_status').val(), $('#from_date').val(), $('#to_date').val());
            });
            $('#payment_status').on('change', function () {
                listStudent($('#user_id').val(), $('#order_status').val(), $('#payment_status').val(), $('#from_date').val(), $('#to_date').val());
            });
            $('#from_date').on('change', function () {
                listStudent($('#user_id').val(), $('#order_status').val(), $('#payment_status').val(), $('#from_date').val(), $('#to_date').val());
            });
            $('#to_date').on('change', function () {
                listStudent($('#user_id').val(), $('#order_status').val(), $('#payment_status').val(), $('#from_date').val(), $('#to_date').val());
            });

            function listStudent(criterial1, criterial2, criterial3, criterial4, criterial5) {
                $.ajax({
                    type: 'get',
                    url: '{{ URL::route('order_reports_data')}}',
                    data: {
                        user_id: criterial1,
                        order_status: criterial2,
                        payment_status: criterial3,
                        from_date: criterial4,
                        to_date: criterial5,
                    },
                    success: function (data) {
                        $('#load_data').empty().html(data);
                    }
                })
            }
        });
    </script>
@endsection