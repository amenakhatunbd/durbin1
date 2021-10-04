@extends("nptl-admin.master")
@section("title","Edit Hostels")
@section("content")
    @include(('nptl-admin/common/media/media_pop_up'))
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            {!! Form::model($hostel,["method"=>"post","action"=>["Admin\Common\Hostels@update",$hostel->id]]) !!}
            @include(("nptl-admin.common.hostels.form"),
            ['f_name'=>__("common.edit"), 'btn_name'=>__("common.update")])
            {!! Form::close() !!}
        </div>
        <!-- end row -->
    </section>
@endsection