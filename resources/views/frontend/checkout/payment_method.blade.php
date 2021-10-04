<div class="payment-area">
    <div class="heading">
        <h4>Payment Methods</h4>
        <hr>
    </div>
    <div class="payment-methods">
        <div class="alert alert-danger error_payment" style="display:none" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            Please select your payment method')
        </div>
        <ul class="list">
            @foreach($payment_methods as $payment_method)
                <li>
                    <label for="pm_{{ $payment_method->id }}">
                        <input required type="radio" id="pm_{{ $payment_method->id }}"
                               name="payment_method_id" class="payment_method"
                               value="{{ $payment_method->id }}">
                        <strong>{{ $payment_method->title }}</strong>
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="books-tetails-cart" style="margin-top: 40px">
        <button type="submit" class="btn btn-warning">Order Now</button>
    </div>
</div>