<?php
$shipping = Session::get("shipping");
$user = Auth::user();

if (!empty($user->firstname)) {
    $name = $user->firstname;
} else {
    $name = '';
}

if (!empty($shipping["mobile"])) {
    $mobile = $shipping["mobile"];
} elseif (!empty($user->mobile)) {
    $mobile = $user->mobile;
} else {
    $mobile = '';
}
if (!empty($shipping["company"])) {
    $company = $shipping["company"];
} elseif (!empty($user->company)) {
    $company = $user->company;
} else {
    $company = '';
}
if (!empty($shipping["address"])) {
    $address = $shipping["address"];
} elseif (!empty($user->address)) {
    $address = $user->address;
} else {
    $address = '';
}
if (!empty($shipping["country"])) {
    $country_value = $shipping["country"];
} elseif (!empty($user->country)) {
    $country_value = $user->country;
} else {
    $country_value = 'Bangladesh';
}
if (!empty($shipping["state"])) {
    $state_value = $shipping["state"];
} elseif (!empty($user->state)) {
    $state_value = $user->state;
} else {
    $state_value = 'Dhaka';
}
if (!empty($shipping["city"])) {
    $city = $shipping["city"];
} elseif (!empty($user->city)) {
    $city = $user->city;
} else {
    $city = '';
}
if (!empty($shipping["zip"])) {
    $zip = $shipping["zip"];
} elseif (!empty($user->zip)) {
    $zip = $user->zip;
} else {
    $zip = '';
}
?>

{!! Form::open(['method'=>'post', 'url'=>'checkout_shipping_address', 'class'=>'form', 'name'=>'signup']) !!}
<form class="form">
    <div class="form-group">
        <label class="control-label">Name</label>
        <input required type="text" class="form-control field-validate" id="name" name="name"
               value="{{ $name }}">
     </div>
    <div class="form-group">
        <label class="control-label">Phone no..</label>
        <input type="text" name="mobile" value="{{ $mobile }}" class="form-control" required>
    </div>
    <div class="form-group">
        <label class="control-label">Country</label>
        <select name="country" id="country"
                class="form-control country p_complete"
                data-state="state"
                data-onload="<?php echo isset($country) ? $country : "" ?>">
            <option value="">Select Your Country</option>
            <?php
            $countries = SM::$countries;
            ?>
            @if(count($countries)>0)
                <?php
                $i = 1;
                ?>
                @foreach($countries as $country)
                    <option data-id="{{ $i }}" value="{{$country}}"
                            @if($country_value == $country) selected @endif >{{$country}}</option>
                    <?php
                    $i++;
                    ?>
                @endforeach
            @endif
        </select>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">State</label>
                <select name="state" id="state"
                        class="form-control state p_complete"
                        data-onload="<?php echo isset($state) ? $state : ""; ?>">
                    <option value="#">Select State / Province</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="control-label">City</label>
                <input required type="text" class="form-control field-validate" id="city" name="city"
                       value="{{ $city }}">
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label">Address</label>
        <textarea class="form-control" name="address" rows="7" required>{{ $address }}</textarea>
    </div>
    <div class="books-tetails-cart text-right">
        <button type="submit" class="btn btn-warning">Continue</button>
    </div>
    <?php
    if(Auth::check()){
    $country = old("country") != "" ? old("country") : Auth::user()->country;
    $state = old("state") != "" ? old("state") : Auth::user()->state;
    ?>
    {{--                                        @push('script')--}}
    <script>
        $("#country").val('<?php echo $country; ?>');
            <?php if($country != ''): ?>
        var selectedCountryIndex = $("#country").find('option:selected').attr('data-id');
        var state = $("#country").attr('data-state');
        change_state(selectedCountryIndex, state);
        <?php endif; ?>
        $("#state").val('<?php echo $state; ?>');
    </script>
    {{--@endpush--}}
    <?php
    }
    ?>

</form>
{!! Form::close() !!}