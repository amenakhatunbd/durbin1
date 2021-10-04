@extends('frontend.master')
@section("title", "Dashboard")
@section("content")
    <section class="common-section bg-black">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 col-xs-12">
                    @include("customer.left-sidebar")
                    <div class="mobile_dashboard_menus">
                        <div id="mySidepanel" class="sidepanel">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                            @include("customer.left-sidebar")
                        </div>
                        <button class="openbtn" onclick="openNav()">☰</button>  
                    </div>
                </div>
                <div class="col-sm-9 col-xs-12">

                <div class="doshboard_order_status_bottom">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="dashboard_title">
                                <h4 class="product_add_title">Dashboard</h4>
                                @if(Auth::user()->type == 'publisher')
                                <a class="product_add_botton" href="{{route('add_book')}}"><i class="fa fa-plus"></i>Add Book</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">

                    <?php

                        //dd($publiser_orderInfo);

                            $user_info_type  = Auth::user()->type;
							$firstname = Auth::user()->firstname;
							$lastname = Auth::user()->lastname;
							$completeOrder = SM::sm_get_count( 'orders', "user_id", Auth::user()->id, "=", "order_status", 1 );
							$progressOrder = SM::sm_get_count( 'orders', "user_id", Auth::user()->id, "=", "order_status", 2 );
							$pendingOrder = SM::sm_get_count( 'orders', "user_id", Auth::user()->id, "=", "order_status", 3 );
							$cancelledOrder = SM::sm_get_count( 'orders', "user_id", Auth::user()->id, "=", "order_status", 4 );
                            
                            $total_book = 0;
                            $published_book = 0;
                            $total_order = 0;
                            if($user_info_type == 'publisher')
                            {
                                $slug = Auth::user()->username;
                                $publisher_info = \App\Model\Common\Publisher::where('slug', $slug)->first();
                                $total_book = \App\Model\Common\Product::where('publisher_id', $publisher_info->id)->count();
                                $published_book = \App\Model\Common\Product::where('publisher_id', $publisher_info->id)->where('status',1)->count();
                                $pending_book = \App\Model\Common\Product::where('publisher_id', $publisher_info->id)->where('status',2)->count();
                                $publisher_book_list = \App\Model\Common\Product::where('publisher_id', $publisher_info->id)->get();
                                if(!empty($publisher_book_list))
                                {
                                    $books = array();
                                    foreach ($publisher_book_list as $key => $value) {
                                        array_push($books, $value->id);
                                    }
                                    $total_order = DB::table('order_details')->whereIn('product_id',$books)->count();
                                }
                            }
							?>
                        @if($user_info_type == 'publisher')
                            
                           
                            <div class="order-status">

                                <div class="col-md-3 col-xs-6">
                                    <div class="single_status" id="single_status1">
                                        <a class="order-pending" href="{{route('add_book')}}">
                                            <div class="card">
                                                <i class="fa fa-plus"></i>
                                                <div class="card-body">
                                                    <p>Add Book</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3 col-xs-6">
                                    <div class="single_status" id="single_status2">
                                        <a class="order-complete" href="{{route('books')}}">
                                            <div class="card">
                                                <i class="fa fa-book"></i>
                                                <div class="card-body">
                                                    <p>Total Book ({{ $total_book }})</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3 col-xs-6">
                                    <div class="single_status" id="single_status3">
                                        <a class="order-pending" href="{{route('published_books')}}">
                                            <div class="card">
                                                <i class="fa fa-check"></i>
                                                <div class="card-body">
                                                    <p>Published Book ({{ $published_book }})</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-md-3 col-xs-6">
                                    <div class="single_status" id="single_status4">
                                        <a class="order-pending" href="{{route('published_books')}}">
                                            <div class="card">
                                                <i class="fa fa-spinner"></i>
                                                <div class="card-body">
                                                    <p>Pending Book ({{ $pending_book }})</p>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                
                            </div>

<div class="col-md-3 col-xs-6">
                                <div class="single_status" id="single_status5">
                                    <a class="order-complete" data-toggle="modal" data-target="#totalBookSales">
                                        <div class="card">
                                            <i class="fa fa-check-square-o"></i>
                                            <div class="card-body">
                                                <!-- total book qty all status-->
                                                <p> Books Sales({{ $totalSalesQty ?? 0 }})</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-6">
                                <div class="single_status" id="single_status6">
                                    <a class="order-pending" data-toggle="modal" data-target="#totalBookDelivered">
                                        <div class="card">
                                            <i class="fa fa-spinner"></i>
                                            <div class="card-body">
                                                <!-- order status complete  qty list -->
                                                <p> Books Delivered ({{ $completeOrderQty ?? 0 }})</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-6">
                                <div class="single_status" id="single_status7">
                                    <a class="order-pending" data-toggle="modal" data-target="#totalBookPending">
                                        <div class="card">
                                            <i class="fa fa-refresh"></i>
                                            <div class="card-body">
                                                <!-- order status pending qty list -->
                                                <p> Books Pending ({{ $pendingOrder ?? '' }})</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-6">
                                <div class="single_status" id="single_status8">
                                    <a class="order-cancel"  data-toggle="modal" data-target="#totalBookProgress">
                                        <div class="card">
                                            <i class="fa fa-times"></i>
                                            <div class="card-body">
                                                <!-- order status progress qty list -->
                                                <p> Books Progress ({{ $processingOrder ?? '' }})</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>



                            @else

<div class="col-md-3 col-xs-6">
                                <div class="single_status" id="single_status5">
                                    <a class="order-complete" href="{!! url("dashboard/orders/status/1") !!}">
                                        <div class="card">
                                            <i class="fa fa-check-square-o"></i>
                                            <div class="card-body">
                                                <p>Order Complete ({{ $completeOrder }})</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-6">
                                <div class="single_status" id="single_status6">
                                    <a class="order-pending" href="{!! url("dashboard/orders/status/2") !!}">
                                        <div class="card">
                                            <i class="fa fa-spinner"></i>
                                            <div class="card-body">
                                                <p>Order Progress ({{ $progressOrder }})</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-6">
                                <div class="single_status" id="single_status7">
                                    <a class="order-pending" href="{!! url("dashboard/orders/status/3") !!}">
                                        <div class="card">
                                            <i class="fa fa-refresh"></i>
                                            <div class="card-body">
                                                <p>Order Pending ({{ $pendingOrder }})</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-6">
                                <div class="single_status" id="single_status8">
                                    <a class="order-cancel" href="{!! url("dashboard/orders/status/4") !!}">
                                        <div class="card">
                                            <i class="fa fa-times"></i>
                                            <div class="card-body">
                                                <p>Order Cancel ({{ $cancelledOrder }})</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            @endif
                            
                        </div>
                    </div>









                    





                    <div class="account-panel">
                        <div class="account-panel-inner">
							
                            <!-- <h3>
                                Hello {{ $firstname !='' || $lastname !='' ? $firstname." ".$lastname : Auth::user()->username }}</h3>
                            <p>From your My Account Dashboard you have the ability to view a snapshot of your recent
                                tops count activity and update your account information. Select a link below.</p> -->
                            
                           
                            
                            




							<?php
							$name = Auth::user()->firstname . " " . Auth::user()->lastname;
							?>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="acc-inner-panel" id="customer_profile_section">
                                        <h4> <i class="fa fa-compress"></i> Contact information</h4>
                                        <div class="panel-contents">
                                            @empty(!$name)<p>{{ $name }}</p>@endempty
                                            @empty(!Auth::user()->username)
                                                <p>
                                                    Username: {{ Auth::user()->username }}
                                                </p>
                                            @endempty
                                            @empty(!Auth::user()->mobile)<p>
                                                Mobile: {{ Auth::user()->mobile }}</p>@endempty
                                            @empty(!Auth::user()->email)<p>Email: {{ Auth::user()->email }}</p>@endempty
                                        </div>
                                        <a class="edit-btn" href="{!! url("dashboard/edit-profile") !!}"><i
                                                    class="fa fa-edit"></i>Edit</a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="acc-inner-panel" id="customer_profile_section">
                                        <h4> <i class="fa fa-map-marker"></i>Default billing address</h4>
                                        <div class="panel-contents">
                                            @empty(!Auth::user()->street)<p>
                                                Street: {{ Auth::user()->street }}</p>@endempty
                                            @empty(!Auth::user()->city)<p>City: {{ Auth::user()->city }}</p>@endempty
                                            @empty(!Auth::user()->state || Auth::user()->zip)
                                                <p>State/District: {{ Auth::user()->state." - ".Auth::user()->zip }}</p>
                                            @endempty
                                            @empty(!Auth::user()->country)<p>
                                                Country: {{ Auth::user()->country }}</p>@endempty
                                        </div>

                                        <a class="edit-btn" href="{!! url("dashboard/edit-profile") !!}"><i
                                                    class="fa fa-edit"></i>Edit</a>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-md-12">
                                    @include("customer.back")
                                </div>
                            </div> -->

                        </div>

                    </div>
                </div>
            </div>

            
        </div>
    </section>




 <div class="modal fade" id="totalBookPending" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pending Books List</h4>
        </div>
        <div class="modal-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                  </tr>
                </thead>
                <tbody>
                    @if(!empty($pendingOrderDetails))
                        @foreach($pendingOrderDetails as $key => $value)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->product_qty}}</td>
                          </tr>
                      @endforeach
                  @endif
                </tbody>
              </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<div class="modal fade" id="totalBookDelivered" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delivery Books List</h4>
        </div>
        <div class="modal-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                  </tr>
                </thead>
                <tbody>
                    @if(!empty($completeOrderDetails))
                        @foreach($completeOrderDetails as $key => $value)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->product_qty}}</td>
                          </tr>
                      @endforeach
                  @endif
                </tbody>
              </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<div class="modal fade" id="totalBookProgress" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Progress Books List</h4>
        </div>
        <div class="modal-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                  </tr>
                </thead>
                <tbody>
                    @if(!empty($processingOrderDetails))
                        @foreach($processingOrderDetails as $key => $value)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->product_qty}}</td>
                          </tr>
                      @endforeach
                  @endif
                </tbody>
              </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<div class="modal fade" id="totalBookSales" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sales Books List</h4>
        </div>
        <div class="modal-body">
            <table class="table table-striped">
                <thead>
                  <tr>
                    <th>SL</th>
                    <th>Product Name</th>
                    <th>Qty</th>
                  </tr>
                </thead>
                <tbody>
                    @if(!empty($totalSalesQtyDetails))
                        @foreach($totalSalesQtyDetails as $key => $value)
                          <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$value->title}}</td>
                            <td>{{$value->product_qty}}</td>
                          </tr>
                      @endforeach
                  @endif
                </tbody>
              </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>




@endsection
