@extends('layouts.frontPage.page')


@section('content')
<style type="text/css">
  @media (max-width:767px) {
    .subscribe-input {width: 90%}
    section.subscribe--newsletter .subscribe--bottom--block button.btn-outline-info {margin-top: 35px}
    .navbar-brand.mr-auto.logo {margin-left: 0 !important}
    .home-bottom-inner-text > p {text-align: justify;}
  }
</style>
    <div class="home-header who-we-are-header">

        <section class="hero" style="background-image:url({{asset('assets/img')}}/{{$website_data[25]->content}}); ">
            <div class="who-we-are-title-text">
              {!!$website_data[19]->content!!}
            </div>
        </section>
    </div>

    <div class="container">

       <div class="row">
           <!-- Projects section v.3 -->
           <section class="my-5 page-main-title" style="width: 100%">
               <!-- Section heading -->
               
               <!-- Section description -->
               {{-- <p class="text-center w-responsive mx-auto mb-5">
                   @inlineEditor( 'who-we-are-lead' )
                   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto asperiores, dicta distinctio dolor iusto magnam, nihil numquam quaerat, recusandae veniam vero. Illum impedit ipsam nihil odio ratione tempora voluptatem!
                   @endInlineEditor
               </p> --}}
               {!!$website_data[15]->content!!}
           </section>
       </div>
    </div>

    <div class="container-fluid home-bottom-section" style="background-color: #fff" id="fundind-business">
        <div class="row home-bottom-inner">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 home-bottom-inner-text">
                <h2><p>{!!$website_data[20]->content!!}</p></h2>
                {!!$website_data[7]->content!!}
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                {{-- <img src="{{asset('assets/img/home-image2.jpg')}}"> --}}
                <img src="{{asset('assets/img')}}/{{$website_data[8]->content}}">
            </div>
        </div>

    </div>

    <div class="container-fluid" id="invest-business">
        <div class="row home-bottom-inner">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                {{-- <img src="{{asset('assets/img/home-image1.jpg')}}"> --}}
                <img src="{{asset('assets/img')}}/{{$website_data[10]->content}}">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 home-bottom-inner-text">
                <h2><p>{!!$website_data[21]->content!!}</p></h2>
                {!!$website_data[9]->content!!}
            </div>
            
        </div>

    </div>
    @include('layouts.frontPage.partials.newsletter')
@endsection