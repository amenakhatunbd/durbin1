<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin\Common;
use App\Model\Common\Gest;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\SM\SM;

use Illuminate\Http\Request;

class GestController extends Controller
{
    public function index(){
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add gests';
        $data['rightButton']['link'] = 'gests/create';
        return view('nptl-admin/common/gests/index', $data);
    }
    public function index2(Request $request){
        $edit = SM::check_this_method_access('gests', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('gests', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('gests', 'destroy') ? 1 : 0;
        $per = $edit + $delete;
        $columns = array(
            0 => 'id',
            1 => 'title',
        );
        $totalData = Gest::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        if (empty($request->input('search.value'))) {

            $gests = Gest::offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->orderBy('title', 'desc')
                ->get();
            $totalFiltered = Gest::count();
        } else {

            $search = $request->input('search.value');
            $gests = Gest::where('title', 'like', "%{$search}%")
                //                ->orWhere('branch', 'like', "%{$search}%")
                //                ->orWhere('account_no', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Gest::where('title', 'like', "%{$search}%")->orderBy('id', 'DESC')->count();
        }
       
        $data = array();
        
        if ($gests) {
            foreach ($gests as $gest) {
                $countProducts =1;
                $nestedData['id'] = '<strong>' . $gest->id . '</strong>';
                $nestedData['title'] = '<strong>' . $gest->title . '</strong>';
                $nestedData['email'] = '<strong>' . $gest->email . '</strong>';
                $nestedData['phone'] = '<strong>' . $gest->phone . '</strong>';
                $nestedData['description'] = '<strong>' . $gest->description . '</strong>'; 

                if ($per != 0) {
                    
                    if ($edit != 0) {
                        
                        if (SM::is_admin() == true || $countProducts <= 0 && $gest->created_by == SM::current_user_id()) {
                            $edit_data = '<a href="'.route('editgest',$gest->id).'" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';

                        } else {
                            $edit_data = '';
                        }
                    } else {
                        $edit_data = '';
                    }
                    if ($delete != 0) {
                        $delete_data = '<a href="' . route('deletegest',$gest->id). '" title="Delete" class="btn btn-xs btn-default delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $gest->id . '">
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
        $data['rightButton']['text'] = 'gests List';
        $data['rightButton']['link'] = 'gests';
        return view("nptl-admin/common/gests/create", $data);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'email' => 'required|email',
            'phone' => 'required|min:6|numeric',
            'description' => 'required|max:255',
        ]);
        $gest = new Gest();
        $gest->title = $request->title;
        $gest->email = $request->email;
        $gest->phone = $request->phone;
        $gest->description = $request->description;
        $gest->save();
    
        return redirect('geeksadmin/gests/allgest')->with('s_message', 'student create sucessfully!');;

    }

    public function edit($id){
    
        $data["gest"] = Gest::find($id);
        if (!empty($data["gest"])) {
            $data['rightButton']['iconClass'] = 'fa fa-plus';
            $data['rightButton']['text'] = 'Add gest';
            $data['rightButton']['link'] = 'gests/addgest';
            $data['rightButton2']['iconClass'] = 'fa fa-list-alt';
            $data['rightButton2']['text'] = 'gest List';
            $data['rightButton2']['link'] = 'gests';
            $data['rightButton4']['iconClass'] = 'fa fa-eye';
            $data['rightButton4']['text'] = 'View';
            $data['rightButton4']['link'] = "gest";
            return view("nptl-admin/common/gests/edit", $data);
        } else {
            return redirect(SM::smAdminSlug('gests'))
                ->with('s_message', 'gest not found!');
        }
    
    }
    public function update(Request $request, $id){
    
        $gest = Gest::findOrFail($id);
        $gest->title = $request->title;
        $gest->email = $request->email;
        $gest->phone = $request->phone;
        $gest->description = $request->description;
        $gest->update();
        return redirect('geeksadmin/gests/allgest')
            ->with('s_message', 'gest update sucessfully!');
}

    public function destroy($id){
        $gest = Gest::find($id);
            if (!empty($gest)) {
                if ($gest->delete() > 0) {
                    return response(1);
                }
            }
    
            return response(0);
        
    }


}
