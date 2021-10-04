{{csrf_field()}}
<fieldset>
    <div class="form-group{{ $errors->has('role') ? ' has-error' : '' }}">
        <label class="label control-label" for="role">Role name</label>
        <div class="input">
            <input name="role" id="role" class="form-control" placeholder="Role Name" type="text" required=""
                   value="{{ old('role')!=''? old('role'): isset($role->name)? $role->name : ""}}" autocomplete="off">
            <input name="id" id="id" type="hidden" value="{{ isset($role->id)? $role->id : ""}}">
            @if ($errors->has('role'))
                <span class="help-block">
            <strong>{{ $errors->first('role') }}</strong>
         </span>
            @endif
        </div>
    </div>
</fieldset>
<fieldset>
    <section>
        <?php
        $permission = (isset($role->permission)) ? SM::sm_unserialize($role->permission) : array();
        ?>
        <div class="row">
            <?php
            $media = isset($permission['media']) ? $permission['media'] : array();
            ?>
            <div class="col col-3 user_role">
                <label class="label"><b>Media Management</b></label>
                <label class="checkbox">
                    <input type="checkbox" name="permission[media][upload]" <?php
                    echo is_array($media) && isset($media['upload']) && $media['upload'] == 1 ? 'checked="checked"' : '';
                    ?> value="1">
                    <i></i>Upload File</label>
                <span class="role_helper_text">Upload any kind of file from media library. Without selecting this user can upload image from upload section.</span>

                <label class="checkbox">
                    <input type="checkbox" name="permission[media][view]" <?php
                    echo is_array($media) && isset($media['view']) && $media['view'] == 1 ? 'checked="checked"' : '';
                    ?> value="1">
                    <i></i>View All User Files</label>
                <span class="role_helper_text">User can view personal image Without selecting this.</span>
            </div>
            {{--categories--}}
            <?php
            $categories = isset($permission['categories']) ? $permission['categories'] : array();
            $methods = [
                'categories' => 'Manage Categories',
                'index' => 'All Category',
                'create' => 'Add Category',
                'edit' => 'Edit Category',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Category',
            ];
            echo SM::generateRoleHtml('Category', 'categories', $methods, $categories);
            ?>
            {{--tags--}}
            <?php
            $tags = isset($permission['tags']) ? $permission['tags'] : array();
            $methods = [
                'tags' => 'Manage Tags',
                'index' => 'All Tag',
                'create' => 'Add Tag',
                'edit' => 'Edit Tag',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Tag',
            ];
            echo SM::generateRoleHtml('Tag', 'tags', $methods, $tags);
            ?>

            {{--Author--}}
            <?php
            $authors = isset($permission['authors']) ? $permission['authors'] : array();
            $methods = [
                'authors' => 'Manage Author',
                'index' => 'All Author',
                'create' => 'Add Author',
                'edit' => 'Edit Author',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Author',
            ];
            echo SM::generateRoleHtml('Author', 'authors', $methods, $authors);
            ?>


            {{--brands--}}
            <?php
            $brands = isset($permission['brands']) ? $permission['brands'] : array();
            $methods = [
                'brands' => 'Manage Brands',
                'index' => 'All Brand',
                'create' => 'Add Brand',
                'edit' => 'Edit Brand',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Brand',
            ];
            echo SM::generateRoleHtml('Brand', 'brands', $methods, $brands);
            ?>
            <div class="clearfix"></div>
            {{--attributetitles--}}
            <?php
            $attributetitles = isset($permission['attributetitles']) ? $permission['attributetitles'] : array();
            $methods = [
                'attributetitles' => 'Manage Attributes',
                'index' => 'All Attribute',
                'create' => 'Add Attribute',
                'edit' => 'Edit Attribute',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Attribute',
            ];
            echo SM::generateRoleHtml('Attribute', 'attributetitles', $methods, $attributetitles);
            ?>
            {{--units--}}
            <?php
            $units = isset($permission['units']) ? $permission['units'] : array();
            $methods = [
                'units' => 'Manage Units',
                'index' => 'All Unit',
                'create' => 'Add Unit',
                'edit' => 'Edit Unit',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Unit',
            ];
            echo SM::generateRoleHtml('Unit', 'units', $methods, $units);
            ?>
            {{--products--}}
            <?php
            $products = isset($permission['products']) ? $permission['products'] : array();
            $methods = [
                'products' => 'Manage Products',
                'index' => 'All Product',
                'create' => 'Add Product',
                'edit' => 'Edit Product',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Product',
                'reviews' => 'Product Review',
                'review_status_update' => 'Review Status Update',
                'delete_review' => 'Delete Review',
            ];
            echo SM::generateRoleHtml('Product', 'products', $methods, $products);
            ?>
            {{--coupons--}}
            <?php
            $coupons = isset($permission['coupons']) ? $permission['coupons'] : array();
            $methods = [
                'coupons' => 'Manage Coupons',
                'index' => 'All Coupon',
                'create' => 'Add Coupon',
                'edit' => 'Edit Coupon',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Coupon',
            ];
            echo SM::generateRoleHtml('Coupon', 'coupons', $methods, $coupons);
            ?>
            <div class="clearfix"></div>
            {{--orders--}}
            <?php
            $orders = isset($permission['orders']) ? $permission['orders'] : array();
            $methods = [
                'orders' => 'Manage Orders',
                'index' => 'All Order',
                'show' => 'View Order Invoice',
                'download' => 'Download Order Invoice',
                'order_mail' => 'Order Mail',
                'order_status_update' => 'Order Status Update',
                'payment_status_update' => 'Payment Status Update',
                'destroy' => 'Delete Order',
                'sales' => 'All Sales ',
            ];
            echo SM::generateRoleHtml('Orders', 'orders', $methods, $orders);
            ?>
            {{--blogs--}}
            <?php
            $blogs = isset($permission['blogs']) ? $permission['blogs'] : array();
            $methods = [
                'blogs' => 'Manage Blogs',
                'index' => 'All Blog',
                'create' => 'Add Blog',
                'edit' => 'Edit Blog',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Blog',
            ];
            echo SM::generateRoleHtml('Blog', 'blogs', $methods, $blogs);
            ?>
            <div class="col col-3 user_role">
                <label class="label"><b>Comments Management</b></label>
                <label class="checkbox">
                    <input type="checkbox" name="permission[blogs][comments]" <?php
                    echo is_array($blogs) && isset($blogs['comments']) && $blogs['comments'] == 1 ? 'checked="checked"' : '';
                    ?>   value="1">
                    <i></i>Comments Management</label>

                <label class="checkbox">
                    <input type="checkbox" name="permission[blogs][comments]" <?php
                    echo is_array($blogs) && isset($blogs['comments']) && $blogs['comments'] == 1 ? 'checked="checked"' : '';
                    ?>   value="1">
                    <i></i>All Comment List</label>

                <label class="checkbox">
                    <input type="checkbox" name="permission[blogs][reply_comment]" <?php
                    echo is_array($blogs) && isset($blogs['reply_comment']) && $blogs['reply_comment'] == 1 ? 'checked="checked"' : '';
                    ?>    value="1">
                    <i></i>Reply Comment</label>

                <label class="checkbox">
                    <input type="checkbox" name="permission[blogs][edit_comment]" <?php
                    echo is_array($blogs) && isset($blogs['edit_comment']) && $blogs['edit_comment'] == 1 ? 'checked="checked"' : '';
                    ?>   value="1">
                    <i></i>Edit Comment</label>

                <label class="checkbox">
                    <input type="checkbox" name="permission[blogs][comment_status_update]" <?php
                    echo is_array($blogs) && isset($blogs['comment_status_update']) && $blogs['comment_status_update'] == 1 ? 'checked="checked"' : '';
                    ?>   value="1">
                    <i></i>Comment Status Change</label>

                <label class="checkbox">
                    <input type="checkbox" name="permission[blogs][delete_comment]" <?php
                    echo is_array($blogs) && isset($blogs['delete_comment']) && $blogs['delete_comment'] == 1 ? 'checked="checked"' : '';
                    ?> value="1">
                    <i></i>Delete Comment</label>
            </div>
            {{--sliders--}}
            <?php
            $pages = isset($permission['pages']) ? $permission['pages'] : array();
            $methods = [
                'pages' => 'Manage Pages',
                'index' => 'All Page',
                'create' => 'Add Page',
                'edit' => 'Edit Page',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Page',
            ];
            echo SM::generateRoleHtml('Page', 'pages', $methods, $pages);
            ?>
            <div class="clearfix"></div>
            {{--sliders--}}
            <?php
            $sliders = isset($permission['sliders']) ? $permission['sliders'] : array();
            $methods = [
                'sliders' => 'Manage Sliders',
                'index' => 'All Slider',
                'create' => 'Add Slider',
                'edit' => 'Edit Slider',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Slider',
            ];
            echo SM::generateRoleHtml('Slider', 'sliders', $methods, $sliders);
            ?>


            <?php
            $appearance = isset($permission['appearance']) ? $permission['appearance'] : array();
            ?>
            <div class="col col-3 user_role">
                <label class="label"><b>Appearance Management</b></label>
                <label class="checkbox">
                    <input type="checkbox" name="permission[appearance][appearance]" <?php
                    echo is_array($appearance) && isset($appearance['appearance']) && $appearance['appearance'] == 1 ? 'checked="checked"' : '';
                    ?> value="1">
                    <i></i>Appearance Management</label>
                <label class="checkbox">
                    <input type="checkbox" name="permission[appearance][smthemeoptions]" <?php
                    echo is_array($appearance) && isset($appearance['smthemeoptions']) && $appearance['smthemeoptions'] == 1 ? 'checked="checked"' : '';
                    ?> value="1">
                    <i></i>Theme Options</label>
                <label class="checkbox">
                    <input type="checkbox" name="permission[appearance][menus]" <?php
                    echo is_array($appearance) && isset($appearance['menus']) && $appearance['menus'] == 1 ? 'checked="checked"' : '';
                    ?> value="1">
                    <i></i>Menus</label>
                <label class="checkbox">
                    <input type="checkbox" name="permission[appearance][editor]" <?php
                    echo is_array($appearance) && isset($appearance['editor']) && $appearance['editor'] == 1 ? 'checked="checked"' : '';
                    ?> value="1">
                    <i></i>View Editor File</label>

                <label class="checkbox">
                    <input type="checkbox" name="permission[appearance][updatefile]" <?php
                    echo is_array($appearance) && isset($appearance['updatefile']) && $appearance['updatefile'] == 1 ? 'checked="checked"' : '';
                    ?> value="1">
                    <i></i>Update Editor File</label>
            </div>
            {{--users--}}
            <?php
            $users = isset($permission['users']) ? $permission['users'] : array();
            $methods = [
                'users' => 'Manage Users',
                'index' => 'All User',
                'create' => 'Add User',
                'edit' => 'Edit User',
                'status_update' => 'Status Update',
                'destroy' => 'Delete User',
            ];
            echo SM::generateRoleHtml('User', 'users', $methods, $users);
            ?>
            {{--Role--}}
            <?php
            $users = isset($permission['users']) ? $permission['users'] : array();
            $methods = [
                'users' => 'User Role Management',
                'roles' => 'All Role',
                'add_role' => 'Add Role',
                'edit_role' => 'Edit Role',
                'delete_role' => 'Delete Role',
            ];
            echo SM::generateRoleHtml('Role', 'users', $methods, $users);
            ?>
            <div class="clearfix"></div>
            {{--customers--}}
            <?php
            $customers = isset($permission['customers']) ? $permission['customers'] : array();
            $methods = [
                'customers' => 'Manage Customers',
                'index' => 'All Customer',
                'create' => 'Add Customer',
                'edit' => 'Edit Customer',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Customer',
            ];
            echo SM::generateRoleHtml('Customer', 'customers', $methods, $customers);
            ?>
            {{--contacts--}}
            <?php
            $contacts = isset($permission['contacts']) ? $permission['contacts'] : array();
            $methods = [
                'contacts' => 'Manage Conatcts',
                'index' => 'All Conatct',
                'destroy' => 'Delete Conatct',
            ];
            echo SM::generateRoleHtml('Conatct', 'contacts', $methods, $contacts);
            ?>
            {{--subscribers--}}
            <?php
            $subscribers = isset($permission['subscribers']) ? $permission['subscribers'] : array();
            $methods = [
                'subscribers' => 'Manage Subscribers',
                'index' => 'All Subscriber',
                'create' => 'Add Subscriber',
                'edit' => 'Edit Subscriber',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Subscriber',
            ];
            echo SM::generateRoleHtml('Subscriber', 'subscribers', $methods, $subscribers);
            ?>
            {{--paymentmethods--}}
            <?php
            $paymentmethods = isset($permission['paymentmethods']) ? $permission['paymentmethods'] : array();
            $methods = [
                'paymentmethods' => 'Manage Payment Method',
                'index' => 'All Payment Method',
                'create' => 'Add Payment Method',
                'edit' => 'Edit Payment Method',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Payment Method',
            ];
            echo SM::generateRoleHtml('Payment Method', 'paymentmethods', $methods, $paymentmethods);
            ?>
            <div class="clearfix"></div>
            {{--paymentmethods--}}
            <?php
            $shippingmethods = isset($permission['shippingmethods']) ? $permission['shippingmethods'] : array();
            $methods = [
                'shippingmethods' => 'Manage Shipping Method',
                'index' => 'All Shipping Method',
                'create' => 'Add Shipping Method',
                'edit' => 'Edit Shipping Method',
                'status_update' => 'Status Update',
                'destroy' => 'Delete Shipping Method',
            ];
            echo SM::generateRoleHtml('Shipping Method', 'shippingmethods', $methods, $shippingmethods);
            ?>
            <?php
            $taxes = isset($permission['taxes']) ? $permission['taxes'] : array();
            $methods = [
                'taxes' => 'Manage Taxes',
                'index' => 'All Tax',
                'create' => 'Add Tax',
                'edit' => 'Edit Tax',
                'status_update' => 'Tax Status Update',
                'destroy' => 'Delete Tax',
            ];
            echo SM::generateRoleHtml('Taxes', 'taxes', $methods, $taxes);
            ?>
            <?php
            $reports = isset($permission['reports']) ? $permission['reports'] : array();
            $methods = [
                'reports' => 'Manage Reports',
                'order_reports' => 'Order Report',
                'order_details' => 'Order Details'
            ];
            echo SM::generateRoleHtml('Report', 'reports', $methods, $reports);
            ?>
            <?php
            $setting = isset($permission['setting']) ? $permission['setting'] : array();
            ?>
            <div class="col col-3 user_role">
                <label class="label"><b>Setting Management</b></label>
                <label class="checkbox">
                    <input type="checkbox" name="permission[setting][setting]" <?php
                    echo is_array($setting) && isset($setting['setting']) && $setting['setting'] == 1 ? 'checked="checked"' : '';
                    ?> value="1">
                    <i></i>Setting Management</label>

                <label class="checkbox">
                    <input type="checkbox" name="permission[setting][index]" <?php
                    echo is_array($setting) && isset($setting['index']) && $setting['index'] == 1 ? 'checked="checked"' : '';
                    ?>    value="1">
                    <i></i>Company General settings</label>

                <label class="checkbox">
                    <input type="checkbox" name="permission[setting][social]" <?php
                    echo is_array($setting) && isset($setting['social']) && $setting['social'] == 1 ? 'checked="checked"' : '';
                    ?>    value="1">
                    <i></i>Social settings</label>
            </div>

        </div>
    </section>
</fieldset>


<footer class="text-center">
    <button class="btn btn-primary" type="submit" id="add_user_btn">
        <i class="fa fa-save"></i>
        {{$btn_text}} Role
    </button>
</footer>

<script>
    $(document).ready(function () {
        $("body").on("change", "input:checkbox", function () {
            elementclass = $(this).attr('class');
            if ($("." + elementclass).prop('checked')) {
                // the checkbox was checked
                $("." + elementclass + "1").prop('checked', true);
            } else {
                // the checkbox was unchecked
                $("." + elementclass + "1").prop('checked', false);
            }
        });
    });
</script>