<?php

namespace App\Http\Controllers\Admin\Common;

use App\Model\Common\Brand;
use App\Model\Common\Order;
use App\Model\Common\Order_detail;
use App\Model\Common\Package;
use App\Model\Common\Product;
use App\Model\Common\Unit;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\SM\SM;
use Maatwebsite\Excel\Facades\Excel;

class Reports extends Controller
{
    public function orders(Request $request)
    {
        $order_id = $request->input('order_id', '');
        $sdate = $request->input('sdate');
        $edate = $request->input('edate');
        $package = $request->input('package', '');
        $pid = $request->input('pid', '');
        $order_status = $request->input('order_status', '');
        $payment_status = $request->input('payment_status', '');

        $customer = $request->input('customer', '');
        $cid = $request->input('customer', '');

//        $query = DB::table('orders')
//            ->select(
//                'orders.*',
//                DB::raw("CONCAT(users.firstname,' ', users.lastname) as fullname"),
//                'users.username'
//            )
//            ->join('users', 'orders.user_id', '=', 'users.id')
////            ->join('products', 'orders.product_id', '=', 'products.id')
        $all_order = Order::latest()
            ->when($order_id, function ($query) use ($order_id) {
                if ($order_id != "") {
                    if (preg_match('/-/', $order_id)) {
                        $order_id = SM::getOriginalOrderId($order_id);
                    }
                    return $query->where('id', '=', $order_id);
                }
            })
            ->when($sdate, function ($query) use ($sdate) {
                if ($sdate != "") {
                    return $query->whereDate('created_at', '=', $sdate);
                }
            })
            ->when($edate, function ($query) use ($edate) {
                if ($edate != "") {
                    return $query->whereDate('created_at', '=', $edate);
                }
            })
            ->when($payment_status, function ($query) use ($payment_status) {
                if ($payment_status != "") {
                    return $query->where('payment_status', '=', $payment_status);
                }
            })
            ->when($order_status, function ($query) use ($order_status) {
                if ($order_status != "") {
                    return $query->where('order_status', '=', $order_status);
                }
            })
            ->when($cid, function ($query) use ($cid) {
                if ($cid != "") {
                    return $query->where('customer_name', '=', $cid);
                }
            })
            ->get();


//        if ($order_id != '') {
//            $orderId = $data['order_id'];
//            if (preg_match('/-/', $orderId)) {
//                $orderId = SM::getOriginalOrderId($orderId);
//            }
//            $query->where('id', '=', $orderId);
//        }
//        if ($data['sdate'] != '') {
//            $query->whereDate('created_at', '<=', $data['edate']);
//        }
//        if ($data['edate'] != '') {
//            $query->whereDate('created_at', '>=', $data['sdate']);
//        }
////        if ($data['pid'] != '') {
////            $query->where('product_id', '=', $data['pid']);
////        } else {
////            $data['package'] = '';
////        }
//        if ($data['payment_status'] != '') {
//            $query->where('payment_status', '=', $data['payment_status']);
//        }
//        if ($data['order_status'] != '') {
//            $query->where('order_status', '=', $data['order_status']);
//        }
//        if ($data['cid'] != '') {
//            $query->where('user_id', '=', $data['cid']);
//        } else {
//            $data['customer'] = '';
//        }
//        $data['all_order'] = $query;

//        $data['all_order'] = Order::all();
        if ($request->has('excel') && $request->excel == 'excel') {
            $orders = $all_order->toArray();
            if (count($orders) > 0) {
                Excel::create('doodle_digital_orders_' . date('YmdHis'), function ($excel) use ($orders) {

                    $excel->sheet('Order Report ' . date('Y-m-d'), function ($sheet) use ($orders) {
                        $loop = 1;
                        $sheet->mergeCells("A$loop:I$loop");
                        $sheet->cells("A$loop:I$loop", function ($cells) {
                            $cells->setBackground('#1d2d5d');
                            $cells->setFontColor('#ffffff');
                            $cells->setFontSize(18);
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                            // Set all borders (top, right, bottom, left)
                            $cells->setBorder('none', 'none', 'solid', 'none');

// Set borders with array
                            $cells->setBorder(array(
                                'bottom' => array(
                                    'style' => 'solid'
                                ),
                            ));
                        });
                        $single = [];
                        $single[] = 'Doodle Digital Order Report Excel';
                        $sheet->row($loop, $single);
                        $sheet->getRowDimension($loop)->setRowHeight(40);
                        $loop++;
                        $dueArray = [];
                        $netTotalArray = [];
                        $paidArray = [];

                        $single = [];
                        $single[] = 'Order ID';
                        $single[] = 'Created Date';
                        $single[] = 'Customer';
                        $single[] = 'Package Title';
                        $single[] = 'Order Status';
                        $single[] = 'Payment Status';
                        $single[] = 'Total';
                        $single[] = 'Paid';
                        $single[] = 'Due';
                        $sheet->row($loop, $single);
                        $sheet->cells("A$loop:I$loop", function ($cells) {
                            $cells->setBackground('#1d2d5d');
                            $cells->setFontColor('#ffffff');
                            $cells->setFontSize(12);
                            $cells->setAlignment('center');
                            $cells->setValignment('center');
                        });
                        $sheet->getRowDimension($loop)->setRowHeight(20);
                        $loop++;
                        $loop++;
                        foreach ($orders as $order) {
                            $single = [];
                            $single[] = SM::orderNumberFormat($order);
                            $single[] = date('Y-m-d H:i:s', strtotime($order->created_at));
                            $single[] = $order->fullname != '' ? $order->fullname : $order->username;
                            $single[] = $order->fullname;
                            if ($order->order_status == 1) {
                                $single[] = 'Completed';
                            } else if ($order->order_status == 2) {
                                $single[] = 'Progress';
                            } else if ($order->order_status == 3) {
                                $single[] = 'Pending';
                            } else {
                                $single[] = 'Canceled';
                            }
                            if ($order->payment_status == 1) {
                                $single[] = 'Completed';
                            } else if ($order->payment_status == 3) {
                                $single[] = 'Pending';
                            } else {
                                $single[] = 'Canceled';
                            }
                            $due = $order->paid - $order->net_total;
                            $dueSign = $due < 0 ? "-" : "+";
                            $dueSign = $due == 0 ? "" : $dueSign;

                            $dueArray[] = $due;
                            $netTotalArray[] = $order->net_total;
                            $paidArray[] = $order->paid;
                            $single[] = number_format($order->net_total, 2);
                            $single[] = number_format($order->paid, 2);
                            $single[] = $dueSign . number_format($due, 2);

                            $sheet->row($loop, $single);
                            $loop++;
                        }
                        $loop++;


                        $single = [];
                        $sheet->mergeCells("A$loop:E$loop");
                        $sheet->cells("A$loop:E$loop", function ($cells) {
                            $cells->setBackground('#1d2d5d');
                            $cells->setFontColor('#ffffff');
                            $cells->setFontSize(12);
                            $cells->setAlignment('left');
                        });
                        $sheet->cells("F$loop:I$loop", function ($cells) {
                            $cells->setBackground('#1d2d5d');
                            $cells->setFontColor('#ffffff');
                            $cells->setFontSize(12);
                            $cells->setAlignment('right');
                        });
                        $single[0] = 'Developed by Next Page Technology Ltd.';
                        $single[1] = "Total";
                        $single[2] = "Total";
                        $single[3] = "Total";
                        $single[4] = "Total";
                        $single[5] = "Total";
                        $single[6] = number_format(array_sum($netTotalArray), 2);
                        $single[7] = number_format(array_sum($paidArray), 2);
                        $single[8] = number_format(array_sum($dueArray), 2);
                        $sheet->row($loop, $single);


                    });

                })->download('xlsx');
            } else {
                return view("nptl-admin/common/reports/orders_report", compact('order_id', 'sdate', 'edate', 'package', 'pid', 'payment_status', 'customer', 'cid', 'all_order', 'order_status'));
            }
        } else {
            return view("nptl-admin/common/reports/orders_report", compact('order_id', 'sdate', 'edate', 'package', 'pid', 'payment_status', 'customer', 'cid', 'all_order', 'order_status'));
        }
    }

    //  order_reports
    public function order_reports()
    {
        $user_lists = DB::table('users')->join('orders', 'users.id', 'orders.user_id')
            ->select('users.id', 'users.name')
            ->groupBy('users.id')
            ->get();
//            User::join('orders')->select('id', 'firstname', 'lastname')->get();
        return view('nptl-admin.common.reports.orders_report', compact('user_lists'));
    }

    public function order_reports_data(Request $request)
    {
        if ($request->ajax()) {
            $fromToData = SM::startEndDate($request->input('from_date'), $request->input('to_date'));
            $start = $fromToData['start'];
            $end = $fromToData['end'];
            $user_id = $request->input('user_id');
            $order_status = $request->input('order_status');
            $payment_status = $request->input('payment_status');

            $output = "";
            $orders = Order::latest()
                ->when($user_id, function ($query) use ($user_id) {
                    if ($user_id != "") {
                        return $query->where('user_id', '=', $user_id);
                    }
                })
                ->when($order_status, function ($query) use ($order_status) {
                    if ($order_status != "") {
                        return $query->where('order_status', '=', $order_status);
                    }
                })
                ->when($payment_status, function ($query) use ($payment_status) {
                    if ($payment_status != "") {
                        return $query->where('payment_status', '=', $payment_status);
                    }
                })
                ->when($start, function ($query) use ($start, $end) {
                    if ($start != "") {
                        return $query->whereBetween('create_date', array($start, $end));
                    }
                })
                ->when($end, function ($query) use ($start, $end) {
                    if ($end != "") {
                        return $query->whereBetween('create_date', array($start, $end));
                    }
                })
                ->get();
            if ($orders) {
                $output .= ' 
               <thead>
                <tr>
                     <th colspan="10" style="background-color: #e7e7e7"></th> 
                     <th style="background-color: #e7e7e7"><strong>Total Data:</strong> </th>
                     <th style="background-color: #e7e7e7"><strong>' . $orders->count() . '</strong></th>
                 </tr>
                  <tr>
                     <th>Date</th>
                     <th>Order No</th>
                     <th>Customer</th>
                     <th>Product Name</th>
                     <th>Status</th>
                     <th>Payment Method</th>
                     <th>Shipping Charge</th>
                     <th>Discount</th>
                     <th>Total Amount</th>
                     <th>Paid</th>
                     <th>Due / Advanced</th>
                     <th>Action</th> 
                  </tr>
               </thead>
               <tbody>';
                $total_qty = 0;
                $total_gt = 0;
                $total_rec = 0;
                $total_adjustment = 0;
                $total_due = 0;
                foreach ($orders as $key => $v_data) {

                    $details = '';
                    foreach ($v_data->detail as $loop => $detail) {
                        $details .= $detail->product->title . ', ' . $detail->product_qty . '' . $detail->product->unit->title . ', ' . SM::get_currency_price_value($detail->product_price) . '<br>';
                    }

                    if ($v_data->order_status == 1) {
                        $order_status = 'Completed';
                    } else if ($v_data->order_status == 2) {
                        $order_status = 'Progress';
                    } else if ($v_data->order_status == 3) {
                        $order_status = 'Pending';
                    } else {
                        $order_status = 'Canceled';
                    }

                    if ($v_data->payment_status == 1) {
                        $payment_status = 'Completed';
                    } else if ($v_data->payment_status == 2) {
                        $payment_status = 'Pending';
                    } else {
                        $payment_status = 'Canceled';
                    }
                    if ($v_data->discount > 0) {
                        $discount = '<strong>Discount</strong>: ' . SM::order_currency_price_value($v_data->id, $v_data->discount);
                    } else {
                        $discount = '';
                    }
                    if ($v_data->coupon_amount > 0) {
                        $coupon_amount = ' <strong>Coupon</strong>: ' . SM::order_currency_price_value($v_data->id, $v_data->coupon_amount);
                    } else {
                        $coupon_amount = '';
                    }
                    $due = $v_data->grand_total - $v_data->paid;
                    $output .= '<tr>
                                 <td>' . SM::showDateTime($v_data->create_date) . '</td>
                                 <td><strong><a href="' . url(config('constant.smAdminSlug') . '/orders/' . $v_data->id) . '?isAdmin=1' . '" target="_blank">' . $v_data->invoice_no . '</strong></td>
                                 <td>' . $v_data->user->firstname . ' ' . $v_data->user->lastname . '<br>' . $v_data->contact_email . '</td>
                                 <td> ' . $details . ' </td>
                                  <td> <strong> Order</strong>: ' . $order_status . ' <br><strong> Payment</strong>:' . $payment_status . ' </td>
                                  <td> ' . $v_data->payment_method->title . '</td>
                                  <td> ' . SM::order_currency_price_value($v_data->id, $v_data->shipping_method_charge) . '</td>
                                  <td> ' . $discount . $coupon_amount . ' </td>
                                 <td> ' . SM::order_currency_price_value($v_data->id, $v_data->grand_total) . '</td>
                                  <td> ' . SM::order_currency_price_value($v_data->id, $v_data->paid) . '</td>
                                 <td> ' . SM::order_currency_price_value($v_data->id, $due) . '</td>
                                 <td>
                                    <a target = "_blank"
                                           href = "' . url(config('constant.smAdminSlug') . '/orders/' . $v_data->id) . '?isAdmin=1' . '"
                                           title = "View Invoice" class="btn btn-xs btn-default" id = "">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <a href = " ' . url(config('constant.smAdminSlug') . '/orders/download/' . $v_data->id) . '"
                                           title = "Download Invoice" class="btn btn-xs btn-default" id = "">
                                            <i class="fa fa-download"></i>
                                        </a>
                                     </td>
                                 </tr> ';

                    $total_gt += $v_data->grand_total;
                    $total_rec += $v_data->paid;
                    $total_due += $due;

                }
                $output .= '<tr>
                                    <td colspan = "8" style = "background-color: #e7e7e7"></td> 
                                     <td style = "background-color: #e7e7e7"><strong>= ' . SM::get_currency_price_value($total_gt) . '</strong></td>
                                    <td style = "background-color: #e7e7e7"><strong>= ' . SM::get_currency_price_value($total_rec) . '</strong></td>
                                     <td style = "background-color: #e7e7e7"><strong>= ' . SM::get_currency_price_value($total_due) . '</strong></td>
                                     <td colspan = "1" style = "background-color: #e7e7e7"></td> 
                                </tr>
                    ';

                $output .= '</tbody> ';
                return Response($output);
            } else {
                return Response()->json(['no' => 'Not found']);
            }
        }
    }

    //  order_reports
    public function order_details()
    {
        $product_lists = DB::table('products')
            ->join('order_details', 'products.id', 'order_details.product_id')
            ->select('products.id', 'products.title')
            ->groupBy('products.id')
            ->pluck('products.title', 'products.id');

//        $product_lists = Product::pluck('title', 'id');
        $user_lists = DB::table('users')->join('orders', 'users.id', 'orders.user_id')
            ->select('users.id', 'users.name')
            ->groupBy('users.id')
            ->get();
        return view('nptl-admin.common.reports.order_details', compact('user_lists', 'product_lists'));
    }

    public function order_details_data(Request $request)
    {
        if ($request->ajax()) {
            $fromToData = SM::startEndDate($request->input('from_date'), $request->input('to_date'));
            $start = $fromToData['start'];
            $end = $fromToData['end'];
            $user_id = $request->input('user_id');
            $product_id = $request->input('product_id');

            $output = "";
            $order_details = DB::table('order_details')
                ->join('orders', 'order_details.order_id', '=', 'orders.id')
                ->leftJoin('products', 'order_details.product_id', '=', 'products.id')
                ->leftJoin('users', 'orders.user_id', '=', 'users.id')
                ->leftJoin('units', 'products.unit_id', '=', 'units.id')
                ->select('order_details.*', 'orders.user_id', 'orders.contact_email as oemail',
                    'users.firstname', 'users.lastname', 'units.title as utitle',
                    'orders.id as oid', 'orders.invoice_no', 'orders.create_date as ocreate_date', 'products.title as ptitle'
                )
                ->when($product_id, function ($query) use ($product_id) {
                    if ($product_id != "") {
                        return $query->where('order_details.product_id', '=', $product_id);
                    }
                })
                ->when($user_id, function ($query) use ($user_id) {
                    if ($user_id != "") {
                        return $query->where('orders.user_id', '=', $user_id);
                    }
                })
                ->when($start, function ($query) use ($start, $end) {
                    if ($start != "") {
                        return $query->whereBetween('orders.create_date', array($start, $end));
                    }
                })
                ->when($end, function ($query) use ($start, $end) {
                    if ($end != "") {
                        return $query->whereBetween('orders.create_date', array($start, $end));
                    }
                })
                ->get();
            if ($order_details) {
                $output .= ' 
               <thead>
                <tr>
                     <th colspan="6" style="background-color: #e7e7e7"></th> 
                     <th style="background-color: #e7e7e7"><strong>Total Data:</strong> </th>
                     <th style="background-color: #e7e7e7"><strong>' . $order_details->count() . '</strong></th>
                 </tr>
                  <tr>
                     <th>Date</th>
                     <th>Order No</th>
                     <th>Customer</th>
                      <th>Product Name</th> 
                      <th>Qty</th>
                     <th>Price</th>
                     <th>Sub Total</th>
                      <th>Action</th> 
                  </tr>
               </thead>
               <tbody>';
                $total_qty = 0;
                $total_gt = 0;
                $total_rec = 0;
                $total_adjustment = 0;
                $total_due = 0;
                foreach ($order_details as $key => $v_data) {
                    $output .= '<tr>
                                 <td>' . SM::showDateTime($v_data->ocreate_date) . '</td>
                                 <td><strong><a href="' . url(config('constant.smAdminSlug') . '/orders/' . $v_data->oid) . '?isAdmin=1' . '" target="_blank">' . $v_data->invoice_no . '</strong></td>
                                  <td>' . $v_data->firstname . ' ' . $v_data->lastname . '<br>' . $v_data->oemail . '</td>
                                  <td> ' . $v_data->ptitle . '<br><img src="' . SM::sm_get_the_src($v_data->product_image, 80, 80) . '"
                                                     alt="' . $v_data->ptitle . '"></td>
                                  <td> ' . $v_data->product_qty . ' ' . $v_data->utitle . '</td>
                                  <td> ' . SM::get_currency_price_value($v_data->product_price) . '</td>
                                  <td> ' . SM::get_currency_price_value($v_data->sub_total) . '</td> 
                                 <td>
                                    <a target = "_blank"
                                           href = "' . url(config('constant.smAdminSlug') . '/orders/' . $v_data->oid) . '?isAdmin=1' . '"
                                           title = "View Invoice" class="btn btn-xs btn-default" id = "">
                                            <i class="fa fa-eye"></i>
                                        </a> 
                                     </td>
                                 </tr> ';

                    $total_gt += $v_data->sub_total;
                    $total_qty += $v_data->product_qty;

                }
                $output .= '<tr>
                                    <td colspan = "4" style = "background-color: #e7e7e7"><strong>Total</strong></td> 
                                     <td style = "background-color: #e7e7e7"><strong>= ' . number_format($total_qty, 2) . '</strong></td>
                                      <td colspan = "1" style = "background-color: #e7e7e7"></td> 
                                     <td style = "background-color: #e7e7e7"><strong>= ' . SM::get_currency_price_value($total_gt) . '</td>
                                      <td colspan = "1" style = "background-color: #e7e7e7"></td> 
                                </tr>
                    ';

                $output .= '</tbody> ';
                return Response($output);
            } else {
                return Response()->json(['no' => 'Not found']);
            }
        }
    }

    public function stock_report(Request $request)
    {
        $product_lists = Product::orderBy('product_qty')
            ->pluck('title', 'id');
        $brand_lists = Brand::pluck('title', 'id');
        $unit_lists = Unit::pluck('title', 'id');
        if ($request->ajax()) {
            $fromToData = SM::startEndDate($request->input('from_date'), $request->input('to_date'));
            $start = $fromToData['start'];
            $end = $fromToData['end'];
            $brand_id = $request->input('brand_id');
            $product_id = $request->input('product_id');
            $unit_id = $request->input('unit_id');

            $output = "";
            $stocks_alert = Product::orderBy('product_qty')
                ->when($product_id, function ($query) use ($product_id) {
                    if ($product_id != "") {
                        return $query->where('id', '=', $product_id);
                    }
                })
                ->when($brand_id, function ($query) use ($brand_id) {
                    if ($brand_id != "") {
                        return $query->where('brand_id', '=', $brand_id);
                    }
                })->when($unit_id, function ($query) use ($unit_id) {
                    if ($unit_id != "") {
                        return $query->where('unit_id', '=', $unit_id);
                    }
                })
                ->get();
            if ($stocks_alert) {
                $output .= ' 
               <thead>
                <tr>
                     <th colspan="6" style="background-color: #e7e7e7"></th> 
                     <th style="background-color: #e7e7e7"><strong>Total Data:</strong> </th>
                     <th style="background-color: #e7e7e7"><strong>' . $stocks_alert->count() . '</strong></th>
                 </tr>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Category</th>
                     <th>Author</th>
                     <th>Attribute</th>
                      <th>Image</th> 
                      <th>Price</th>
                     <th>Expiry Date</th> 
                  </tr>
               </thead>
               <tbody>';
                $total_qty = 0;
                foreach ($stocks_alert as $key => $v_data) {
                    $cat_title = '';
                    if (count($v_data->categories) > 0) {
                        foreach ($v_data->categories as $i => $cat) {
                            $cat_title .= $cat->title . ', ';
                        }
                    }
                    if ($v_data->product_type == 2) {
                        if (count($v_data->attributeProduct) > 0) {
                            $attribute_data = '';
                            foreach ($v_data->attributeProduct as $attribute) {
                                $attribute_data .= $attribute->attribute->title . ', ' . $attribute->colorName->title . ', ' . $attribute->attribute_qty . ', ' . $attribute->attribute_price . '<br>';
                            }
                        }
                        $nestedData_attributes = $attribute_data;
                    } else {
                        if (!empty($v_data->unit_id)) {
                            $unit = $v_data->unit->title;
                        } else {
                            $unit = '';
                        }
                        $nestedData_attributes = $v_data->product_weight . ' ' . $unit;
                    }
                    $output .= '<tr>
                                 <td><strong>' . $v_data->id . '</strong></td>
                                  <td><strong>' . $v_data->title . '</strong><br>SKU: ' . $v_data->sku . '<br>Qty: ' . $v_data->product_qty . '<br>Alert Qty: ' . $v_data->alert_quantity . '</td>
                                  <td> ' . $cat_title . '</td>
                                  <td> ' . $v_data->author->title . '</td>
                                  <td> ' . $nestedData_attributes . '</td>
                                 <td><img src="' . SM::sm_get_the_src($v_data->product_image, 80, 80) . '"
                                                     alt="' . $v_data->title . '"></td>
                                   <td> ' . SM::get_currency_price_value($v_data->regular_price) . '</td>
                                  <td>' . SM::showDateTime($v_data->expiry_date) . '</td> 
                                 </tr> ';

                    $total_qty += $v_data->product_qty;

                }
                $output .= '<tr>
                                    <td colspan = "1" style = "background-color: #e7e7e7"><strong>Total</strong></td> 
                                     <td style = "background-color: #e7e7e7"><strong>= ' . number_format($total_qty, 2) . '</strong></td>
                                      <td colspan = "6" style = "background-color: #e7e7e7"></td>   
                                </tr>
                    ';

                $output .= '</tbody> ';
                return Response($output);
            } else {
                return Response()->json(['no' => 'Not found']);
            }
        }
        return view('nptl-admin.common.reports.stock_report', compact('product_lists', 'brand_lists', 'unit_lists'));
    }

    public function stock_alert(Request $request)
    {
        $product_lists = Product::orderBy('product_qty')
            ->pluck('products.title', 'products.id');
        $brand_lists = Brand::pluck('title', 'id');
        if ($request->ajax()) {
            $fromToData = SM::startEndDate($request->input('from_date'), $request->input('to_date'));
            $start = $fromToData['start'];
            $end = $fromToData['end'];
            $user_id = $request->input('user_id');
            $product_id = $request->input('product_id');

            $output = "";
            $stocks_alert = Product::orderBy('product_qty')
//                    ->where('product_qty', '<', 5)
                ->when($product_id, function ($query) use ($product_id) {
                    if ($product_id != "") {
                        return $query->where('id', '=', $product_id);
                    }
                })
                ->get();
            if ($stocks_alert) {
                $output .= ' 
               <thead>
                <tr>
                     <th colspan="4" style="background-color: #e7e7e7"></th> 
                     <th style="background-color: #e7e7e7"><strong>Total Data:</strong> </th>
                     <th style="background-color: #e7e7e7"><strong>' . $stocks_alert->count() . '</strong></th>
                 </tr>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                      <th>Image</th> 
                      <th>Qty</th>
                     <th>Price</th>
                     <th>Expiry Date</th> 
                  </tr>
               </thead>
               <tbody>';
                $total_qty = 0;
                foreach ($stocks_alert as $key => $v_data) {
                    if ($v_data->alert_quantity >= $v_data->product_qty) {
                        $output .= '<tr>
                                 <td><strong>' . $v_data->id . '</strong></td>
                                  <td> ' . $v_data->title . '</td>
                                 <td><img src="' . SM::sm_get_the_src($v_data->product_image, 80, 80) . '"
                                                     alt="' . $v_data->title . '"></td>
                                  <td> ' . $v_data->product_qty . ' ' . $v_data->unit->title . '</td>
                                  <td> ' . SM::get_currency_price_value($v_data->regular_price) . '</td>
                                  <td>' . SM::showDateTime($v_data->expiry_date) . '</td> 
                                 </tr> ';

                        $total_qty += $v_data->product_qty;

                    }
                }
                $output .= '<tr>
                                    <td colspan = "3" style = "background-color: #e7e7e7"><strong>Total</strong></td> 
                                     <td style = "background-color: #e7e7e7"><strong>= ' . number_format($total_qty, 2) . '</strong></td>
                                      <td colspan = "1" style = "background-color: #e7e7e7"></td> 
                                       <td colspan = "1" style = "background-color: #e7e7e7"></td> 
                                </tr>
                    ';

                $output .= '</tbody> ';
                return Response($output);
            } else {
                return Response()->json(['no' => 'Not found']);
            }
        }
        return view('nptl-admin.common.reports.stock_alert', compact('product_lists', 'brand_lists'));
    }

    public function stock_expiry(Request $request)
    {
        $carbon_now = Carbon::now()->addMonth(2)->toDateString();

        $product_lists = Product::pluck('products.title', 'products.id');
        if ($request->ajax()) {
            $fromToData = SM::startEndDate($request->input('from_date'), $request->input('to_date'));
            $start = $fromToData['start'];
            $end = $fromToData['end'];
            $user_id = $request->input('user_id');
            $product_id = $request->input('product_id');

            $output = "";
            $stocks_alert = Product::where('expiry_date', '<=', $carbon_now)
                ->when($product_id, function ($query) use ($product_id) {
                    if ($product_id != "") {
                        return $query->where('id', '=', $product_id);
                    }
                })
                ->get();
            if ($stocks_alert) {
                $output .= ' 
               <thead>
                <tr>
                     <th colspan="4" style="background-color: #e7e7e7"></th> 
                     <th style="background-color: #e7e7e7"><strong>Total Data:</strong> </th>
                     <th style="background-color: #e7e7e7"><strong>' . $stocks_alert->count() . '</strong></th>
                 </tr>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                      <th>Image</th> 
                      <th>Qty</th>
                     <th>Price</th>
                     <th>Expiry Date</th> 
                  </tr>
               </thead>
               <tbody>';
                $total_qty = 0;
                foreach ($stocks_alert as $key => $v_data) {
                    $output .= '<tr>
                                 <td><strong>' . $v_data->id . '</strong></td>
                                  <td> ' . $v_data->title . '</td>
                                 <td><img src="' . SM::sm_get_the_src($v_data->product_image, 80, 80) . '"
                                                     alt="' . $v_data->title . '"></td>
                                  <td> ' . $v_data->product_qty . ' ' . $v_data->unit->title . '</td>
                                  <td> ' . SM::get_currency_price_value($v_data->regular_price) . '</td>
                                  <td>' . SM::showDateTime($v_data->expiry_date) . '</td> 
                                 </tr> ';

                    $total_qty += $v_data->product_qty;

                }
                $output .= '<tr>
                                    <td colspan = "3" style = "background-color: #e7e7e7"><strong>Total</strong></td> 
                                     <td style = "background-color: #e7e7e7"><strong>= ' . number_format($total_qty, 2) . '</strong></td>
                                      <td colspan = "1" style = "background-color: #e7e7e7"></td> 
                                       <td colspan = "1" style = "background-color: #e7e7e7"></td> 
                                </tr>
                    ';

                $output .= '</tbody> ';
                return Response($output);
            } else {
                return Response()->json(['no' => 'Not found']);
            }
        }
        return view('nptl-admin.common.reports.stock_expiry', compact('product_lists'));
    }

    public function slow_motion()
    {
        $product_lists = DB::table('products')
            ->join('order_details', 'products.id', 'order_details.product_id')
            ->select('products.id', 'products.title')
            ->groupBy('products.id')
            ->pluck('products.title', 'products.id');

        return view('nptl-admin.common.reports.slow_motion', compact('product_lists'));
    }

    public function slow_motion_data(Request $request)
    {
        if ($request->ajax()) {
            $fromToData = SM::startEndDate($request->input('from_date'), $request->input('to_date'));
            $start = $fromToData['start'];
            $end = $fromToData['end'];
            $product_id = $request->input('product_id');

            $output = "";
            $order_details = DB::table('order_details')->get();
            $product_details = DB::table('products')->get();
            $order_id = array();
            $product_det = array();
            foreach ($order_details as $key => $order) {
                $order_id[] = $order->product_id;
            }
            foreach ($product_details as $key => $product) {
                $product_det[] = $product->id;
            }


            $data = array_diff($product_det, $order_id);
            $product_data = Product::whereIn('id', $data)->paginate(10);

            if ($product_data) {
                $output .= ' 
               <thead>
                <tr>
                     <th colspan="2" style="background-color: #e7e7e7"></th> 
                     <th style="background-color: #e7e7e7"><strong>Total Data:</strong> </th>
                     <th style="background-color: #e7e7e7"><strong>' . $product_data->count() . '</strong></th>
                 </tr>
                  <tr>
                     <th>Sl</th>
                      <th>Product Name</th> 
                      <th>Qty</th>
                     <th>Price</th>
                  </tr>
               </thead>
               <tbody>';
                $total_qty = 0;
                $total_gt = 0;
                $total_rec = 0;
                $total_adjustment = 0;
                $total_due = 0;
                $count = 1;
                foreach ($product_data as $key => $v_data) {

                    $output .= '<tr>
                                 <td>' . $v_data->id . '</td>
                                  <td>' . $v_data->title . '</td>
                                  <td><img src="' . SM::sm_get_the_src($v_data->image, 80, 80) . '"
                                                     alt="' . $v_data->title . '"></td>';
                    if ($v_data->sale_price > 0) {

                        $output .= ' <td> ' . SM::get_currency_price_value($v_data->sale_price) . ' <del>' . SM::get_currency_price_value($v_data->regular_price) . '</del></td>';
                    } else {
                        $output .= ' <td> ' . SM::get_currency_price_value($v_data->regular_price) . ' </td>';
                    }

                    $total_gt += $v_data->sub_total;
                    $total_qty += $v_data->product_qty;

                }
                $output .= '<tr>
                                    <td colspan = "4" style = "background-color: #e7e7e7">
                                   <div class="col-sx-12 col-sm-12 col-md-12 col-lg-12 product">
                              <div class="col-md-6">
                               <div class="" style="color: #000;font-size: 17px;margin-top: 17px;"> Showing ' . $product_data->firstItem() . '-' . $product_data->lastItem() . '
                                of ' . $product_data->total() . '     
                                </div>
                            </div>
                            <div id="slow_motion_pagination" class="col-md-6 pull-right" >
                                ' . $product_data->links() . '
                            </div>
                            </div></td> 
                                </tr>
                    ';

                $output .= '</tbody> ';
                return Response($output);
            } else {
                return Response()->json(['no' => 'Not found']);
            }
        }
    }

}
