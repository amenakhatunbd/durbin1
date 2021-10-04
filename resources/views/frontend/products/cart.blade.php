@extends('frontend.master')
@section('title', 'Cart')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="all-books-content">
                        <div class="total-cat-item">
                            <h3>My Cart ({{ count($cart) }} Items) <span
                                        class="pull-right">Total: {{ SM::currency_price_value(Cart::instance('cart')->total())}}</span>
                            </h3>
                        </div>
                    </div>
                    <div class="all-books-content">
                        <div class="table-responsive">
                            <table class="table table-striped cart-product">
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
                                            <span>Man fashion</span>
                                        </td>
                                        <td>
                                            <div class="select-product-count mar-top-0">
                                                <form>
                                                    <div class="input-group">
                                                        <span data-row_id="{{ $item->rowId }}" class="input-group-addon dec" id="decrease"
                                                              onclick="decreaseValue()" value="Decrease Value"><i
                                                                    class="fa fa-minus-circle"
                                                                    aria-hidden="true"></i></span>

                                                        <input id="number" type="number" name="qty" class="form-control input-sm qty-inc-dc"
                                                               id="{{ $item->rowId }}" value="{{ $item->qty }}">


                                                        <span data-row_id="{{ $item->rowId }}" class="input-group-addon inc" id="increase"
                                                              onclick="increaseValue()" value="Increase Value"><i
                                                                    class="fa fa-plus-circle"
                                                                    aria-hidden="true"></i></span>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <b>{{ SM::currency_price_value($item->price * $item->qty) }}</b>
                                        </td>
                                        <td>

                                            <button data-product_id="{{ $item->rowId }}" id="close-cart" class="removeToCart close-cart cart-close-btn">
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
                        <div class="books-tetails-cart text-center">
                            <a href="" class="btn btn-default">Order as a Gift </a>
                            <a href="shiping.html" class="btn btn-warning">Go to Shipping Page </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="all-books-content">
                        <div class="give-a-cuponCode">
                            <h4>Do you have a Promo code or Gift voucher?</h4>
                            <div class="input-group">
                                <input id="msg" type="text" class="form-control" name="msg"
                                       placeholder="Give Your Cupon Code">
                                <span class="input-group-addon">Apply</span>
                            </div>
                        </div>
                    </div>
                    <div class="all-books-content">
                        <div class="give-a-cuponCode">
                            <h4>Checkout Summary</h4>
                            <table class="table table-striped cart-product">
                                <tbody>
                                <tr>
                                    <th>Subtotal</th>
                                    <td>536 Tk.</td>
                                </tr>
                                <tr>
                                    <th>Gift Wrap</th>
                                    <td>536 Tk.</td>
                                </tr>
                                <tr>
                                    <th>Shipping</th>
                                    <td>536 Tk.</td>
                                </tr>
                                <tr>
                                    <th>Total</th>
                                    <td>536 Tk.</td>
                                </tr>
                                <tr>
                                    <th>Payable Total</th>
                                    <td>536 Tk.</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection