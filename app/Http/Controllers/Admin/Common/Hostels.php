<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin\Common;
use App\Model\Common\Hostel;
use App\Model\Common\Country;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\SM\SM;
use Illuminate\Http\Request;
class Hostels extends Controller
{
    public function index()
    {
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Product';
        $data['rightButton']['link'] = 'products/create';
        return view("nptl-admin/common/hostels/index");
    }

    public function index2(Request $request){
        $edit = SM::check_this_method_access('hostels', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('hostels', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('hostels', 'destroy') ? 1 : 0;
        $per = $edit + $delete;
        $columns = array(
            0 => 'id',
            1 => 'title',
        );
        $totalData = Hostel::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        if (empty($request->input('search.value'))) {

            $hostels = Hostel::offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->orderBy('title', 'desc')
                ->get();
            $totalFiltered = Hostel::count();
        } else {

            $search = $request->input('search.value');
            $hostels = Hostel::where('title', 'like', "%{$search}%")
                //                ->orWhere('branch', 'like', "%{$search}%")
                //                ->orWhere('account_no', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Hostel::where('title', 'like', "%{$search}%")->orderBy('id', 'DESC')->count();
        }
       
        $data = array();
        
        if ($hostels) {
            foreach ($hostels as $hostel) {
                $countProducts =1;
                $nestedData['id'] = '<strong>' . $hostel->id . '</strong>';
                $nestedData['title'] = '<strong>' . $hostel->title . '</strong>';
                $nestedData['description'] = '<strong>' . $hostel->description . '</strong>'; 
                $nestedData['countrie_id'] = '<strong>' . $hostel->countrie_id . '</strong>';

                if ($per != 0) {
                    
                    if ($edit != 0) {                        
                        
                            $edit_data = '<a href="'.route('editHostel',$hostel->id).'" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';
                    } else {
                        $edit_data = '';
                    }
                    if ($delete != 0) {
                        $delete_data = '<a href="' . route('deleteHostel',$hostel->id). '" title="Delete" class="btn btn-xs btn-default delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $hostel->id . '">
                     <i class="fa fa-times"></i></a> ';
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
        $data['rightButton']['text'] = 'hostel List';
        $data['rightButton']['link'] = 'hostels';

        $data["country_lists"] = Country::orderBy('name')->pluck('name', 'id');
        return view("nptl-admin/common/hostels/create", $data);
    }
    
    public function store(Request $request)
    {        
       $this->validate($request, [
            'title' => 'required',
            'description' => 'required|max:255',
        ]);
        $hostel = new Hostel();
        $hostel->title = $request->title;
        $hostel->description = $request->description;
        $hostel->countrie_id = $request->input("countrie_id", "");
        $hostel->save();
    
        return redirect('geeksadmin/hostels/allhostel')->with('s_message', 'student create sucessfully!');
    }

    public function edit($id)
    {
// dd($id);

        $data["hostel"] = Hostel::with( "country")->find($id);

        if (!empty($data["hostel"])) {
            $data['rightButton']['iconClass'] = 'fa fa-plus';
            $data['rightButton']['text'] = 'Add hostel';
            $data['rightButton']['link'] = 'hostels/addhostel';
            $data['rightButton2']['iconClass'] = 'fa fa-list-alt';
            $data['rightButton2']['text'] = 'hostels List';
            $data['rightButton2']['link'] = 'hostels';
            $data['rightButton4']['iconClass'] = 'fa fa-eye';
            $data['rightButton4']['text'] = 'View';
            $data['rightButton4']['link'] = "hostel";
            $data["country_lists"] = Country::orderBy('name')->pluck('name', 'id');

            return view("nptl-admin/common/hostels/edit", $data);
        } else {
            return redirect(SM::smAdminSlug('hostels'))
                ->with('s_message', 'shop not found!');
        }
    }

    public function update(Request $request, $id){
    
        $hostel = Hostel::findOrFail($id);
        $hostel->title = $request->title;
        $hostel->description = $request->description;
        $hostel->countrie_id = $request->input("countrie_id", "");

        $hostel->update();
        return redirect('geeksadmin/hostels/allhostel')
            ->with('s_message', 'shop update sucessfully!');
}
    
    public function destroy($id){
        $hostel = Hostel::find($id);
            if (!empty($hostel)) {
                if ($hostel->delete() > 0) {
                    return response(1);
                }
            }
    
            return response(0);
        
    }

}
