@extends('layouts.frontPage.page')


@section('content')
    <div class="container" style="margin-top:100px;">


        <!-- Section heading -->
        <h2 class="h1-responsive font-weight-bold my-5">
            @inlineEditor( 'contact-title' )
            Contact us
            @endInlineEditor
        </h2>
        <!-- Section description -->
        <p class="mx-auto mb-5">
            @inlineEditor( 'contact-lead' )
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto asperiores, dicta distinctio dolor iusto magnam, nihil numquam quaerat, recusandae veniam vero. Illum impedit ipsam nihil odio ratione tempora voluptatem!
            @endInlineEditor
        </p>
            <div class="row">
                <div class="col-md-12">
                    @if (session('msg'))
                        <div class="alert alert-success" role="alert">
                            {{ session('msg') }}
                        </div>
                    @endif
                </div>
                <div class="col-md-12">
                    {!! Form::open(['url'=> route('contact'),'method'=>'POST']) !!}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputEmail4">First Name</label>
                                <input type="txt" class="form-control" id="inputEmail4" placeholder="Name" name="name">
                                <span class="error_input">
                                    <strong>{{$errors->first('name')}}</strong>
                                </span>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Email</label>
                                <input type="email" class="form-control" id="inputPassword4" placeholder="Email" name="email">
                                <span class="error_input">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress">Address</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address_1">
                            <span class="error_input">
                                <strong>{{$errors->first('address_1')}}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Address 2</label>
                            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor" name="address_2">
                            <span class="error_input">
                                <strong>{{$errors->first('address_2')}}</strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="inputAddress2">Your Message</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" name="comments"></textarea>
                            <span class="error_input">
                                <strong>{{$errors->first('comments')}}</strong>
                            </span>
                        </div>


                        <button type="submit" class="btn btn-primary float-right">Send</button>
                   {!! Form::close() !!}
                </div>
            </div>
        </div>
@endsection

