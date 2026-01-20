@extends('layouts.frontPage.page')
@section('content')
    <div class="container" style="margin-top:25vh;margin-bottom: 25vh">
        <div class="row justify-content-center">
            <div class="col-md-8 mt-5">
                <div class="card">
                    <div class="card-header">
                       Mysql Error
                    </div>
                    <div class="card-body">

                        <p>
                            {!! ($exception->getMessage()) !!}
                        </p>

                        <div class="row">
                            <div class="col-lg-12">
                                <a href="{{ url('/')  }}" class="btn btn-primary"> Click here to go to home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection