<?php

namespace App\Http\Controllers\Admin\Common;

use App\Model\Common\Blog;
use App\Model\Common\Comment;
use App\Model\Common\Order;
use App\Model\Common\Order_detail;
use App\Model\Common\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Common\Users_meta;
use App\SM\SM;
use App\Model\Common\Media;
use Illuminate\Support\Facades\Auth;

class Customers extends Controller
{

    public function index1()
    {
        $data['rightButton']['iconClass'] = 'fa fa-user';
        $data['rightButton']['text'] = 'Add Customer';
        $data['rightButton']['link'] = 'customers/create';
        return view('nptl-admin/common/customers/index', $data);
    }

    public function dataProcessing(Request $request)
    {
        $edit = SM::check_this_method_access('customers', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('customers', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('customers', 'destroy') ? 1 : 0;
        $per = $edit + $delete;

        $columns = array(
            0 => 'id',
            1 => 'title',
        );

        $totalData = User::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $customers = User::offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = User::count();
        } else {
            $search = $request->input('search.value');

            $customers = User::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = User::where('title', 'like', "%{$search}%")->count();
        }
        $data = array();

        if ($customers) {
            foreach ($customers as $v_data) {
                $nestedData['select'] = '<label><input type="checkbox" class="smCheckbox subscriber subscriber' . $v_data->id . '" value="' . $v_data->id . '"></label>';
                $nestedData['image'] = '<img class="img-blog" src="' . SM::sm_get_the_src($v_data->image, 80, 80) . '" width="80px" alt="' . $v_data->title . '" />';
                $nestedData['name'] = $v_data->name;
                $nestedData['username'] = $v_data->username;
                $nestedData['email'] = '<span class="subscriberemail' . $v_data->id . '">' . $v_data->email . '</span>';
                $nestedData['date'] = SM::showDateTime($v_data->created_at);

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
                if ($status_update != 0) {
                    $nestedData['status'] = '<select class="form-control change_status"
                                            route="' . config('constant.smAdminSlug') . '/customer_status_update' . '"
                                            post_id="' . $v_data->id . '">
                                        <option value="1" ' . $selected1 . '>Approved </option>
                                        <option value="2" ' . $selected2 . '>Pending </option>
                                        <option value="3" ' . $selected3 . '>Canceled </option>
                                        </select>';
                }
                $mail_data = ' <a href="javascript:void(0)" row="' . $v_data->id . '" title="Send Offer Mail" class="btn btn-xs btn-success showOfferMailPopUpForSingleSubscriber"><i class="fa fa-envelope"></i></a>';

                if ($per != 0) {
                    if ($edit != 0) {
                        $edit_data = '<a href="' . url(config('constant.smAdminSlug') . '/customers') . '/' . $v_data->id . '/edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';
                    } else {
                        $edit_data = '';
                    }
                    if ($delete != 0) {
                        $delete_data = '<a href="' . url(config('constant.smAdminSlug') . '/customers/destroy') . '/' . $v_data->id . '" 
                  title="Delete" class="btn btn-xs btn-default delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $v_data->id . '">
                     <i class="fa fa-times"></i>
                    </a> ';
                    } else {
                        $delete_data = '';
                    }
                    $nestedData['action'] = $mail_data . ' ' . $edit_data . ' ' . $delete_data;
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

    public function index(Request $request)
    {

        $data['rightButton']['iconClass'] = 'fa fa-user';
        $data['rightButton']['text'] = 'Add Customer';
        $data['rightButton']['link'] = 'customers/create';
        $data['min'] = $request->input('min', '');
        $data['max'] = $request->input('max', '');
        $data['status'] = $request->input('status', '');
        $data['customer'] = $request->input('customer', '');
        $data['cid'] = $request->input('cid', '');

        $query = User::where('type','customer')->orderBy('users.id', 'desc');

        if ($data['min'] != '') {
            $query->where('total_paid', '>=', $data['min']);
        }
        if ($data['max'] != '') {
            $query->where('total_paid', '<=', $data['max']);
        }
        if ($data['status'] != '') {
            $query->where('status', '=', $data['status']);
        }
        if ($data['cid'] != '') {
            $query->where('id', '=', $data['cid']);
        } else {
            $data['customer'] = '';
        }

        $data['users'] = $query->paginate(config('constant.smPagination'));
        if ($request->ajax()) {
            $json['data'] = view('nptl-admin/common/customers/customers', $data)->render();
            $json['smPagination'] = view('nptl-admin/common/common/pagination_links', [
                'smPagination' => $data['users']
            ])->render();

            return response()->json($json);
        }

        return view('nptl-admin/common/customers/manage_user', $data);
    }

    public function create()
    {
        $data['rightButton']['iconClass'] = 'fa fa-users';
        $data['rightButton']['text'] = 'Customer List';
        $data['rightButton']['link'] = 'customers';

        return view('nptl-admin/common/customers/create', $data);
    }

    public function store(Request $data)
    {
        $this->validate($data, [
            'username' => 'required|min:6|max:50|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'firstname' => 'required',
            
            'mobile' => 'required|unique:users',
            'street' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'country' => 'required',
        ]);

        $user = new User();
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->firstname = isset($data['firstname']) ? $data['firstname'] : null;
        // $user->lastname = isset($data['lastname']) ? $data['lastname'] : null;
        $user->mobile = isset($data['mobile']) ? $data['mobile'] : null;

        $user->password = bcrypt($data['password']);
        if (isset($data['image']) && $data['image'] != '') {
            $user->image = $data['image'];
        }
        $user->street = isset($data['street']) ? $data['street'] : null;
        $user->city = isset($data['city']) ? $data['city'] : null;
        $user->zip = isset($data['zip']) ? $data['zip'] : null;
        $user->state = isset($data['state']) ? $data['state'] : null;
        $user->country = isset($data['country']) ? $data['country'] : null;
        if (SM::is_admin() || isset($permission) &&
            isset($permission['customers']['customer_status_update'])
            && $permission['customers']['customer_status_update'] == 1) {
            $user->status = $data->status;
        }
        $user->save();

        $user_id = $user->id;

        $value = isset($data['mobile2']) ? $data['mobile2'] : null;
        SM::update_front_user_meta($user_id, 'mobile2', $value);


        $value = isset($data['gender']) ? $data['gender'] : null;
        SM::update_front_user_meta($user_id, 'gender', $value);


        $value = isset($data['skype']) ? $data['skype'] : null;
        SM::update_front_user_meta($user_id, 'skype', $value);


        $value = isset($data['whats_app']) ? $data['whats_app'] : null;
        SM::update_front_user_meta($user_id, 'whats_app', $value);


        $value = isset($data['extra_note']) ? $data['extra_note'] : null;
        SM::update_front_user_meta($user_id, 'extra_note', $value);

        return redirect(config('constant.smAdminSlug') . '/customers')
            ->with('s_message', 'Customer created successfully!');
    }

    public function show()
    {

    }

    public function edit($id)
    {
        $data['user'] = User::find($id);
        $user_meta = Users_meta::where('user_id', $id)->get();
        if (count($user_meta)) {
            $data['rightButton']['iconClass'] = 'fa fa-users';
            $data['rightButton']['text'] = 'Customer List';
            $data['rightButton']['link'] = 'customers';
            foreach ($user_meta as $meta) {
                $key = $meta->meta_key;
                $data['user']->$key = $meta->meta_value;
            }
        }
        unset($data['user']->password);

        return view('nptl-admin/common/customers/edit', $data);
    }

    public function update(Request $data, $id)
    {
        $this->validate($data, [
            'firstname' => 'required',
            'password' => 'confirmed',
            'mobile' => 'required',
            'street' => 'required',
            'city' => 'required',
            'zip' => 'required',
            'state' => 'required',
            'country' => 'required'
        ]);
        $user_id = $id;

        $user = User::find($user_id);

        if (isset($data['image']) && $data['image'] != '') {
            $user->image = $data['image'];
        }
        if (isset($data['password']) && $data['password'] != '' && $data['password'] == $data['password_confirmation']) {
            $user->password = bcrypt($data['password']);
        }
        $user->mobile = isset($data['mobile']) ? $data['mobile'] : null;
        $user->street = isset($data['street']) ? $data['street'] : null;
        $user->city = isset($data['city']) ? $data['city'] : null;
        $user->zip = isset($data['zip']) ? $data['zip'] : null;
        $user->state = isset($data['state']) ? $data['state'] : null;
        $user->country = isset($data['country']) ? $data['country'] : null;
        if (SM::is_admin() || isset($permission) &&
            isset($permission['customers']['customer_status_update'])
            && $permission['customers']['customer_status_update'] == 1) {
            $user->status = $data->status;
        }

        $user->firstname = isset($data['firstname']) ? $data['firstname'] : null;
        
        $user->update();

        $value = isset($data['mobile2']) ? $data['mobile2'] : null;
        SM::update_front_user_meta($user_id, 'mobile2', $value);

        $value = isset($data['gender']) ? $data['gender'] : null;
        SM::update_front_user_meta($user_id, 'gender', $value);


        $value = isset($data['skype']) ? $data['skype'] : null;
        SM::update_front_user_meta($user_id, 'skype', $value);


        $value = isset($data['whats_app']) ? $data['whats_app'] : null;
        SM::update_front_user_meta($user_id, 'whats_app', $value);

        $value = isset($data['extra_note']) ? $data['extra_note'] : null;
        SM::update_front_user_meta($user_id, 'extra_note', $value);

        return redirect(config('constant.smAdminSlug') . '/customers')->with('s_message', 'Customer updated successfully!');
    }

    public function destroy($id)
    {
        $user = User::find($id);
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
            Users_meta::where('user_id', $id)->delete();
            $user->delete();

            $orders = Order::where("user_id", $id)->get();
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    if ($order->package_type == 2) {
                        Order_detail::where("order_id", $order->id)->delete();
                    }
                    $order->delete();
                }
            }

            $comments = Comment::where("created_by", $id)->get();
            if (count($comments) > 0) {
                foreach ($comments as $comment) {
                    if ($comment->commentable_type == 'App\Model\Common\Blog') {
                        $blog = Blog::find($comment->commentable_id);
                        if ($blog && $blog->comments > 0) {
                            $blog->decrement('comments');
                        }
                        $comment->delete();
                    }
                }
            }
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }

    public function status_update(Request $data)
    {
        $user = User::find($data['post_id']);
        $user->status = $data['status'];
        $user->save();
        echo 1;
    }

    public function check_username(Request $data)
    {
        $username = $data['username'];
        $user = User::where('username', $username)->first();
        if (isset($user) && count($user) > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function check_email(Request $data)
    {
        $username = $data['email'];
        $user = User::where('email', $username)->first();
        if (isset($user) && count($user) > 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
}
