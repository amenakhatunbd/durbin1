<?php

namespace App\Http\Controllers\Admin\Common;

use App\Model\Common\Brand;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Common\Brand as Brand_model;
use App\SM\SM;
use Illuminate\Support\Facades\Cache;

class Brands extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Brand';
        $data['rightButton']['link'] = 'brands/create';
        return view("nptl-admin/common/brand/index", $data);
    }

    public function index2(Request $request)
    {
        $edit = SM::check_this_method_access('brands', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('brands', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('brands', 'destroy') ? 1 : 0;
        $per = $edit + $delete;

        $columns = array(
            0 => 'id',
            1 => 'title',
        );

        $totalData = Brand::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $products = Brand::offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Brand::count();
        } else {
            $search = $request->input('search.value');

            $products = Brand::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Brand::where('title', 'like', "%{$search}%")->count();
        }
        $data = array();

        if ($products) {
            foreach ($products as $v_data) {
                $countProducts = count($v_data->products);
                $nestedData['id'] = $v_data->id;
                $nestedData['title'] = '<strong>' . $v_data->title . '</strong>';
                $nestedData['website'] = $v_data->website;
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
                                            route="' . config('constant.smAdminSlug') . '/brand_status_update' . '"
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
                        $edit_data = '<a href="' . url(config('constant.smAdminSlug') . '/brands') . '/' . $v_data->id . '/edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';
                    } else {
                        $edit_data = '';
                    }
                    if (SM::access_edit_delete($delete, $v_data->created_by) == true) {
                        $delete_data = '<a href="' . url(config('constant.smAdminSlug') . '/brands/destroy') . '/' . $v_data->id . '" 
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
        $data['rightButton']['text'] = 'Brand List';
        $data['rightButton']['link'] = 'brands';
        return view("nptl-admin/common/brand/create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:150',
            'seo_title' => 'max:70',
            'meta_description' => 'max:215'
        ]);
        $brand = $request->all();
        $permission = SM::current_user_permission_array();
        if (SM::is_admin() || isset($permission) &&
            isset($permission['brands']['brand_status_update'])
            && $permission['brands']['brand_status_update'] == 1) {
            $brand['status'] = $request->status;
        }
        if (isset($request->image) && $request->image != '') {
            $brand['image'] = $request->image;
        }

        $slug = (trim($request->slug) != '') ? $request->slug : $request->title;
        if ($request->is_featured == true) {
            $brand->is_featured = $request->is_featured != '' && $request->is_featured == 'on' ? 1 : 0;
        }
        $brand['slug'] = SM::create_uri('brands', $slug);
        $brand['website'] = $request->input("website", "");
        $brand['created_by'] = SM::current_user_id();
        $brand['seo_title'] = $request->input("seo_title", "");
        $brand['meta_key'] = $request->input("meta_key", "");
        $brand['meta_description'] = $request->input("meta_description", "");
        $cat = Brand_model::create($brand);
        if ($cat) {
            $this->removeThisCache();

            Toastr::success('Brand Saved Successfully!', 'Success');
            return redirect(SM::smAdminSlug("brands"))
                ->with('s_message', 'Brand Saved Successfully!');
        } else {
            Toastr::error('Brand Save Failed!', 'Error');
            return redirect(SM::smAdminSlug("brands"))
                ->with('s_message', 'Brand Save Failed!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
//	public function show( $id ) {
//		//
//	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["brand_info"] = Brand_model::find($id);
        if (!empty($data["brand_info"])) {
            $data['rightButton']['iconClass'] = 'fa fa-plus';
            $data['rightButton']['text'] = 'Add Brand';
            $data['rightButton']['link'] = 'brands/create';

            $data['rightButton2']['iconClass'] = 'fa fa-list-alt';
            $data['rightButton2']['text'] = 'Brand List';
            $data['rightButton2']['link'] = 'brands';
            $data['rightButton4']['iconClass'] = 'fa fa-eye';
            $data['rightButton4']['text'] = 'View';
            $data['rightButton4']['link'] = "blog/brand/" . $data['brand_info']->slug;
            return view("nptl-admin/common/brand/edit", $data);
        } else {
            return redirect(SM::smAdminSlug('brands'))
                ->with('s_message', 'Brand not found!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:150',
            'seo_title' => 'max:70',
            'meta_description' => 'max:215'
        ]);
        $brand = Brand_model::find($id);
        if (!empty($brand)) {
            $this->removeThisCache($brand->slug);
            $brand->title = $request->title;
            $brand->website = $request->website;
            $brand->description = $request->description;
            $brand->priority = $request->priority;
            $brand->is_featured = isset($request->is_featured) && $request->is_featured == 'on' ? 1 : 0;
            $brand->seo_title = $request->input("seo_title", "");
            $brand->meta_key = $request->input("meta_key", "");
            $brand->meta_description = $request->input("meta_description", "");
            $permission = SM::current_user_permission_array();
            if (SM::is_admin() || isset($permission) &&
                isset($permission['brands']['brand_status_update'])
                && $permission['brands']['brand_status_update'] == 1) {
                $brand->status = $request->status;
            }
            if (isset($request->image) && $request->image != '') {
                $brand->image = $request->image;
            }

            $slug = (trim($request->slug) != '') ? $request->slug : $request->title;
            $brand->slug = SM::create_uri('brands', $slug, $id);
            $brand->modified_by = SM::current_user_id();

            if ($brand->update() > 0) {
                $this->removeThisCache();

                return redirect(SM::smAdminSlug("brands/$brand->id/edit"))
                    ->with('s_message', 'Brand Update Successfully!');
            } else {
                return redirect(SM::smAdminSlug("brands/$brand->id/edit"))
                    ->with('s_message', 'Brand Update Failed!');
            }
        } else {
            return redirect(SM::smAdminSlug('brands'))
                ->with('w_message', 'Brand not found!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Brand_model::find($id);
        if (!empty($cat)) {
            if ($cat->delete() > 0) {
                $this->removeThisCache($cat->slug);
                return response(1);
            }
        }

        return response(0);
    }

    /**
     * status change the specified resource from storage.
     *
     * @param  Request $request
     *
     * @return null
     */
    public function status_update(Request $request)
    {
        $this->validate($request, [
            "post_id" => "required",
            "status" => "required",
        ]);

        $cat = Brand_model::find($request->post_id);
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
            SM::removeCache('brand_' . $slug);
        }
        SM::removeCache('brands_have_products');
        SM::removeCache('brands_have_not_product');
        SM::removeCache(['brand'], 1);
        SM::removeCache(['brandProducts'], 1);
    }
}
