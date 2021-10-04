<?php

$reviews = $product->reviews->where('status', 1);

?>

<style>
div#logInToSubitReview {
    position: absolute;
    background: #ddddddad;
    top: 0;
    width: 100%;
    height: 100%;
    text-align: center;
    padding-top:6%;
    /* padding-top: 22%; */
}
div#loggedInForReview {
    position: relative;
    /* top: 0; */
}
button.btn.btn-default-2 {
    background: #f7921c;
    color: #fff;
}
</style>



<div class="review-content-box review-content-box-2">

    <h3>Submit Your review and Ratings</h3>
    {{-- @if(!Auth::check()) --}}
    <div id="loggedInForReview">                  
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
            @if(!Auth::check())
            <div id="logInToSubitReview">
               <h4>Please Login before submitting a review..</h4>
               <!-- <a href="{{ url('/login_signin_new') }}" class="btn btn-default-2">Sign in</a>         -->
               <button type="button" class="btn btn-default-2" data-toggle="modal" data-target="#exampleModal">
               Sign in
                </button>        
            </div>
            @endif
        </div>
        
    {{--  @endif --}}

</div>

@if(count($reviews)>0)

    <div class="review-content-box review-content-box-1">

        <h3>Customer review and Ratings</h3>

        @foreach($reviews as $review)

            <div class="media books-reviewrs-box">

                <div class="media-left media-top">


@if(!empty($review->user->image))
<img  style="height: 100px!important;width: 100px!important;border-radius: 100px!important;" id="profile_picture_img" src="{!! SM::sm_get_the_src($review->user->image,165,165) !!}" class="media-object" alt="{{ $review->user->firstname }}">
        @else 
        <i class="fa fa-user-circle-o"></i>
        @endif
                    <!--<img src="{!! SM::sm_get_the_src($review->user->image,112,112) !!}" class="media-object"-->

                    <!--     style="width:100px">-->

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





<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- loginfom -->
        <form id="login-form" action="{{ url('/login') }}" method="post" class="login-form-wraper smAuthHide smAuthForm" style="display: block;">
            {!! csrf_field() !!}
            <div class="form-group">
                <!--<input type="text" autocomplete="off" name="username" id="username" tabindex="1" class="form-control only-border" placeholder="Username" value="">-->
                {!! Form::email('username', null, ['class' => 'form-control only-border', 'required', 'autocomplete'=>'off', 'id'=>'username', 'tabindex' => '1',  'placeholder'=> 'Username']) !!}
            </div>
            <div class="form-group">
                <!--<input type="password" autocomplete="off" name="password" id="password" tabindex="2" class="form-control only-border" placeholder="Password">-->
                <input required name="password" autocomplete="off" id="password" tabindex="2" type="password"
                        class="form-control only-border"
                        placeholder="********">
            </div>
            <div class="form-group">
                <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                <label for="remember"> Remember Me</label>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3">
                        <!--<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">-->
                        <button type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login">Log In</button>
                    </div>
                </div>
            </div>
            <div class="form-group" style="display:none;">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- loginfom -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
<!-- Modal -->

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

 