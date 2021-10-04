@if(isset($sliders) && count($sliders)>0)
    <?php

   // dd($sliders);

    $slider_change_autoplay = (int)SM::smGetThemeOption("slider_change_autoplay", 4);
    $slider_change_autoplay *= 3000;
    ?>
    <section class="slider-section">
        <div class="container">
            <div id="myCarousel" class="carousel slide carousel-fade wow fadeInDown" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @foreach($sliders as $key=>$slider)
                        <li data-target="#myCarousel" data-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    @foreach($sliders as $key=>$slider)



                        <div class="item {{ $key == 0 ? 'active' : '' }}">
                            @if(!empty($slider->image))
                                <img src="{!! SM::sm_get_the_src($slider->image, 1140,433) !!}" class="img-responsive"
                                     alt="{{ $slider->title }}">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

