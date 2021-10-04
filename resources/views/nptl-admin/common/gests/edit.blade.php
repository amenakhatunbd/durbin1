@extends("nptl-admin.master")
@section("title","Edit gest")
@section("content")
    @include(('nptl-admin/common/media/media_pop_up'))
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            {!! Form::model($gest,["method"=>"post","action"=>["Admin\Common\GestController@update",$gest->id]]) !!}
            @include(("nptl-admin.common.gests.form"),
            ['f_name'=>__("common.edit"), 'btn_name'=>__("common.update")])
            {!! Form::close() !!}
        </div>
        <!-- end row -->
    </section>
@endsection