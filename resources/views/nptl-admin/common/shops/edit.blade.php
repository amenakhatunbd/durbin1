@extends("nptl-admin.master")
@section("title","Edit Shop")
@section("content")
    @include(('nptl-admin/common/media/media_pop_up'))
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            {!! Form::model($shop,["method"=>"post","action"=>["Admin\Common\ShopController@update",$shop->id]]) !!}
            @include(("nptl-admin.common.shops.form"),
            ['f_name'=>__("common.edit"), 'btn_name'=>__("common.update")])
            {!! Form::close() !!}
        </div>
        <!-- end row -->
    </section>
@endsection