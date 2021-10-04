<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\Admin\Common;
use App\Model\Common\School;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SM\SM;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Category';
        $data['rightButton']['link'] = 'schools/create';

        return view("nptl-admin/common/schools/index", $data);
    }

    public function index2(Request $request){
        $edit = SM::check_this_method_access('schools', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('schools', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('schools', 'destroy') ? 1 : 0;
        $per = $edit + $delete;
        $columns = array(
            0 => 'id',
            1 => 'title',
        );
        $totalData = School::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        
        if (empty($request->input('search.value'))) {

            $schools = School::offset($start)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->orderBy('title', 'desc')
                ->get();
            $totalFiltered = School::count();
        } else {

            $search = $request->input('search.value');
            $schools = School::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = School::where('title', 'like', "%{$search}%")->orderBy('id', 'DESC')->count();
        }
       
        $data = array();
        
        if ($schools) {
            foreach ($schools as $school) {
                $countProducts =1;
                $nestedData['id'] = '<strong>' . $school->id . '</strong>';
                $nestedData['title'] = '<strong>' . $school->title . '</strong>';
                $nestedData['description'] = '<strong>' . $school->description . '</strong>'; 
              
                if ($per != 0) {
                    
                    if ($edit != 0) {
                        
                        if (SM::is_admin() == true || $countProducts <= 0 && $school->created_by == SM::current_user_id()) {
                            $edit_data = '<a href="' . url(config('constant.smAdminSlug') . '/schools') . '/' . $school->id . '/edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';
                        } else {
                            $edit_data = '';
                        }
                    } else {
                        $edit_data = '';
                    }
                    if ($delete != 0) {
                        $delete_data = '<a href="' . url(config('constant.smAdminSlug') . '/schools/destroy') . '/' . $school->id . '" 
                  title="Delete" class="btn btn-xs btn-default delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $school->id . '">
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['rightButton']['iconClass'] = 'fa fa-list-alt';
        $data['rightButton']['text'] = 'School List';
        $data['rightButton']['link'] = 'schools';

        return view("nptl-admin/common/schools/create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|max:255',
        ]);
        $school = new School();
        $school->title = $request->title;
        $school->description = $request->description;
        $school->save();
        return redirect("geeksadmin/schools")->with('s_message', 'school insert Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function show(School $school)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["school"] = School::find($id);
        if (!empty($data["school"])) {
            $data['rightButton']['iconClass'] = 'fa fa-plus';
            $data['rightButton']['text'] = 'Add school';
            $data['rightButton']['link'] = 'Schools/create';
            $data['rightButton2']['iconClass'] = 'fa fa-list-alt';
            $data['rightButton2']['text'] = 'School List';
            $data['rightButton2']['link'] = 'schools';
            $data['rightButton4']['iconClass'] = 'fa fa-eye';
            $data['rightButton4']['text'] = 'View';
            $data['rightButton4']['link'] = "school";
            return view("nptl-admin/common/schools/edit", $data);
        } else {
            return redirect(SM::smAdminSlug('schools'))
                ->with('s_message', 'school not found!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $school = School::find($id);
        if (!empty($school)) {
            $school->title = $request->title;
            $school->description = $request->input("description", "");
            $permission = SM::current_user_permission_array();
            if (
                SM::is_admin() || isset($permission) &&
                isset($permission['schools']['school_status_update'])
                && $permission['schools']['school_status_update'] == 1
            )           
            if ($school->update() > 0) {
                return redirect(SM::smAdminSlug("schools/$school->id/edit"))
                    ->with('s_message', 'school Update Successfully!');
            } else {
                return redirect(SM::smAdminSlug("schools/$school->id/edit"))
                    ->with('s_message', 'school Update Failed!');
            }
        } else {
            return redirect(SM::smAdminSlug('schools'))
                ->with('w_message', 'school not found!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\School  $school
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::find($id);
        if (!empty($school)) {
            if ($school->delete() > 0) {
                return response(1);
            }
        }

        return response(0);
    }
    public function status_update(Request $request)
    {
       $school = School::find($request->post_id);
        if (!empty($school)) {
            $school->status = $request->status;
            $school->update();
        }
        exit;
    }

}
