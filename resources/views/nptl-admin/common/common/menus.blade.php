<!-- NAVIGATION : This navigation is also responsive

  To make this navigation dynamic please make sure to link the node
  (the reference to the nav > ul) after page load. Or the navigation
  will not initialize.
-->
<nav id="admin_main_nav">
    <!-- NOTE: Notice the gaps after each icon usage <i></i>..
    Please note that these links work a bit different than
    traditional href="" links. See documentation for details.
    -->

    <ul>
        <?php $user_role = SM::current_user_role_name();

        if ($user_role != 'Publisher') {
        ?>
        <li ctrl="dashboard">
            <a href="{{url(url(SM::smAdminSlug()))}}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i>
                <span class="menu-item-parent">Dashboard</span>
            </a>
        </li>

        <li ctrl="media">
            <a href="{{url(url(SM::smAdminSlug('media')))}}" title="Media"><i class="fa fa-lg fa-fw fa-picture-o"></i>
                <span class="menu-item-parent">Media Gallery</span>
            </a>
        </li>






        <?php if (SM::check_this_contoller_access('posts')) : ?>
        <li ctrl="posts">
            <a href="#"><i class="fa fa-sticky-note-o" aria-hidden="true"></i><span class="menu-item-parent">All Posts</span></a>
            <ul>
                <?php if (SM::check_this_method_access('posts', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('posts/addposts'))}}">Add Posts</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('posts', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('posts/postsall'))}} ">All Posts</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>



        <?php if (SM::check_this_contoller_access('teachers')) : ?>
        <li ctrl="teacher">
            <a href="#"><i class="fa fa-sticky-note-o" aria-hidden="true"></i><span class="menu-item-parent">All Teacher</span></a>
            <ul>
                <?php if (SM::check_this_method_access('teachers', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('teachers/addteacher'))}}">Add Teacher</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('teachers', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('teachers/allteacher'))}} ">All Teacher</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>



        <?php if (SM::check_this_contoller_access('phones')) : ?>
        <li ctrl="phones">
            <a href="#"><i class="fa fa-sticky-note-o" aria-hidden="true"></i><span class="menu-item-parent"> Phone</span></a>
            <ul>
                <?php if (SM::check_this_method_access('phones', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('phones/addphone'))}}">Add phones</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('phones', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('phones/allphone'))}} ">All phones</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>








        <?php if (SM::check_this_contoller_access('shops')) : ?>
        <li ctrl="shops">
            <a href="#"><i class="fa fa-sticky-note-o" aria-hidden="true"></i><span class="menu-item-parent">Shop</span></a>
            <ul>
                <?php if (SM::check_this_method_access('shops', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('shops/addshop'))}}">Add Shop</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('shops', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('shops/allshop'))}} ">All Shop</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>



        <?php if (SM::check_this_contoller_access('students')) : ?>
        <li ctrl="students">
            <a href="#"><i class="fa fa-sticky-note-o" aria-hidden="true"></i><span class="menu-item-parent">Students</span></a>
            <ul>
                <?php if (SM::check_this_method_access('students', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('students/addstudent'))}}">Add student</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('students', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('students/allstudent'))}} ">All student</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>



        <?php if (SM::check_this_contoller_access('gests')) : ?>
        <li ctrl="gests">
            <a href="#"><i class="fa fa-sticky-note-o" aria-hidden="true"></i><span class="menu-item-parent">Gests</span></a>
            <ul>
                <?php if (SM::check_this_method_access('gests', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('gests/addgest'))}}">Add Gest</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('gests', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('gests/allgest'))}} ">All Gests</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>


        <?php if (SM::check_this_contoller_access('hostels')) : ?>
        <li ctrl="hostels">
            <a href="#"><i class="fa fa-sticky-note-o" aria-hidden="true"></i><span class="menu-item-parent">Hostels</span></a>
            <ul>
                <?php if (SM::check_this_method_access('hostels', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('hostels/addhostel'))}}">Add Hostel</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('hostels', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('hostels/allhostel'))}} ">All Hostels</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>


        <?php } ?>
        <li ctrl="media">
            <a href="https://fengyuanchen.github.io/photo-editor/" title="Media"><i
                    class="fa fa-lg fa-fw fa-picture-o"></i>
                <span class="menu-item-parent">Image Cropper</span>
            </a>
        </li>
        <?php if (SM::check_this_contoller_access('categories')) : ?>
        <li ctrl="categories">
            <a href="#"><i class="fa fa-lg fa-fw fa-list"></i> <span class="menu-item-parent">Category
                </span>&nbsp;
        @if($pendingCategory > 0)
                        <span class="label label-success">{{$pendingCategory}}</span>
        @endif

            </a>
            <ul>
                <?php if (SM::check_this_method_access('categories', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('categories/create'))}}">Add category</a>
                </li>

                <?php endif; ?>

                <?php if (SM::check_this_method_access('categories', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('categories'))}}">All Categories</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>



        <?php if (SM::check_this_contoller_access('schools')) : ?>
        <li ctrl="tags">
            <a href="#"><i class="fa fa-lg fa-fw fa-tags"></i> <span class="menu-item-parent">Schools</span></a>
            <ul>
                <?php if (SM::check_this_method_access('schools', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('schools/create'))}}">Add schools</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('schools', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('schools'))}}">All schools</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>








        <?php if (SM::check_this_contoller_access('tags')) : ?>
        <li ctrl="tags">
            <a href="#"><i class="fa fa-lg fa-fw fa-tags"></i> <span class="menu-item-parent">Tag Management</span></a>
            <ul>
                <?php if (SM::check_this_method_access('tags', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('tags/create'))}}">Add Tag</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('tags', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('tags'))}}">All Tag</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>


        <?php if (SM::check_this_contoller_access('brands')) : ?>
        <li ctrl="brands" class="hidden">
            <a href="#"><i class="fa fa-lg fa-fw fa-tags"></i> <span class="menu-item-parent">Brand
                    Management</span></a>
            <ul>
                <?php if (SM::check_this_method_access('brands', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('brands/create'))}}">Add Brand</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('brands', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('brands'))}}">All Brand</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('authors')) : ?>
        <li ctrl="authors">
            <a href="#"><i class="fa fa-lg fa-fw fa-tags"></i> <span class="menu-item-parent">Author</span>

@if($pendingAuthor > 0)
                <span class="label label-success">{{$pendingAuthor}}</span>
@endif


            </a>
            <ul>
                <?php if (SM::check_this_method_access('authors', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('authors/create'))}}">Add Author</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('authors', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('authors'))}}">All Author</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('publishers')) : ?>
        <li ctrl="publishers">
            <a href="#"><i class="fa fa-lg fa-fw fa-tags"></i> <span class="menu-item-parent">Publisher
                    </span>
@if($pendingPublisher > 0)
                <span class="label label-success">{{$pendingPublisher}}</span>
@endif



                </a>
            <ul>
                <?php if (SM::check_this_method_access('publishers', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('publishers/create'))}}">Add Publisher</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('publishers', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('publishers'))}}">All Publisher</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('attributetitles')) : ?>
        <li ctrl="attributetitles" class="hidden">
            <a href="#"><i class="fa fa-lg fa-fw fa-tags"></i> <span class="menu-item-parent">Attribute
                    Management</span></a>
            <ul>
                <?php if (SM::check_this_method_access('attributetitles', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('attributetitles/create'))}}">Add Attribute Title</a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('attributetitles', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('attributetitles'))}}">All Attribute Title</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('units')) : ?>
        <li ctrl="units">
            <a href="#"><i class="fa fa-lg fa-fw fa-tags"></i> <span class="menu-item-parent">Unit Management</span></a>
            <ul>
                <?php if (SM::check_this_method_access('units', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('units/create'))}}">Add Unit</a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('units', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('units'))}}">All Unit</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>


        <?php if ($user_role != 'Publisher') { ?>
        <?php if (SM::check_this_contoller_access('products')) : ?>
        <li ctrl="products">
            <a href="#"><i class="fa fa-lg fa-fw fa-list-alt"></i>  <span class="menu-item-parent">Product </span>&nbsp;
@if($pendingProduct > 0)
                <span class="label label-success"> {{ $pendingProduct }} </span>
@endif
            </a>
            <ul>
                <?php if (SM::check_this_method_access('products', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('products/create'))}}">Add Product</a>
                </li>
                <?php endif; ?>


                <?php if (SM::check_this_method_access('products', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('products'))}}">All Product</a>
                </li>
                <?php endif; ?>





                <?php if (SM::check_this_method_access('products', 'reviews')) : ?>
                <li mtd="reviews">
                    <a href="{{url(SM::smAdminSlug('products/reviews'))}}">All Reviews</a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('products', 'reviews')) : ?>
                <li mtd="reviews">
                    <a href="{{url(SM::smAdminSlug('products/importproducts'))}}">Import Product</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php } ?>

        <?php if ($user_role == 'Publisher') { ?>

        <?php if (SM::check_this_method_access('products', 'create')) : ?>
        <li mtd="create">
            <a href="{{url(SM::smAdminSlug('products/create'))}}"><i class="fa fa-lg fa-fw fa-list-alt"></i>Add Book</a>
        </li>
        <?php endif; ?>


        <?php if (SM::check_this_method_access('products', 'index')) : ?>
        <li mtd="index">
            <a href="{{url(SM::smAdminSlug('products'))}}"><i class="fa fa-lg fa-fw fa-list-alt"></i>All Books</a>
        </li>
        <?php endif; ?>

        <li mtd="index">
            <a href="{{route('index_inventory')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i>Inventory</a>
        </li>
        <?php } ?>

        <?php if ($user_role == 'Publisher') { ?>
        <li mtd="index">
            <a href="{{route('index_out_stock')}}"><i class="fa fa-lg fa-fw fa-list-alt"></i>Stock Out Product</a>
        </li>
        <?php } ?>


        <?php if (SM::check_this_contoller_access('coupons')) : ?>
        <li ctrl="coupons">
            <a href="#"><i class="fa fa-lg fa-fw fa-thumbs-up"></i> <span class="menu-item-parent">Coupon
                    Management</span></a>
            <ul>
                <?php if (SM::check_this_method_access('coupons', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('coupons/create'))}}">Add Coupon</a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('coupons', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('coupons'))}}">All Coupon</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('orders')) : ?>
        <li ctrl="orders">
            <a href="#"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Manage
                    Orders</span></a>
            <ul>
                <?php if (SM::check_this_method_access('orders', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('orders'))}}">All Orders</a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('orders', 'sales')) : ?>
                <li class="hidden" mtd="sales">
                    <a href="{{url(SM::smAdminSlug('orders-sales'))}}">Sales</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>

        <?php if (SM::check_this_contoller_access('blogs')) : ?>
        <li ctrl="blogs">
            <a href="#"><i class="fa fa-lg fa-fw fa-list-alt"></i> <span class="menu-item-parent">Blog
                    Management</span></a>
            <ul>
                <?php if (SM::check_this_method_access('blogs', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('blogs/create'))}}">Add Blog</a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('blogs', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('blogs'))}}">All Blog</a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('blogs', 'comments')) : ?>
                <li mtd="comments">
                    <a href="{{url(SM::smAdminSlug('blogs/comments'))}}">All Comments</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('pages')) : ?>
        <li ctrl="pages">
            <a href="#"><i class="fa fa-lg fa-fw fa-pagelines"></i> <span class="menu-item-parent">Page
                    Management</span></a>
            <ul>
                <?php if (SM::check_this_method_access('pages', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('pages/create'))}}">Add Page</a>
                </li>
                <?php endif; ?>

                <?php if (SM::check_this_method_access('pages', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('pages'))}}">All Page</a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('sliders')) : ?>
        <li ctrl="sliders">
            <a href="#"><i class="fa fa-lg fa-fw fa-sliders"></i> <span class="menu-item-parent">
                    Sliders
                </span></a>
            <ul>
                <?php if (SM::check_this_method_access('sliders', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('sliders/create'))}}">
                        {{__("menu.addSlider")}}
                    </a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('sliders', 'index    ')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('sliders'))}}">
                        {{__("menu.sliders")}}
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php
        endif;
        ?>
        <?php if (SM::check_this_contoller_access('appearance')) : ?>
        <li ctrl="appearance">
            <a href="#"><i class="fa fa-lg fa-fw fa-eye"></i> <span class="menu-item-parent">
                    {{__("menu.appearance")}}
                </span></a>
            <ul>
                <?php if (SM::check_this_method_access('appearance', 'smthemeoptions')) : ?>
                <li mtd="smthemeoptions">
                    <a href="{{url(SM::smAdminSlug('appearance/smthemeoptions'))}}">
                        {{__("menu.themeOption")}}
                    </a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('appearance', 'menus')) : ?>
                <li mtd="menus">
                    <a href="{{url(SM::smAdminSlug('appearance/menus'))}}">
                        {{__("menu.menus")}}
                    </a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('appearance', 'editor')) : ?>
                <li mtd="editor">
                    <a href="{{url(SM::smAdminSlug('appearance/editor'))}}">
                        <span class="menu-item-parent">Editor</span></a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php
        endif;
        ?>


        <?php if (SM::check_this_contoller_access('users')) : ?>
        <li ctrl="users">
            <a href="#"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">
                    Users
                </span></a>
            <ul>
                <?php if (SM::check_this_method_access('users', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('users/create'))}}">
                        {{__("menu.addUser")}}
                    </a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('users', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('users'))}}">
                        {{__("menu.allUser")}}
                    </a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('users', 'add_role')) : ?>
                <li mtd="add_role">
                    <a href="{{url(SM::smAdminSlug('users/add_role'))}}">
                        Add Role
                    </a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('users', 'roles')) : ?>
                <li mtd="roles">
                    <a href="{{url(SM::smAdminSlug('users/roles'))}}">
                        User Roles
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('customers')) : ?>
        <li ctrl="customers">
            <a href="#"><i class="fa fa-lg fa-fw fa-users"></i> <span class="menu-item-parent">
                    Customers
                </span></a>
            <ul>
                <?php if (SM::check_this_method_access('customers', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('customers/create'))}}">
                        Add Customer
                    </a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('customers', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('customers'))}}">
                        Customer List
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('contacts')) : ?>
        <li ctrl="contacts">
            <a href="{{url(url(SM::smAdminSlug('contacts')))}}" title="contacts"><i
                    class="fa fa-lg fa-fw fa-address-book"></i>
                <span class="menu-item-parent">Contacts</span>
            </a>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('subscribers')) : ?>
        <li ctrl="subscribers">
            <a href="{{url(url(SM::smAdminSlug('subscribers')))}}" title="Media"><i class="fa fa-lg fa-fw fa-star"></i>
                <span class="menu-item-parent">Subscribers</span>
            </a>
        </li>
        <?php endif; ?>

        <?php if (SM::check_this_contoller_access('paymentmethods')) : ?>
        <li ctrl="paymentmethods">
            <a href="#"><i class="fa fa-lg fa-fw fa-credit-card"></i> <span class="menu-item-parent">
                    Payment Methods
                </span></a>
            <ul>
                <?php if (SM::check_this_method_access('paymentmethods', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('paymentmethods/create'))}}">
                        Add Payment Method
                    </a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('paymentmethods', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('paymentmethods'))}}">
                        Payment Method List
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('shippingmethods')) : ?>
        <li ctrl="shippingmethods">
            <a href="#"><i class="fa fa-lg fa-fw fa-credit-card"></i> <span class="menu-item-parent">
                    Shipping Methods
                </span></a>
            <ul>
                <?php if (SM::check_this_method_access('shippingmethods', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('shippingmethods/create'))}}">
                        Add Shipping Method
                    </a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('shippingmethods', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('shippingmethods'))}}">
                        Shipping Method List
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('taxes')) : ?>
        <li ctrl="taxes">
            <a href="#"><i class="fa fa-lg fa-fw fa-money"></i> <span class="menu-item-parent">
                    Taxes
                </span></a>
            <ul>
                <?php if (SM::check_this_method_access('taxes', 'create')) : ?>
                <li mtd="create">
                    <a href="{{url(SM::smAdminSlug('taxes/create'))}}">
                        Add Tax
                    </a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('taxes', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('taxes'))}}">
                        Tax List
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('reports')) : ?>
        <li ctrl="reports">
            <a href="#"><i class="fa fa-lg fa-fw fa fa-file-text"></i> <span class="menu-item-parent">
                    Reports
                </span></a>
            <ul>
                <?php if (SM::check_this_method_access('reports', 'orders')) : ?>
                <li style="display: none;" mtd="orders">
                    <a href="{{url(SM::smAdminSlug('reports/orders'))}}"><i class="fa fa-lg fa-fw fa-shopping-cart"></i>
                        <span class="menu-item-parent">Order</span></a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('reports', 'order_reports')) : ?>
                <li mtd="order_reports">
                    <a href="{{url(SM::smAdminSlug('reports/order-reports'))}}"><i
                            class="fa fa-lg fa-fw fa-shopping-cart"></i>
                        <span class="menu-item-parent">Order Report</span></a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('reports', 'order_details')) : ?>
                <li mtd="order_details">
                    <a href="{{url(SM::smAdminSlug('reports/order-details'))}}"><i
                            class="fa fa-lg fa-fw fa-shopping-cart"></i>
                        <span class="menu-item-parent">Order Details</span></a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('reports', 'stock_report')) : ?>
                <li mtd="stock_report">
                    <a href="{{url(SM::smAdminSlug('reports/stock-report'))}}"><i class="fa fa-lg fa-fw fa-glass"></i>
                        <span class="menu-item-parent">Stock Report</span></a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('reports', 'stock_alert')) : ?>
                <li mtd="stock_alert">
                    <a href="{{url(SM::smAdminSlug('reports/stock-alert'))}}"><i class="fa fa-lg fa-fw fa-warning"></i>
                        <span class="menu-item-parent">Stock Alert</span></a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('reports', 'stock_expiry')) : ?>
                <li mtd="stock_expiry" class="hidden">
                    <a href="{{url(SM::smAdminSlug('reports/stock-expiry'))}}"><i
                            class="fa fa-lg fa-fw fa-calendar"></i>
                        <span class="menu-item-parent">Stock Expiry</span></a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('reports', 'slow_motion')) : ?>
                <li mtd="slow_motion">
                    <a href="{{url(SM::smAdminSlug('reports/slow-motion'))}}"><i
                            class="fa fa-lg fa-fw fa-shopping-cart"></i>
                        <span class="menu-item-parent">Slow Motion</span></a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if (SM::check_this_contoller_access('setting')) : ?>
        <li ctrl="setting">
            <a href="#"><i class="fa fa-lg fa-fw fa-cog"></i> <span class="menu-item-parent">
                    {{__("menu.setting")}}
                </span></a>
            <ul>
                <?php if (SM::check_this_method_access('setting', 'index')) : ?>
                <li mtd="index">
                    <a href="{{url(SM::smAdminSlug('setting'))}}"><i class="fa fa-lg fa-fw fa-cogs"></i>
                        <span class="menu-item-parent">{{__("menu.generalSetting")}}</span></a>
                </li>
                <?php endif; ?>
                <?php if (SM::check_this_method_access('setting', 'social')) : ?>
                <li mtd="social">
                    <a href="{{url(SM::smAdminSlug('setting/social'))}}"><i class="fa fa-lg fa-fw fa-share"></i>
                        <span class="menu-item-parent">Social Setting</span></a>
                </li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
    </ul>
</nav>
<span class="minifyme" data-action="minifyMenu">
    <i class="fa fa-arrow-circle-left hit"></i>
</span>