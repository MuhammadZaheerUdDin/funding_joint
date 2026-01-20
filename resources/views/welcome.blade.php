@extends('layouts.frontPage.page')


@section('content')
<style type="text/css">
    .login-popup-container {display: none; position: fixed; width: 400px;left:0;right:0;margin-left:auto;margin-right:auto; top: 130px;
    z-index: 99999;
    text-align: center;
    background: #fff;border-radius: 5px;}
.login-popup-title {color: #fff; font-size: 18px; font-weight: 600; padding: 20px; background: #5c2aaf}
.login-popup-form {padding: 20px;}
.login-popup-form input[type=text], .login-popup-form input[type=email], .login-popup-form input[type=phone] {
    border: 1px solid #932d98; 
    box-shadow: none; 
    border-radius: 5px;
    width: 100%;
    height: 45px;
    margin-bottom: 15px;
    padding: 10px;
    color: #000;}
.login-popup-form input[type=submit] {background-image: url({{asset('/assets/img/login-bg.png')}}); background-repeat: no-repeat; background-size: cover; height: 50px; width: 130px; text-align: center;color: #fff;
    border: none;margin-top: 15px;}
.close-popup {
    border: 1px solid #932d98; 
    padding: 10px; border-radius: 25px; 
    color: #932d98; cursor: pointer;
    padding: 2px 10px;
    position: absolute;
    right: 5px;
    top: 5px;
    border: 1px solid #fff; color: #fff;
}
.loginOverlay {background: #000;
    opacity: 0.8;
    position: fixed;
    height: 100%;
    width: 100%;
    top: 0;
    z-index: 9999;
display: none;}
@media (max-width:767px) {
    /*.hero.px-2 video {
        height: 1070px !important;
    }*/
    .hero.px-2 {max-height: 298px}
    .home-header .hero h1 {font-size: 20px;padding: 0 30px;}
    .home-header .hero p { padding: 5px;}
    .home-header .hero > div {min-height: auto !important;}
    .home-header .hero--intro--text .funding-opportunities { padding: 20px !important;}
    .home-header .hero--intro--text .invest-button a {font-size: 12px}
    .home-header .hero--intro--text .investor-opportunities {padding: 20px !important;margin-left: 0 !important;}
    .subscribe-input {width: 90%}
    section.subscribe--newsletter .subscribe--bottom--block button.btn-outline-info {margin-top: 35px}
    .navbar-brand.mr-auto.logo {margin-left: 0 !important}
    .home-bottom-inner-text > p {text-align: justify;}
    .login-popup-container { max-width: 85%;}
}
/*@media not all and (min-resolution:.001dpcm) { @media {
    .safariSpecificMargin { 
        margin-top: 0 !important;
    }
}}*/
</style>
    <div class="home-header">

        <main class="hero px-2 ">

            <!--Section heading-->
            {{-- <h1 class="h1-responsive font-weight-bold text-center">
                
                <!-- @inlineEditor('hero-title',null,null,null,null,null,true) Where Opportunity Meets Investment @endInlineEditor -->
            </h1> --}}
            <h1 class="h1-responsive font-weight-bold text-center">
                Release cash from your invoices and fund your business growth</h1>
            <article class="lead text-white text-center">
                <p>The fair and ethical sharia structure for raising finance</p>
                <!-- @inlineEditor( 'hero-lead',null,null,null,null,null,true) Some leed text lorem ipsum sum est @endInlineEditor -->
            </article>
            <div class="play-video-section">
                <a href="https://youtu.be/VhD7Nk5ZUW8" class="play-video-btn" target="_blank" id="video-Btn">Watch video</a> 
                {{-- <button class="play-video-btn" id="video-Btn">Watch video</button> --}}
            </div>
            <div id="video_overlays"></div>
            <video controls playsinline autoplay muted loop style="pointer-events: none;width: 100%;height: 100%;z-index: -2; margin-top: -950px;position: relative;" id="myVideo" >
  <source src="{{url('uploads/Trim3_Compressed.mp4')}}" type="video/mp4" >
  Your browser does not support the video tag.
</video>

{{-- <video width="400" controls>
  <source src="{{url('uploads/Trim3_Compressed.mp4')}}" type="video/mp4">
  <source src="mov_bbb.ogg" type="video/ogg">
  Your browser does not support HTML video.
</video> --}}
            {{-- <div style="background-image: url({{asset('assets/img/hero-image.jpg')}});"></div> --}}
           
        </main>

          <!--  <div class="container hero--intro--text">
              <h2 class=" h2-responsive text-center" style="color: white ;font-size: 18px;">  @inlineEditor( 'hero-title-base-1',null,null,null,null,null,true) Some leed text lorem ipsum sum est @endInlineEditor</h2>
               <h2 class=" h2-responsive text-center" style="color: white; font-size: 18px;"> @inlineEditor( 'hero-title-base-2',null,null,null,null,null,true) Some leed text lorem ipsum sum est @endInlineEditor</h2>
           </div>    -->
        <div class="container hero--intro--text">

            <!-- Section description -->
            <div class="row vertical-divider">
                <div class="col col-lg-6 col-md-6 col-12 col-12 funding-opportunities">
                    <h2>
                        @inlineEditor( 'funding-opportunities',null,null,null,null,null,true )
                        Funding Opportunities
                        @endInlineEditor
                    </h2>
                    {{-- <p class="home-text">
                        @inlineEditor( 'funding-opportunities-lead',null,null,null,null,null,true)
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.
                        @endInlineEditor
                    </p> --}}
                    {!!$website_data[0]->content!!}
                    <div class="row">
                        <div class="col col-sm-4">
                            <div class="op-icon">
                                <img src="assets/img/bank-icon.png" alt="Unlimited auctions"/>
                                <p>
                                    @inlineEditor( 'create-unlimited-auctions' ) Create unlimited auctions @endInlineEditor
                                </p>
                            </div>
                        </div>
                        <div class="col col-sm-4">
                            <div class="op-icon">
                                <img src="assets/img/settings-icon.png" alt="Set and Control"/>
                                <p>
                                    @inlineEditor( 'set-and-control',null,null,null,null,null,true ) Set and control finance terms @endInlineEditor
                                </p>
                            </div>
                        </div>
                        
                        <div class="col col-sm-4">
                            <div class="op-icon">
                                <img src="../public/assets/img/cash-icon.png" alt="Quick funding"/>
                                <p>
                                    @inlineEditor( 'generate-quick-funding',null,null,null,null,null,true ) {{-- Generate quick funding --}} @endInlineEditor
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center invest-button">
                        <a href="{{ route('registration',$seller) }}" class="btn btn-primary funding-btn">
                            Fund your business</a>
                        <a href="#fundind-business" class="btn btn-primary learn-more-btn">
                            Learn more
                        </a>
                    </div>

                </div>
                <div class="col col-lg-6 col-md-6 col-12 col-12 investor-opportunities">
                    <h2>
                        @inlineEditor( 'investor-opportunities',null,null,null,null,null,true )
                        Investor Opportunities
                        @endInlineEditor
                    </h2>
                    {{-- <p class="home-text">
                        @inlineEditor( 'investor-opportunities-lead',null,null,null,null,null,true )
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.
                        @endInlineEditor
                        
                    </p> --}}
                    {!!$website_data[1]->content!!}
                    <div class="row">
                        <div class="col col-sm-4">
                            <div class="op-icon">
                                <img src="assets/img/coin-icon.png" alt="Browse marketplace"/>
                                <p>
                                    @inlineEditor( 'browse-marketplace',null,null,null,null,null,true )
                                    Browse marketplace
                                    @endInlineEditor
                                </p>
                            </div>
                        </div>
                        <div class="col col-sm-4">
                            <div class="op-icon">
                                <img src="assets/img/safe.png" alt="Safe investment opportunities"/>
                                <p>
                                    @inlineEditor( 'safe-investment-opportunities',null,null,null,null,null,true )
                                    Safe investment opportunities
                                    @endInlineEditor
                                </p>
                            </div>
                        </div>
                        
                        
                        <div class="col col-sm-4">
                            <div class="op-icon">
                                <img src="assets/img/settings-icon.png" alt="Control your ROI"/>
                                <p>

                                    @inlineEditor( 'control-your-roi',null,null,null,null,null,true)
                                    Control your ROI
                                    @endInlineEditor
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center invest-button-secondary">
                        <a href="{{ route('registration',$investors) }}" class="btn btn-danger invest-btn">
                            Start Investing
                        </a>
                        <a href="#invest-business" class="btn btn-danger learn-more-btn">
                            Learn more
                        </a>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-2"></div>
            <div class="col-10 col-md working-points">
                <div class="row">
                    <div class="col">
                        <div class="row bullet-row">
                            <div class="col">
                                <p>
                                    <img src="assets/img/notes.png" alt="Register"/>
                                    @inlineEditor( 'create-and-register',null,null,null,null,null,true )
                                    Create and register your business profile or register as an investor.
                                    @endInlineEditor
                                </p>
                            </div>
                        </div>
                        <div class="row bullet-row">
                            <div class="col">
                                <p>
                                    <img src="assets/img/bullet-bank.png" alt="Create"/>
                                    @inlineEditor( 'create-an-auction',null,null,null,null,null,true)
                                    Create an auction in the marketplace and set your terms to raise business funds.
                                    @endInlineEditor
                                </p>
                            </div>
                        </div>
                        <div class="row bullet-row">
                            <div class="col">
                                <p>
                                    <img src="assets/img/bullet-coin.png" alt="Investors"/>
                                    @inlineEditor( 'investors-browse',null,null,null,null,null,true )
                                    Investors browse and bid to invest in credit-worthy, short-term opportunities.
                                    @endInlineEditor
                                </p>
                            </div>
                        </div>
                        <div class="row bullet-row">
                            <div class="col">
                                <p>
                                    <img src="assets/img/bullet-leader.png" alt="Leaderboard"/>
                                    @inlineEditor( 'leaderboard-displays',null,null,null,null,null,true)
                                    Leaderboard displays auction dynamics. Most competitive bids fund the
                                    opportunity.
                                    @endInlineEditor
                                </p>
                            </div>
                        </div>
                        <div class="row bullet-row">
                            <div class="col">
                                <p>
                                    <img src="assets/img/bullet-face.png" alt="Funds"/>

                                    @inlineEditor( 'fund-are-released',null,null,null,null,null,true)
                                    Funds are released to business. Repayments and returns are collected on behalf of
                                    investors.
                                    @endInlineEditor
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-md p-0 right-background">
            </div>
        </div>

    </div>
    <div id="fundind-business" style="height: 70px;"></div>
    <div class="container-fluid home-bottom-section" >
        <div class="row home-bottom-inner">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 home-bottom-inner-text">
                <h2><p>{!!$website_data[17]->content!!}</p></h2>
                {{-- <p class="home-bottom-inner-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.</p>
                <p class="home-bottom-inner-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.</p>
                <p class="home-bottom-inner-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.</p> --}}

                {!!$website_data[2]->content!!}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                {{-- <img src="{{asset('assets/img/home-image2.jpg')}}"> --}}
                <img src="{{asset('assets/img')}}/{{$website_data[3]->content}}">
            </div>
        </div>

    </div>
    <div id="invest-business" style="height: 70px;"></div>
    <div class="container-fluid" >
        <div class="row home-bottom-inner">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <img src="{{asset('assets/img')}}/{{$website_data[5]->content}}">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 home-bottom-inner-text">
                <h2><p>{!!$website_data[18]->content!!}</p></h2>
                {{-- <p class="home-bottom-inner-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.</p>
                <p class="home-bottom-inner-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.</p>
                <p class="home-bottom-inner-content">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras ut laoreet turpis. In sed turpis sagittis, iaculis velit sed, convallis arcu. Praesent magna egestas accumsan.</p> --}}
                {!!$website_data[4]->content!!}
            </div>
            
        </div>

    </div>

<script>
//var video = document.getElementById("myVideo");
//var btn = document.getElementById("video-Btn");

// function myFunction() {
//   if (video.paused) {
//     video.play();
//     btn.innerHTML = "Pause video";
//   } else {
//     video.pause();
//     btn.innerHTML = "Play video";
//   }
// }
</script>

    @include('layouts.frontPage.partials.newsletter')

@endsection
