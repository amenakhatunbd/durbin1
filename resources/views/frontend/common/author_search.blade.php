@extends("frontend.master")
@section("title", "Blog")
@section("content")
	<section>
			<div class="container">
				<div class="all-books-content">
					<div class="row">
						<div class="col-md-offset-3 col-md-6" >
							<!--<div class="search-author-box">-->
							<!--	<div class="input-group">-->
							<!--	 <input id="msg" type="text" class="form-control" name="msg" placeholder="Search favorite">-->
							<!--  <span class="input-group-addon">Search</span>-->
							<!--  </div>-->
							<!--</div>-->
							
							<div class="search-author-box">
							<div class="input-group">
								    <form action="{!! url('author_search') !!}" method="get">
								 <input  type="search" class="form-control" name="msg" placeholder="Search favorite">
							 <button><span class="input-group-addon">Search</span></button>
						 </form>
							  </div>
							</div>
							
						</div>
					</div>
					<hr>
					<div class="row">
						@if($datas)
							@foreach($datas as $key => $data)
							<div class="col-md-2 col-xs-6">	
							    @if(request()->segment(1)=="all_authors")					
								<a href="{{ url('/author', $data->slug) }}">
								@elseif(request()->segment(1)=="all_publishers")
							    <a href="{{ url('/publisher', $data->slug) }}">
							    @elseif(request()->segment(1)=="all_categories")
							    <a href="{{ url('/category', $data->slug) }}">
							    @endif
									<div class="author-profile mar-bot-20">
										<img src="{{ SM::sm_get_the_src($data->image, 140, 140) }}" alt="{{ $data->title }}"
                                     	class="img-responsive img-circle">
										<p>{{ $data->title }}</p>
									</div>
								</a>
							</div>
							@endforeach
							{{ $datas->links() }}		
						@endif
					</div>								
				</div>
			</div>
		</section>
		@endsection