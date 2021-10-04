<div class="col-md-4">
    

    <div id="coupon_error" style="display: none"></div>
    <div id="coupon_require_error"
         style="display: none">Please enter a valid coupon code
    </div>


    <div class="all-books-content">
        <div class="give-a-cuponCode">
            <h4>Cart Summary</h4>
            <table class="table table-striped cart-product">
                <thead>
                </thead>
                <tbody>

                <tr>
                    <th><span>SubTotal</span></th>
                    <td align="right"
                        id="subtotal"> <span class="sub_total">{{ SM::currency_price_value(Cart::instance('cart')->total()) }}</span></td>
                </tr>
                
                
               
                
                <tr>
                    <th class="last"><span>Total</span></th>
                    <td class="last grand_total_val" align="right"
                        id="grand_total"><span class="sub_total">{{ SM::currency_price_value($grand_total) }}</span></td>
                </tr>
                </tbody>
            </table>
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