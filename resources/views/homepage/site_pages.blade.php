@extends('layouts.frontPage.page')


@section('content')
    <div class="container" style="margin-top:100px;height:70vh">

        <!-- Section heading -->
        <h2 class="h1-responsive font-weight-bold text-center my-5">
           {{$page['title']}}
        </h2>
        <!-- Section description -->
        <p class="w-responsive mx-auto mb-5">
           {!!$page['content']!!}
        </p>
    </div>
@endsection