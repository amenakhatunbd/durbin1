<?php
namespace App\Http\Controllers;
namespace App\Http\Controllers\Admin\Common;
use App\Model\Common\Teacher;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SM\SM;



class TeacherController extends Controller
{
    public function index(){
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Category';
        $data['rightButton']['link'] = 'teacher/create';

        return view('nptl-admin/common/teacher/index', get_defined_vars());
    }


    public function index2(Request $request){
        $edit = SM::check_this_method_access('teachers', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('teachers', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('teachers', 'destroy') ? 1 : 0;
        $per = $edit + $delete;
        $columns = array(
            0 => 'id',
            1 => 'title',
        );
        $totalData = Teacher::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        if (empty($request->input('search.value'))) {

            $teachers = Teacher::offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->orderBy('title', 'desc')
                ->get();
            $totalFiltered = Teacher::count();
        } else {

            $search = $request->input('search.value');
            $teachers = Teacher::where('title', 'like', "%{$search}%")
                //                ->orWhere('branch', 'like', "%{$search}%")
                //                ->orWhere('account_no', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Teacher::where('title', 'like', "%{$search}%")->orderBy('id', 'DESC')->count();
        }
       
        $data = array();
        
        if ($teachers) {
            foreach ($teachers as $teacher) {
                $countProducts =1;
                $nestedData['id'] = '<strong>' . $teacher->id . '</strong>';
                $nestedData['title'] = '<strong>' . $teacher->title . '</strong>';
                $nestedData['description'] = '<strong>' . $teacher->description . '</strong>'; 

                if ($per != 0) {
                    
                    if ($edit != 0) {
                        
                        if (SM::is_admin() == true || $countProducts <= 0 && $teacher->created_by == SM::current_user_id()) {
                            $edit_data = '<a href="'.route('editTeacher',$teacher->id).'" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';

                        } else {
                            $edit_data = '';
                        }
                    } else {
                        $edit_data = '';
                    }
                    if ($delete != 0) {
                        $delete_data = '<a href="' . route('deleteTeacher',$teacher->id). '" title="Delete" class="btn btn-xs btn-default delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $teacher->id . '">
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

public function create(){
    return view('nptl-admin/common/teacher/create');
}

public function store(Request $request){


    $this->validate($request, [
        'title' => 'required',
        'description' => 'required|max:255',
    ]);
    $teacher = new Teacher();
    $teacher->title = $request->title;
    $teacher->description = $request->description;
    $teacher->save();

    return redirect('geeksadmin/teachers/allteacher');

}

public function edit($id){
    
    $data["teacher"] = Teacher::find($id);
    if (!empty($data["teacher"])) {
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add teacher';
        $data['rightButton']['link'] = 'Schools/create';
        $data['rightButton2']['iconClass'] = 'fa fa-list-alt';
        $data['rightButton2']['text'] = 'teacher List';
        $data['rightButton2']['link'] = 'teachers';
        $data['rightButton4']['iconClass'] = 'fa fa-eye';
        $data['rightButton4']['text'] = 'View';
        $data['rightButton4']['link'] = "teacher";
        return view("nptl-admin/common/teacher/edit", $data);
    } else {
        return redirect(SM::smAdminSlug('teacher'))
            ->with('s_message', 'teacher not found!');
    }

}


public function update(Request $request, $id){
    
        $teacher = Teacher::findOrFail($id);
        $teacher->title = $request->title;
        $teacher->description = $request->description;
        $teacher->update();
        return redirect('geeksadmin/teachers/allteacher')
            ->with('s_message', 'teacher update sucessfully!');
}

public function destroy($id){
    $teacher = Teacher::find($id);
        if (!empty($teacher)) {
            if ($teacher->delete() > 0) {
                return response(1);
            }
        }

        return response(0);
    
}
public function status_update(Request $request)
{
    $teacher = Teacher::find($request->post_id);
        if (!empty($teacher)) {
            $teacher->status = $request->status;
            $teacher->update();
        }
        exit;
}
}
