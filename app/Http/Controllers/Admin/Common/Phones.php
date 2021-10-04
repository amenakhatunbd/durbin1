<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin\Common;
use App\Model\Common\Phone;
use App\Model\Common\Country;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use App\SM\SM;
use Illuminate\Http\Request;

class Phones extends Controller
{
    public function index(){
        // $phones = Phone::get();
        // $phones = Phone::with('supplier','product')->get();
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Category';
        $data['rightButton']['link'] = 'teacher/create';

        return view('nptl-admin/common/phones/index', get_defined_vars());
    }

    public function index2(Request $request){
        $edit = SM::check_this_method_access('phones', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('phones', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('phones', 'destroy') ? 1 : 0;
        $per = $edit + $delete;
        $columns = array(
            0 => 'id',
            1 => 'title',
        );



        $countries_id = Country::where($countrie_name)->first()->id;

        $totalData = Phone::where($countries_id)->count();


        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        if (empty($request->input('search.value'))) {



            if (empty($request->input('search.value'))) {
                $products = Product::offset($start)
                    ->where('publisher_id', $user_id)
                    ->limit($limit)
                    ->orderByRaw("FIELD(status, $ids_ordered)")
                    ->orderBy('id', 'desc')
                    ->get();
                $totalFiltered = Product::where('publisher_id', $user_id)->count();
            } else {
                $search = $request->input('search.value');
                $phones = Phone::where('title', 'like', "%{$search}%")
                    ->where('publisher_id', $user_id)
                    ->orWhere('sku', 'like', "%{$search}%")
                    ->offset($start)
                    ->limit($limit)
                    ->orderByRaw("FIELD(status, $ids_ordered)")
                    ->orderBy('id', 'desc')
                    ->get();
                $totalFiltered = Phone::where('publisher_id', $user_id)->where('title', 'like', "%{$search}%")->count();
            }

        } else {

            $search = $request->input('search.value');
            $phones = Phone::where('title', 'like', "%{$search}%")
                //                ->orWhere('branch', 'like', "%{$search}%")
                //                ->orWhere('account_no', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Phone::where('title', 'like', "%{$search}%")->orderBy('id', 'DESC')->count();
        }
       
        $data = array();
        
        if ($phones) {
            foreach ($phones as $phone) {
                $countProducts =1;
                $nestedData['id'] = '<strong>' . $phone->id . '</strong>';
                $nestedData['title'] = '<strong>' . $phone->title . '</strong>';
                $nestedData['countrie_id'] = '<strong>' . $phone->countrie_id. '</strong>';
                $nestedData['description'] = '<strong>' . $phone->description . '</strong>'; 

                if ($per != 0) {
                    if ($edit != 0) {   
                            $edit_data = '<a href="'.route('editPhone',$phone->id).'" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';
                    } else {
                        $edit_data = '';
                    }
                    if ($delete != 0) {
                        $delete_data = '<a href="' . route('deletePhone',$phone->id).'" title="Delete" class="btn btn-xs btn-default delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $phone->id . '">
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
        $data['rightButton']['text'] = 'Phone List';
        $data['rightButton']['link'] = 'phones';
        $data["countrie_adds"] = Country::orderBy('name')->pluck('name', 'id');
        return view("nptl-admin/common/phones/create",$data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|max:255',
        ]);
        $phone = new Phone();
        $phone->title = $request->title;
        $phone->countrie_id = $request->input("countrie_id", "");
        $phone->description = $request->description;
        $phone->save();
    
        return redirect('geeksadmin/phones/allphone')->with('s_message', 'phone create sucessfully!');
    }

    public function edit($id)
    {
        // dd($id);

        $data["phone"] = Phone::with("country")->find($id);
        // dd($data);
        if (!empty($data["phone"])) {
            // dd($data);
            $data['rightButton']['iconClass'] = 'fa fa-plus';
            $data['rightButton']['text'] = 'Add phone';
            $data['rightButton']['link'] = 'phones/addphone';
            $data['rightButton2']['iconClass'] = 'fa fa-list-alt';
            $data['rightButton2']['text'] = 'Phone List';
            $data['rightButton2']['link'] = 'phones';
            $data['rightButton4']['iconClass'] = 'fa fa-eye';
            $data['rightButton4']['text'] = 'View';
            $data['rightButton4']['link'] = "phone";
            $data["countrie_adds"] = Country::orderBy('name')->pluck('name', 'id');
            // dd($data);
            return view("nptl-admin/common/phones/edit", $data);
        } else {
            return redirect(SM::smAdminSlug('phones'))->with('s_message', 'phone not found!');
        }
    }

    public function update(Request $request, $id)
    {
       // dd($id);
       $this->validate($request, [
            'title' => 'required',
            'description' => 'required|max:255',
        ]);
        $phone = Phone::with("country")->find($id);;
        $phone->title = $request->title;
        $phone->countrie_id = $request->input("countrie_id", "");
        $phone->description = $request->description;
        $phone->update();
    
        return redirect('geeksadmin/phones/allphone')->with('s_message', 'phone update sucessfully!');
    }
    public function destroy($id){
        $phone = Phone::find($id);
            if (!empty($phone)) {
                if ($phone->delete() > 0) {
                    return response(1);
                }
            }
    
            return response(0);
        
    }




}
