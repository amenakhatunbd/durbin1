<?php

namespace App\Http\Controllers\Admin\Common;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Common\Slider;
use App\SM\SM;

class Sliders extends Controller
{
    function index()
    {
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Slider';
        $data['rightButton']['link'] = 'sliders/create';
        return view('nptl-admin/common/slider/index', $data);
    }

    public function index2(Request $request)
    {
        $edit = SM::check_this_method_access('sliders', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('sliders', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('sliders', 'destroy') ? 1 : 0;
        $per = $edit + $delete;

        $columns = array(
            0 => 'id',
            1 => 'title',
        );

        $totalData = Slider::Owner()->count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $products = Slider::Owner()->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Slider::Owner()->count();
        } else {
            $search = $request->input('search.value');

            $products = Slider::Owner()->where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Slider::Owner()->where('title', 'like', "%{$search}%")->count();
        }
        $data = array();

        if ($products) {
            foreach ($products as $v_data) {
                $nestedData['id'] = $v_data->id;
                $nestedData['title'] = '<strong>' . $v_data->title . '</strong>';
                $nestedData['image'] = '<img class="img" src="' . SM::sm_get_the_src($v_data->image, 80, 80) . '">';
                $nestedData['background_image'] = '<img class="img" src="' . SM::sm_get_the_src($v_data->background_image, 80, 80) . '">';

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
                    if (SM::is_admin() == true || $v_data->created_by == SM::current_user_id()) {
                        $status = '<select class="form-control change_status"
                                            route="' . config('constant.smAdminSlug') . '/slider_status_update' . '"
                                            post_id="' . $v_data->id . '">
                                        <option value="1" ' . $selected1 . '>Published </option>
                                        <option value="2" ' . $selected2 . '>Pending </option>
                                        <option value="3" ' . $selected3 . '>Canceled </option>
                                        </select>';
                    } else {
                        $status = '';
                    }
                } else {
                    $status = '';
                }
                $nestedData['status'] = $status;

                if ($per != 0) {
                    if ($edit != 0) {
                        if (SM::is_admin() == true || $v_data->created_by == SM::current_user_id()) {
                            $edit_data = '<a href="' . url(config('constant.smAdminSlug') . '/sliders') . '/' . $v_data->id . '/edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';
                        } else {
                            $edit_data = '';
                        }
                    } else {
                        $edit_data = '';
                    }
                    if ($delete != 0) {
                        $delete_data = '<a href="' . url(config('constant.smAdminSlug') . '/sliders/destroy') . '/' . $v_data->id . '" 
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

    function create()
    {
        $data['rightButton']['iconClass'] = 'fa fa-sliders';
        $data['rightButton']['text'] = 'Slider List';
        $data['rightButton']['link'] = 'sliders';

        return view('nptl-admin/common/slider/create', $data);
    }

    function store(Request $data)
    {

        $this->validate($data, [
            'title' => 'required',
            'image' => 'required',
            'style' => 'required'
        ]);
        $slider = new Slider();
        if (isset($data['image']) && $data['image'] != '') {
            $slider->image = $data['image'];
        }
        if (isset($data['fav_icon']) && $data['fav_icon'] != '') {
            $slider->background_image = $data['fav_icon'];
        }
        $slider->title = $data['title'];
        $slider->description = $data->input("description", "");
        $slider->style = $data['style'];
        $slider->priority = $data['priority'];
        $slider->extra = SM::sm_serialize($data['buttion']);
        if (SM::is_admin() || isset($permission) &&
            isset($permission['sliders']['slider_status_update'])
            && $permission['sliders']['slider_status_update'] == 1) {
            $slider->status = $data->status;
        }
        $slider->status = $data['status'];

        $slider->created_by = SM::current_user_id();


        if ($slider->save()) {
            $this->removeThisCache();

            return redirect(config('constant.smAdminSlug') . '/sliders/' . $slider->id . '/edit')->with('s_message', 'Sliders successfully added!');
        } else {
            return redirect(config('constant.smAdminSlug') . '/sliders')->with('s_message', 'Sliders Save Failed!');
        }
    }

    public function show()
    {

    }

    function edit($id)
    {
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Slider';
        $data['rightButton']['link'] = 'sliders/create';

        $data['rightButton2']['iconClass'] = 'fa fa-sliders';
        $data['rightButton2']['text'] = 'Slider List';
        $data['rightButton2']['link'] = 'sliders';
        $data['slider'] = Slider::find($id);
        $data['slider']->extra = SM::sm_unserialize($data['slider']->extra);

        return view('nptl-admin/common/slider/edit', $data);
    }

    function update(Request $data, $id)
    {
        $this->validate($data, [
            'title' => 'required',
            'image' => 'required',
            'style' => 'required'
        ]);

        $slider = Slider::find($id);
        if ($slider) {
            if (isset($data['image']) && $data['image'] != '') {
                $slider->image = $data['image'];
            }
            $slider->title = $data['title'];
            $slider->description = $data->input("description", "");
            $slider->style = $data['style'];
            $slider->priority = $data['priority'];
            $slider->extra = SM::sm_serialize($data['buttion']);
            if (SM::is_admin() || isset($permission) &&
                isset($permission['sliders']['slider_status_update'])
                && $permission['sliders']['slider_status_update'] == 1) {
                $slider->status = $data->status;
            }

            $slider->modified_by = SM::current_user_id();

            if ($slider->update()) {
                $this->removeThisCache();

                return redirect(config('constant.smAdminSlug') . '/sliders/' . $id . '/edit')
                    ->with('s_message', 'Sliders updated successfully!');
            } else {
                return redirect(config('constant . smAdminSlug') . ' / sliders')
                    ->with('s_message', 'Sliders Update Failed!');
            }
        } else {
            return redirect(config('constant . smAdminSlug') . ' / sliders')->with('w_message', 'Sliders update error occurred!');
        }
    }

    public function destroy($id)
    {
        $slider = Slider::find($id);
        if ($slider) {
            if ($slider->delete() > 0) {
                $this->removeThisCache();

                return response(1);
            }
        }

        return response(0);
    }

    public function status_update(Request $data)
    {
        $slider = Slider::find($data['post_id']);
        $slider->status = $data['status'];
        $slider->save();
        $this->removeThisCache();
        echo 1;
    }

    private function removeThisCache()
    {
        SM::removeCache('homeSlider');
    }
}
