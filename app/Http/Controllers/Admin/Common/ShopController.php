<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin\Common;
use App\Model\Common\Shop;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\SM\SM;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(){
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add shop';
        $data['rightButton']['link'] = 'shops/addshop';

        return view('nptl-admin/common/shops/index', $data);
    }
    public function index2(Request $request){
        $edit = SM::check_this_method_access('shops', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('shops', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('shops', 'destroy') ? 1 : 0;
        $per = $edit + $delete;
        $columns = array(
            0 => 'id',
            1 => 'title',
        );
        $totalData = Shop::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        if (empty($request->input('search.value'))) {

            $shops = Shop::offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->orderBy('title', 'desc')
                ->get();
            $totalFiltered = Shop::count();
        } else {

            $search = $request->input('search.value');
            $shops = Shop::where('title', 'like', "%{$search}%")
                //                ->orWhere('branch', 'like', "%{$search}%")
                //                ->orWhere('account_no', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Shop::where('title', 'like', "%{$search}%")->orderBy('id', 'DESC')->count();
        }
       
        $data = array();
        
        if ($shops) {
            foreach ($shops as $shop) {
                $countProducts =1;
                $nestedData['id'] = '<strong>' . $shop->id . '</strong>';
                $nestedData['title'] = '<strong>' . $shop->title . '</strong>';
                $nestedData['description'] = '<strong>' . $shop->description . '</strong>'; 

                if ($per != 0) {
                    
                    if ($edit != 0) {
                        
                        if (SM::is_admin() == true || $countProducts <= 0 && $shop->created_by == SM::current_user_id()) {
                            $edit_data = '<a href="'.route('editShop',$shop->id).'" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';

                        } else {
                            $edit_data = '';
                        }
                    } else {
                        $edit_data = '';
                    }
                    if ($delete != 0) {
                        $delete_data = '<a href="' . route('deleteShop',$shop->id). '" title="Delete" class="btn btn-xs btn-default delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $shop->id . '">
                     <i class="fa fa-times"></i>
                    </a> ';
                    } else {
                        $delete_data = '';
                    }
                    $nestedData['action'] = $edit_data . ' ' . $delete_data;
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


    public function create()
    {
        $data['rightButton']['iconClass'] = 'fa fa-list-alt';
        $data['rightButton']['text'] = 'Shop List';
        $data['rightButton']['link'] = 'shops';
        return view("nptl-admin/common/shops/create", $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|max:255',
        ]);
        $shop = new Shop();
        $shop->title = $request->title;
        $shop->description = $request->description;
        $shop->save();
    
        return redirect('geeksadmin/shops/allshop')->with('s_message', 'shop create sucessfully!');;
    }

    public function edit($id){
    
        $data["shop"] = Shop::find($id);
        if (!empty($data["shop"])) {
            $data['rightButton']['iconClass'] = 'fa fa-plus';
            $data['rightButton']['text'] = 'Add shop';
            $data['rightButton']['link'] = 'shops/create';
            $data['rightButton2']['iconClass'] = 'fa fa-list-alt';
            $data['rightButton2']['text'] = 'shop List';
            $data['rightButton2']['link'] = 'shops';
            $data['rightButton4']['iconClass'] = 'fa fa-eye';
            $data['rightButton4']['text'] = 'View';
            $data['rightButton4']['link'] = "shop";
            return view("nptl-admin/common/shops/edit", $data);
        } else {
            return redirect(SM::smAdminSlug('shops'))
                ->with('s_message', 'shop not found!');
        }
    
    }
    public function update(Request $request, $id){
    
        $shop = Shop::findOrFail($id);
        $shop->title = $request->title;
        $shop->description = $request->description;
        $shop->update();
        return redirect('geeksadmin/shops/allshop')
            ->with('s_message', 'shop update sucessfully!');
}

    public function destroy($id){
        $shop = Shop::find($id);
            if (!empty($shop)) {
                if ($shop->delete() > 0) {
                    return response(1);
                }
            }
    
            return response(0);
        
    }
}
