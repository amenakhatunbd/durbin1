<?php

namespace App\Http\Controllers\Admin\Common;

use App\Mail\InvoiceMail;
use App\Mail\NormalMail;
use App\Model\Common\Attribute;
use App\Model\Common\AttributeProduct;
use App\Model\Common\Coupon;
use App\Model\Common\Media_permissions;
use App\Model\Common\Order_detail;
use App\Model\Common\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Common\Order;
use App\User;
use App\Model\Common\Payment;
use Barryvdh\DomPDF\Facade as PDF;
use App\SM\SM;
use App\Model\Common\Media;

class Orders extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("nptl-admin.common.order.index");
    }

    public function phone_number()
    {
        $orders = Order::all();




        foreach ($orders as $key => $value) {
            $customer = User::where('id', $value->user_id)->first();
            if(!empty($customer->mobile))
            {
                Order::where('id', $value->id)->update(['phone' => $customer->mobile]);
            }
        }
        // dd($order);
    }

    public function index2(Request $request)
    {
        $edit_order = SM::check_this_method_access('orders', 'edit') ? 1 : 0;
        $order_status_update = SM::check_this_method_access('orders', 'order_status_update') ? 1 : 0;
        $delete_order = SM::check_this_method_access('orders', 'destroy') ? 1 : 0;
        $per = $edit_order + $delete_order;

        $columns = array(
            0 => 'id',
            1 => 'title',
        );

        $totalData = Order::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $orders = Order::offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Order::count();
        } else {
            $search = $request->input('search.value');

            $orders = Order::where('id', 'like', "%{$search}%")
                ->orWhere('customer_name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Order::where('id', 'like', "%{$search}%")->orWhere('customer_name', 'like', "%{$search}%")->count();
        }
        $data = array();


       

        if ($orders) {
            foreach ($orders as $v_data) {
                $due = $v_data->paid - $v_data->grand_total;
                $dueSign = $due < 0 ? "-" : "+";
                $dueSign = $due == 0 ? "" : $dueSign;

                $nestedData['create_date'] = '<td>' . SM::showDateTime($v_data->create_date) . '</td>';
                $nestedData['id'] = '<a href="' . url(config('constant.smAdminSlug') . '/orders/' . $v_data->id) . '?isAdmin=1' . '" target="_blank"><strong>' . $v_data->invoice_no . '</strong></a>';
                $nestedData['customer'] = '<strong>Name</strong>: ' . $v_data->customer_name . '<br><strong>Email</strong>: ' . $v_data->contact_email . '<br><strong>Phone</strong>: ' . $v_data->phone;
                $nestedData['amount'] = '<strong>Total</strong>: ' . SM::order_currency_price_value($v_data->id, $v_data->grand_total) .
                    '<br><strong>Paid</strong>: ' . SM::order_currency_price_value($v_data->id, $v_data->paid, 2) .
                    '<br><strong>Due</strong>: ' . SM::order_currency_price_value($v_data->id, $due);
                $shipping_method = 'Shipping Method: ' . $v_data->shipping_method_name;
                $shipping_method_charge = '<br>Delivery Charge: ' . SM::order_currency_price_value($v_data->id, $v_data->shipping_method_charge, 2);

                $coupon_amount = '';
                if ($v_data->coupon_amount > 0) {
                    $coupon_amount = '<br>Coupon Amount: ' . SM::order_currency_price_value($v_data->id, $v_data->coupon_amount, 2);
                }
                $discount = '';
                if ($v_data->discount > 0) {
                    $discount = '<br>Discount: ' . SM::order_currency_price_value($v_data->id, $v_data->discount, 2);
                }
                $order_note = '';
                if ($v_data->order_note != '') {
                    $order_note = '<br>Note: ' . $v_data->order_note;
                }
                $nestedData['others_info'] = $shipping_method . $shipping_method_charge . $discount . $coupon_amount . $order_note;

                $p_details = '';
                if ($v_data->payment_method_id != 3) {
                    // $payment_details = json_decode($v_data->payment_details);
                    // foreach ($payment_details as $key => $value) {
                    //     if ($key == 'card_number' || $key == 'card_type' || $key == 'pay_status' || $key == 'bank_txn') {
                    //         $key_field = str_replace("_", " ", $key);
                    //         $p_details = '<label style="font-weight: 700; color: #1d2d5d">' . ucfirst($key_field) . ': </label> <span>' . $value . '</span><br>';
                    //     }
                    // }
                }
                $nestedData['payment_method'] = $v_data->payment_method->title . '<br>' . $p_details;

                if ($v_data->order_status == 1) {
                    $selected1 = "Selected";
                } else {
                    $selected1 = '';
                }
                if ($v_data->order_status == 2) {
                    $selected2 = "Selected";
                } else {
                    $selected2 = "";
                }
                if ($v_data->order_status == 3) {
                    $selected3 = "Selected";
                } else {
                    $selected3 = "";
                }
                if ($v_data->order_status == 4) {
                    $selected4 = "Selected";
                } else {
                    $selected4 = "";
                }
                if ($order_status_update != 0) {
                    $nestedData['o_status'] = ' <select class="form-control order_change_status"
                                                id="order_change_status_' . $v_data->id . '"
                                                data-post_id="' . $v_data->id . '"
                                                data-due="' . abs($due) . '"
                                                data-row="' . $v_data->id . '"> 
                                        <option value="1" ' . $selected1 . '>Completed </option>
                                        <option value="2" ' . $selected2 . '>Progress </option>
                                        <option value="3" ' . $selected3 . '>Pending </option>
                                        <option value="4" ' . $selected4 . '>Canceled </option>
                                        </select>';
                }

                // if ($v_data->payment_status == 1) {
                //     $selected1 = "Selected";
                //      $selected2 = "disabled";
                //     $selected3 = "disabled";
                // } else {
                //     $selected1 = '';
                // }
                // if ($v_data->payment_status == 2) {
                //     $selected2 = "Selected";
                // } else {
                //     $selected2 = "";
                // }
                // if ($v_data->payment_status == 3) {
                //     $selected3 = "Selected";
                // } else {
                //     $selected3 = "";
                // }
                 if ($v_data->payment_status == 1) {
                    $selected1 = "Selected";
                     $selected2 = "disabled";
                    $selected3 = "disabled";
                } else {
                     $selected1 = "";
                }
                if ($v_data->payment_status == 2) {
                    $selected2 = "Selected";
                     
                } else {
                    $selected1 = "";
                }
                if ($v_data->payment_status == 3) {
                  $selected3 = "Selected";

                } else {
                    $selected1 = "";
                }
                if ($order_status_update != 0) {
                    $nestedData['p_status'] = ' <select class="form-control payment_change_status"
                id="payment_change_status_' . $v_data->id . '"
                data-post_id="' . $v_data->id . '"
                data-due="' . abs($due) . '"
                data-row="' . $v_data->id . '">
                <option value="1" ' . $selected1 . '>Published </option>
                <option value="2" ' . $selected2 . '>Pending </option>
                <option value="3" ' . $selected3 . '>Canceled </option>
                </select>';
                }
                if ($per != 0) {
                    $send_mail = '<a href="javascript:void(0)" data-post_id="' . $v_data->id . '" title="Send Mail" class="btn btn-xs btn-success showOrderMailModal">
                                <i class="fa fa-envelope"></i>
                            </a>';
                    $view_invoice = ' <a target="_blank"
                                   href="' . url(config('constant.smAdminSlug') . '/orders') . '/' . $v_data->id . '?isAdmin=1"
                                   title="View Invoice" class="btn btn-xs btn-default" id="">
                                    <i class="fa fa-eye"></i>
                                </a>';
                    $download_invoice = '<a href="' . url(config('constant.smAdminSlug') . '/orders/download/' . $v_data->id) . '"
                                       title="Download Invoice" class="btn btn-xs btn-default" id="">
                                        <i class="fa fa-download"></i>
                                    </a>';
                    $edit_invoice = ' <a target="_blank"
                                   href="' . url(config('constant.smAdminSlug') . '/orders') . '/' . $v_data->id . '/edit"
                                   title="View Invoice" class="btn btn-xs btn-default" id="">
                                    <i class="fa fa-pencil"></i>
                                </a>';
                    if ($delete_order != 0) {
                        $delete_data = '<a href="' . url(config('constant.smAdminSlug') . '/orders/destroy') . '/' . $v_data->id . '" 
                  title="Delete" class="btn btn-xs btn-default delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $v_data->id . '">
                     <i class="fa fa-times"></i>
                    </a> ';
                    } else {
                        $delete_data = '';
                    }
                    $nestedData['action'] = $send_mail . ' ' . $view_invoice . ' ' . $download_invoice . ' ' . $delete_data;
                } else {
                    $nestedData['action'] = '';
                }
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }


    public function ordersType($type)
    {
        if ($type == 'completed') {
            $type_val = 1;
        } elseif ($type == 'procession') {
            $type_val = 2;
        } elseif ($type == 'pending') {
            $type_val = 3;
        } else {
            $type_val = 4;
        }
        $orders = Order::where('order_status', $type_val)->get();
        return view("nptl-admin.common.order.type", compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data["order"] = Order::with('payment', 'user', 'detail')->find($id);
//        if ( count( $data["order"] ) > 0 ) {
        if (!empty($data["order"])) {
            $data["payment"] = Payment::find($data["order"]->payment_id);

            return view("customer/order_detail", $data);
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["order"] = Order::find($id);
        $data['product_lists'] = Product::orderBy('title')->pluck('title', 'id');
        $data["size_lists"] = Attribute::Size()->orderBy('title')->pluck('title', 'id');
        $data["color_lists"] = Attribute::Color()->orderBy('title')->pluck('title', 'id');
        if (!empty($data["order"])) {
            return view("nptl-admin.common.order.edit_order", $data);
        } else {
            return abort(404);
        }
    }

    public function findProductBySize(Request $request)
    {
        $data = AttributeProduct::where('product_id', $request->product_id)
            ->get();
        $optiodata = '<option value="">Select Option</option>';
        foreach ($data as $key => $v_data) {
            $optiodata .= '<option value="' . $v_data->attribute_id . '">' . $v_data->attribute->title . '</option>';
        }
        return response()->json($optiodata);
    }

    public function findProductSizeByColorPrice(Request $request)
    {
        $type = Product::where('id', $request->product_id)->first();
        $files = array();
        if (!empty($type)) {
            if ($type->product_type == 2) {
                $data = AttributeProduct::where('product_id', $request->product_id)
                    ->where('attribute_id', $request->attribute_id)
                    ->first();
                if (count($data) > 0) {
                    $optiodata = '<option value="' . $data->color_id . '">' . $data->colorName->title . '</option>';
                    $files = array(
                        'color_data' => $optiodata,
                        'product_price' => $data->attribute_price,
                        'in_stock_qty' => $data->attribute_qty
                    );

                }
            } else {
                if ($type->sale_price > 0) {
                    $price = $type->sale_price;
                } else {
                    $price = $type->regular_price;
                }
                $files = array(
                    'product_price' => $price,
                    'in_stock_qty' => $type->product_qty
                );
            }
        }


        return Response($files);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->gross_amount = $request->gross_amount;
        $order->discount_type = $request->discount_type;
        $order->input_discount = $request->input_discount;
        $order->discount = $request->discount;
        $order->coupon_code = $request->coupon_code;
        $order->coupon_amount = $request->coupon_amount;
        $order->tax = $request->tax;
        $order->shipping_method_charge = $request->shipping_method_charge;
        $order->grand_total = $request->grand_total;
//        $order->confirm_order = $request->confirm_order;
        $order->order_note = $request->order_note;
        if ($order->update()) {
            $order_id = $order->id;
            if (!empty($request->product_id[0])) {
                $data = [];
                $row11 = Order_detail::where('order_id', $order_id)->get();
                if (count($row11)) {
                    foreach ($row11 as $data12) {
                        $this->decreaseQuantities($data12->product_id, -$data12->product_qty);
                        $array_id[] = $data12->id;
                    }
                    foreach ($request->product_id as $key => $v) {
                        $detail_id[] = $request->detail_id [$key];
                    }
                    $remove_data = array_diff($array_id, $detail_id);
                    Order_detail::whereIn('id', $remove_data)->delete();
                }

                foreach ($request->product_id as $key => $v) {
                    if (!empty($request->attribute_id [$key])) {
                        $attribute_id = $request->attribute_id [$key];
                    } else {
                        $attribute_id = "";
                    }
                    if (!empty($request->color_id[$key])) {
                        $color_id = $request->color_id [$key];
                    } else {
                        $color_id = "";
                    }
                    $product_qty = $request->product_qty [$key];
                    $data = array(
                        'order_id' => $order_id,
                        'product_id' => $v,
//                        'attribute_id' => $request->attribute_id [$key],
//                        'color_id' => $request->color_id [$key],
                        'product_qty' => $product_qty,
                        'product_price' => $request->product_price [$key],
                        'sub_total' => $request->sub_total [$key],
                    );
                    $row = Order_detail::find($request->detail_id [$key]);
                    if (!empty($row)) {
                        Order_detail::where('id', $request->detail_id [$key])->update($data);
                    } else {
                        Order_detail::insert($data);
                    }
                    $this->decreaseQuantities($v, $product_qty);
                }
            }

//            if($order->confirm_order != 1 && $request->confirm_order !='') {
            // var_dump('sdad');
            // exit();
            //mail
            $extra = new \stdClass();
            $contact_email = $order->contact_email;
            $contact_email2 = SM::get_setting_value('email');

            if (filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
                $extra->subject = "Order Invoice id # " . SM::orderNumberFormat($order) . " Mail";
                $extra->message = $request->message;
                \Mail::to($contact_email)->queue(new InvoiceMail($order_id));
                \Mail::to($contact_email2)->queue(new InvoiceMail($order_id));
                $info['message'] = 'Mail Successfully Send';
            }
//            }
        }


        return redirect()->back()
            ->with('s_message', 'Order Update successfully!');
    }

    protected function adminApplyCoupon(Request $request)
    {
        $coupon = Coupon::Published()->where("discount_type", 3)->first();
        $shipping_method_charge = 70;
        if (!empty($coupon)) {
            if ($coupon->coupon_amount < $request->gross_amount_val) {
                $shipping_method_charge = 0;
            } else {
                $shipping_method_charge = 70;
            }
        }

        return $shipping_method_charge;
    }

    protected function decreaseQuantities($product_id, $product_qty)
    {
        $product = Product::find($product_id);
        $product->update(['product_qty' => $product->product_qty - $product_qty]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $order = Order::find($id);
        if ($order) {
            $error = 0;
            $message = '';
            if ($order->payment_status == 1) {
                $error++;
                $message = " Order payment status is completed";
            }
            if ($order->order_status == 1) {
                $error++;
                $message = ($message != '') ? ' and ' . $message : $message;
                $message .= " Order is Completed";
            }


            if ($error == 0) {
                foreach ($order->detail as $detail) {
                    $this->decreaseQuantities($detail->product_id, -$detail->product_qty);
                }
                $order->delete();
            } else {
                return response('We cannot delete order because ' . $message . "!", 422);
            }
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
//     public
//     function download($id)
//     {
//         $data["order"] = Order::with('payment', 'user', 'detail')->find($id);
// //        if ( count( $data["order"] ) > 0 ) {
//         if (!empty($data["order"])) {
//             $data["payment"] = Payment::find($data["order"]->payment_id);
//                 // return view( "pdf/invoice", $data );
//             // return view("customer/order_detail", $data);
//             $view = view("pdf/invoice", $data);
//             return PDF::loadHTML($view)
//                 ->download('durbiin_invoice_' . SM::orderNumberFormat($data["order"]) . '.pdf');
//         } else {
//             return abort(404);
//         }
//     }

public
    function download($id)
    {
        $data["order"] = Order::with('payment', 'user', 'detail')->find($id);
        
        // dd($data);
        if (!empty($data["order"])) {
            $data["payment"] = Payment::find($data["order"]->payment_id);
            
            // dd($data);
                return view( "pdf/invoice", $data );
        } else {
            return abort(404);
        }
    }


    /**
     * Order payment status update
     */
    public
    function payment_status_update(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|integer',
            'payment_status' => 'required|integer'
        ]);
        $order = Order::find($request->post_id);
        if ($order) {
            if (!($request->payment_status == 1 && $order->grand_total > $order->paid)) {
                $order->payment_status = $request->payment_status;
                $order->update();

                return response(1, 200);
            } else {
                return response()->json(['errors' => ['payment_status' => ['Order Payment Can not complete because you have a due.']]], 422);
            }
        } else {
            return response()->json(['errors' => ['payment_status' => ['Order Not Found']]], 404);
        }
    }

    /**
     * Order payment info update
     */
    // public
    // function payment_info_update(Request $request)
    // {
    //     $this->validate($request, [
    //         'order_id' => 'required|integer',
    //         'payment_status' => 'required|integer',
    //         'pay' => 'required|numeric'
    //     ]);
    //     $order = Order::find($request->order_id);
    //     if ($order) {
    //         $order->paid += (float)$request->pay;
    //         $due = $order->grand_total - $order->paid;
    //         if ($due <= 0) {
    //             $order->payment_status = $request->payment_status;
    //             $info['hasError'] = 0;
    //             $info['message'] = 'Payment status update completed.';
    //         } else {
    //             $order->payment_status = 2;
    //             $info['hasError'] = 1;
    //             $info['message'] = 'Payment status cannot update to complete because you have a due $' . $due .
    //                 '\nYou paid total $' . $order->paid;
    //         }
    //         $due *= (-1);
    //         $dueSign = $due < 0 ? "-" : "+";
    //         $dueSign = $due == 0 ? "" : $dueSign;
    //         $info['due'] = $dueSign . " $" . abs(number_format($due, 2));
    //         $order->update();
    //         $info['order'] = $order;

    //         return response($info, 200);

    //     } else {
    //         return response()->json(['errors' => ['payment_status' => ['Order Not Found']]], 404);
    //     }
    // }
    
     public
    function payment_info_update(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required|integer',
            'payment_status' => 'required|integer',
            'pay' => 'required|numeric'
        ]);
        $order = Order::find($request->order_id);
        if ($order) {
            if(($request->pay+$order->paid) <= $order->grand_total)
            {
               $order->paid += (float)$request->pay;
               $due = $order->grand_total - $order->paid;
                if ($due <= 0) {
                    $order->payment_status = $request->payment_status;
                    $info['hasError'] = 0;
                    $info['message'] = 'Payment status update completed.';
                } else {
                    $order->payment_status = 2;
                    $info['hasError'] = 1;
                    // $info['message'] = 'Payment status cannot update to complete because you have a due $' . $due .
                    // '\nYou paid total $' . $order->paid;
                    $info['message'] = 'Payment status update completed.';
                }

            }else{
                $info['hasError'] = 1;
                $info['message'] = 'must be less then total';
            }
        $due *= (-1);
        $dueSign = $due < 0 ? "-" : "+";
        $dueSign = $due == 0 ? "" : $dueSign;
        $info['due'] = $dueSign . " $" . abs(number_format($due, 2));
        $order->update();
        $info['order'] = $order;
        return response($info, 200);

    } else {
        return response()->json(['errors' => ['payment_status' => ['Order Not Found']]], 404);
    }
}

    
    

    /**
     * Order payment status update
     */
    public
    function order_status_update(Request $request)
    {
        $this->validate($request, [
            'post_id' => 'required|integer',
            'order_status' => 'required|integer'
        ]);
        $order = Order::find($request->post_id);
        if ($order) {
            if (!($request->order_status == 1 && $order->grand_total > $order->paid)) {
                $order->order_status = $request->order_status;
                $order->update();

                return response(1, 200);
            } else {
                return response()->json(['errors' => ['order_status' => ['Order Payment Can not complete because you have a due.']]], 422);
            }
        } else {
            return response()->json(['errors' => ['order_status' => ['Order Not Found.']]], 404);
        }
    }

    /**
     * Order payment status update
     */
    public
    function order_info_update(Request $request)
    {
        
        $this->validate($request, [
            'order_id' => 'required|integer',
            'order_status' => 'required|integer',
            'pay' => 'required|numeric',
            'message' => 'required'
        ]);

        $order = Order::find($request->order_id);

        if ($order) {
            $info['filesHtml'] = '';
            if (trim($request->image) != '') {
                if (trim($order->completed_files) != '') {
                    $order->completed_files .= ',' . $request->image;
                } else {
                    $order->completed_files = $request->image;
                }
                $filesArray = explode(',', $order->completed_files);
                $files = Media::whereIn('slug', $filesArray)->get();

                if (count($files) > 0) {
                    foreach ($files as $fl) {
                        $img = SM::sm_get_galary_src_data_img($fl->slug, $fl->is_private == 1 ? true : false);
                        $src = $img['src'];
                        $info['filesHtml'] .= '<a href="' . url(SM::smAdminSlug('media/download/' . $fl->id)) . '" title="Download ' . $fl->title . '">
													<img src="' . $src . '"
                                                     caption="' . $fl->caption . '" description="' . $fl->description . '"
                                                     class="orderFile" width="50"></a>';

                        $permission = Media_permissions::where('media_id', $fl->id)->where('user_id', $order->user_id)->first();
                        if (!$permission) {
                            $permission = new Media_permissions();
                            $permission->media_id = $fl->id;
                            $permission->user_id = $order->user_id;
                            $permission->save();
                        }
                    }
                }
            }

            $order->paid += (float)$request->pay;
            $due = $order->grand_total - $order->paid;
            if ($due <= 0) {
                $order->order_status = $request->order_status;
                $info['hasError'] = 0;
                $info['message'] = 'Order completed successfully';
            } else {
                $order->payment_status = 2;
                $info['hasError'] = 1;
                $info['message'] = 'Order status cannot update to complete because you have a due $' . $due .
                    '\nYou paid total $' . $order->paid;
            }
            $due *= (-1);
            $dueSign = $due < 0 ? "-" : "+";
            $dueSign = $due == 0 ? "" : $dueSign;
            $info['due'] = $dueSign . " $" . abs(number_format($due, 2));
            $order->update();
            $info['order'] = $order;


            //mail
            $contact_email = $order->contact_email;
            
            if (filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
                $extra = new \stdClass();
                
                $extra->message = $request->message;
            
                // $dd = \Mail::to($contact_email)->queue(new InvoiceMail($order->id, $extra));
         
                $info['message'] .= 'And Mail Successfully Send';
                
            }
            $info['message'] .= '!';
            
            return response()->json($info, 200);
        } else {
            return response()->json(['errors' => ['order_status' => ['Order Not Found.']]], 404);
        }
    }

    /**
     * Order Mail
     */
    public
    function order_mail(Request $request)
    {
        $this->validate($request, [
            'order_id' => 'required|integer',
            'message' => 'required'
        ]);
        $order = Order::with('user')
            ->find($request->order_id);
        if ($order) {
            $info['filesHtml'] = '';

            $extra = new \stdClass();
            if (trim($request->order_image) != '') {
                if (trim($order->completed_files) != '') {
                    $order->completed_files .= ',' . $request->order_image;
                } else {
                    $order->completed_files = $request->order_image;
                }
                $filesArray = explode(',', $order->completed_files);
                $files = Media::whereIn('slug', $filesArray)->get();

                if (count($files) > 0) {
                    $extra->files = $files;
                    foreach ($files as $fl) {
                        $img = SM::sm_get_galary_src_data_img($fl->slug, $fl->is_private == 1 ? true : false);
                        $src = $img['src'];
                        $info['filesHtml'] .= '<a href="' . url(SM::smAdminSlug('media/download/' . $fl->id)) . '" title="Download ' . $fl->title . '">
													<img src="' . $src . '"
                                                     caption="' . $fl->caption . '" description="' . $fl->description . '"
                                                     class="orderFile" width="50"></a>';

                        if ($fl->is_private == 1) {
                            $permission = Media_permissions::where('media_id', $fl->id)
                                ->where('user_id', $order->user_id)
                                ->first();
                            if (!$permission) {
                                $permission = new Media_permissions();
                                $permission->media_id = $fl->id;
                                $permission->user_id = $order->user_id;
                                $permission->save();
                            }
                        }
                    }
                }
            }

            //mail
            $contact_email = $order->contact_email;
            if (filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
                $extra->subject = "Order Invoice id # " . SM::orderNumberFormat($order) . " Mail";
                $extra->message = $request->message;
                \Mail::to($contact_email)->queue(new NormalMail($extra));
                $info['message'] = 'Mail Successfully Send';
            }
            $info['message'] .= '!';

            return response()->json($info, 200);
        } else {
            return response()->json(['errors' => ['order_status' => ['Order Not Found.']]], 404);
        }
    }
}
