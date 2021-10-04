<?php

namespace App\Http\Controllers\Admin\Common;

use App\Model\Common\ShippingMethod;
use App\SM\SM;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShippingMethods extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Shipping Method';
        $data['rightButton']['link'] = 'shippingmethods/create';
        $data['all_shipping_method'] = ShippingMethod::orderBy("id", "desc")
            ->paginate(config("constant.smPagination"));
        if (\request()->ajax()) {
            $json['data'] = view('nptl-admin/common/shipping_method/shippingmethods', $data)->render();
            $json['smPagination'] = view('nptl-admin/common/common/pagination_links', [
                'smPagination' => $data['all_shipping_method']
            ])->render();

            return response()->json($json);
        }
        return view("nptl-admin/common/shipping_method/index", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['rightButton']['iconClass'] = 'fa fa-credit-card';
        $data['rightButton']['text'] = 'Shipping Methods';
        $data['rightButton']['link'] = 'shippingmethods';

        return view("nptl-admin/common/shipping_method/create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
            "meta_key" => "max:160",
            "meta_description" => "max:160"
        ];
        $this->validate($request, $rules);
        $shipping_method = new ShippingMethod();
        $shipping_method->title = $request->title;
        $shipping_method->charge = $request->charge;
//        $shipping_method->target_amount = $request->target_amount;
        $shipping_method->description = $request->description;

        if (SM::is_admin() || isset($permission) &&
            isset($permission['paymentmethods']['shipping_method_status_update'])
            && $permission['paymentmethods']['shipping_method_status_update'] == 1) {
            $shipping_method->status = $request->status;
        }
        if (isset($request->image) && $request->image != '') {
            $shipping_method->image = $request->image;
        }

        $shipping_method->created_by = SM::current_user_id();
        $shipping_method->save();

        return redirect(SM::smAdminSlug('shippingmethods'))
            ->with('s_message', 'ShippingMethod created successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
//	public function show( $id ) {
//		//
//	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['rightButton']['iconClass'] = 'fa fa-credit-card';
        $data['rightButton']['text'] = 'Shipping Methods';
        $data['rightButton']['link'] = 'shippingmethods';
        $data['shipping_method_info'] = ShippingMethod::find($id);
        if (!empty($data['shipping_method_info']) > 0) {
            return view('nptl-admin/common/shipping_method/edit', $data);
        } else {
            return redirect(SM::smAdminSlug("shippingmethods"))
                ->with("w_message", "No shipping_method Found!");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'title' => 'required',
            "meta_key" => "max:160",
            "meta_description" => "max:160"
        ];

        $this->validate($request, $rules);
        $shipping_method = ShippingMethod::find($id);
        if (!empty($shipping_method) > 0) {
            $shipping_method->title = $request->title;
            $shipping_method->charge = $request->charge;
//            $shipping_method->target_amount = $request->target_amount;
            $shipping_method->description = $request->description;

            if (SM::is_admin() || isset($permission) &&
                isset($permission['paymentmethods']['shipping_method_status_update'])
                && $permission['paymentmethods']['shipping_method_status_update'] == 1) {
                $shipping_method->status = $request->status;
            }
            if (isset($request->image) && $request->image != '') {
                $shipping_method->image = $request->image;
            }

            $shipping_method->modified_by = SM::current_user_id();
            $shipping_method->update();

            return redirect(SM::smAdminSlug('shippingmethods'))
                ->with('s_message', 'ShippingMethod updated successfully!');
        } else {
            return redirect(SM::smAdminSlug("shippingmethods"))
                ->with("w_message", "No shipping_method Found!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $shipping_method = ShippingMethod::find($id);
    //     if (count($shipping_method) > 0) {
    //         $shipping_method->delete();

    //       return response(1);
    //     } else {
    //       return response(0);
    //     }
    // }
    
     public function destroy($id)
    {
        $shipping_method = ShippingMethod::find($id);
        if (!empty($shipping_method) > 0) {
            $shipping_method->delete();

          return response(1);
           
        } else {
            return response(0);
        }
    }

    /**
     * status change the specified resource from storage.
     *
     * @param  Request $request
     *
     * @return null
     */
    public function status_update(Request $request)
    {
        $this->validate($request, [
            "post_id" => "required",
            "status" => "required",
        ]);

        $shipping_method = ShippingMethod::find($request->post_id);
        if (count($shipping_method) > 0) {
            $shipping_method->status = $request->status;
            $shipping_method->update();
        }
        exit;
    }
}
