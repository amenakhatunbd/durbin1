@extends("nptl-admin.master")
@section("title","Edit Phones")
@section("content")
    @include(('nptl-admin/common/media/media_pop_up'))
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            {!! Form::model($phone,["method"=>"post","action"=>["Admin\Common\Phones@update",$phone->id]]) !!}
            @include(("nptl-admin.common.phones.form"),
            ['f_name'=>__("common.edit"), 'btn_name'=>__("common.update")])
            {!! Form::close() !!}
        </div>
        <!-- end row -->
    </section>
@endsection