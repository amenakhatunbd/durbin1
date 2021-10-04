<?php

$features = SM::smGetThemeOption("features", array());


    //dd($features);



?>

@if(count($features)>0)

    <section class="top-ads-section wow fadeInLeft">

        <div class="container">

            <div class="row">

                @foreach($features as $key=> $feature)

                    <?php

                    $title = isset($feature["title"]) ? $feature["title"] : "";
                    $link = isset($feature["link"]) ? $feature["link"] : "";

                    ?>

                    <div class="col-md-4 col-sm-4 col-xs-12">

                        <div class="top-ads-box">

                            <a href="{{$link}}">

                                <img src="{!! SM::sm_get_the_src($feature["image"], 360,83) !!}" alt="{{ $title }}"

                                     class="img-responsive">

                            </a>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    </section>

@endif