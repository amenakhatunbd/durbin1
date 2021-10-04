{!! Form::open(['method'=>'post', 'url'=>'checkout_shipping_method', 'id'=>'shipping_mehtods_form', 'class'=>'form']) !!}

<div class="form-group">
        <label class="control-label">Shipping Methods</label>
        <ul class="list">
            <?php
            $checked_method = '';
            $hidden_method = '';
            ?>
            @foreach($shipping_methods as $shipping_method)
                <?php
                if ($shipping_method->target_amount > 0) {
                if ($grand_total > $shipping_method->target_amount) {
                $checked_method = 'checked';
                ?>
                <div class="heading">
                    <h2>{{$shipping_method->title}}</h2>
                    <hr>
                </div>
                <li>
                    <input <?php echo $checked_method ?> required class="shipping_data"
                           id="shipping_{{$shipping_method->id}}" type="radio"
                           name="shipping_method"
                           value="{{$shipping_method->id}}"
                           shipping_price="{{$shipping_method->charge}}"
                           method_name="{{$shipping_method->title}}"
                           @if(!empty(Session::get('shipping_method')))
                           @if(Session::get('shipping_method.method_name') == $shipping_method->title) checked
                            @endif @endif
                    >
                    <label for="shipping_{{$shipping_method->id}}">{{$shipping_method->title}}</label>
                </li>
                <?php
                }
                }
                ?>
            @endforeach
            <?php
            if (empty($checked_method)) {
            foreach ($shipping_methods as  $shipping_method) {

            if ($shipping_method->target_amount > 0) {
                continue;
            }
            ?>
            <div class="heading <?php echo $hidden_method ?>">

            </div>
            <li>
                <input <?php echo $checked_method ?> required class="shipping_data"
                       id="shipping_method_{{$shipping_method->id}}" type="radio"
                       name="shipping_method"
                       value="{{$shipping_method->id}}"
                       shipping_price="{{$shipping_method->charge}}"
                       method_name="{{$shipping_method->title}}"
                       @if(!empty(Session::get('shipping_method')))
                       @if(Session::get('shipping_method.method_name') == $shipping_method->title) checked
                        @endif @endif
                >
                <label for="shipping_method_{{$shipping_method->id}}">{{$shipping_method->title}}</label>
                = {{$shipping_method->charge}}
            </li>

            <?php }
            } ?>
        </ul>
    </div>
<div class="books-tetails-cart text-right">
    <button type="submit" class="btn btn-warning">Continue</button>
</div>
{!! Form::close() !!}
 