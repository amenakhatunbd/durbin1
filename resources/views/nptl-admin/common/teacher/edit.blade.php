@extends("nptl-admin.master")
@section("title","Edit teacher")
@section("content")
    @include(('nptl-admin/common/media/media_pop_up'))
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            {!! Form::model($teacher,["method"=>"post","action"=>["Admin\Common\TeacherController@update",$teacher->id]]) !!}
            @include(("nptl-admin.common.teacher.form"),
            ['f_name'=>__("common.edit"), 'btn_name'=>__("common.update")])
            {!! Form::close() !!}
        </div>
        <!-- end row -->
    </section>
@endsection