@extends("nptl-admin.master")
@section("title","Edit Post")
@section("content")
    @include(('nptl-admin/common/media/media_pop_up'))
    <section id="widget-grid" class="">
        <!-- row -->
    
        <div class="row">
            {!! Form::model($post,["method"=>"PATCH","action"=>["Admin\Common\PostController@update",$post->id]]) !!}
            @include(("nptl-admin.common.posts.form"),
            ['f_name'=>__("common.edit"), 'btn_name'=>__("common.update")])
            {!! Form::close() !!}
        </div>
        <!-- end row -->
    </section>
@endsection