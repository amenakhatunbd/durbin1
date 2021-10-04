<div class="col-md-4">
    <div class="all-books-content">
        <div class="give-a-cuponCode">
            <h4>Do you have a Promo code or Gift voucher?</h4>
            <div class="input-group">
                <input id="coupon_code" type="text" class="form-control" name="coupon_code"
                       placeholder="Give Your Cupon Code" autocomplete="off">
                <input type="hidden" name="sub_total_price" value="{{ $net_sub_total }}"
                       class="form-control"
                       id="sub_total_price">
                <span class="input-group-addon apply_coupon">Apply</span>
            </div>
        </div>
    </div>

    <div id="coupon_error" style="display: none"></div>
    <div id="coupon_require_error"
         style="display: none">Please enter a valid coupon code
    </div>


    <div class="all-books-content">
        <div class="give-a-cuponCode">
            <h4>Checkout Summary</h4>
                <div class="table-responsive">
            <table class="table table-striped cart-product">
                <thead>
                </thead>
                <tbody>
                <tr>
                    <th><span>SubTotal</span></th>
                    <td align="right"
                        id="subtotal">{{ SM::currency_price_value($sub_total) }}</td>
                </tr>
                @if($tax>0)
                    <tr>
                        <th><span>Tax</span></th>
                        <td align="right">{{ SM::currency_price_value($tax) }}</td>
                    </tr>
                @endif
                <tr>
                    <th><span>Shipping Cost<br>
                            <small> {{ $shipping_method_name }}</small></span></th>
                    <td align="right">{{ SM::currency_price_value($shipping_method_charge) }}</td>
                </tr>
                @if($noraml_discount_amount>0)
                    <tr>
                        <th><span>Discount (Noraml)
                                @if($discount_amount>0)
                                    - {{ $discount_amount }} %
                                @endif
                                </span></th>
                        <td align="right"
                            id="discount">
                            {{ SM::currency_price_value($noraml_discount_amount) }}</td>
                    </tr>
                @endif
                <tr>
                    <th><span>Discount(Coupon)</span></th>
                    <td class="coupon_amount_val" align="right"
                        id="coupon_amount">
                        {{ SM::currency_price_value($coupon_amount) }}</td>
                </tr>
                <tr>
                    <th class="last"><span>Total</span></th>
                    <td class="last grand_total_val" align="right"
                        id="grand_total">{{ SM::currency_price_value($grand_total) }}</td>
                </tr>
                </tbody>
            </table>
            </div>
         </div>
    </div>
</div>
<script>
    $('body').on('click', '.apply_coupon', function (event) {
        var coupon_code = $('#coupon_code').val();
        var sub_total_price = $('#sub_total_price').val();
        $.ajax({
            type: 'get',
            dataType: "json",
            url: '{{ URL::route('coupon_check')}}',
            data: {coupon_code: coupon_code, sub_total_price: sub_total_price},
            success: function (data) {
                if (data.check_coupon == 1) {
                    $('.coupon_amount_val').html(currencyFormat(data.coupon_amount))
                    $('.grand_total_val').html(currencyFormat(data.grand_total))
                    $('.coupon_amount').val(data.coupon_amount)
                    $('.grand_total').val(data.grand_total)
                    $('.coupon_code').val(data.coupon_code)
                    toastr.success(data.title);
                } else {
                    toastr.error(data.title);
                }
            }
        });
    });
</script>