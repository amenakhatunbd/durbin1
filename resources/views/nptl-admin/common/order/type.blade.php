@extends("nptl-admin/master")
@section("title","Order")
@section("content")
    <?php
    $edit_order = SM::check_this_method_access('orders', 'edit') ? 1 : 0;
    $order_status_update = SM::check_this_method_access('orders', 'order_status_update') ? 1 : 0;
    $delete_order = SM::check_this_method_access('orders', 'destroy') ? 1 : 0;
    $per = $edit_order + $delete_order;
    ?>
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
                                <table id="example1" class="table table-hover table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>ID</th>
                                        <th>Customer</th>
                                        <th>Amount</th>
                                        <th>Others Info</th>
                                        <th>Payment Method</th>
                                        <?php if ($order_status_update != 0): ?>
                                        <th class="text-center">Order Status</th>
                                        <th class="text-center">Payment Status</th>
                                        <?php endif; ?>
                                        <?php if ($per != 0): ?>
                                        <th class="text-center">Action</th>
                                        <?php endif; ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($orders)>0)
                                        @foreach($orders as $v_data)
                                            <?php
                                            $due = $v_data->paid - $v_data->grand_total;
                                            $dueSign = $due < 0 ? "-" : "+";
                                            $dueSign = $due == 0 ? "" : $dueSign;

                                            if ($v_data->order_status == 1) {
                                                $order_status = "Completed";
                                            } elseif ($v_data->order_status == 2) {
                                                $order_status = "Processing";
                                            } elseif ($v_data->order_status == 3) {
                                                $order_status = "Pending";
                                            } elseif ($v_data->order_status == 4) {
                                                $order_status = "Cancelled";
                                            }
                                            if ($v_data->payment_status == 1) {
                                                $payment_status = "Completed";
                                            } elseif ($v_data->payment_status == 2) {
                                                $payment_status = "Pending";
                                            } elseif ($v_data->payment_status == 3) {
                                                $payment_status = "Cancelled";
                                            }


                                            $p_details = '';
                                            if ($v_data->payment_method_id != 3) {
                                                if (!empty($v_data->payment_details)) {
                                                    $payment_details = json_decode($v_data->payment_details);
                                                    foreach ($payment_details as $key => $value) {
                                                        if ($key == 'card_number' || $key == 'card_type' || $key == 'pay_status' || $key == 'bank_txn') {
                                                            $key_field = str_replace("_", " ", $key);
                                                            $p_details = '<label style="font-weight: 700; color: #1d2d5d">' . ucfirst($key_field) . ': </label> <span>' . $value . '</span><br>';
                                                        }
                                                    }
                                                }
                                            }


                                            ?>
                                            <tr>
                                                <td>{{ SM::showDateTime($v_data->create_date) }}</td>
                                                <td>
                                                    <a href="{{ url(config('constant.smAdminSlug') . '/orders/' . $v_data->id) . '?isAdmin=1' }}"
                                                       target="_blank"><strong>{{ $v_data->invoice_no }}</strong></a>
                                                </td>
                                                <td><strong>Name</strong>: {{ $v_data->customer_name }}
                                                    <br><strong>Email</strong>: {{ $v_data->contact_email }}</td>
                                                <td>
                                                    <strong>Total</strong>: {{ SM::order_currency_price_value($v_data->id, $v_data->grand_total) }}
                                                    <br><strong>Paid</strong>: {{ SM::order_currency_price_value($v_data->id, $v_data->paid, 2) }}
                                                    <br><strong>Due</strong>: {{ SM::order_currency_price_value($v_data->id, $due) }}

                                                <td>
                                                    Shipping Method: {{ $v_data->shipping_method_name }}
                                                    <br>Delivery
                                                    Charge: {{ SM::order_currency_price_value($v_data->id, $v_data->shipping_method_charge, 2) }}

                                                    @if ($v_data->coupon_amount > 0)
                                                        <br>Coupon
                                                        Amount: {{ SM::order_currency_price_value($v_data->id, $v_data->coupon_amount, 2) }}
                                                    @endif
                                                    @if ($v_data->discount > 0)
                                                        <br>
                                                        Discount: {{ SM::order_currency_price_value($v_data->id, $v_data->discount, 2) }}
                                                    @endif
                                                    @if ($v_data->order_note != '')
                                                        <br>Note: {{ $v_data->order_note }}
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ isset($v_data->payment_method->title)? $v_data->payment_method->title: " " }}
                                                    <br>{{ $p_details }}
                                                </td>
                                                <td>
                                                    {{ $order_status }}
                                                </td>
                                                <td>
                                                    {{ $payment_status }}
                                                </td>
                                                <td>
                                                    @if ($per != 0)
                                                        <a href="javascript:void(0)" data-post_id="{{ $v_data->id  }}"
                                                           title="Send Mail"
                                                           class="btn btn-xs btn-success showOrderMailModal">
                                                            <i class="fa fa-envelope"></i>
                                                        </a>
                                                        <a target="_blank"
                                                           href="{{ url(config('constant.smAdminSlug') . '/orders') . '/' . $v_data->id }}?isAdmin=1"
                                                           title="View Invoice" class="btn btn-xs btn-default" id="">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <a href="{{ url(config('constant.smAdminSlug') . '/orders/download/' . $v_data->id) }}"
                                                           title="Download Invoice" class="btn btn-xs btn-default"
                                                           id=""> <i class="fa fa-download"></i>
                                                        </a>
                                                        @if ($delete_order != 0)
                                                            <a href="{{ url(config('constant.smAdminSlug') . '/orders/destroy') }}/{{ $v_data->id }}"
                                                               title="Delete"
                                                               class="btn btn-xs btn-default delete_data_row"
                                                               delete_message="Are you sure to delete this data?"
                                                               delete_row="tr_{{ $v_data->id }}">
                                                                <i class="fa fa-times"></i>
                                                            </a>
                                                        @endif
                                                    @else
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td class="text-center red padding-10" colspan="9">
                                                <strong>No data found!</strong>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
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

@endsection
<!-- Button trigger modal -->
<div class="modal fade" id="sm_order_status_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            {!! Form::open(["method"=>"post", "route"=>"order_info_update", "id"=>"order_status_form"]) !!}
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel">{{SM::sm_get_site_name()}} Order</h2>
            </div>
            <div class="modal-body">
                <div class="form-group" id="od_pay_div">
                    <input type="hidden" id="od_order_id" name="order_id">
                    <input type="hidden" id="od_row">
                    <input type="hidden" id="od_order_status" name="order_status">
                    <label for="od_pay">Pay Due</label>
                    <input type="number" class="form-control" step="any" id="od_pay" name="pay">
                    <span class="help-block">
                              <strong></strong>
                        </span>
                </div>
                <div class="form-group">
                    <label for="od_mail_message">Mail Message</label>
                    <textarea class="form-control" id="od_mail_message" name="message" rows="8" required></textarea>
                    <span class="help-block">
                              <strong></strong>
                        </span>
                </div>
                <div class="row hidden">
                    @include('nptl-admin/common/common/gallary_form',['header_name'=>'Mail Files', 'image'=>'', 'grid'=>'col-xs-12 col-sm-12 col-md-12'])
                </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="save_order_info"><i class="fa fa-save"></i>
                    Save Order Info and Send Mail
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<div class="modal fade" id="sm_mail_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            {!! Form::open(["method"=>"post", "route"=>"order_mail", "id"=>"order_mail_form"]) !!}
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel">{{SM::sm_get_site_name()}} Mail</h2>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="od_mail_message">Mail Message</label>
                    <input type="hidden" id="mail_order_id" name="order_id">
                    <textarea class="form-control" id="od_mail_message" name="message" rows="8" required></textarea>
                    <span class="help-block">
                              <strong></strong>
                        </span>
                </div>
                <div class="row">
                    @include('nptl-admin/common/common/gallary_form',[
                    'header_name'=>'Mail Files',
                    'image'=>'',
                    'input_holder'=>'order_image',
                    'img_holder'=>'order_mail',
                    'grid'=>'col-xs-12 col-sm-12 col-md-12'
                    ])
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="send_order_info"><i class="fa fa-save"></i>
                    Send Mail
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<div class="modal fade" id="sm_order_payment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            {!! Form::open(["method"=>"post", "route"=>"payment_info_update", "id"=>"payment_status_form"]) !!}
            <div class="modal-header">
                <h2 class="modal-title" id="myModalLabel">{{SM::sm_get_site_name()}} Order</h2>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" id="pm_order_id" name="order_id">
                    <input type="hidden" id="pm_row">
                    <input type="hidden" id="pm_payment_status" name="payment_status">
                    <label for="pm_pay">Pay Due</label>
                    <input type="number" class="form-control" step="any" id="pm_pay" name="pay" min="1">
                    <span class="help-block">
                              <strong></strong>
                        </span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="save_payment_info"><i class="fa fa-save"></i> Save
                    Order Info
                </button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@include(('nptl-admin/common/media/media_pop_up'))

@endsection