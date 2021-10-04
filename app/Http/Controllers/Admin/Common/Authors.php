<?php

namespace App\Http\Controllers\Admin\Common;

use App\Model\Common\Author;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Common\Author as Author_model;
use App\SM\SM;
use Illuminate\Support\Facades\Cache;

class Authors extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Author';
        $data['rightButton']['link'] = 'authors/create';
        return view("nptl-admin/common/author/index", $data);
    }

    public function index2(Request $request)
    {
        $edit = SM::check_this_method_access('authors', 'edit') ? 1 : 0;
        $status_update = SM::check_this_method_access('authors', 'status_update') ? 1 : 0;
        $delete = SM::check_this_method_access('authors', 'destroy') ? 1 : 0;
        $per = $edit + $delete;

        $columns = array(
            0 => 'id',
            1 => 'title',
        );

        $totalData = Author::count();
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $products = Author::offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Author::count();
        } else {
            $search = $request->input('search.value');

            $products = Author::where('title', 'like', "%{$search}%")
                ->offset($start)
                ->limit($limit)
                //->orderBy($order, $dir)
                ->orderBy('id', 'desc')
                ->get();
            $totalFiltered = Author::where('title', 'like', "%{$search}%")->count();
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
                                            route="' . config('constant.smAdminSlug') . '/author_status_update' . '"
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
                        $edit_data = '<a href="' . url(config('constant.smAdminSlug') . '/authors') . '/' . $v_data->id . '/edit" class="btn btn-xs btn-default"><i class="fa fa-pencil"></i></a>';
                    } else {
                        $edit_data = '';
                    }
                    if (SM::access_edit_delete($delete, $v_data->created_by) == true) {
                        $delete_data = '<a href="' . url(config('constant.smAdminSlug') . '/authors/destroy') . '/' . $v_data->id . '" 
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
        $data['rightButton']['text'] = 'Author List';
        $data['rightButton']['link'] = 'authors';
        return view("nptl-admin/common/author/create", $data);
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

        //dd($request->all());

        $this->validate($request, [
            'title' => 'required|max:150',
            'seo_title' => 'max:70',
            'meta_description' => 'max:215'
        ]);
        $author = $request->all();
        $permission = SM::current_user_permission_array();
        if (SM::is_admin() || isset($permission) &&
            isset($permission['authors']['author_status_update'])
            && $permission['authors']['author_status_update'] == 1) {
            $author['status'] = $request->status;
        }
        if (isset($request->image) && $request->image != '') {
            $author['image'] = $request->image;
        }

        $slug = (trim($request->slug) != '') ? $request->slug : $request->title;
        if ($request->is_featured == true) {
            $author['is_featured'] = $request->is_featured != '' && $request->is_featured == 'on' ? 1 : 0;
        }
        $author['slug'] = SM::create_uri('authors', $slug);
        $author['created_by'] = SM::current_user_id();
        $author['seo_title'] = $request->input("seo_title", "");
        $author['meta_key'] = $request->input("meta_key", "");
        $author['meta_description'] = $request->input("meta_description", "");
        $cat = Author_model::create($author);
        if ($cat) {
            $this->removeThisCache();

            Toastr::success('Author Saved Successfully!', 'Success');
            return redirect(SM::smAdminSlug("authors"))
                ->with('s_message', 'Author Saved Successfully!');
        } else {
            Toastr::error('Author Save Failed!', 'Error');
            return redirect(SM::smAdminSlug("authors"))
                ->with('s_message', 'Author Save Failed!');
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
        $data["author_info"] = Author_model::find($id);
       
        if (!empty($data["author_info"])) {
            $data['rightButton']['iconClass'] = 'fa fa-plus';
            $data['rightButton']['text'] = 'Add Author';
            $data['rightButton']['link'] = 'authors/create';

            $data['rightButton2']['iconClass'] = 'fa fa-list-alt';
            $data['rightButton2']['text'] = 'Author List';
            $data['rightButton2']['link'] = 'authors';
            $data['rightButton4']['iconClass'] = 'fa fa-eye';
            $data['rightButton4']['text'] = 'View';
            $data['rightButton4']['link'] = "author/" . $data['author_info']->slug;
            return view("nptl-admin/common/author/edit", $data);
        } else {
            return redirect(SM::smAdminSlug('authors'))
                ->with('s_message', 'Author not found!');
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
        $this->validate($request, [
            'title' => 'required|max:150',
            'seo_title' => 'max:70',
            'meta_description' => 'max:215'
        ]);
        $author = Author_model::find($id);
        if (!empty($author)) {
            $this->removeThisCache($author->slug);
            $author->title = $request->title;
            $author->description = $request->description;
            $author->seo_title = $request->input("seo_title", "");
            $author->meta_key = $request->input("meta_key", "");
            $author->meta_description = $request->input("meta_description", "");
            if ($request->is_featured == true) {
                $author->is_featured= $request->is_featured != '' && $request->is_featured == 'on' ? 1 : 0;
            }else{
                $author->is_featured= 0;//$request->is_featured != '' && $request->is_featured == 'on' ? 1 : 0;
            }
            $permission = SM::current_user_permission_array();
            if (SM::is_admin() || isset($permission) &&
                isset($permission['authors']['author_status_update'])
                && $permission['authors']['author_status_update'] == 1) {
                $author->status = $request->status;
            }
            if (isset($request->image) && $request->image != '') {
                $author->image = $request->image;
            }

            $slug = (trim($request->slug) != '') ? $request->slug : $request->title;
            $author->slug = SM::create_uri('authors', $slug, $id);
            $author->modified_by = SM::current_user_id();

            if ($author->update() > 0) {
                $this->removeThisCache();

                return redirect(SM::smAdminSlug("authors/$author->id/edit"))
                    ->with('s_message', 'Author Update Successfully!');
            } else {
                return redirect(SM::smAdminSlug("authors/$author->id/edit"))
                    ->with('s_message', 'Author Update Failed!');
            }
        } else {
            return redirect(SM::smAdminSlug('authors'))
                ->with('w_message', 'Author not found!');
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
        $cat = Author_model::find($id);
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

        $cat = Author_model::find($request->post_id);
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
            SM::removeCache('author_' . $slug);
        }
        SM::removeCache('authors_have_products');
        SM::removeCache('authors_have_not_product');
        SM::removeCache(['author'], 1);
        SM::removeCache(['authorProducts'], 1);
    }
}
