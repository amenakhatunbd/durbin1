



<div class="account-panel account-sidebar" id="dashboard_side_bar_menu">
    <a href="{{route('dashboard')}}"><h2>My Account</h2></a>
    {!! Form::open(['method'=>'post', 'url'=>'dashboard/user-profile-pic-change','files'=>true, 'id'=>'profile_picture_form']) !!}
    <div class="account-profile-img">
        @if(!empty($userInfo->image))
        <img id="profile_picture_img" src="{!! SM::sm_get_the_src($userInfo->image,165,165) !!}" alt="{{ $userInfo->username }}">
        @else 
        <img id="profile_picture_img" src="{{ asset('images/writer-icon.png') }}" alt="{{ $userInfo->username }}">
        
        @endif
          
        <span class="change-profile-pic">
                <i class="fa fa-camera"></i>
                 <input type="file" name="profile_picture">
        </span>
    </div>
    {!! Form::close() !!}
    <h4 class="change-account-name-opt">
        <?php
        $user_info_type  = Auth::user()->type;

       // dd($user_info_type);

        $flname = $userInfo->firstname . " " . $userInfo->lastname;
        $name = trim($flname != '') ? $flname : $userInfo->username;
        ?>
        {{ $name }}
        {{-- <a href="{!! url("dashboard/edit-profile") !!}"><i class="fa fa-pencil-square-o"></i> </a> --}}
    </h4>
    <span class="devider"></span>
    @if($user_info_type == 'customer')
    <ul>
        <li class="@if($activeMenu == 'dashboard') {{ 'active' }} @endif">
            <a href="{!! url('dashboard') !!}"><i class="fa fa-dashboard"></i> Dashboard
            </a>
        </li>
        <li class="@if($activeMenu == 'edit-profile') {{ 'active' }} @endif">
            <a href="{!! url("dashboard/edit-profile") !!}">
                <i class="fa fa-file-text-o"></i> Profile
            </a>
        </li>
        <li class="@if($activeMenu == 'orders') {{ 'active' }} @endif">
            <a href="{!! url('dashboard/orders') !!}"><i class="fa fa-shopping-cart"></i> My Orders
            </a>
        </li>
        <li class="@if($activeMenu == 'wishlist') {{ 'active' }} @endif">
            <a href="{!! url('dashboard/wishlist') !!}"><i class="fa fa-heart"></i> Wishlist
            </a>
        </li>
        <li class="@if($activeMenu == 'review') {{ 'active' }} @endif">
            <a href="{!! url('dashboard/review') !!}"><i class="fa fa-star"></i> Review
            </a>
        </li>

        {{--<li class="@if($activeMenu == 'coupons') {{ 'active' }} @endif">--}}
        {{--<a href="{!! url('dashboard/coupons') !!}"><i class="fa fa-thumbs-up"></i> Coupons<span--}}
        {{--class="fa fa-angle-right"></span></a>--}}
        {{--</li>--}}
        <li style="display: none;" class="@if($activeMenu == 'downloads') {{ 'active' }} @endif">
            <a href="{!! url('dashboard/downloads') !!}"><i class="fa fa-download"></i> Downloads
            </a>
        </li>
        <li style="display: none;" class="@if($activeMenu == 'tickets') {{ 'active' }} @endif">
            <a href="{!! url('dashboard/tickets') !!}"><i class="fa fa-support"></i> My Tickets
            </a>
        </li>
        <li style="display: none;" class="@if($activeMenu == 'add-ticket') {{ 'active' }} @endif">
            <a href="{!! url('dashboard/tickets/add') !!}"><i class="fa fa-ticket"></i> Add Tickets
            </a>
        </li>
        <li>
            <a href="{!! url('logout') !!}"><i class="fa fa-power-off"></i> Log Out</a>
        </li>
    </ul>
    @else
    <ul>
        <li class="@if($activeMenu == 'dashboard') {{ 'active' }} @endif">
            <a href="{!! url('dashboard') !!}"><i class="fa fa-dashboard"></i> Dashboard
            </a>
        </li>
        <li class="@if($activeMenu == 'edit-profile') {{ 'active' }} @endif">
            <a href="{!! url("dashboard/edit-profile") !!}">
                <i class="fa fa-file-text-o"></i> Update Profile
            </a>
        </li>
        <li class="@if($activeMenu == 'publisher_orders') {{ 'active' }} @endif">
            <a href="{{route('publisher_orders')}}"><i class="fa fa-shopping-cart"></i>Customer Orders
            </a>
        </li>
        <li class="@if($activeMenu == 'orders') {{ 'active' }} @endif">
            <a href="{!! url('dashboard/orders') !!}"><i class="fa fa-shopping-cart"></i> My Orders
            </a>
        </li>
        {{-- <li class="@if($activeMenu == 'publisher_orders_today') {{ 'active' }} @endif">
            <a href="{{route('publisher_orders_today')}}"><i class="fa fa-shopping-cart"></i>Customer Orders Today
            </a>
        </li> --}}
        <li class="@if($activeMenu == 'books') {{ 'active' }} @endif">
            <a href="{{route('books')}}"><i class="fa fa-book"></i>Books List
            </a>
        </li>

        <li class="@if($activeMenu == 'books_short_stock') {{ 'active' }} @endif">
            <a href="{{route('books_short_stock')}}"><i class="fa fa-book"></i>Low Stock Books
            </a>
        </li>
        <li>
            <a href="{!! url('logout') !!}"><i class="fa fa-power-off"></i> Log Out</a>
        </li>
    </ul>
    @endif
<script type="text/javascript">
    if ($("#profile_picture_form").length > 0) {
    $("#profile_picture_form").on("change", function () {
      
        $(".change-profile-pic i").removeClass("fa-camera");
        $(".change-profile-pic i").addClass("fa-refresh fa-spin");
        $.ajax({
            type: 'post',
            url: $(this).attr("action"),
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {
                $("#profile_picture_img").attr("src", response.src);
                $(".change-profile-pic i").removeClass("fa-refresh fa-spin");
                $(".change-profile-pic i").addClass("fa-camera");
            },
            error: function (error) {
                console.log(error);
            }
        });
        return false;
    });
}
</script>
</div>
