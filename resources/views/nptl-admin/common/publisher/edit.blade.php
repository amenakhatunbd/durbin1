@extends("nptl-admin.master")
@section("title","Edit Publisher")
@section("content")
    @include(('nptl-admin/common/media/media_pop_up'))
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            {!! Form::model($publisher_info,["method"=>"PATCH","action"=>["Admin\Common\Publishers@update",$publisher_info->id]]) !!}
            @include(("nptl-admin.common.publisher.editform"),
            ['f_name'=>__("common.edit"), 'btn_name'=>__("common.update")])
            {!! Form::close() !!}
        </div>
        <!-- end row -->
    </section>
@endsection