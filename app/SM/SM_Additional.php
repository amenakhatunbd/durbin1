<?php

namespace App\SM;

use App\Model\Common\Category;
use App\Model\Common\Country;
use App\Model\Common\Order;
use App\Model\Common\Order_detail;
use App\Model\Common\Product;
use App\Model\Common\Author;
use Carbon;

use Illuminate\Support\Facades\DB;

trait SM_Additional
{

    public static function date_difference_in_day($start_date, $end_date)
    {
        $date1 = date_create($start_date);
        $date2 = date_create($end_date);
        $diff = date_diff($date1, $date2);
        $day_count = $diff->format("%a");
        $suffix = ($day_count > 1) ? " days" : " day";

        return $day_count . $suffix;
    }

    public static function showDateTime($timeData = null, $time = 0, $format = 0)
    {
        if ($time == 0) {
            $t = '';
        } else {
            if ($format == 0) {
                $t = ', g:i
		 A';
            } else {
                $t = ', H:i
		';
            }
        }
        if ($timeData) {
            $strData = strtotime($timeData);
            // return date("F j, Y" . $t, $strData);
            return date("d/m/Y" . $t, $strData);
        }
//        else {
//            return date("d/m/Y" . $t);
//        }
    }

    public
    static function startEndDate($start = null, $end = null)
    {

        if (!empty($start) && empty($end)) {
            $start = $start;
            $end = Carbon::now()->toDateString();
        }
        if (!empty($end) && empty($start)) {
            $start = '1970-01-01';
            $end = $end;
        }
        $array = array('start' => $start, 'end' => $end);
        return $array;
    }

    public
    static function orderNo($id)
    {
        $order_no = 'ORD-00' . $id;
        return $order_no;
    }

    public static function get_currency_price_value($currency_price = null)
    {
        $get_currency = Country::find(SM::get_setting_value('currency'));
        $get_currency_price = $get_currency->currency_symbol . ' ' . number_format($currency_price);
        return $get_currency_price;
    }

    public static function get_deshboard_order_summary_count($status = null)
    {
        $get_count = Order::when($status, function ($query) use ($status) {
            if ($status != "") {
                return $query->where('order_status', $status);
            }
        })->count();
        return $get_count;
    }
    
    public static function get_product_image($product_slug)
    {
        
        $image_name = Product::where('slug', $product_slug)->first();
        
        return $image_name->image;
        
    }
    public static function get_author_image($author_slug)
    {
        
        $image_name = Author::where('slug', $author_slug)->first();
        
        return $image_name->image;
        
    }

    public static function order_summary_reports($start_date, $end_date)
    {
        $get_sum_amount = Order::whereBetween('create_date', array($start_date, $end_date))
            ->sum('grand_total');
        $get_currency = Country::find(SM::get_setting_value('currency'));
        $get_gata = $get_currency->currency_symbol . ' ' . number_format($get_sum_amount);
        return $get_gata;
    }

    public static function top_5_customers_orders_report($start_date, $end_date)
    {
        $get_gata = Order::groupBy('user_id')
            ->selectRaw('*, sum(grand_total) as totalGrandTotal')
            ->whereBetween('create_date', array($start_date, $end_date))
            ->orderBy('totalGrandTotal', 'desc')
            ->take(5)
            ->get();
        return $get_gata;
    }

    public static function top_5_products_orders_report($start_date, $end_date)
    {

        
            $start_date = $start_date." 00:00:00";
            $end_date = $end_date." 00:00:00";

      
        $get_gata = Order_detail::groupBy('product_id')
            ->selectRaw('*, sum(product_qty) as totalQty, sum(sub_total) as subTotalSales')
            ->whereBetween('created_at', array($start_date, $end_date))
            ->orderBy('subTotalSales', 'desc')
            ->take(5)
            ->get();
        return $get_gata;
    }

    /**
     * This method will provide seralize array data with base64 encode
     *
     * @param array $data Data that need to serialized and base64encoded
     *
     * @return string base64encoded string
     */
    public static function sm_serialize($data)
    {
        return serialize($data);
    }

    /**
     * This method will provide unserialized array with base64decode
     *
     * @param $data string this data need to be base64encoded searialize data
     *
     * @return array
     */
    public static function sm_unserialize($data, $return_empty_array = 0)
    {
        $uns_chk = @unserialize($data);
        if ($uns_chk !== false || $data === 'b:0;') {
            return unserialize($data);
        } elseif ($return_empty_array == 1) {
            return array();
        }
    }


}
