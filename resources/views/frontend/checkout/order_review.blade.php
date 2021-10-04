<div class="table-responsive">
<table class="table table-striped cart-product cart_table">
    <thead>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Qty</th>
        <th>Unit price</th>
        <th>Total</th>
    </tr>
    </thead>
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
                {{ $item->qty }}
            </td>
            <td>
                <b>{{ SM::currency_price_value($item->price) }}</b>
            </td>
            <td>
                <b>{{ SM::currency_price_value($item->price * $item->qty) }}</b>
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