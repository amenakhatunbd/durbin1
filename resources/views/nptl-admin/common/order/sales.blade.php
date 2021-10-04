@extends("nptl-admin/master")
@section("title","Order")
@section("content")

    <section id="widget-grid" class="">

        <!-- row -->
        <div class="row">

            <!-- NEW WIDGET START -->
            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget" id="order_list_wid">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-shopping-cart"></i> </span>
                        <h2>Order list </h2>
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
                                        <th>Date</th>
                                        <th>Invoice No</th>
                                        <th>Product Name</th>
                                        <th>Attribute</th>
                                        <th>Image</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <?php if (SM::is_admin() == true): ?>
                                        <th>Vendor</th>
                                        <?php endif; ?>
                                        <th>Sub Total</th>
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
                "url": "{{ route('dataProcessingSale') }}",
                "dataType": "json",
                "type": "GET",
                "data": {"_token": "<?= csrf_token() ?>"}
            },
            "columns": [
                {"data": "create_date"},
                {"data": "invoice_no"},
                {"data": "product"},
                {"data": "attribute"},
                {"data": "image"},
                {"data": "qty"},
                {"data": "price"},
                {"data": "sub_total"},
                    <?php if (SM::is_admin() == true): ?>
                {
                    "data": "user"
                },
                <?php endif; ?>

            ]
        });
    </script>
@endsection
@endsection