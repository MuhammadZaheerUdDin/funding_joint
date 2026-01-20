<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/6/2018
 * Time: 11:19 AM
 */
?>

@extends('layouts.admin.page')
@section('content')


    <h1>
        Login/Register page editor
    </h1>
    <hr>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="">Login page image</h2>
                <img src="{{asset('uploads/login_image.png')}}" alt="" width="250" height="250">
                {!!  Form::open(['url'=>route('auth.edit'),'class' => '','method' => 'post','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::file('login_image') !!}
                    <span class="error_input text-red"><strong>{{$errors->first('login_image')}}</strong></span>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" role="submit">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>



            <div class="col-md-6">
                <h2 class="">Register page image</h2>
                <img src="{{asset('uploads/register_image.png')}}" alt="" width="250" height="250">
                {!!  Form::open(['url'=>route('auth.edit'),'class' => '','method' => 'post','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::file('register_image') !!}
                    <span class="error-input text-red"><strong>{{$errors->first('register_image')}}</strong></span>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" role="submit">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

@endsection
