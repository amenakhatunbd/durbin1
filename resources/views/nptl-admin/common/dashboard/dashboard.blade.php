@extends(('nptl-admin/master'))
@section('title', 'Admin Dashboard')
@section('subtitle', '')
@section('content')
    <style>
        .huge {
            font-size: 35px;
        }

        .dashboard-title {
            font-size: 14px;
            font-weight: bold;
        }
    </style>
    <section id="widget-grid" class="">
        <!-- row -->
        <!-- WIDGET END -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-lg-12 col-xs-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-total_order_summary-info" data-widget-editbutton="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-shopping-bag"></i> </span>
                        <h2>Total Order Summary</h2>
                    </header>
                    <!-- widget content -->
                    <div class="widget-body">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{ SM::get_deshboard_order_summary_count()  }}</div>
                                            <div class="dashboard-title">Total Order</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url(config('constant.smAdminSlug').'/orders')}}">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-hourglass-1 fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{ SM::get_deshboard_order_summary_count(3)  }}</div>
                                            <div class="dashboard-title">Pending Order</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url(config('constant.smAdminSlug').'/order/pending')}}">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-spinner fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{ SM::get_deshboard_order_summary_count(2)  }}</div>
                                            <div class="dashboard-title">Processing  Order</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url(config('constant.smAdminSlug').'/order/procession')}}">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-check-square-o fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{ SM::get_deshboard_order_summary_count(1)  }}</div>
                                            <div class="dashboard-title">Completed Order</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url(config('constant.smAdminSlug').'/order/completed')}}">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>








<div class="col-lg-3 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-sitemap fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{ $total_category  }}</div>
                                            <div class="dashboard-title">Pending:&nbsp;<span class="label label-success"> {{$pending_category}}</span><br>Total Category</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url(SM::smAdminSlug('categories'))}}">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-product-hunt fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{ $total_product  }}</div>
                                            <div class="dashboard-title">Pending: &nbsp;<span class="label label-success">{{$pending_product}}</span><br>Total Product</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url(SM::smAdminSlug('products'))}}">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-pencil fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{ $total_author }}</div>
                                            <div class="dashboard-title">Pending:&nbsp;<span class="label label-success"> {{$pending_author}}</span><br>Total Author</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url(SM::smAdminSlug('authors'))}}">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class=" fa fa-address-card  fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{ $total_publisher }}</div>
                                            <div class="dashboard-title">Pending: &nbsp;<span class="label label-success">{{$pending_publisher}}</span><br>Total Publisher</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{url(SM::smAdminSlug('publishers'))}}">
                                    <div class="panel-footer">
                                        <span class="pull-left">View Details</span>
                                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>















                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget -->
            </article>
        </div>
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-sm-6">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-top5customer-info" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                        <h2>Top 5 Customer</h2>
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
                            <div class="panel with-nav-tabs panel-default">
                                <div class="panel-heading">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab1Customers" data-toggle="tab">Today's</a></li>
                                        <li><a href="#tab6Customers" data-toggle="tab">Week Till Date</a></li>
                                        <li><a href="#tab2Customers" data-toggle="tab">Month Till Date</a></li>
                                        <li><a href="#tab3Customers" data-toggle="tab">Last Month</a></li>
                                        <li><a href="#tab4Customers" data-toggle="tab">Year Till Date</a></li>
                                        <li><a href="#tab5Customers" data-toggle="tab">Total</a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab1Customers">
                                            <table class="table table-striped">
                                                <?php
                                                $top_customers_today = SM::top_5_customers_orders_report($todayDate, $todayDate);
                                                ?>
                                                @foreach($top_customers_today as $top_customer)
                                                    <?php
                                                    $top_customer_name = $top_customer->user->firstname . " " . $top_customer->user->lastname;
                                                    $top_customer_name_val = trim($top_customer_name != " ") ? $top_customer_name : $top_customer->user->username;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            {{ $top_customer_name_val }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_customer->totalGrandTotal) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab6Customers">
                                            <table class="table table-striped">
                                                <?php
                                                $top_customers_week_till_date = SM::top_5_customers_orders_report($startOfWeek, $todayDate);
                                                ?>
                                                @foreach($top_customers_week_till_date as $top_customer)
                                                    <?php
                                                    $top_customer_name = $top_customer->user->firstname . " " . $top_customer->user->lastname;
                                                    $top_customer_name_val = trim($top_customer_name != " ") ? $top_customer_name : $top_customer->user->username;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            {{ $top_customer_name_val }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_customer->totalGrandTotal) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="tab2Customers">
                                            <table class="table table-striped">
                                                <?php
                                                $top_customers_month_till_date = SM::top_5_customers_orders_report($startOfMonth, $todayDate);
                                                ?>
                                                @foreach($top_customers_month_till_date as $top_customer)
                                                    <?php
                                                    $top_customer_name = $top_customer->user->firstname . " " . $top_customer->user->lastname;
                                                    $top_customer_name_val = trim($top_customer_name != " ") ? $top_customer_name : $top_customer->user->username;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            {{ $top_customer_name_val }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_customer->totalGrandTotal) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="tab3Customers">
                                            <table class="table table-striped">
                                                <?php
                                                $top_customers_last_month = SM::top_5_customers_orders_report($firstDayofPreviousMonth, $lastDayofPreviousMonth);
                                                ?>
                                                @foreach($top_customers_last_month as $top_customer)
                                                    <?php
                                                    $top_customer_name = $top_customer->user->firstname . " " . $top_customer->user->lastname;
                                                    $top_customer_name_val = trim($top_customer_name != " ") ? $top_customer_name : $top_customer->user->username;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            {{ $top_customer_name_val }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_customer->totalGrandTotal) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab4Customers">
                                            <table class="table table-striped">
                                                <?php
                                                $top_customers_year_till_date = SM::top_5_customers_orders_report($startOfYear, $todayDate);
                                                ?>
                                                @foreach($top_customers_year_till_date as $top_customer)
                                                    <?php
                                                    $top_customer_name = $top_customer->user->firstname . " " . $top_customer->user->lastname;
                                                    $top_customer_name_val = trim($top_customer_name != " ") ? $top_customer_name : $top_customer->user->username;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            {{ $top_customer_name_val }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_customer->totalGrandTotal) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab5Customers">
                                            <table class="table table-striped">
                                                <?php
                                                $top_customers_total = SM::top_5_customers_orders_report($startOfDate, $todayDate);
                                                ?>
                                                @foreach($top_customers_total as $top_customer)
                                                    <?php
                                                    $top_customer_name = $top_customer->user->firstname . " " . $top_customer->user->lastname;
                                                    $top_customer_name_val = trim($top_customer_name != " ") ? $top_customer_name : $top_customer->user->username;
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            {{ $top_customer_name_val }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_customer->totalGrandTotal) }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
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
            <!-- NEW WIDGET START -->
            <article class="col-sm-6">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-top5product-info" data-widget-editbutton="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-lg fa-fw fa-product-hunt"></i> </span>
                        <h2>Top 5 Product</h2>
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
                            <div class="panel with-nav-tabs panel-default">
                                <div class="panel-heading">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab1Products" data-toggle="tab">Today's</a></li>
                                        <li><a href="#tab6Products" data-toggle="tab">Week Till Date</a></li>
                                        <li><a href="#tab2Products" data-toggle="tab">Month Till Date</a></li>
                                        <li><a href="#tab3Products" data-toggle="tab">Last Month</a></li>
                                        <li><a href="#tab4Products" data-toggle="tab">Year Till Date</a></li>
                                        <li><a href="#tab5Products" data-toggle="tab">Total</a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div class="tab-pane fade in active" id="tab1Products">
                                            <table class="table table-striped">
                                                <?php
                                                $top_products_today = SM::top_5_products_orders_report($todayDate, $todayDate);
                                                ?>
                                                @foreach($top_products_today as $top_product)
                                                @if(!empty($top_product->product))
                                                    <tr>
                                                        <td>
                                                            <a target="_blank"
                                                               href="{{  url(config('constant.smAdminSlug') . '/products/' . $top_product->product->id) . '/edit' }}">
                                                                <strong>{{ $top_product->product->title }}</strong>
                                                            </a>
                                                        </td>
                                                        <td class="">
                                                            {{ number_format($top_product->totalQty, 2) }} {{ $top_product->product->unit->title }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_product->subTotalSales) }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab6Products">
                                            <table class="table table-striped">
                                                <?php
                                                $top_products_week_till_date = SM::top_5_products_orders_report($startOfWeek, $todayDate);
                                                ?>
                                                @foreach($top_products_week_till_date as $top_product)
                                                @if(!empty($top_product->product))
                                                    <tr>
                                                        <td>
                                                            <a target="_blank"
                                                               href="{{  url(config('constant.smAdminSlug') . '/products/' . $top_product->product->id) . '/edit' }}">
                                                                <strong>{{ $top_product->product->title }}</strong>
                                                            </a>
                                                        </td>
                                                        <td class="">
                                                            {{ number_format($top_product->totalQty, 2) }} {{ $top_product->product->unit->title }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_product->subTotalSales) }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab2Products">
                                            <table class="table table-striped">
                                                <?php
                                                $top_products_month_till_date = SM::top_5_products_orders_report($startOfMonth, $todayDate);
                                                ?>
                                                @foreach($top_products_month_till_date as $top_product)
                                                @if(!empty($top_product->product))
                                                    <tr>
                                                        <td>
                                                            <a target="_blank"
                                                               href="{{  url(config('constant.smAdminSlug') . '/products/' . $top_product->product->id) . '/edit' }}">
                                                                <strong>{{ $top_product->product->title }}</strong>
                                                            </a>
                                                        </td>
                                                        <td class="">
                                                            {{ number_format($top_product->totalQty, 2) }} {{ $top_product->product->unit->title }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_product->subTotalSales) }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </table>

                                        </div>
                                        <div class="tab-pane fade" id="tab3Products">
                                            <table class="table table-striped">
                                                <?php
                                                $top_products_last_month = SM::top_5_products_orders_report($firstDayofPreviousMonth, $lastDayofPreviousMonth);
                                                ?>
                                                @foreach($top_products_last_month as $top_product)
                                                @if(!empty($top_product->product))
                                                    <tr>
                                                        <td>
                                                            <a target="_blank"
                                                               href="{{  url(config('constant.smAdminSlug') . '/products/' . $top_product->product->id) . '/edit' }}">
                                                                <strong>{{ $top_product->product->title }}</strong>
                                                            </a>
                                                        </td>
                                                        <td class="">
                                                            {{ number_format($top_product->totalQty, 2) }} {{ $top_product->product->unit->title }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_product->subTotalSales) }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab4Products">
                                            <table class="table table-striped">
                                                <?php
                                                $top_products_year_till_date = SM::top_5_products_orders_report($startOfYear, $todayDate);
                                                ?>
                                                @foreach($top_products_year_till_date as $top_product)
                                                @if(!empty($top_product->product))
                                                    <tr>
                                                        <td>
                                                            <a target="_blank"
                                                               href="{{  url(config('constant.smAdminSlug') . '/products/' . $top_product->product->id) . '/edit' }}">
                                                                <strong>{{ $top_product->product->title }}</strong>
                                                            </a>
                                                        </td>
                                                        <td class="">
                                                            {{ number_format($top_product->totalQty, 2) }} {{ $top_product->product->unit->title }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_product->subTotalSales) }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                        <div class="tab-pane fade" id="tab5Products">
                                            <table class="table table-striped">
                                                <?php
                                                $top_products_total = SM::top_5_products_orders_report($startOfDate, $todayDate);
                                                ?>
                                                @foreach($top_products_total as $top_product)
                                                @if(!empty($top_product->product))
                                                    <tr>
                                                        <td>
                                                            <a target="_blank"
                                                               href="{{  url(config('constant.smAdminSlug') . '/products/' . $top_product->product->id) . '/edit' }}">
                                                                <strong>{{ $top_product->product->title }}</strong>
                                                            </a>
                                                        </td>
                                                        <td class="">
                                                            {{ number_format($top_product->totalQty, 2) }} {{ $top_product->product->unit->title }}
                                                        </td>
                                                        <td class="text-right">
                                                            {{ SM::get_currency_value($top_product->subTotalSales) }}
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
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
            <!-- NEW WIDGET START -->
            <article class="col-sm-6">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-latest_5_orders-info" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-lg fa-fw fa-shopping-cart"></i> </span>
                        <h2>Latest 5 Orders</h2>
                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget content -->
                        <div class="widget-body">

                            <table class="table table-striped">
                                @foreach($latest_orders as $latest_order)
                                    <?php
                                    if ($latest_order->order_status == 1) {
                                        $order_status = "Completed";
                                    } elseif ($latest_order->order_status == 2) {
                                        $order_status = "Processing";
                                    } elseif ($latest_order->order_status == 3) {
                                        $order_status = "Pending";
                                    } elseif ($latest_order->order_status == 4) {
                                        $order_status = "Cancelled";
                                    }
                                    $customer_name = $latest_order->user->firstname . " " . $latest_order->user->lastname;
                                    $customer_name_val = trim($customer_name != " ") ? $customer_name : $latest_order->user->username;
                                    ?>
                                    <tr>
                                        <td>
                                            {{ SM::showDateTime($latest_order->create_date)}}
                                        </td>
                                        <td>
                                            <a target="_blank"
                                               href="{{  url(config('constant.smAdminSlug') . '/orders/' . $latest_order->id) . '?isAdmin=1' }}">
                                                <strong>{{ $latest_order->invoice_no }}</strong>
                                            </a>
                                        </td>
                                        <td>
                                            {{ $customer_name_val }}
                                        </td>
                                        <td> {{ $order_status }}</td>
                                        <td class="text-right">
                                            {{ SM::get_currency_value($latest_order->grand_total) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </article>
            <!-- WIDGET END -->
            <!-- NEW WIDGET START -->
            <article class="col-sm-6">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-stocks_alert-info" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-lg fa-fw fa-exclamation-triangle"></i> </span>
                        <h2> Product Stock Alert </h2>
                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget content -->
                        <div class="widget-body">

                            <table class="table table-striped">
                                @foreach($stocks_alert as $stock_alert)
                                    <tr>
                                        <td>
                                            <a target="_blank"
                                               href="{{  url(config('constant.smAdminSlug') . '/products/' . $stock_alert->id) . '/edit' }}">
                                                <strong>{{ $stock_alert->title }}</strong>
                                            </a>
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($stock_alert->product_qty, 2) }} {{ $stock_alert->unit->title }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </article>
            <!-- WIDGET END -->
            <!-- NEW WIDGET START -->
            <article class="col-sm-6">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-stocks_alert-info" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-lg fa-fw fa-shopping-basket"></i> </span>
                        <h2> Sales Summary Reports </h2>
                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget content -->
                        <div class="widget-body">
                            <table class="table table-striped">
                                <tr>
                                    <td>
                                        Today's Sales
                                    </td>
                                    <td class="text-right">
                                        {{ SM::order_summary_reports($todayDate, $todayDate) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Month Till Date
                                    </td>
                                    <td class="text-right">
                                        {{ SM::order_summary_reports($startOfMonth, $todayDate) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Last Month
                                    </td>
                                    <td class="text-right">
                                        {{ SM::order_summary_reports($firstDayofPreviousMonth, $lastDayofPreviousMonth) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Year Till Date
                                    </td>
                                    <td class="text-right">
                                        {{ SM::order_summary_reports($startOfYear, $todayDate) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Total Sales
                                    </td>
                                    <td class="text-right">
                                        {{ SM::order_summary_reports($startOfDate, $todayDate) }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </article>
            <!-- WIDGET END -->
            <!-- NEW WIDGET START -->
            <article class="col-sm-6">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-latest_5_subscribers-info" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-lg fa-fw fa-product-hunt"></i> </span>
                        <h2>Latest 5 Subscribers</h2>
                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget content -->
                        <div class="widget-body">
                            <table class="table table-striped">
                                @foreach($latest_5_subscribers as $subscriber)
                                    <tr>
                                        <td>
                                            <strong>{{ $subscriber->email }}</strong>
                                        </td>
                                        <td class="">
                                            {{$subscriber->ip }}
                                        </td>
                                        <td class="text-right">
                                            {{ SM::showDateTime($subscriber->created_at)}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </article>
            <!-- WIDGET END -->
            <!-- NEW WIDGET START -->
            <article class="col-sm-6">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-latest_5_customers-info" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-lg fa-fw fa-product-hunt"></i> </span>
                        <h2>Latest 5 Customers</h2>
                    </header>
                    <!-- widget div-->
                    <div>
                        <!-- widget content -->
                        <div class="widget-body">
                            <table class="table table-striped">
                                @foreach($latest_5_customers as $customer)
                                    <?php
                                    $flname = $customer->firstname . " " . $customer->lastname;
                                    $name = trim($flname != " ") ? $flname : $customer->username;
                                    ?>
                                    <tr>
                                        <td>
                                            <strong>{{ $name }}</strong>
                                        </td>
                                        <td class="">
                                            {{$customer->email }}
                                        </td>
                                        <td class="text-right">
                                            {{ SM::showDateTime($customer->created_at)}}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
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
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
            <article class="col-sm-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="wid-id-visitor" data-widget-editbutton="false">

                    <header>
                        <span class="widget-icon"> <i class="glyphicon glyphicon-stats txt-color-darken"></i> </span>
                        <h2>Daily Site Visitor</h2>

                        <ul class="nav nav-tabs pull-right in" id="myTab">
                            <li class="active">
                                <a data-toggle="tab" href="#s1"><i class="fa fa-clock-o"></i>
                                    <span class="hidden-mobile hidden-tablet">
                                        {{__("dashboard.visitorStats")}}
                                    </span>
                                </a>
                            </li>
                        </ul>

                    </header>

                    <!-- widget div-->
                    <div class="no-padding">
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                        </div>
                        <!-- end widget edit box -->

                        <div class="widget-body">
                            <!-- content -->
                            <div id="myTabContent" class="tab-content">
                                <div class="tab-pane fade active in padding-10 no-padding-bottom" id="s1">
                                    <div class="row no-space">
                                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                            <div id="updating-chart" class="chart-large txt-color-red"></div>

                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 show-stats">

                                            <div class="row">
                                                <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> <span class="text">
                                                        {{__("dashboard.todayVisitor")}} <span
                                                                class="pull-right"><?php
                                                            echo $today_visitor;
                                                            echo $today_visitor == 1 ? ' Person' : ' Persons';
                                                            ?> </span> </span>
                                                    <div class="progress">
                                                        <?php
                                                        if ($max_visitor > 0) {
                                                            $t_slider = ceil((100 * $today_visitor) / $max_visitor);
                                                        } else {
                                                            $t_slider = 0;
                                                        }

                                                        ?>
                                                        <div class="progress-bar bg-color-blueDark"
                                                             style="width: <?php echo "$t_slider"; ?>%;"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"> <span class="text">
                                                        {{__("dashboard.maxVisitor")}}
                                                        <span
                                                                class="pull-right"><?php
                                                            echo $max_visitor;
                                                            echo $max_visitor == 1 ? ' Person' : ' Persons';
                                                            ?></span> </span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-color-blue"
                                                             style="width: 100%;"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"><span class="text">
                                                {{__("dashboard.bugsSquashed")}}<span
                                                                class="pull-right">77%</span> </span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-color-blue"
                                                             style="width: 77%;"></div>
                                                    </div>
                                                </div>
                                                <div class="col-xs-6 col-sm-6 col-md-12 col-lg-12"><span class="text">
                                                {{__("dashboard.userTesting")}} <span
                                                                class="pull-right">7 Days</span> </span>
                                                    <div class="progress">
                                                        <div class="progress-bar bg-color-greenLight"
                                                             style="width: 84%;"></div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <!-- end s1 tab pane -->


                            </div>

                            <!-- end content -->
                        </div>

                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->

            </article>
            <!-- WIDGET END -->
        </div>
        <!-- end row -->

    </section>
    <!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
    <script src="{{asset('nptl-admin/js/plugin/flot/jquery.flot.cust.min.js')}}"></script>
    <script src="{{asset('nptl-admin/js/plugin/flot/jquery.flot.resize.min.js')}}"></script>
    <script src="{{asset('nptl-admin/js/plugin/flot/jquery.flot.tooltip.min.js')}}"></script>
    <?php
    $mv = round($max_visitor / 20) * 20;
    $mv = $mv < $max_visitor ? $mv + 20 : $mv;
    ?>
    <script type="text/javascript">
        $(document).ready(function () {
            var data = [], totalPoints = 200, $UpdatingChartColors = $("#updating-chart").css('color');
            // setup plot
            var options = {
                yaxis: {
                    min: 0,
                    max: <?php echo($mv); ?>
                },
                xaxis: {
                    min: 0,
                    max: 50
                },
                colors: [$UpdatingChartColors],
                series: {
                    lines: {
                        lineWidth: 1,
                        fill: true,
                        fillColor: {
                            colors: [{
                                opacity: 0
                            }, {
                                opacity: 0.4
                            }]
                        },
                        steps: false
                    }
                },
                grid: {hoverable: true}
            };
            var plot = $.plot($("#updating-chart"), [<?php echo json_encode($viewsReformatted); ?>], options);

            /*end updating chart*/

            function showTooltip(x, y, contents) {
                $('<div id="tooltip">' + contents + '</div>').css({
                    position: 'absolute',
                    display: 'none',
                    top: y - 35,
                    left: x - 10,
                    border: '1px solid #fdd',
                    padding: '2px',
                    'background-color': '#fee'
                }).appendTo("body").fadeIn(200);
            }

            var viewsInfo = <?php echo json_encode($viewsInfo); ?>;
            var previousPoint = null;
            $("#updating-chart").bind("plothover", function (event, pos, item) {
                if (item) {
                    if (previousPoint != item.dataIndex) {
                        previousPoint = item.dataIndex;
                        $("#tooltip").remove();
                        var x = item.datapoint[0].toFixed(0),
                            y = item.datapoint[1].toFixed(0);

                        showTooltip(item.pageX, item.pageY, viewsInfo[x]);
                    }
                } else {
                    $("#tooltip").remove();
                    previousPoint = null;
                }
            });
        });
    </script>
@endsection