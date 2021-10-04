<?php

namespace App\Http\Controllers\Admin\Common;

use App\Model\Common\Attribute;
use App\Model\Common\Attributetitle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Common\Attributetitle as Attributetitle_model;
use App\SM\SM;
use Illuminate\Support\Facades\Cache;

class Attributetitles extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rightButton']['iconClass'] = 'fa fa-plus';
        $data['rightButton']['text'] = 'Add Attributetitle';
        $data['rightButton']['link'] = 'attributetitles/create';

        $data['all_attributetitle'] = Attributetitle_model::orderBy("id", "desc")
            ->paginate(config("constant.smPagination"));
        if (\request()->ajax()) {
            $json['data'] = view('nptl-admin.common.attributetitle.attributetitles', $data)->render();
            $json['smPagination'] = view('nptl-admin.common.common.pagination_links', [
                'smPagination' => $data['all_attributetitle']
            ])->render();

            return response()->json($json);
        }

        return view("nptl-admin.common.attributetitle.manage_attributetitle", $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['rightButton']['iconClass'] = 'fa fa-list-alt';
        $data['rightButton']['text'] = 'Attributetitle List';
        $data['rightButton']['link'] = 'attributetitles';
        return view("nptl-admin/common/attributetitle/create", $data);
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
            'title' => 'required|max:150',
//            'seo_title' => 'max:70',
//            'meta_description' => 'max:215'
        ]);
        $attribute = $request->all();
        $permission = SM::current_user_permission_array();
        if (SM::is_admin() || isset($permission) &&
            isset($permission['attributetitles']['status_update'])
            && $permission['attributetitles']['status_update'] == 1) {
            $attribute['status'] = $request->status;
        }
        if (isset($request->image) && $request->image != '') {
            $attribute['image'] = $request->image;
        }

        $slug = (trim($request->slug) != '') ? $request->slug : $request->title;
        $attribute['slug'] = SM::create_uri('attributetitles', $slug);
        $attribute['created_by'] = SM::current_user_id();
        $attribute['seo_title'] = $request->input("seo_title", "");
        $attribute['meta_key'] = $request->input("meta_key", "");
        $attribute['meta_description'] = $request->input("meta_description", "");
        $cat = Attributetitle_model::create($attribute);
        if ($cat) {
            $this->removeThisCache();

            return redirect(SM::smAdminSlug("attributetitles"))
                ->with('s_message', 'Attributetitle Saved Successfully!');
        } else {
            return redirect(SM::smAdminSlug("attributetitles"))
                ->with('s_message', 'Attributetitle Save Failed!');
        }

    }

    public function get_add_new_attribute_title(Request $request)
    {
        if ($request->ajax()) {
            $output = '<div class="modal-header"> 
                    <h4 class="modal-title">Add New Attribute Title<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
                 </div>  
                 <div class="modal-body"> 
                       <div class="col-md-12">
                        <div class="form-group row">  
                             <label class="col-md-4 col-form-label">Attribute Title</label>
                              <div class="col-md-8">
                                 <input type="text" required="true" name="title" autocomplete="off"  placeholder="Attribute Value" class="form-control title"> 
                            </div> 
                       </div>   
                    </div>  
                 </div>
                    <div class="modal-footer">
                       <button type="button" id="close" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>
                       <button type="button" class="btn btn-success submit_new_attribute_title" id="btn">Submit</button>
                    </div>';
            echo $output;
        }
    }

    public function get_add_new_attribute(Request $request)
    {
        if ($request->ajax()) {
            $output = '';
            $row = Attributetitle::find($request->attributetitle_id);
            if ($row) {
                $output .= '<div class="modal-header"> 
                    <h4 class="modal-title">Add New <strong>' . $row->title . '</strong> Value<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></h4>
                 </div>  
                 <div class="modal-body"> 
                       <div class="col-md-12">
                        <div class="form-group row">  
                             <label class="col-md-4 col-form-label">Attribute Value</label>
                              <div class="col-md-8">
                                 <input type="text" required="true" name="title" autocomplete="off"  placeholder="Attribute Value" class="form-control title"> 
                            </div> 
                       </div>   
                    </div> 
                     <input type="hidden" class="attributetitle_id" name="attributetitle_id" value="' . $row->id . '"> 
                    <input type="hidden" class="attributetitle" name="attributetitle" value="' . $row->title . '"> 
                 </div>
                    <div class="modal-footer">
                       <button type="button" id="close" class="btn btn-warning pull-left" data-dismiss="modal">Close</button>
                       <button type="button" class="btn btn-success submit_new_attribute" id="btn">Submit</button>
                    </div>  ';
            } else {
                $output .= 'false';
            }
            echo $output;
        }
    }

    public function store_new_attribute_title(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'title' => 'required|max:155|unique:attributetitles',
                'slug' => 'max:155|unique:attributetitles',
            ]);
            $attribute = new Attributetitle();
            $attribute->title = $request->title;
            $attribute->slug = str_slug($request->title);
            $attribute->created_by = SM::current_user_id();
            $attribute->status = 1;
            if ($attribute->save()) {
                $output['view_attribute_title_html'] = $this->view_attribute_title_html($attribute->id);
                echo json_encode($output);
            }
        }
    }

    public function view_attribute_title_html($attributeId)
    {
        $html = '';
        $attributetitle = Attributetitle::find($attributeId);
        if (!empty($attributetitle)) {
            $attKey = $attributeId;
            $collapsed = '';
            $aria_expanded = 'true';
            $collapse = 'in';
            $html .= '<div class="panel panel-default stock_parent">
                            <div class="panel-heading" role="tab" id="heading_' . $attKey . '">
                                <h4 class="panel-title">
                                    <a class="' . $collapsed . '"
                                       role="button" data-toggle="collapse"
                                       data-parent="#accordion" href="#collapse_' . $attKey . '"
                                       aria-expanded="' . $aria_expanded . '"
                                       aria-controls="collapse_' . $attKey . '">
                                        ' . $attributetitle->title . '
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_' . $attKey . '"
                                 class="panel-collapse collapse ' . $collapse . '"
                                 role="tabpanel" aria-labelledby="heading_' . $attKey . '">
                                <div id="attribute_value_' . $attributetitle->id . '" class="panel-body">
                                 <button type="button" data-attributetitle_id="' . $attributetitle->id . '"
                                    class="addNewAttribute  btn btn-sm btn-success" title="Add Attribute">
                                    <i class="fa fa-plus"></i>
                                    </button>';
            if (count($attributetitle->attributes) > 0) {
                foreach ($attributetitle->attributes as $attribute) {
                    $html .= '<button type="button" name="view"
                                                    value="' . $attribute->id . '"
                                                    class="btn btn-xs btn-default attribute_data"
                                                    title= "' . $attribute->title . '" > ' . $attribute->title . '
                                            </button >';
                }
            }
            $html .= ' </div>
                                 <div class="form-group row">
                                        <div class="col-sm-9">
                                           ' . \Form::checkbox('product_attribute[]', $attributetitle->id, false, ['id' => 'product_attribute' . $attKey, 'class' => 'product_attribute']) . '
                                            ' . \Form::label('product_attribute' . $attKey, 'Used for variations?', array('class' => 'col-form-label')) . '
                                        </div>
                                    </div>
                            </div>
                        </div> ';
        }

        return $html;
    }

    public function store_new_attribute(Request $request)
    {
        if ($request->ajax()) {
            $this->validate($request, [
                'title' => 'required|max:155|unique:attributes',
                'attributetitle_id' => 'required',
            ]);
            $attribute = new Attribute();
            $attribute->attributetitle_id = $request->attributetitle_id;
            $attribute->title = $request->title;
            $attribute->type = $request->type;
            $attribute->created_by = SM::current_user_id();
            $attribute->status = 1;
            if ($attribute->save()) {
                $html = '<button type="button" name="view" value="' . $attribute->id . '" class="btn btn-sm btn-default attribute_data_edit"
                                                    title="' . $request->title . '">' . $request->title . '
                                            </button>';
                $output['view_attribute_html'] = $html;
                echo json_encode($output);
            }
        }
    }

    public function view_attribute_html($attributetitle_id)
    {
        $html = '';
        $attributetitle_lists = Attributetitle::Published()->get();
        if (count($attributetitle_lists) > 0) {
            foreach ($attributetitle_lists as $attKey => $attributetitle) {
                $html .= '<div class="panel panel-default stock_parent">
                            <div class="panel-heading" role="tab" id="heading_' . $attKey . '">
                                <h4 class="panel-title">
                                    <a class=""
                                       role="button" data-toggle="collapse" aria-controls="collapse_' . $attKey . '"
                                       data-parent="#accordion" href="#collapse_' . $attKey . '"
                                       aria-expanded="">
                                        ' . $attributetitle->title . '
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse_' . $attKey . '" role="tabpanel" aria-labelledby="heading_' . $attKey . '"
                                 class="panel-collapse collapse">
                                <div class="panel-body">';
                if (count($attributetitle->attributes) > 0) {
                    foreach ($attributetitle->attributes as $attribute) {
                        $html .= '<button type="button" name="view" value="' . $attribute->id . '" class="btn btn-xs btn-default attribute_data"
                                                    title="' . $attribute->title . '">' . $attribute->title . '
                                            </button>';
                    }
                }
                $html .= '<button type="button" data-attributetitle_id="' . $attributetitle->id . '"
                                            class="addNewAttribute" title="Add Attribute"><i
                                                class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>';
            }
        }
        return $html;
    }

    public function edit_attribute_data(Request $request)
    {
        $delete = SM::check_this_method_access('attributetitles', 'destroy') ? 1 : 0;
        if ($request->ajax()) {
            $output = '';
            $row = Attribute::find($request->attribute_id);
            if ($row) {
                $output .= '<div class="modal-header">
            
            <h4 class="modal-title"><strong>' . $row->attributetitle->title . ' : ' . $row->title . '</strong>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </h4>
         </div>
          <form action="' . route('update_attribute_data') . '" method="POST">  
          <input type="hidden" name="_token" value="' . csrf_token() . '" > 
         <div class="modal-body"> 
               <div class="col-md-12">
                <div class="form-group row">  
                     <label class="col-md-4 col-form-label">Attribute Value</label>
                      <div class="col-md-8">
                         <input type="text" required="true" name="title" value="' . $row->title . '" autocomplete="off"  placeholder="Attribute" class="form-control"> 
                    </div> 
               </div>   
            </div> 
            <input type="hidden" name="modified_by" value="' . SM::current_user_id() . '"> 
            <input type="hidden" name="attributetitle_id" value="' . $row->attributetitle_id . '"> 
            <input type="hidden" name="attribute_id" value="' . $row->id . '"> 
            <input type="hidden" name="type" value="' . $row->title . '"> 
         </div>
            <div class="modal-footer">
               <button type="button" id="close" class="btn btn-warning pull-left" data-dismiss="modal">Close</button> ';
                if ($delete != 0) {
                    $output .= '<a href="' . url(config('constant.smAdminSlug') . '/delete_attribute_data') . '/' . $row->id . '" 
                  title="Delete" class="btn btn-danger pull-left delete_data_row" delete_message="Are you sure to delete this data?" delete_row="tr_' . $row->id . '">
                    Delete
                    </a> ';
                }
                if (SM::is_admin() == true || count($row->products) <= 0 && $row->created_by == SM::current_user_id()) {
//                if ($row->created_by == SM::current_user_id()) {
                    $output .= '<button type="submit" class="btn btn-success" id="btn">Update</button>';
                }
                $output .= '</div>
            </form> 
                 ';
            } else {
                $output .= 'false';
            }
            echo $output;


        }
    }

    public function store_attribute_data(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:150',
//            'seo_title' => 'max:70',
//            'meta_description' => 'max:215'
        ]);
        $attribute = $request->all();
        $cat = Attribute::create($attribute);
        if ($cat) {
            $this->removeThisCache();
            return back()->with('s_message', 'Attribute Value Saved Successfully!');
        } else {
            return back()->with('s_message', 'Attribute Value Save Failed!');
        }

    }

    public function update_attribute_data(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:150',
//            'seo_title' => 'max:70',
//            'meta_description' => 'max:215'
        ]);

        $attribute = Attribute::find($request->attribute_id);
        $attribute->title = $request->title;
        $attribute->attributetitle_id = $request->attributetitle_id;
        $attribute->type = $request->type;
        $attribute->modified_by = $request->modified_by;
        $attribute->update();
        if ($attribute) {
            $this->removeThisCache();
            return back()->with('s_message', 'Attribute Value Updated Successfully!');
        } else {
            return back() > with('s_message', 'Attribute Value Updated Failed!');
        }

    }

    public function delete_attribute_data($id)
    {
        $data = Attribute::find($id);
        if (count($data) > 0) {
            if ($data->delete() > 0) {
                return response(1);
            }
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
        $data["attributetitle_info"] = Attributetitle_model::find($id);
        if (count($data["attributetitle_info"]) > 0) {
            $data['rightButton']['iconClass'] = 'fa fa-list-alt';
            $data['rightButton']['text'] = 'Attributetitle List';
            $data['rightButton']['link'] = 'attributetitles';
            $data['rightButton2']['iconClass'] = 'fa fa-eye';
            $data['rightButton2']['text'] = 'View';
            $data['rightButton2']['link'] = "attributetitle/attributetitle/" . $data['attributetitle_info']->slug;
            return view("nptl-admin/common/attributetitle/edit", $data);
        } else {
            return redirect(SM::smAdminSlug('attributetitles'))
                ->with('s_message', 'Attributetitle not found!');
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
//            'seo_title' => 'max:70',
//            'meta_description' => 'max:215'
        ]);
        $attribute = Attributetitle_model::find($id);
        if (count($attribute) > 0) {
            $this->removeThisCache($attribute->slug);
            $attribute->title = $request->title;
            $attribute->description = $request->description;
            $attribute->seo_title = $request->input("seo_title", "");
            $attribute->meta_key = $request->input("meta_key", "");
            $attribute->meta_description = $request->input("meta_description", "");
            $permission = SM::current_user_permission_array();
            if (SM::is_admin() || isset($permission) &&
                isset($permission['attributetitles']['status_update'])
                && $permission['attributetitles']['status_update'] == 1) {
                $attribute->status = $request->status;
            }
            if (isset($request->image) && $request->image != '') {
                $attribute->image = $request->image;
            }

            $slug = (trim($request->slug) != '') ? $request->slug : $request->title;
            $attribute->slug = SM::create_uri('attributetitles', $slug, $id);
            $attribute->modified_by = SM::current_user_id();

            if ($attribute->update() > 0) {
                $this->removeThisCache();

                return redirect(SM::smAdminSlug("attributetitles/$attribute->id/edit"))
                    ->with('s_message', 'Attributetitle Update Successfully!');
            } else {
                return redirect(SM::smAdminSlug("attributetitles/$attribute->id/edit"))
                    ->with('s_message', 'Attributetitle Update Failed!');
            }
        } else {
            return redirect(SM::smAdminSlug('attributetitles'))
                ->with('w_message', 'Attributetitle not found!');
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
        $cat = Attributetitle_model::find($id);
        if (count($cat->attributes) < 1) {
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

        $cat = Attributetitle_model::find($request->post_id);
        if (count($cat) > 0) {
            $cat->status = $request->status;
            $cat->update();
            $this->removeThisCache($cat->slug);
        }
        exit;
    }

    private
    function removeThisCache($slug = null)
    {
        if ($slug != null) {
            SM::removeCache('attributetitle_' . $slug);
        }
        SM::removeCache('attributetitles_have_posts');
        SM::removeCache('attributetitles_have_not_post');
        SM::removeCache(['attribute'], 1);
        SM::removeCache(['attributeBlogs'], 1);
    }
}
