@extends('layouts.frontPage.master')
@section('content')
    <div class="container" style="margin-top:25vh;margin-bottom: 25vh">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                        @inlineEditor( '404-title' )
                        Page not found
                        @endInlineEditor
                    </div>
                    <div class="card-body">


                        <p>
                            Sorry, the page you are looking for could not be found.
                        </p>

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="/" class="btn btn-primary"> Click here to go to home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection