@extends(('nptl-admin/master'))
@section('title', 'Publisher Dashboard')
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
                        <h2>Books Summary</h2>
                    </header>
                    <!-- widget content -->
                    <div class="widget-body">
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-list fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{ $all_product_publisher  }}</div>
                                            <div class="dashboard-title">Total Books</div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-hourglass-1 fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{ $all_publish_product_publisher  }}</div>
                                            <div class="dashboard-title">Published Books</div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-spinner fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right">
                                            <div class="huge">{{ $all_unpublish_product_publisher  }}</div>
                                            <div class="dashboard-title">Pending Books</div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        

                    </div>
                    <!-- end widget content -->
                </div>
                <!-- end widget -->
            </article>
        </div>


    </section>
    <!-- Flot Chart Plugin: Flot Engine, Flot Resizer, Flot Tooltip -->
    
    
@endsection