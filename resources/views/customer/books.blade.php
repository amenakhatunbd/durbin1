@extends('frontend.master')
@section("title", "Books")
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
                    <div class="account-panel" id="books_short_stock">
                        <h2 class="product_add_title">Books List</h2>
                        <a class="product_add_botton" href="{{route('add_book')}}"><i class="fa fa-plus"></i>Add Book</a>
                        @if(count($orders)>0)
                            <div class="account-panel-inner">
								<div class="table-responsive">
                            	<table class="table table-secondary table-bordered">
								    <thead>
								      <tr>
								        <th width="10%"><b>Image</b></th>
								        <th width="40%"><b>Title</b></th>
								        <th width="30%"><b>Writer</b></th>
								        <th width="5%"><b>Stock</b></th>
								        <th width="5%"><b>Status</b></th>
								        <th width="15%"><b>Action</b></th>
								      </tr>
								    </thead>
								    <tbody>



		                                @foreach($orders as $key => $book)

										<?php 
										
										
										
										?>

		                                	<tr>
										        <td><img style="height: 50px;" src="{{ SM::sm_get_the_src($book->image,60, 80) }}" alt="{{$book->image}}"></td>
												
										        <td>
													@if($book->status == 2)
													<a>{{$book->title}}</a>
												   @else
												   @if(!empty($book->slug) && $book->slug== true)
												    <a  target="_blank" href="{{ url('book/'.$book->slug ?? '') }}">
														@else 

														<a href="#">
														@endif
														{{$book->title}}</a>
												   @endif
												</td>
										        <td><?php
				                                    $list = explode(",", $book->author_id);
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
										        <td><span class="badge bg-success">
													
													@if($book->product_qty > 0)
													   In Stock
													@else 
													   Stock Out
													@endif
													</span></td>

										        <td nowrap>
													@if($book->status == 2)
													<i class="fa fa-spinner" aria-hidden="true"></i> Pending
													@else
													<i class="fa fa-check" aria-hidden="true"></i> Approved
													@endif
												</td>
										        <td nowrap> 



													@if($book->status == 1)
										        	<a target="_blank" href="{{ url('/book',$book->slug) }}" title="View" class="btn" id=""> <i class="fa fa-eye"></i> </a>
													@endif
				                                    <a href="{{ route('edit_product',$book->slug) }}" class="btn"><i class="fa fa-pencil"></i></a>
													@if($book->orders == 0)
														<a href="{{ route('books_delete',$book->id) }}" title="Delete" class="btn delete_data_row" delete_message="Are you sure to delete this product post?" delete_row="tr_' . $book->id . '">
															<i class="fa fa-times"></i>
														   </a>
													@endif
										        </td>
		                                    </tr>
		                                @endforeach

								    </tbody>
								  </table>
								  </div>
                            </div>
                            <div class="text-center">
                                {!! $orders->links('common.pagination_orders') !!}
                            </div>
                        
                        @endif
                    </div>
					<!-- <div class="row">
						<div class="col-md-12">
							<div class="single_back_btn">
								@include("customer.back")
							</div>
						</div>
					</div> -->
                </div>

                <!-- <div class="row">
                    <div class="col-sm-3">
                        
                    </div>
                </div> -->
            </div>
        </div>
    </section>
@endsection