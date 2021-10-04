<?php
/**
 * Created by PhpStorm.
 * User: NPTL
 * Date: 10/30/17
 * Time: 2:22 PM
 */

namespace App\Http\Controllers\Admin\Common;

use App\Model\Common\Blog;
use App\Model\Common\Category;
use App\Model\Common\Coupon;
use App\Model\Common\Package;
use App\Model\Common\Page;
use App\Model\Common\Payment;
use App\Model\Common\Payment_method;
use App\Model\Common\Service;
use App\Model\Common\Tag;
use App\Model\Common\Tax;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Model\Common\Admins_meta;
use App\Model\Common\Role;
use App\SM\SM;
use App\Model\Common\Comment;
use App\Model\Common\Media;
use DB;

class Users extends Controller
{

    public function index()
    {
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Users';
        $data['rightButton']['link'] = 'users/create';
        return view('nptl-admin/common/users/index', $data);
    }

    public function index2(Request $request)
    {
        $edit = SM::check_this_method_access('users', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('users', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('users', 'destroy') ? 1 : 0;
        $per = $edit + $delete;

        $columns = array(
            0 => 'id',
            1 => 'title',
        );

        $totalData = Admin::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $users = Admin::offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Admin::count();
        } else {
            $search = $request->input('search.value');

            $users = Admin::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Admin::where('title', 'like', "%{$search}%")->count();
        }
        $data = array();

        if ($users) {
            foreach ($users as $v_data) {
                $nestedData['id'] = $v_data->id;
                $nestedData['role'] = $v_data->role->name;
                $nestedData['image'] = '<img class="img-blog" src="' . SM::sm_get_the_src($v_data->image, 80, 80) . '" width="80px"/>';
                $nestedData['name'] = $v_data->firstname . ' ' . $v_data->lastname;
                $nestedData['username'] = $v_data->username;
                $nestedData['email'] = $v_data->eamil;
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
                if ($v_data->status == 3) {
                    $selected3 = "Selected";
                } else {
                    $selected3 = "";
                }
                if ($v_data->id != 1) {
                    if ($status_update != 0) {
                        $nestedData['status'] = '<select class="form-control change_status"
                                            route="' . config('constant.smAdminSlug') . '/user_status_update' . '"
                                            post_id="' . $v_data->id . '">
                                        <option value="1" ' . $selected1 . '>Approved </option>
                                        <option value="2" ' . $selected2 . '>Pending </option>
                                        <option value="3" ' . $selected3 . '>Canceled </option>
                                        </select>';
                    }
                } else {
                    $nestedData['status'] = 'Approved';
                }
                if ($per != 0) {
                    if ($edit != 0) {
                        $edit_data = '<a href="' . url(config('constant.smAdminSlug') . '/users') . '/' . $v_data->id . '/edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';
                    } else {
                        $edit_data = '';
                    }
                    if ($v_data->id != 1) {
                        if ($delete != 0) {
                            $delete_data = '<a href="' . url(config('constant.smAdminSlug') . '/users/destroy') . '/' . $v_data->id . '" 
                  title="Delete" class="btn btn-xs btn-default delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $v_data->id . '">
                     <i class="fa fa-times"></i>
                    </a> ';
                        } else {
                            $delete_data = '';
                        }
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
    public function publisher_user()
    {
     
        $publisher = DB::table('publishers')->get();
        foreach($publisher as $value)
        {
            $user = new User();
            $user->username = $value->slug;
            $user->email = $value->slug.'@gmail.com';
            $user->firstname = $value->title;
            $user->password = bcrypt('123456');
            $user->type = "publisher";
            
             $user->save();
        }
        
    }

    public function create()
    {
        $data['roles'] = Role::where("status", 1)->get();

        return view('nptl-admin/common/users/create', $data);
    }

    public function store(Request $data)
    {
      
        $this->validate($data, [
            'username' => 'required|min:6|max:50|unique:admins',
            'email' => 'required|email|max:255|unique:admins',
            'password' => 'required|confirmed|min:6',
            'role_id' => 'required'
        ]);
        $admin = new Admin();
        $admin->username = $data['username'];
        $admin->email = $data['email'];
        $admin->firstname = isset($data['firstname']) ? $data['firstname'] : null;
        $admin->lastname = isset($data['lastname']) ? $data['lastname'] : null;
        $admin->password = bcrypt($data['password']);
        $admin->role_id = $data['role_id'];
        if (isset($data['image']) && $data['image'] != '') {
            $admin->image = $data['image'];
        }

        $permission = SM::current_user_permission_array();
        if (SM::is_admin() || isset($permission) && isset($permission['users']['user_status_update']) && $permission['users']['user_status_update'] == 1) {
            $admin->status = $data['status'];
        }
        //   dd($data['role_id']);
          
          
        if($data['role_id']==2)
        {
            $user_data =  array();
            $user_data['title'] = $admin->firstname.' '.$admin->lastname;
            $user_data['slug'] = $admin->username;
            
           
            $x= DB::table('publishers')->insert($user_data);
            
            $user = new User();
            $user->username = $admin->username;
            $user->email = $admin->username.'@gmail.com';
            $user->firstname = $admin->title;
            $user->password = bcrypt('123456');
            $user->type = "publisher";
            $user->status = 1;
            $user->save();


            return redirect(config('constant.smAdminSlug') . '/publishers')->with('s_message', 'Publisher created successfully!');
      
        }
        
        
        $admin->save();
        

        $user_id = $admin->id;


        $value = isset($data['mobile']) ? $data['mobile'] : null;
        SM::update_user_meta($user_id, 'mobile', $value);


        $value = isset($data['gender']) ? $data['gender'] : null;
        SM::update_user_meta($user_id, 'gender', $value);


        $value = isset($data['skype']) ? $data['skype'] : null;
        SM::update_user_meta($user_id, 'skype', $value);


        $value = isset($data['whats_app']) ? $data['whats_app'] : null;
        SM::update_user_meta($user_id, 'whats_app', $value);


        $value = isset($data['street']) ? $data['street'] : null;
        SM::update_user_meta($user_id, 'street', $value);


        $value = isset($data['city']) ? $data['city'] : null;
        SM::update_user_meta($user_id, 'city', $value);

        $value = isset($data['state']) ? $data['state'] : null;
        SM::update_front_user_meta($user_id, 'state', $value);

        $value = isset($data['zip']) ? $data['zip'] : null;
        SM::update_user_meta($user_id, 'zip', $value);


        $value = isset($data['country']) ? $data['country'] : null;
        SM::update_user_meta($user_id, 'country', $value);


        $value = isset($data['extra_note']) ? $data['extra_note'] : null;
        SM::update_user_meta($user_id, 'extra_note', $value);

        return redirect(config('constant.smAdminSlug') . '/users')->with('s_message', 'User created successfully!');
    }

    public function edit($id)
    {
        $data['roles'] = Role::where("status", 1)->get();
        $data['user'] = Admin::find($id);
        $user_meta = Admins_meta::where('admin_id', $id)->get();
        if (count($user_meta)) {
            foreach ($user_meta as $meta) {
                $key = $meta->meta_key;
                $data['user']->$key = $meta->meta_value;
            }
        }
        unset($data['user']->password);

        return view('nptl-admin/common/users/edit', $data);
    }

    public function update(Request $data, $id)
    {
        $this->validate($data, [
            'password' => 'confirmed',
            'username' => 'required|min:6|max:50|unique:admins,username,'.$id,
            'email' => 'required|email|max:255|unique:admins,email,'.$id,
            'role_id' => 'required'
        ]);
        $user_id = $id;

        $user = Admin::find($user_id);





        if (isset($data['image']) && $data['image'] != '') {
            $user->image = $data['image'];
        }

        


        if (isset($data['password']) && $data['password'] != '' && $data['password'] == $data['password_confirmation']) {
            $user->password = bcrypt($data['password']);
        }
        $permission = SM::current_user_permission_array();
        if (SM::is_admin() || isset($permission) && isset($permission['users']['user_status_update']) && $permission['user']['user_status_update'] == 1) {
            $user->status = $data['status'];
        }

        $user->firstname = isset($data['firstname']) ? $data['firstname'] : null;
        $user->lastname = isset($data['lastname']) ? $data['lastname'] : null;

        if($data['role_id']==2)
        {
            $user_data =  array();

            if (isset($data['username']) && $data['username'] != '') 
            {
                $user_data['slug'] = $data['username'];
                DB::table('publishers')->where('slug', $user->username)->update($user_data); 
            }


      
        }

        if (isset($data['username']) && $data['username'] != '') {
            $user->username = $data['username'];
        }

        if (isset($data['email']) && $data['email'] != '') {
            $user->email = $data['email'];
        }

        $user->role_id = $data['role_id'];
        $user->update();

        $value = isset($data['mobile']) ? $data['mobile'] : null;
        SM::update_user_meta($user_id, 'mobile', $value);


        $value = isset($data['gender']) ? $data['gender'] : null;
        SM::update_user_meta($user_id, 'gender', $value);


        $value = isset($data['skype']) ? $data['skype'] : null;
        SM::update_user_meta($user_id, 'skype', $value);


        $value = isset($data['whats_app']) ? $data['whats_app'] : null;
        SM::update_user_meta($user_id, 'whats_app', $value);


        $value = isset($data['street']) ? $data['street'] : null;
        SM::update_user_meta($user_id, 'street', $value);


        $value = isset($data['city']) ? $data['city'] : null;
        SM::update_user_meta($user_id, 'city', $value);

        $value = isset($data['state']) ? $data['state'] : null;
        SM::update_user_meta($user_id, 'state', $value);

        $value = isset($data['zip']) ? $data['zip'] : null;
        SM::update_user_meta($user_id, 'zip', $value);


        $value = isset($data['country']) ? $data['country'] : null;
        SM::update_user_meta($user_id, 'country', $value);


        $value = isset($data['extra_note']) ? $data['extra_note'] : null;
        SM::update_user_meta($user_id, 'extra_note', $value);

        return redirect(config('constant.smAdminSlug') . '/users')->with('s_message', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $user = Admin::find($id);
        if ($user) {
            $path = config('constant.smUploadsDir');
            $all_width = config('constant.smImgWidth');
            $all_height = config('constant.smImgHeight');
            $medias = Media::where('created_by', $id)->get();
            if (count($medias) > 0) {
                foreach ($medias as $media) {
                    SM::sm_file_delete($all_width, $all_height, $path, $media->id);
                }
            }

            $user_meta = Admins_meta::where('admin_id', $id)->delete();
            Comment::where("created_by", $id)->delete();
            Blog::where("created_by", $id)->delete();
            Category::where("created_by", $id)->delete();
            Coupon::where("created_by", $id)->delete();
            Payment_method::where("created_by", $id)->delete();
            Tag::where("created_by", $id)->delete();
            Tax::where("created_by", $id)->delete();
            Page::where("created_by", $id)->delete();
            $user->delete();

            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }

    public function status_update(Request $data)
    {
        $user = Admin::find($data['post_id']);
        $user->status = $data['status'];
        $user->save();
        echo 1;
    }

    ///role
    public function roles()
    {
        $data['roles'] = role::paginate(config('constant.smPagination'));
        if (\request()->ajax()) {
            $json['data'] = view('nptl-admin/common/users/roles_list', $data)->render();
            $json['smPagination'] = view('nptl-admin/common/common/pagination_links', [
                'smPagination' => $data['roles']
            ])->render();

            return response()->json($json);
        }

        return view('nptl-admin/common/users/manage_roles', $data);
    }

    public function add_role()
    {
        $data['role'] = array();

        return view('nptl-admin/common/users/add_role', $data);
    }

    public function save_role(Request $data)
    {
        $per = SM::sm_serialize($data['permission']);
        $role = new Role;
        $role->name = $data['role'];
        $role->permission = $per;
        $role->created_by = SM::current_user_id();
        $role->status = 1;
        $role->save();

        return redirect(config('constant.smAdminSlug') . '/users/roles')->with('s_message', 'Successfully role created!');
    }

    public function edit_role($id)
    {
        $data['role'] = Role::find($id);

        return view('nptl-admin/common/users/edit_role', $data);
    }

    public function update_role(Request $data)
    {
//        var_dump($data['permission']);
//        exit();
        $per = SM::sm_serialize($data['permission']);
        $id = $data['id'];
        $role = Role::find($id);
        $role->name = $data['role'];
        $role->permission = $per;
        $role->modified_by = SM::current_user_id();
        $role->update();

        return back()->with('s_message', 'Successfully role updated!');
//		return redirect( config( 'constant.smAdminSlug' ) . '/users/roles' )->with( 's_message', 'Successfully role updated!' );
    }

    public function delete_role($id)
    {
        $role = Role::find($id);
        if ($role) {
            $data = 'Successfully role deleted!';
            $admins = Admin::where('role_id', $id)->get();
            if ($admins) {
                $users = '';
                $i = 0;
                foreach ($admins as $admin) {
                    if ($i > 0) {
                        $users .= ', ';
                    }
                    $users .= $admin->username;
                    $admin->status = 2;
                    $admin->role = 0;
                    $admin->save();
                    $i++;
                }
                if ($users != '') {
                    $data .= 'Please check these username like <b>' . $users . '</b> users has this role, those user status changed to pending. change those user role and status!';
                }
            }

            $role->delete();

            return response($data, 200);
        }
        echo 0;
        exit;
    }
}
