<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 07/01/2019
 * Time: 16:11
 */
?>
@extends('layouts.admin.page')

@section('content')
    <div class="profile">
        <div class="profile__content">

            @if(Session::has('message'))
                @push('alerts')
                <div class="alert alert-info">
                    <a class="close" data-dismiss="alert">×</a>
                    {!!Session::get('message')!!}
                </div>
                @endpush
            @endif
            {!! Form::model(array($user, 'files' => true), ['action' => 'Profile\UserProfileController@postChangePassword','class' => '','files'=>true]) !!}

            <div class="form-asrea  mt-5">

                <div class="form-group confirm pb-3">
                    <div class="row">
                        <div class="col">
                            <h5 class="profile__content__heading">Login Details</h5>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Email address', 'Email address') !!}
                            {!! Form::text('',$user->email,['class'=>'form-control','readonly']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Password', 'Current Password') !!}
                            <input type="password" value="" class="form-control" name="current_password"
                                   id="exampleInputPassword1" placeholder="*******">
                            <span class="error_input"><strong>{{ $errors->first('current_password') }}</strong></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Password', 'New Password') !!}
                            <input type="password" value="" class="form-control" name="password"
                                   id="exampleInputPassword1" placeholder="*******">
                            <span class="error_input"><strong>{{ $errors->first('password') }}</strong></span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Confirm password', 'Confirm password') !!}
                            <input type="password" value="" class="form-control" name="password_confirmation"
                                   id="exampleInputPassword2" placeholder="*******">
                            <span class="error_input"><strong>{{ $errors->first('password_confirmation') }}</strong></span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark mt-5">
                    {{ __('SAVE') }}
                </button>
            </div><!--end card body-->
            {!! Form::close() !!}
        </div> <!--end card-->
    </div>


@endsection
