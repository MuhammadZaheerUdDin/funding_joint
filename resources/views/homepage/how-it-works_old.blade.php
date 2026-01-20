@extends('layouts.frontPage.page')


@section('content')

    <div class="home-header">

        <section class="hero">
            <div style="background-image: url({{asset('assets/img/hero-image.jpg')}});"></div>
        </section>


    </div>

    <div class="container">

        <!-- Projects section v.3 -->
        <section class="my-5">

            <!-- Section heading -->
            <h2 class="h1-responsive font-weight-bold text-center my-5">
                @inlineEditor( 'how-it-works-title' )
                How It Works
                @endInlineEditor
            </h2>
            <!-- Section description -->
            <p class="text-center w-responsive mx-auto mb-5">
                @inlineEditor( 'how-it-works-lead' )
               Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto asperiores, dicta distinctio dolor iusto magnam, nihil numquam quaerat, recusandae veniam vero. Illum impedit ipsam nihil odio ratione tempora voluptatem!
                @endInlineEditor
            </p>

            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-lg-7">

                    <!-- Grid row -->
                    <div class="row">
                        <div class="col-md-11 col-10 pt-5">
                            <h5 class="font-weight-bold mb-3">
                                @inlineEditor( 'register-as-an-investor-or-seller' )
                                Register as an Investor or a Seller
                                @endInlineEditor
                            </h5>
                            <p>
                                @inlineEditor( 'register-as-an-investor-or-seller-lead' )
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, dicta dolore esse eveniet excepturi exercitationem hic ipsam laborum libero modi mollitia officiis perspiciatis rem sapiente soluta suscipit veniam, voluptate voluptatibus.
                                @endInlineEditor
                            </p>
                        </div>
                    </div>
                    <!-- Grid row -->


                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-lg-5 mb-lg-0 mb-5">
                    <img src="https://mdbootstrap.com/img/Photos/Others/images/83.jpg" alt="Sample project image" class="img-fluid rounded z-depth-1">
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
            <!-- Grid row -->
            <div class="row mt-lg-5">
                <!-- Grid column -->
                <div class="col-lg-5 mb-lg-0 mb-5">
                    <img src="https://mdbootstrap.com/img/Photos/Others/images/83.jpg" alt="Sample project image" class="img-fluid rounded z-depth-1">
                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-lg-7">
                    <!-- Grid row -->
                    <div class="row pt-5">
                        <div class="col-md-11 col-10">
                            <h5 class="font-weight-bold mb-3">
                                @inlineEditor( 'create-an-auction-or-bid-header' )
                                Create an Auction or Bid for an Investment
                                @endInlineEditor
                            </h5>
                            <p>
                                @inlineEditor( 'create-an-auction-or-bid-lead' )
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, dicta dolore esse eveniet excepturi exercitationem hic ipsam laborum libero modi mollitia officiis perspiciatis rem sapiente soluta suscipit veniam, voluptate voluptatibus.
                                @endInlineEditor
                            </p>
                        </div>
                    </div>
                    <!-- Grid row -->


                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->



            <!-- Grid row -->
            <div class="row mt-lg-5">

                <!-- Grid column -->
                <div class="col-lg-7">
                    <!-- Grid row -->
                    <div class="row pt-5">
                        <div class="col-md-11 col-10">
                            <h5 class="font-weight-bold mb-3">
                                @inlineEditor( 'competitive-bids-are-top' )
                                Competitive Bids are top of the Leaderboard.
                                @endInlineEditor
                            </h5>
                            <p>
                                @inlineEditor( 'competitive-bids-are-top-lead' )
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, dicta dolore esse eveniet excepturi exercitationem hic ipsam laborum libero modi mollitia officiis perspiciatis rem sapiente soluta suscipit veniam, voluptate voluptatibus.
                                @endInlineEditor
                            </p>
                        </div>
                    </div>
                    <!-- Grid row -->


                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-lg-5 mb-lg-0 mb-5">
                    <img src="https://mdbootstrap.com/img/Photos/Others/images/83.jpg" alt="Sample project image" class="img-fluid rounded z-depth-1">
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->


            <!-- Grid row -->
            <div class="row mt-lg-5">
                <!-- Grid column -->
                <div class="col-lg-5 mb-lg-0 mb-5">
                    <img src="https://mdbootstrap.com/img/Photos/Others/images/83.jpg" alt="Sample project image" class="img-fluid rounded z-depth-1">
                </div>
                <!-- Grid column -->
                <!-- Grid column -->
                <div class="col-lg-7">
                    <!-- Grid row -->
                    <div class="row pt-5">
                        <div class="col-md-11 col-10">
                            <h5 class="font-weight-bold mb-3">
                                @inlineEditor( 'payment-is-released-to-investor' )
                                Payments is released to Investor or funding to Seller
                                @endInlineEditor
                            </h5>
                            <p>
                                @inlineEditor( 'payment-is-released-to-investor-lead' )
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, dicta dolore esse eveniet excepturi exercitationem hic ipsam laborum libero modi mollitia officiis perspiciatis rem sapiente soluta suscipit veniam, voluptate voluptatibus.
                                @endInlineEditor
                            </p>
                        </div>
                    </div>
                    <!-- Grid row -->
                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->


            <!-- Grid row -->
            <div class="row mt-lg-5">

                <!-- Grid column -->
                <div class="col-lg-7">
                    <!-- Grid row -->
                    <div class="row pt-5">
                        <div class="col-md-11 col-10">
                            <h5 class="font-weight-bold mb-3">
                                @inlineEditor( 'safe-efficient-platform-with-an-ethical-mindset-header' )
                                Safe, Efficient platform with Ethical mindset
                                @endInlineEditor
                            </h5>
                            <p>
                                @inlineEditor( 'safe-efficient-platform-with-an-ethical-mindset-lead' )
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus, dicta dolore esse eveniet excepturi exercitationem hic ipsam laborum libero modi mollitia officiis perspiciatis rem sapiente soluta suscipit veniam, voluptate voluptatibus.
                                @endInlineEditor
                            </p>
                        </div>
                    </div>
                    <!-- Grid row -->
                </div>
                <!-- Grid column -->


                <!-- Grid column -->
                <div class="col-lg-5 mb-lg-0 mb-5">
                    <img src="https://mdbootstrap.com/img/Photos/Others/images/83.jpg" alt="Sample project image" class="img-fluid rounded z-depth-1">
                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->



        </section>
        <!-- Projects section v.3 -->

    </div>




@endsection