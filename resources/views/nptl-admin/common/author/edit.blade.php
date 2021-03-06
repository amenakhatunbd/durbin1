@extends("nptl-admin.master")
@section("title","Edit Author")
@section("content")
    @include(('nptl-admin/common/media/media_pop_up'))
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            {!! Form::model($author_info,["method"=>"PATCH","action"=>["Admin\Common\Authors@update",$author_info->id]]) !!}
            @include(("nptl-admin.common.author.form"),
            ['f_name'=>__("common.edit"), 'btn_name'=>__("common.update")])
            {!! Form::close() !!}
        </div>
        <!-- end row -->
    </section>
@endsection