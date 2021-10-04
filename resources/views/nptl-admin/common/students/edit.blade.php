@extends("nptl-admin.master")
@section("title","Edit student")
@section("content")
    @include(('nptl-admin/common/media/media_pop_up'))
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            {!! Form::model($student,["method"=>"post","action"=>["Admin\Common\StudentController@update",$student->id]]) !!}
            @include(("nptl-admin.common.students.form"),
            ['f_name'=>__("common.edit"), 'btn_name'=>__("common.update")])
            {!! Form::close() !!}
        </div>
        <!-- end row -->
    </section>
@endsection