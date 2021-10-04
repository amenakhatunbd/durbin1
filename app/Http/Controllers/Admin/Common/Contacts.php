<?php

namespace App\Http\Controllers\Admin\Common;

use App\Model\Common\Contact;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SM\SM;
use Illuminate\Support\Facades\Cache;

class Contacts extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("nptl-admin/common/contact/index");
    }

    public function index2(Request $request)
    {
        $delete = SM::check_this_method_access('contacts', 'destroy') ? 1 : 0;
        $per = $delete;

        $columns = array(
            0 => 'id',
            1 => 'title',
        );

        $totalData = Contact::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $products = Contact::offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Contact::count();
        } else {
            $search = $request->input('search.value');

            $products = Contact::where('name', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Contact::where('name', 'like', "%{$search}%")->count();
        }
        $data = array();

        if ($products) {
            foreach ($products as $v_data) {
                $nestedData['id'] = $v_data->id;
                $nestedData['fullname'] = '<strong>' . $v_data->fullname . '</strong>';
                $nestedData['email'] = $v_data->email;
                $nestedData['subject'] = $v_data->subject;
                $nestedData['phone'] = $v_data->phone;
                $nestedData['message'] = $v_data->message;
                if ($per != 0) {
                    if ($delete != 0) {
                        $delete_data = '<a href="' . url(config('constant.smAdminSlug') . '/contacts/destroy') . '/' . $v_data->id . '" 
                  title="Delete" class="btn btn-xs btn-default delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $v_data->id . '">
                     <i class="fa fa-times"></i>
                    </a> ';
                    } else {
                        $delete_data = '';
                    }
                    $nestedData['action'] = $delete_data;
                } else {
                    $nestedData['action'] = '';
                }
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Contact::find($id);
        if (count($cat) > 0) {
            if ($cat->delete() > 0) {
                return response(1);
            }
        }

        return response(0);
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

        $cat = Contact::find($request->post_id);
        if (count($cat) > 0) {
            $cat->status = $request->status;
            $cat->update();
        }
        exit;
    }


}
