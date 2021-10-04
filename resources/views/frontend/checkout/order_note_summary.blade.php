<div class="notes-summary-area">
    <div class="row">
        <div class="col-sm-6 order-notes">
            <div class="heading">
                <h4>Order Notes</h4>
                <hr>
            </div>
            <div class="form-group">
                <p for="order_comments"></p>
                <textarea rows="5" name="order_note" id="order_note" class="form-control"
                          placeholder="Order Notes">@if(!empty(session('order_comments'))){{session('order_comments')}}@endif</textarea>
            </div>
        </div>
        <div class="col-sm-6 order-notes">
            @include('frontend.checkout.payment_method')
        </div>
    </div>
</div>