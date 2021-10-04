@extends("nptl-admin.master")
@section("title","Edit School")
@section("content")
    @include(('nptl-admin/common/media/media_pop_up'))
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            {!! Form::model($school,["method"=>"PATCH","action"=>["Admin\Common\SchoolController@update",$school->id]]) !!}
            @include(("nptl-admin.common.schools.form"),
            ['f_name'=>__("common.edit"), 'btn_name'=>__("common.update")])
            {!! Form::close() !!}
        </div>
        <!-- end row -->
    </section>
@endsection