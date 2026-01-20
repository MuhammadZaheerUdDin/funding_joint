@extends('layouts.frontPage.page')


@section('content')
    <div class="container" style="margin-top:100px;height:60vh">

        <!-- Section heading -->
        <h2 class="h1-responsive font-weight-bold text-center my-5">
            @inlineEditor( 'compliance-policy-title' )
            Compliance Policy
            @endInlineEditor
        </h2>
        <!-- Section description -->
        <p class="w-responsive mx-auto mb-5">
            @inlineEditor( 'compliance-policy-content' )
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto asperiores, dicta distinctio dolor iusto magnam, nihil numquam quaerat, recusandae veniam vero. Illum impedit ipsam nihil odio ratione tempora voluptatem!
            @endInlineEditor
        </p>
    </div>
@endsection