<?php

namespace App\Http\Controllers\Front;

use App\Mail\InvoiceMail;
use App\Mail\NormalMail;
use App\Model\Common\Category;
use App\Model\Common\Coupon;
use App\Model\Common\Order;
use App\Model\Common\Order_detail;
use App\Model\Common\Orderaddress;
use App\Model\Common\Shipping;
use App\Model\Common\Payment_method;
use App\Model\Common\Product;
use App\Model\Common\ShippingMethod;
use App\Model\Common\Tax;
use App\SM\SM;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{

    public function viewcart()
    {
        $result['activeMenu'] = 'dashboard';
        $result['cart'] = Cart::instance('cart')->content();

        return view('frontend.checkout.viewcart', $result);
    }

    public function checkout()
    {
        $data["sub_total"] = Cart::instance('cart')->subTotal();

        $noraml_discount = Coupon::Published()->where('discount_type', 1)->where('validity', '>=', Carbon::now()->toDateString())->first();
        if (count($noraml_discount) > 0) {
            if ($noraml_discount->type == 1) {
                $data["noraml_discount_amount"] = $noraml_discount->coupon_amount;
                $data["discount_amount"] = 0;
            } elseif ($noraml_discount->type == 2) {
                $data["noraml_discount_amount"] = $data["sub_total"] * $noraml_discount->coupon_amount / 100;
                $data["discount_amount"] = $noraml_discount->coupon_amount;
            } else {
                $data["noraml_discount_amount"] = 0;
            }
        } else {
            $data["noraml_discount_amount"] = 0;
        }
        $more_then = Coupon::Published()->where('discount_type', 3)->where('validity', '>=', Carbon::now()->toDateString())->first();
        $data['more_then_discount_amount'] = 0;
        if (count($more_then)) {
            if ($data["sub_total"] > $more_then->coupon_amount) {
                $data['more_then_discount_amount'] = 1;
            }
        }
        $data["cart"] = Cart::instance('cart')->content();
        if (count($data["cart"]) > 0) {
            if (empty(session('step'))) {
                session(['step' => '0']);
            }
            $data['shipping_methods'] = ShippingMethod::Published()->get();
            $data['payment_methods'] = Payment_method::Published()->get();
            $data["sub_total"] = Cart::instance('cart')->subTotal();
//        -----------tax-------------
            $data['is_tax_enable'] = SM::get_setting_value("is_tax_enable", 1);

            $data['default_tax'] = SM::get_setting_value("default_tax", 1);
            $data['default_tax_type'] = SM::get_setting_value("default_tax_type", 1);
            if ($data['is_tax_enable'] == 1 && Auth::check() && Session::get('shipping.country') != '') {
                $taxInfo = Tax::where("country", Session::get('shipping.country'))->first();
                if (!empty($taxInfo)) {
//                if (count($taxInfo) > 0) {
                    if ($taxInfo->type == 1) {
                        $tax = $taxInfo->tax;
                    } else {
                        $tax = $data["sub_total"] * $taxInfo->tax / 100;
                    }
                } else {
                    if ($data['default_tax_type'] == 1) {
                        $tax = (float)$data['default_tax'];
                    } else {
                        $tax = (float)$data['default_tax'] * $taxInfo->tax / 100;
                    }
                }
                $data['tax'] = $tax;
            } else {
                $data['tax'] = 0;
            }
            return view('frontend.checkout.checkout', $data);
        } else {
            return redirect('/shop')->with('s_message', "Please Order First...!");
        }
    }

    public function shippingMethod()
    {
        $data["userInfo"] = Auth::user();
        $data["shippingInfo"] = Auth::user()->shipping;
        $data['shipping_methods'] = ShippingMethod::Published()->get();
    }

    public function checkout_shipping_address(Request $request)
    {
        if (session('step') == '0') {
            session(['step' => '1']);
        }

        $shipping["firstname"] = $request->firstname;
        $shipping["lastname"] = $request->lastname;
        $shipping["mobile"] = $request->mobile;
        $shipping["company"] = $request->company;
        $shipping["address"] = $request->address;
        $shipping["country"] = $request->country;
        $shipping["state"] = $request->state;
        $shipping["city"] = $request->city;
        $shipping["zip"] = $request->zip;
        Session::put("shipping", $shipping);
        return redirect()->back();
    }

    //checkout_billing_address
    public function checkout_billing_address(Request $request)
    {
        if (session('step') == '1') {
            session(['step' => '2']);
        }

        $billing["billing_firstname"] = $request->billing_firstname;
        $billing["billing_lastname"] = $request->billing_lastname;
        $billing["billing_mobile"] = $request->billing_mobile;
        $billing["billing_company"] = $request->billing_company;
        $billing["billing_address"] = $request->billing_address;
        $billing["billing_country"] = $request->billing_country;
        $billing["billing_state"] = $request->billing_state;
        $billing["billing_city"] = $request->billing_city;
        $billing["billing_zip"] = $request->billing_zip;
        $billing["billing_same_address"] = $request->billing_same_address;
        Session::put("billing", $billing);
        return redirect()->back();
    }

    public function saveShippingMethod(Request $request)
    {
        $this->validate($request, [
            'shipping_method' => 'required',
        ]);
    }

    //checkout_shipping_method
    public function checkout_shipping_method(Request $request)
    {
        if (session('step') == '2') {
            session(['step' => '3']);
        }
        $shipping_data = ShippingMethod::find($request->shipping_method);
        $shipping_method["method_name"] = $shipping_data->title;
        $shipping_method["method_charge"] = $shipping_data->charge;
        Session::put("shipping_method", $shipping_method);
        return redirect()->back();
    }

    public function couponCheck(Request $request)
    {
        $this->validate($request, ['coupon_code' => 'required']);
        $sub_total_price = $request->sub_total_price;

        $coupon = Coupon::Published()->where("discount_type", 2)->where("coupon_code", $request->coupon_code)->first();


//        if (count($coupon) > 0) {
        if (!empty($coupon)) {
            if (!empty(Session::get('coupon.coupon_code'))) {
                $response['check_coupon'] = 0;
                $response['title'] = 'Coupon Already exits!';
                $response['message'] = 'Description';
                return response()->json($response);
            } else {
                $validity = $coupon->validity;
                $balance_qty = $coupon->balance_qty;
                $response["couponCode"] = $request->couponCode;
                if ($balance_qty > 0) {
                    if ($validity >= Carbon::now()->toDateString()) {
                        if ($coupon->type == 1) {
                            $response["id"] = $coupon->id;
                            $response["coupon_code"] = $coupon->coupon_code;
                            $response["coupon_amount"] = $coupon->coupon_amount;
                            $response["type"] = $coupon->type;
                            Session::put("coupon", $response);
                            Session::save();
                            unset($response["id"]);
                            $update_qty = $balance_qty - 1;

                            Coupon::where("coupon_code", $request->coupon_code)
                                ->update(['balance_qty' => $update_qty]);

                        } else {
                            $response["id"] = $coupon->id;
                            $response["coupon_code"] = $coupon->coupon_code;
                            $response["coupon_amount"] = $sub_total_price * $coupon->coupon_amount / 100;
                            $response["type"] = $coupon->type;
                            Session::put("coupon", $response);
                            Session::save();
                            unset($response["id"]);
                            $update_qty = $balance_qty - 1;
                            Coupon::where("coupon_code", $request->coupon_code)
                                ->update(['balance_qty' => $update_qty]);
                        }
                        $response['check_coupon'] = 1;
                        $response['title'] = 'Coupon Successfully Applied!';
                        $response['message'] = 'Description';
                        $response['coupon_amount'] = Session::get('coupon.coupon_amount');
                        $response['grand_total'] = $sub_total_price - Session::get('coupon.coupon_amount');

                        return response()->json($response);
                    } else {
                        $response['check_coupon'] = 0;
                        $response['title'] = 'Coupon Validity Expired!';
                        $response['message'] = 'Description';
                        return response()->json($response);
                    }
                } else {
                    $response['check_coupon'] = 0;
                    $response['title'] = 'Coupon Qty limit over';
                    $response['message'] = 'Description';
                    return response()->json($response);
                }

            }
        } else {
            $response['check_coupon'] = 0;
            $response['title'] = 'Coupon Not Found!';
            $response['message'] = 'Description';
            return response()->json($response);
        }
    }

    public function orderDetail()
    {
        $data["sub_total"] = Cart::instance('cart')->subTotal();

//        $data["amount"] = Cart::instance('cart')->subTotal();

        $data['is_tax_enable'] = SM::get_setting_value("is_tax_enable", 1);
        $data['default_tax'] = SM::get_setting_value("default_tax", 1);
        $data['default_tax_type'] = SM::get_setting_value("default_tax_type", 1);
        $data['packageInfo'] = array();

        if ($data['is_tax_enable'] == 1 && Auth::check() && Auth::user()->country != '') {
            $taxInfo = Tax::where("country", Auth::user()->country)->first();

            if (!empty($taxInfo)) {
//                if (count($taxInfo) > 0) {
                if ($taxInfo->type == 1) {
                    $tax = $taxInfo->tax;
                } else {
                    $tax = $data["sub_total"] * $taxInfo->tax / 100;
                }
            } else {
                if ($data['default_tax_type'] == 1) {
                    $tax = (float)$data['default_tax'];
                } else {
                    $tax = (float)$data['default_tax'] * $taxInfo->tax / 100;
                }
            }
            $data['tax'] = $tax;
        } else {
            $data['tax'] = 0;
        }

        $data['activeMenu'] = 'dashboard';
        $data['payment_methods'] = Payment_method::Published()->get();
        $data["cart"] = Cart::instance('cart')->content();

        return view('frontend.checkout.order_detail', $data);
    }

    public function placeOrder(Request $request)
    {
        // Check race condition when there are less items available to purchase
        if ($this->productsAreNoLongerAvailable()) {
            return redirect('/shop')->with('w_message', "Sorry! One of the items in your cart is no longer avialble.");
        }

        if ($request->isMethod('post')) {
//            $this->validate($request, [
//                'firstname' => 'required',
//                'lastname' => 'required',
//                'address' => 'required',
//                'city' => 'required',
//                'zip' => 'required',
//                'state' => 'required',
//                'country' => 'required',
//                'mobile' => 'required|max:255|unique:users',
//            ]);
            if (!empty($request->coupon_amount)) {
                $coupon_amount = $request->coupon_amount;
            } else {
                $coupon_amount = 0;
            }
            $shipping = Session::get("shipping");
            $billing = Session::get("billing");
            $user = Auth::user();
            $name = $shipping["firstname"] . ' ' . $shipping["lastname"];
            $user->firstname = $shipping["firstname"];
            $user->lastname = $shipping["lastname"];
            $user->mobile = $shipping["mobile"];
            $user->company = $shipping["company"];
            $user->address = $shipping["address"];
            $user->country = $shipping["country"];
            $user->state = $shipping["state"];
            $user->city = $shipping["city"];
            $user->zip = $shipping["zip"];
            $user->billing_firstname = $billing["billing_firstname"];
            $user->billing_lastname = $billing["billing_lastname"];
            $user->billing_mobile = $billing["billing_mobile"];
            $user->billing_company = $billing["billing_company"];
            $user->billing_address = $billing["billing_address"];
            $user->billing_country = $billing["billing_country"];
            $user->billing_state = $billing["billing_state"];
            $user->billing_city = $billing["billing_city"];
            $user->billing_zip = $billing["billing_zip"];
            $user->update();
            $cartProducts = Cart::instance('cart')->content();
            $user_id = Auth::id();
            $user_email = Auth::user()->email;

            $last_order_id = Order::select('id')->latest('id')->limit(1)->first();
            if (!empty($last_order_id)) {
                $invoice_no = sprintf("%04d", $last_order_id->id + 1);
            } else {
                $invoice_no = sprintf("%04d", 1);
            }

            $order = new Order;
            if ($request->payment_method_id == 6) {
                Session::put('invoice_no', $invoice_no);
                Session::put('grand_total', $request->grand_total);
                Session::put('tax', $request->tax);
                Session::put('coupon_code', $request->coupon_code);
                Session::put('coupon_amount', $coupon_amount);
                Session::put('payment_method_id', $request->payment_method_id);
                Session::put('order_note', $request->order_note);
                $tran_id = 'buckelup-' . rand(10000, 20000);
                Session::put('tran_id', $tran_id);
                Session::put('shipping_method_charge', $request->shipping_method_charge);
                Session::put('shipping_method_name', $request->shipping_method_name);

                Session::put('sub_total', $request->sub_total);
                $url = 'https://securepay.easypayway.com/payment/request.php';
                $fields = array(
                    'store_id' => 'buckelup',
                    'amount' => '1',
                    'payment_type' => 'VISA',
                    'currency' => 'BDT',
                    'tran_id' => $tran_id,
                    'cus_name' => $name,
                    'cus_email' => $user_email,
                    'cus_add1' => $shipping["address"],
                    'cus_add2' => $billing["billing_address"],
                    'cus_city' => $billing["billing_city"],
                    'cus_state' => $billing["billing_state"],
                    'cus_postcode' => $billing["billing_zip"],
                    'cus_country' => 'Bangladesh',
                    'cus_phone' => $shipping["mobile"],
                    'cus_fax' => 'Not-Applicable',
                    'ship_name' => $name,
                    'ship_add1' => $shipping["address"],
                    'ship_add2' => $shipping["address"],
                    'ship_city' => $shipping["city"],
                    'ship_state' => $shipping["state"],
                    'ship_postcode' => $shipping["zip"],
                    'ship_country' => 'Bangladesh',
                    'desc' => 'Products',
                    'success_url' => url('/easypaywaySuccess'),
                    'fail_url' => url('/order-fail'),
                    'cancel_url' => url('/order-fail'),
                    'opt_a' => 'Optional Value A',
                    'opt_b' => 'Optional Value B',
                    'opt_c' => 'Optional Value C',
                    'opt_d' => 'Optional Value D',
                    'signature_key' => '6e1c769e1a768ef65d610bea66897c35'
                );

//
                $domain = $_SERVER["SERVER_NAME"]; // or Manually put your domain name
                $ip = $_SERVER["SERVER_ADDR"];
                $fields_string = '';
//url-ify the data for the POST
                foreach ($fields as $key => $value) {
                    $fields_string .= $key . '=' . $value . '&';
                }
                rtrim($fields_string, '&');
//open connection
                $ch = curl_init();
//set the url, number of POST vars, POST data
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("REMOTE_ADDR: $ip", "HTTP_X_FORWARDED_FOR: $ip"));
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_REFERER, $domain);
                curl_setopt($ch, CURLOPT_INTERFACE, $ip);
                curl_setopt($ch, CURLOPT_POST, count($fields));
                curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//execute post
                $result = curl_exec($ch);
                $url_forward = json_decode($result, true);

//close connection
                curl_close($ch);
                return redirect($url_forward);
            }

//            $cookie_name = 'countryCurrency';
//            if (isset($_COOKIE[$cookie_name])) {
//                $cooki_val = $_COOKIE[$cookie_name];
//                $get_currency = DB::table('countries')
//                    ->where('id', $cooki_val)
//                    ->first();
//                if (SM::get_setting_value('currency') != $cooki_val) {
//                    $orderCurrency = $cooki_val;
//                    $currencyRate = $get_currency->currency_rate;
//                    $currency_symbol = $get_currency->currency_symbol;
//
//                } else {
//                    $currencyRate = 0;
//                    $orderCurrency = SM::get_setting_value('currency');
//                    $currency_symbol = $get_currency->currency_symbol;
//
//                }
//            } else {
//                $get_currency = DB::table('countries')
//                    ->where('id', SM::get_setting_value('currency'))
//                    ->first();
//
//                $currency_symbol = $get_currency->currency_symbol;
//
//                $currencyRate = 0;
//                $orderCurrency = SM::get_setting_value('currency');
//            }

            $get_currency = DB::table('countries')
                ->where('id', SM::get_setting_value('currency'))
                ->first();

            $currency_symbol = $get_currency->currency_symbol;

            $currencyRate = 0;
            $orderCurrency = SM::get_setting_value('currency');


            $order->user_id = $user_id;
            $order->invoice_no = $invoice_no;
            $order->contact_email = $user_email;
            $order->customer_name = $name;
            $order->create_date = Carbon::now()->toDateString();
            $order->cart_json = json_encode($cartProducts);
            $order->coupon_code = $request->coupon_code;
            $order->gross_amount = $request->sub_total;
            $order->discount = $request->discount;
            $order->tax = $request->tax;
            $order->currency = $orderCurrency;
            $order->currencyRate = $currencyRate;
            $order->currency_symbol = $currency_symbol;
            $order->baseCurrency = SM::get_setting_value('currency');
            $order->coupon_amount = $coupon_amount;
            $order->grand_total = $request->grand_total;
            $order->payment_method_id = $request->payment_method_id;
            $order->shipping_method_charge = $request->shipping_method_charge;
            $order->shipping_method_name = $request->shipping_method_name;
            $order->order_note = $request->order_note;
            $order->order_status = 3;
//            $order->created_by = SM::current_user_id();
            if ($order->save()) {
                $order_id = $order->id;
                $order_address = new Orderaddress();
                $order_address->order_id = $order_id;
                $order_address->firstname = $shipping["firstname"];
                $order_address->lastname = $shipping["lastname"];
                $order_address->mobile = $shipping["mobile"];
                $order_address->company = $shipping["company"];
                $order_address->address = $shipping["address"];
                $order_address->country = $shipping["country"];
                $order_address->state = $shipping["state"];
                $order_address->city = $shipping["city"];
                $order_address->zip = $shipping["zip"];
                $order_address->billing_firstname = $billing["billing_firstname"];
                $order_address->billing_lastname = $billing["billing_lastname"];
                $order_address->billing_mobile = $billing["billing_mobile"];
                $order_address->billing_company = $billing["billing_company"];
                $order_address->billing_address = $billing["billing_address"];
                $order_address->billing_country = $billing["billing_country"];
                $order_address->billing_state = $billing["billing_state"];
                $order_address->billing_city = $billing["billing_city"];
                $order_address->billing_zip = $billing["billing_zip"];
                $order_address->save();
                foreach ($cartProducts as $pro) {
                    $cartPro = new Order_detail;
                    $cartPro->order_id = $order_id;
                    $cartPro->product_id = $pro->id;
                    $cartPro->product_color = $pro->options->colorname;
                    $cartPro->product_size = $pro->options->sizename;
                    $cartPro->product_image = $pro->options->image;
                    $cartPro->product_price = $pro->price;
                    $cartPro->product_qty = $pro->qty;
                    $cartPro->sub_total = $pro->price * $pro->qty;
                    $cartPro->save();
                }
                // decrease the quantities of all the products in the cart
                $this->decreaseQuantities();
            }
            Session::forget('step');
            Session::forget('shipping');
            Session::forget('billing');
            Session::forget('shipping_method');
            Session::forget('coupon');
            Cart::instance('cart')->destroy();
            Session::put('order_id', $order_id);
            Session::put('grand_total', $request->grand_total);

            //mail
            $extra = new \stdClass();
            $contact_email = $order->contact_email;
            $contact_email2 = SM::get_setting_value('email');
            $contact_email3 = 'sumaiya.minnat@gmail.com';

            if (filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
                $extra->subject = "Order Invoice id # " . SM::orderNumberFormat($order) . " Mail";
//                $extra->message = $request->message;
                \Mail::to($contact_email)->queue(new InvoiceMail($order_id));
                \Mail::to($contact_email2)->queue(new InvoiceMail($order_id));
                \Mail::to($contact_email3)->queue(new InvoiceMail($order_id));
                $info['message'] = 'Mail Successfully Send';
            }
            return redirect('/dashboard/orders/detail/' . $order_id)->with('s_message', "Ordered Successfully!");
        }
        return redirect('/order-success')->with('s_message', "Ordered Successfully!");
    }

    public function easypaywaySuccess()
    {
        $shipping = Session::get("shipping");
        $billing = Session::get("billing");
        $user = Auth::user();
        $name = $shipping["firstname"] . ' ' . $shipping["lastname"];
        $user->firstname = $shipping["firstname"];
        $user->lastname = $shipping["lastname"];
        $user->mobile = $shipping["mobile"];
        $user->company = $shipping["company"];
        $user->address = $shipping["address"];
        $user->country = $shipping["country"];
        $user->state = $shipping["state"];
        $user->city = $shipping["city"];
        $user->zip = $shipping["zip"];
        $user->billing_firstname = $billing["billing_firstname"];
        $user->billing_lastname = $billing["billing_lastname"];
        $user->billing_mobile = $billing["billing_mobile"];
        $user->billing_company = $billing["billing_company"];
        $user->billing_address = $billing["billing_address"];
        $user->billing_country = $billing["billing_country"];
        $user->billing_state = $billing["billing_state"];
        $user->billing_city = $billing["billing_city"];
        $user->billing_zip = $billing["billing_zip"];
        $user->update();
        $cartProducts = Cart::instance('cart')->content();
        $user_id = Auth::id();
        $user_email = Auth::user()->email;
        $tran_id = Session::get('tran_id');
        $url = 'https://securepay.easypayway.com/api/v1/trxcheck/request.php?request_id="' . $tran_id . '"&store_id=buckelup&signature_key=6e1c769e1a768ef65d610bea66897c35&type=json';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        $headers = array();
        $headers[] = "Key: Value";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $data = json_decode($result, true);

        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close($ch);
        if ($data['pay_status'] == 'Successful') {
            $order = new Order;
            $order->user_id = $user_id;
            $order->invoice_no = Session::get('invoice_no');
            $order->contact_email = $user_email;
            $order->create_date = Carbon::now()->toDateString();
            $order->cart_json = json_encode($cartProducts);
            $order->coupon_code = Session::get('coupon_code');
            $order->gross_amount = Session::get('sub_total');
            $order->tax = Session::get('tax');
            $order->coupon_amount = Session::get('coupon_amount');
            $order->grand_total = Session::get('grand_total');
            $order->payment_method_id = Session::get('payment_method_id');
            $order->shipping_method_charge = Session::get('shipping_method_charge');
            $order->shipping_method_name = Session::get('shipping_method_name');
            $order->order_note = Session::get('order_note');
            $order->order_status = 3;
//            $order->created_by = SM::current_user_id();
            if ($order->save()) {
                $order_id = $order->id;
                $order_address = new Orderaddress();
                $order_address->order_id = $order_id;
                $order_address->firstname = $shipping["firstname"];
                $order_address->lastname = $shipping["lastname"];
                $order_address->mobile = $shipping["mobile"];
                $order_address->company = $shipping["company"];
                $order_address->address = $shipping["address"];
                $order_address->country = $shipping["country"];
                $order_address->state = $shipping["state"];
                $order_address->city = $shipping["city"];
                $order_address->zip = $shipping["zip"];
                $order_address->billing_firstname = $billing["billing_firstname"];
                $order_address->billing_lastname = $billing["billing_lastname"];
                $order_address->billing_mobile = $billing["billing_mobile"];
                $order_address->billing_company = $billing["billing_company"];
                $order_address->billing_address = $billing["billing_address"];
                $order_address->billing_country = $billing["billing_country"];
                $order_address->billing_state = $billing["billing_state"];
                $order_address->billing_city = $billing["billing_city"];
                $order_address->billing_zip = $billing["billing_zip"];
                $order_address->save();

                foreach ($cartProducts as $pro) {
                    $cartPro = new Order_detail;
                    $cartPro->create_date = $order->create_date;
                    $cartPro->order_id = $order_id;
                    $cartPro->product_id = $pro->id;
                    $cartPro->product_color = $pro->options->colorname;
                    $cartPro->product_size = $pro->options->sizename;
                    $cartPro->product_price = $pro->price;
                    $cartPro->product_qty = $pro->qty;
                    $cartPro->sub_total = $pro->price * $pro->qty;
                    $cartPro->save();
                }

                // decrease the quantities of all the products in the cart
                $this->decreaseQuantities();
            }
            //mail
            $extra = new \stdClass();
            $contact_email = $order->contact_email;
            $contact_email2 = SM::get_setting_value('email');
//            $contact_email3 = 'nextpagetl@gmail.com';
            $contact_email3 = 'sumaiya.minnat@gmail.com';

            if (filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
                $extra->subject = "Order Invoice id # " . $order->invoice_no . " Mail";
//                $extra->message = $request->message;
                \Mail::to($contact_email)->queue(new InvoiceMail($order_id));
                \Mail::to($contact_email2)->queue(new InvoiceMail($order_id));
                \Mail::to($contact_email3)->queue(new InvoiceMail($order_id));
                $info['message'] = 'Mail Successfully Send';
            }
            Session::forget('step');
            Session::forget('shipping');
            Session::forget('billing');
            Session::forget('shipping_method');
            Session::forget('coupon');
            Cart::instance('cart')->destroy();
            Session::forget('coupon_code');
            Session::forget('sub_total');
            Session::forget('tax');
            Session::forget('coupon_amount');
            Session::forget('grand_total');
            Session::forget('payment_method_id');
            Session::forget('order_note');
            Session::forget('tran_id');
            return redirect('/order-success')->with('s_message', "Order Placed Successfully!");
        } else {
            return redirect('/order-success')->with('w_message', "Order Payment Failed!");
        }
    }

    protected function decreaseQuantities()
    {
        foreach (Cart::instance('cart')->content() as $item) {
            $product = Product::find($item->id);
            $product->update(['product_qty' => $product->product_qty - $item->qty]);
        }
    }

    protected function productsAreNoLongerAvailable()
    {
        foreach (Cart::instance('cart')->content() as $item) {
            $product = Product::find($item->id);
            if ($product->product_qty < $item->qty) {
                return true;
            }
        }
        return false;
    }

    public function orderSuccess()
    {
        return view('frontend.checkout.order_success');
    }

    public function orderFail()
    {

        return view('frontend.checkout.order_fail');
    }

}
