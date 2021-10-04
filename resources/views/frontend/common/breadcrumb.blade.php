@if(isset($bannerImage) && !empty($bannerImage))
    <section class="page-banner-section about-banner-section" style="margin-bottom: 10px;">
        <div class="blog-banner-sec "
             style="background:url( {!! SM::sm_get_the_src( $bannerImage ) !!}) no-repeat center center /cover">
            <div class="container">
                <div class="row">
                    <div class="blog-banner-contents text-center">
                        {{--@empty(!$title)--}}
                        {{--<h1></h1>--}}
                        {{--@endempty--}}
                        {{--@if(isset($subtitle) && $subtitle != '')--}}
                        {{--<p></p>--}}
                        {{--@endif--}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endempty
<div class="breadcrumb clearfix">

    @if(Route::current()->getName() != 'home')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mt-2">
                {{--<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>--}}
                @php
                    $link = url('/');
                @endphp
                <a href="/"><i class="fa fa-home"></i> Home</a><i class="fa fa-chevron-right"
                                                                  style="padding: 2px 10px;"></i>
                <?php $link = "" ?>
                @for($i = 1; $i <= count(Request::segments()); $i++)
                    @if($i < count(Request::segments()) & $i > 0)
                        <?php $link .= "/" . Request::segment($i); ?>
                        <a href="<?= $link ?>">{{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a> <i
                                class="fa fa-chevron-right" style="padding: 2px 10px;"></i>
                    @else {{ucwords(str_replace('-',' ',Request::segment($i)))}}
                    @endif
                @endfor
                {{--@foreach(request()->segments() as $segment)--}}
                {{--@php--}}
                {{--$link .= "/" . request()->segment($loop->iteration);--}}
                {{--@endphp--}}
                {{--@if(rtrim(request()->route()->getPrefix(), '/') != $segment && ! preg_match('/[0-9]/', $segment))--}}
                {{--<li class="breadcrumb-item {{ $loop->last ? 'active' : '' }}">--}}
                {{--@if($loop->last)--}}
                {{--{{ title_case($segment) }}--}}
                {{--@else--}}
                {{--<a href="{{ $link }}">{{ title_case($segment) }}</a>--}}
                {{--@endif--}}
                {{--</li>--}}
                {{--@endif--}}
                {{--@endforeach--}}
            </ol>
        </nav>
    @endif
</div>