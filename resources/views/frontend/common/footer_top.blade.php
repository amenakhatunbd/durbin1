<?php
$footer_top_features = SM::smGetThemeOption("footer_top_features", array());

?>
@if(count($footer_top_features)>0)
    <section class="top-ads-section pad-top-0">
        <div class="section-block-grey">
            <div class="container">
                <div class="row mt-60">

                    @foreach($footer_top_features as $key=> $footer_top)

                    <div class="col-md-3 col-sm-12 col-12">
                        <div class="serv-section-2">
                            <div class="serv-section-2-icon"> <i class="fa fa-question-circle"></i> </div>
                            <div class="serv-section-desc">
                                <h4>{{ $footer_top["title"] }}</h4>
                                <h5>{!! $footer_top["description"] !!}</h5>  
                            </div>
                            <div class="section-heading-line-left"></div>
                        </div>
                    </div>

                    @endforeach
                   
                   
                </div>
            </div>
        </div>




    </section>
@endif