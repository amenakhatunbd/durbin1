<?php

namespace App\Http\Controllers\Admin\Common;

use App\Model\Common\Publisher;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Common\Publisher as Publisher_model;
use App\SM\SM;
use App\User;
use Illuminate\Support\Facades\Cache;
use DB;
class Publishers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['rightButton']['iconClass'] = 'fa fa-plus';
        // $data['rightButton']['text'] = 'Add Publisher';
        // $data['rightButton']['link'] = '#';
        $data = array();
        return view("nptl-admin/common/publisher/index", $data);
    }

    public function index2(Request $request)
    {
        $edit = SM::check_this_method_access('publishers', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('publishers', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('publishers', 'destroy') ? 1 : 0;
        $per = $edit + $delete;

        $columns = array(
            0 => 'id',
            1 => 'title',
        );

        $totalData = Publisher::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $products = Publisher::offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = Publisher::count();
        } else {
            $search = $request->input('search.value');

            $products = Publisher::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('status', 'desc')
                ->get();
            $totalFiltered = Publisher::where('title', 'like', "%{$search}%")->count();
        }
        $data = array();

        if ($products) {
            foreach ($products as $v_data) {
                $countProducts = count($v_data->products);
                $nestedData['id'] = $v_data->id;
                $nestedData['title'] = '<strong>' . $v_data->title . '</strong>';
                $nestedData['image'] = '<img class="img-product" src="' . SM::sm_get_the_src($v_data->image, 80, 80) . '">';
                $nestedData['total_products'] = $countProducts;

                if ($v_data->status == 1) {
                    $selected1 = "Selected";
                } else {
                    $selected1 = '';
                }
                if ($v_data->status == 2) {
                    $selected2 = "Selected";
                } else {
                    $selected2 = "";
                }
                if (SM::access_edit_delete($status_update, $v_data->created_by) == true) {
                    $status = '<select class="form-control change_status"
                                            route="' . config('constant.smAdminSlug') . '/publisher_status_update' . '"
                                            post_id="' . $v_data->id . '">
                                        <option value="1" ' . $selected1 . '>Published </option>
                                        <option value="2" ' . $selected2 . '>Pending </option>
                                         </select>';
                } else {
                    $status = '';
                }
                $nestedData['status'] = $status;
                if ($per != 0) {
                    if (SM::access_edit_delete($edit, $v_data->created_by) == true) {
                        $edit_data = '<a href="' . url(config('constant.smAdminSlug') . '/publishers') . '/' . $v_data->id . '/edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';
                    } else {
                        $edit_data = '';
                    }
                    if (SM::access_edit_delete($delete, $v_data->created_by) == true) {
                        $delete_data = '<a href="' . url(config('constant.smAdminSlug') . '/publishers/destroy') . '/' . $v_data->id . '" 
                  title="Delete" class="btn btn-xs btn-default delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $v_data->id . '">
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
        $data['rightButton']['text'] = 'Publisher List';
        $data['rightButton']['link'] = 'publishers';
        return view("nptl-admin/common/publisher/create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $this->validate($request, [
            'username' => 'required|min:6|max:50|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'mobile' => 'required|unique:users',
            'seo_title' => 'max:70',
            'meta_description' => 'max:215'
        ]);



        $publisher = $request->all();
        $permission = SM::current_user_permission_array();
        if (SM::is_admin() || isset($permission) &&  isset($permission['publishers']['publisher_status_update'])  && $permission['publishers']['publisher_status_update'] == 1) {
            $publisher['status'] = $request->status;
        }
        if (isset($request->image) && $request->image != '') {
            $publisher['image'] = $request->image;
        }
        $slug = (trim($request->username) != '') ? $request->username : $request->username;
        if ($request->is_featured == true) {
            $publisher['is_featured'] = $request->is_featured != '' && $request->is_featured == 'on' ? 1 : 0;
        }
        $publisher['slug'] = SM::create_uri('publishers', $slug);
        $publisher['created_by'] = SM::current_user_id();
        $publisher['seo_title'] = $request->input("seo_title", "");
        $publisher['meta_key'] = $request->input("meta_key", "");
        $publisher['meta_description'] = $request->input("meta_description", "");
        $publisher['title'] =$request->input("fullname", "");
        $cat = Publisher_model::create($publisher);

        $user = new User();
        $user->username = $publisher['slug'];
        $user->email = $request->email;
        $user->firstname = $request->fullname;
        $user->mobile = $request->mobile;
        $user->street = $request->street;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zip = $request->zip;
        $user->type ='publisher';
        $user->status =$request->status;
        $user->password = bcrypt($request->password);
        $user->save();
        if ($cat) {
            $this->removeThisCache();

            Toastr::success('Publisher Saved Successfully!', 'Success');
            return redirect(SM::smAdminSlug("publishers"))
                ->with('s_message', 'Publisher Saved Successfully!');
        } else {
            Toastr::error('Publisher Save Failed!', 'Error');
            return redirect(SM::smAdminSlug("publishers"))
                ->with('s_message', 'Publisher Save Failed!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
//	public function show( $id ) {
//		//
//	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["publisher_info"] =$publisherinfo = Publisher_model::find($id);




        if (!empty($data["publisher_info"])) {
            $data["user_info"] = User::where('username',$publisherinfo->slug)->first();
            $data['rightButton']['iconClass'] = 'fa fa-plus';
            $data['rightButton']['text'] = 'Add Publisher';
            $data['rightButton']['link'] = 'publishers/create';

            $data['rightButton2']['iconClass'] = 'fa fa-list-alt';
            $data['rightButton2']['text'] = 'Publisher List';
            $data['rightButton2']['link'] = 'publishers';
            $data['rightButton4']['iconClass'] = 'fa fa-eye';
            $data['rightButton4']['text'] = 'View';
            $data['rightButton4']['link'] = "publisher/" . $data['publisher_info']->slug;
            return view("nptl-admin/common/publisher/edit", $data);
        } else {
            return redirect(SM::smAdminSlug('publishers'))
                ->with('s_message', 'Publisher not found!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $publisher = $publisherInfo = Publisher_model::find($id);
        $user = User::where('username',$publisherInfo->slug)->first();
        $this->validate($request, [
            'username' => 'required|max:55|unique:users,username,'.$user->id,
            'email' => 'required|max:55|email|unique:users,email,'.$user->id,
            'password' => 'nullable|confirmed|min:6',
            'mobile' => 'required|unique:users,mobile,'.$user->id,
            'seo_title' => 'max:70',
            'meta_description' => 'max:215'
        ]);
        if (!empty($publisher)) {
            $this->removeThisCache($publisher->slug);
            $publisher->title = $request->fullname;
            $publisher->description = $request->description;
            $publisher->seo_title = $request->input("seo_title", "");
            $publisher->meta_key = $request->input("meta_key", "");
            $publisher->meta_description = $request->input("meta_description", "");
            $permission = SM::current_user_permission_array();
            if (SM::is_admin() || isset($permission) &&
                isset($permission['publishers']['publisher_status_update'])
                && $permission['publishers']['publisher_status_update'] == 1) {
                $publisher->status = $request->status;
            }
            if (isset($request->image) && $request->image != '') {
                $publisher->image = $request->image;
            }

            $slug = (trim($request->slug) != '') ? $request->slug : $request->title;
            $publisher->slug = $request->username;
            $publisher->modified_by = SM::current_user_id();
            $publisher->update();
            $user->username = $request->username;
            $user->email = $request->email;
            $user->firstname = $request->fullname;
            $user->mobile = $request->mobile;
            $user->street = $request->street;
            $user->country = $request->country;
            $user->state = $request->state;
            $user->city = $request->city;
            $user->zip = $request->zip;
            $user->type ='publisher';
            $user->status =$request->status;
            if(!empty($request->password)){
                $user->password = bcrypt($request->password);
            }

            if ($user->save() > 0) {
                $this->removeThisCache();

                return redirect(SM::smAdminSlug("publishers/$publisher->id/edit"))
                    ->with('s_message', 'Publisher Update Successfully!');
            } else {
                return redirect(SM::smAdminSlug("publishers/$publisher->id/edit"))
                    ->with('s_message', 'Publisher Update Failed!');
            }
        } else {
            return redirect(SM::smAdminSlug('publishers'))
                ->with('w_message', 'Publisher not found!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Publisher_model::find($id);
        if (!empty($cat)) {
            if ($cat->delete() > 0) {
                $userinfo =  User::where('username',$cat->slug)->first();
                $user = User::find($userinfo->id);
                $user->delete();
                $this->removeThisCache($cat->slug);
                return response(1);
            }
        }
        return response(0);
    }

    /**
     * status change the specified resource from storage.
     *
     * @param Request $request
     *
     * @return null
     */
    public function status_update(Request $request)
    {
        $this->validate($request, [
            "post_id" => "required",
            "status" => "required",
        ]);

        $cat = Publisher_model::find($request->post_id);
        if (!empty($cat)) {
            $cat->status = $request->status;
            $cat->update();
            $this->removeThisCache($cat->slug);
        }
        exit;
    }

    private function removeThisCache($slug = null)
    {
        if ($slug != null) {
            SM::removeCache('publisher_' . $slug);
        }
        SM::removeCache('publishers_have_products');
        SM::removeCache('publishers_have_not_product');
        SM::removeCache(['publisher'], 1);
        SM::removeCache(['publisherProducts'], 1);
    }
}
