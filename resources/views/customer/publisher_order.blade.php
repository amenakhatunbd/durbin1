@extends('frontend.master')
@section("title", "Orders")
@section("content")
    <style>
        .order-btn a {
            padding: 7px 15px;
        }
    </style>
    <section class="common-section bg-black">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    @include("customer.left-sidebar")
					<div class="mobile_dashboard_menus">
                        <div id="mySidepanel" class="sidepanel">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
                            @include("customer.left-sidebar")
                        </div>
                        <button class="openbtn" onclick="openNav()">☰</button>  
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="account-panel">
                        <h2 class="product_add_title">Customer Orders List</h2>
						<a class="product_add_botton" href="{{route('add_book')}}"><i class="fa fa-plus"></i>Add Book</a>
                        @if(count($orders)>0)
                            <div class="account-panel-inner">
								<div class="table-responsive">
                            	<table class="table table-secondary table-striped table-hover">
								    <thead>
								      <tr>
								        <th width="15%">Image</th>
								        <th width="45%">Title</th>
								        <th width="30%">Writer</th>
								        <th width="10%">Quantity</th>
								      </tr>
								    </thead>
								    <tbody>
								      
								      
								      
		                                @foreach($orders as $book)

		                                	<?php $book_info = \App\Model\Common\Product::where('id', $book->product_id)->first(); ?>
		                                	<tr>
										        
										        <td><img src="{{ SM::sm_get_the_src($book_info->image, 60, 80) }}"></td>
										        <td><a href="{{ url('book/'.$book_info->slug) }}">{{$book_info->title}}</a></td>
										        <td><?php
                                    
				                                    $list = explode(",", $book_info->author_id);
				                                    $count = sizeof($list)-1;
				                                   
				                                    foreach($list as $key=>$author)
				                                    {
				                                        $auhtor_info = DB::table('authors')->where('id', $author)->first();
				                                       
				                                        ?>
				                                        @if($key==$count)
				                                        <a target="_blank"

				                                           href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }}</a>
				                                        @else
				                                     
				                                        <a target="_blank"

				                                           href="{{ url('/author',$auhtor_info->slug) }}">{{ $auhtor_info->title }} ,</a>
				                                        @endif
				                                        

				                                    <?php }?>
                                				</td>
										        <td>{{$book->product_qty}}</td>


										        
										       
		                                    </tr>
		                                @endforeach

								    </tbody>
								  </table>
								  </div>
                            </div>
                            <div class="text-center">
                                {!! $orders->links('common.pagination_orders') !!}
                            </div>
                        
                        @else

						<div class="alert alert-warning">
							<i class="fa fa-warning"></i> No Order Found!
						</div>

						@endif
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-sm-3">
						<div class="single_back_btn">
                        	@include("customer.back")
                    	</div>
					</div>
                </div> -->
            </div>
        </div>
    </section>
@endsection