@extends('frontend.master')
@section('title', 'Cart')
@section('content')
<?php

    $shipping_method_charge = Session::get('shipping_method.method_charge');
    $shipping_method_name = Session::get('shipping_method.method_name');
    $coupon_code = Session::get('coupon.coupon_code');
    $coupon_amount = Session::get('coupon.coupon_amount');
    $net_sub_total = Cart::instance('cart')->total()  + $shipping_method_charge;
    $grand_total = Cart::instance('cart')->total()  + $shipping_method_charge - $coupon_amount;

    ?>
    <section class="cart_section_page">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="all-books-content">
                        <div class="total-cat-item">
                            <h3>My Cart (<span class="cart_item_count">{{ count($cart) }}</span> Items) <span
                                        class="pull-right">Total: <span class="sub_total">{{ SM::currency_price_value(Cart::instance('cart')->total())}}</span></span>
                            </h3>
                        </div>
                    </div>
                    <div class="all-books-content">
                        <div class="table-responsive">
                            <table class="table table-striped cart-product cart_table">
                                <tbody>
                                @forelse($cart as $id => $item)
                                    <tr id="cartClose" id="tr_{{$item->rowId}}" class="removeCartTrLi">
                                        <td>
                                            <a href="{{ url('product/'.$item->options->slug) }}">
                                                <img src="{{ SM::sm_get_the_src($item->options->image, 60, 80) }}"
                                                     style="height: 60px;">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('product/'.$item->options->slug) }}">
                                                <p class="product-title">{{ $item->name }}</p>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="select-product-count mar-top-0">
                                                <form>
                                                    <div class="input-group">
                                                        <span data-row_id="{{ $item->rowId }}"
                                                              class="input-group-addon dec" id="decrease"
                                                              value="Decrease Value"><i
                                                                    class="fa fa-minus-circle"
                                                                    aria-hidden="true"></i></span>

                                                        <input type="number" name="qty"
                                                               class="form-control input-sm qty-inc-dc"
                                                               id="{{ $item->rowId }}" value="{{ $item->qty }}">


                                                        <span data-row_id="{{ $item->rowId }}"
                                                              class="input-group-addon inc" id="increase"
                                                              value="Increase Value"><i
                                                                    class="fa fa-plus-circle"
                                                                    aria-hidden="true"></i></span>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <b>{{ SM::currency_price_value($item->price) }}</b>
                                        </td>
                                        <td>
                                            <b>{{ SM::currency_price_value($item->price * $item->qty) }}</b>
                                        </td>
                                        <td>

                                            <button data-product_id="{{ $item->rowId }}" id="close-cart"
                                                    class="removeToCart close-cart cart-close-btn">
                                                <i class="fa fa-times" aria-hidden="true"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">
                                            <p class="product-name" style="color: red">No data found!</p>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="books-tetails-cart">
                            <div class="row">
                                <div class="col-md-6 col-xs-6">
                                    <a href="{{url('/shop')}}" class="btn btn-default left">Continue shopping</a>
                                </div>
                                <div class="col-md-6 col-xs-6">
                                    @if(Auth::check())
                                    <a class="btn btn-warning" href="{{url('/checkout')}}"><i class="fa fa-shopping-basket"></i>Go to Shipping Page</a>
                                    @else
                                        <a class="btn btn-warning right" data-toggle="modal" data-target="#loginModal"
                                        href="#">Go to Shipping Page</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('frontend.checkout.sidebar_1', ['net_sub_total'=>0])
            </div>
        </div>
    </section>
@endsection