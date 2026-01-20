@extends('layouts.frontPage.page')


@section('content')
<style type="text/css">
  @media (max-width:767px) {
    .subscribe-input {width: 90%}
    section.subscribe--newsletter .subscribe--bottom--block button.btn-outline-info {margin-top: 35px}
    .howitworks-btns { margin-left: 24% !important}
    .funding-btn {min-width: 200px !important}
    .navbar-brand.mr-auto.logo {margin-left: 0 !important}
    .home-bottom-inner-text > p {text-align: justify;}
  }
</style>
    <div class="home-header how-it-works-header">

        <section class="hero" style="background-image:url({{asset('assets/img')}}/{{$website_data[26]->content}}); ">
            <div class="who-we-are-title-text">
              {!!$website_data[22]->content!!}
            </div>
            <div class="howitworks-btns">
                {{-- <a href="#section1" class="howitworks-btn1">BTN 1</a>
                <a href="#section2" class="howitworks-btn1">BTN 2</a> --}}
                <a href="#funding-business" class="btn btn-danger funding-btn" style="text-transform: none;font-size: 16px;font-weight: 600;min-width: 185px;">
                    For Businesses
                </a>
                <a href="#invest-business" class="btn btn-danger invest-btn for-invest" style="text-transform: none;font-size: 16px;font-weight: 600;">
                    For Investors
                </a>
            </div>
        </section>
    </div>

    <div class="container">

       <div class="row">
           <!-- Projects section v.3 -->
           <section class="my-5 page-main-title" style="margin-bottom: 0 !important;width: 100% ">
               <!-- Section heading -->
               
               <!-- Section description -->
               {{-- <p class="text-center w-responsive mx-auto mb-5">
                   @inlineEditor( 'who-we-are-lead' )
                   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto asperiores, dicta distinctio dolor iusto magnam, nihil numquam quaerat, recusandae veniam vero. Illum impedit ipsam nihil odio ratione tempora voluptatem!
                   @endInlineEditor
               </p> --}}
               {!!$website_data[16]->content!!}
           </section>
       </div>
    </div>
    <div id="funding-business" style="height: 70px;"></div>
    <div class="container-fluid home-bottom-section" style="background-color: #fff">
        <div class="row home-bottom-inner">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 home-bottom-inner-text">
                <h2><p>{!!$website_data[23]->content!!}</p></h2>
                {!!$website_data[11]->content!!}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                {{-- <img src="{{asset('assets/img/home-image2.jpg')}}"> --}}
                <img src="{{asset('assets/img')}}/{{$website_data[12]->content}}">
            </div>
        </div>

    </div>

    <div id="invest-business" style="height: 70px;"></div>
    <div class="container-fluid" >
        <div class="row home-bottom-inner">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                {{-- <img src="{{asset('assets/img/home-image1.jpg')}}"> --}}
                <img src="{{asset('assets/img')}}/{{$website_data[14]->content}}">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 home-bottom-inner-text">
                <h2><p>{!!$website_data[24]->content!!}</p></h2>
                {!!$website_data[13]->content!!}
            </div>
            
        </div>

    </div>
    @include('layouts.frontPage.partials.newsletter')
@endsection