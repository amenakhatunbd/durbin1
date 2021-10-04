<html>
    <head>
        
    </head>
    <body>
        <?php
        $sm_get_site_logo = url(SM::sm_get_the_src(SM::sm_get_site_logo(), 294, 90));
        $site_name = SM::get_setting_value('site_name');
        $orderUser = $order->orderaddress;
        $orderId = SM::orderNumberFormat($order);
        ?>
        {{ $sm_get_site_logo }} |
        {{ $site_name }} |
        {{ $orderUser }} |
        {{ $orderId }} |
        <br>
        {{ $payment }} |
        <br>
        {{ $order }} |
        <br>
        
        @if(!empty($orderUser))
        <?php
        if(isset($order->user->name)){
            $flname = $order->user->name;
        } else {
            $flname = '';
        }
        if(isset($order->user->username)){
            $name = $order->user->username;
        } else {
            $name = '';
        }
        $address = "";
        $address .= !empty($order->user->address) ? $order->user->address . ", " : "";
        if (strlen($address) > 30) {
            $address .= '<br>';
        }
        $address .= !empty($order->user->city) ? $order->user->city . ", " : "";
        $address .= !empty($order->user->state) ? $order->user->state . " - " : "";
        $address .= !empty($order->user->zip) ? $order->user->zip . ", " : "";
        $address .= $order->user->country;
        ?>
        <br><br>
        {{ $flname }} >
        {{ $name }} > 
        {{$address}} >
        
        <br>
        <?php echo $sm_get_site_logo;?>
        {{ $order->invoice_no }} | {{ date('d-m-Y', strtotime($order->created_at)) }}
        <?php 
            if ($order->order_status == 1) {
                                        echo 'Completed';
                                    } else if ($order->order_status == 2) {
                                        echo 'Processing';
                                    } else if ($order->order_status == 3) {
                                        echo 'Pending';
                                    } else {
                                        echo 'Cancel';
                                    }
        
        ?>
            @foreach($order->detail as $detail)
                            <?php

                            $title = $detail->product->title;
                            $price = $detail->product_price;
                            $total = $detail->product_qty * $price;
                            $orderTotal[] = $total;

                            ?>
                {{ $title }}            
                {{ $price }}            
                {{ $total }}      
                
                <?php
                    if (!empty($detail->product_color)) {
                    ?>
                    Color : {{ $detail->product_color}}
                    <br>
                    Size : {{ $detail->product_size}}
                <?php } ?>
                <br>
                {{url(SM::sm_get_the_src($detail->product_image, 200, 200)) }}
                <br>
                {{ $title }}
                
                <br>{{ $detail->product_qty }}
                <br>{{SM::order_currency_price_value($detail->order_id,$price)}}
                <br>{{ SM::order_currency_price_value($detail->order_id,$total) }}
                            
            @endforeach                
        @endif
        
        <?php
                $invoice_signature = SM::smGetThemeOption("invoice_signature");
                $invoice_approved_by_name = SM::smGetThemeOption("invoice_approved_by_name", "NPTL Author");
                $invoice_approved_by_designation = SM::smGetThemeOption("invoice_approved_by_designation", "Director of Development");
                $src = ($invoice_signature != '') ? SM::sm_get_the_src($invoice_signature) : "additional/images/signature.png";
                ?>
                
                {{ $invoice_signature }} 
                {{ $invoice_approved_by_name }} 
                {{ $invoice_approved_by_designation }} 
                {{ $invoice_signature }} 
                
                <br>
                {{ title_case(SM::sm_convert_number_to_words($order->grand_total)) }}
                
                <br>
                
                <?php
                if ($order->payment_status == 1) {
                                        echo 'Completed';
                                    } else if ($order->payment_status == 2) {
                                        echo 'Pending';
                                    } else {
                                        echo 'Pending';
                                    }
                ?>
                                    
                            <?php
                            $due = $order->paid - $order->grand_total;
                            $dueSign = $due < 0 ? "-" : "+";
                            $dueSign = $due == 0 ? "" : $dueSign;
                            ?>
                            
                            @if($due < 0)
                                <p><label style="font-weight: 700; color: #000">Due Status </label> : <span style="color: #000; font-weight: bold">{{ $dueSign.' '. SM::currency_price_value(abs($due)) }}
                            </span></p>
                            <!--<a href="{{ url("dashboard/orders/pay/$order->id") }}">Pay Your Due</a>-->
                            @endif
                            
                            
                            

</body>
</html>