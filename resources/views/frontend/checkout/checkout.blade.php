@extends('frontend.master')
@section('title', 'Shiping Address')
@section('content')
    <?php
    $shipping_method_charge = Session::get('shipping_method.method_charge');
    $shipping_method_name = Session::get('shipping_method.method_name');
    $coupon_code = Session::get('coupon.coupon_code');
    $coupon_amount = Session::get('coupon.coupon_amount');
    $net_sub_total = $sub_total + $tax + $shipping_method_charge - $noraml_discount_amount;
    $grand_total = $sub_total + $tax + $shipping_method_charge - $coupon_amount - $noraml_discount_amount;

    ?>
    <section class="checkout_page_section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb_section">
                        <div class="total-cat-item">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ URL::to('/')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Checkout</a></li>
                                <li class="breadcrumb-item">
                                    <a href="javascript:void(0)">
                                        @if(session('step')==0)
                                            Shipping & Billing Address
                                        @elseif(session('step')==1)
                                            Shipping Methods
                                        @elseif(session('step')==2)
                                            Order Detail
                                        @endif

                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="shipping_address_checkout">
                        <div class="shipping-address-box">
                            <h4>Fill out your information</h4>
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item ckeckout-tabs @if(session('step')==0) active @endif">
                                    <a class="nav-link @if(session('step')==0) active @elseif(session('step')>0) active-check @endif"
                                       id="shipping-tab" data-toggle="pill" href="#pills-shipping" role="tab"
                                       aria-controls="pills-shpping"
                                       aria-expanded="true">
                                       <i class="fa fa-map-marker"></i>
                                       Shipping & Billing Address
                                    </a>
                                </li>
                                <li class="nav-item ckeckout-tabs @if(session('step')==1) active @endif">
                                    <a class="nav-link @if(session('step')==1) active @elseif(session('step')>1) active-check @endif"
                                       @if(session('step')>=1)  id="shipping-methods-tab" data-toggle="pill"
                                       href="#pills-shipping-methods" role="tab" aria-controls="pills-shipping-methods"
                                       aria-expanded="true" @endif>
                                       <i class="fa fa-credit-card-alt"></i>
                                       Shipping Methods
                                    </a>
                                </li>
                                <li class="nav-item ckeckout-tabs @if(session('step')==2) active @endif">
                                    <a class="nav-link @if(session('step')==2) active @elseif(session('step')>2) active-check @endif"
                                       @if(session('step')>=2)  id="order-tab" data-toggle="pill" href="#pills-order"
                                       role="tab" aria-controls="pills-order"
                                       aria-expanded="true" @endif>
                                       <i class="fa fa-shopping-bag"></i>
                                       Order Detail
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade @if(session('step') == 0) active in @endif"
                                     id="pills-shipping"
                                     role="tabpanel" aria-labelledby="shipping-tab">
                                    @include('frontend.checkout.shipping_address')
                                </div>
                                <div class="tab-pane fade @if(session('step') == 1) active in @endif"
                                     id="pills-shipping-methods"
                                     role="tabpanel" aria-labelledby="shipping-tab">
                                    @include('frontend.checkout.shipping_method')
                                </div>
                                <div class="tab-pane fade @if(session('step') == 2) active in @endif"
                                     id="pills-order"
                                     role="tabpanel" aria-labelledby="billing-tab">
                                    {!! Form::open(['method'=>'post', 'url'=>'place_order', 'id'=>'place_order']) !!}
                                    <div class="order-review">
                                        @include('frontend.checkout.order_review')
                                    </div>
                                    @include('frontend.checkout.order_note_summary')

                                    <input type="hidden" name="shipping_method_name"
                                           value="{{ $shipping_method_name }}">
                                    <input type="hidden" name="shipping_method_charge"
                                           value="{{ $shipping_method_charge }}">
                                    <input type="hidden" name="sub_total" value="{{ $sub_total }}">
                                    <input type="hidden" name="discount" value="{{ $noraml_discount_amount }}">
                                    <input type="hidden" name="tax" value="{{ $tax }}">
                                    <input type="hidden" name="coupon_code" class="coupon_code"
                                           value="{{ $coupon_code }}">
                                    <input type="hidden" name="coupon_amount" class="coupon_amount"
                                           value="{{ $coupon_amount }}">
                                    <input type="hidden" name="grand_total" class="grand_total"
                                           value="{{ $grand_total }}">
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('frontend.checkout.sidebar', ['net_sub_total'=>$net_sub_total])
            </div>
        </div>
    </section>
@endsection