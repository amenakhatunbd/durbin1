<?php

$reviews = $product->reviews->where('status', 1);

?>

@if(count($reviews)>0)

    <div class="review-content-box">

        <h3>Customer review and Ratings</h3>

        @foreach($reviews as $review)

            <div class="media books-reviewrs-box">

                <div class="media-left media-top">

                    <img src="{!! SM::sm_get_the_src($review->user->image,112,112) !!}" class="media-object"

                         style="width:100px">

                </div>

                <div class="media-body">

                    <h4 class="media-heading">{{ $review->user->username }}</h4>

                    <span class="date"><i class="fa fa-calendar"></i>{{ SM::showDateTime($review->created_at) }}</span>

                    <span class="ratting">

                       <!-- ?php

                        echo SM::product_review($product->id);

                       ? -->
                       
                       <?php
                       $r = $review->rating;
                       for($i=1;$i<=5;$i++){
                           if($i <= $r){
                               echo '<i class="fa fa-star" aria-hidden="true"></i>';
                           } else {
                               echo '<i class="fa fa-star-o" aria-hidden="true"></i>';
                           }
                       }
                       
                       ?>
                       
                       
                    </span>

                    <p>{{ $review->description }}</p>

                    <a class="read-more-comments hidden">Read More</a>

                    <a class="read-less hidden">Read less</a>

                    <div class="like-dislike-box hidden">

                        <a href="" class="btn btn-default"><i class="fa fa-thumbs-o-up"></i></a>

                        <a href="" class="btn btn-default"><i class="fa fa-thumbs-o-down"></i></a>

                    </div>

                </div>

            </div>

    @endforeach

    <!-- ------------------------------------- -->

    </div>

@endif

<div class="review-content-box">

    <h3>Submit Your review and Ratings</h3>

    <form class="ajaxReviewForm form">

        {!! Form::hidden('product_id', $product->id, ['class' => 'product_id']) !!}

        <div class="row">

            <div class="col-md-6">

                <div class="form-group">

                    <label class="control-label">Write Your Review</label>

                    <textarea required name="description" class="form-control description" id="product_review" rows="5"

                              placeholder="Write Rating description..."></textarea>

                </div>

                <div class="form-group">

                    <input type="button" name="" class="btn btn-default submit-review ajaxReviewSubmit"

                           value="Submit Review">

                </div>

            </div>

            <div class="col-md-6">

                <div class="sort-check-box">

                    <label class="control-label">Select Your Ratting</label>

                    <label class="fil-check"> <i class="fa fa-star"></i>

                        <input type="checkbox" name="rating" class="product_rating" value="1"/>

                        <span class="checkmark"></span>

                    </label>

                    <label class="fil-check"><i class="fa fa-star"></i> <i class="fa fa-star"></i>

                        <input type="checkbox" name="rating" class="product_rating" value="2"/>

                        <span class="checkmark"></span>

                    </label>

                    <label class="fil-check"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i

                                class="fa fa-star"></i>

                        <input type="checkbox" name="rating" class="product_rating" value="3"/>

                        <span class="checkmark"></span>

                    </label>

                    <label class="fil-check"><i class="fa fa-star"></i> <i class="fa fa-star"></i><i

                                class="fa fa-star"></i><i class="fa fa-star"></i>

                        <input type="checkbox" name="rating" class="product_rating" value="4"/>

                        <span class="checkmark"></span>

                    </label>

                    <label class="fil-check"><i class="fa fa-star"></i><i class="fa fa-star"></i><i

                                class="fa fa-star"></i><i class="fa fa-star"></i><i

                                class="fa fa-star"></i>

                        <input type="checkbox" name="rating" class="product_rating" value="5"/>

                        <span class="checkmark"></span>

                    </label>



                </div>

            </div>

        </div>

    </form>

</div>

<script>

    $(document).ready(function () {

        $('input.product_rating').click(function () {

            $('input.product_rating').not(this).prop('checked', false);

        });

    });

</script>

@if (Auth::check())

@else

    @push('script')

        <script type="text/javascript">

            $(document).ready(function () {

                $("#product_review").click(function () {

                    $('#loginModal').modal('show');

                });

            });

        </script>

    @endpush

@endif

 