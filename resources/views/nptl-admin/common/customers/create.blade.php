@extends(('nptl-admin/master'))
@section('title','Add Customer')
@section('content')
    @include(('nptl-admin/common/media/media_pop_up'))
    <section id="widget-grid" class="">
        <!-- row -->
        <div class="row">
            {!! Form::open(["method"=>"post","action"=>"Admin\Common\Customers@store", "id"=>"add_front_user_form"]) !!}
            @include(("nptl-admin/common/customers/form"),
           ['f_name'=>__("common.add"), 'btn_name'=>__("common.save")])
            {!! Form::close() !!}
        </div>
        <!-- end row -->
    </section>
@endsection