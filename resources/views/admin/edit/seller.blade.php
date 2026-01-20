<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 29/10/2018
 * Time: 12:27
 */

?>

@extends('layouts.admin.page')

@section('content')

    @if(Session::has('msg'))
        @push('alerts')
            <div class="alert alert-info">
                <a class="close" data-dismiss="alert">×</a>
                {!!Session::get('msg')!!}
            </div>
        @endpush
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
               
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
           
            <span>Please fill up mandatory fields.</span>
        </div>
    @endif
    <div class="profile">
        @include('admin.view.seller.top-profile-bar')

        <div class="profile__content">
            {!! Form::open(['url'=>route('admin.editUser',['UserType'=>'seller','id'=>$profile->id])], ['action' => 'Admin\EditUsersController@edit','class' => '']) !!}
            <div class="row mb-4 align-items-center">
                <div class="col-12 edit-button">
                    <h5 class="profile__content__heading">Edit Seller Profile</h5>
                    <hr>
                </div>
                <div class="col-12 col-md-9">
                    <div class="icon">
                        <img src="https://ui-avatars.com/api/?size=100&name=F+J&background=212121&color=fff"
                             class="rounded-circle float-left" style="width:100px">
                    </div>
                    <div class="icon-text">
                        <!-- <img src="http://placehold.it/100" alt="" class="rounded-circle float-left mr-3"> -->
                        <h4 class="font-weight-bold">{{$profile->full_name}}</h4>
                        <p class="profile-label">Member Since : {{\App\Helpers\FormattedDate::format($profile->created_at)}}</p>
                    </div>
                </div>
                <div class="col-12 col-md-3 edit-button">
                <!-- {!! Form::submit('Save',['class' => 'btn btn-dark float-right']) !!} -->
                    <a href="{{URL::asset('users')}}" class="btn  col1" style="color:black;margin-top:0px !important;  padding-left: 2.14rem; padding-right: 2.14rem; font-size: all;border-radius:0px;">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="btn btn-dark float-righ">
                        {{ __('SAVE') }}
                    </button>
                </div>
            </div>

            <div class="form-area mt-5">
                <div class="form-group pb-3">
                    <h5 class="profile__content__heading">Personal Details</h5>
                    <div class="row">
                        <div class="col">
                            {!! Form::label('Title', 'Title') !!} *
                            <select class="form-control" name="title">
                                <option @if(empty($profile->title)) selected @endif value=""></option>
                                <option @if($profile->title =='Mr') selected @endif value="Mr">Mr</option>
                                <option @if($profile->title =='Mrs') selected @endif value="Mrs">Mrs</option>
                                <option @if($profile->title =='Ms.') selected @endif value="Ms">Ms</option>
                            </select>
                            <span class="error_input">
                                        <strong>{{ $errors->first('title') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('First name','First name') !!} *
                            {!! Form::text('first_name',$profile->first_name,['class'=>'form-control']) !!}
                            <span class="error_input">
                                       <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Last name','Last name') !!} *
                            {!! Form::text('last_name',$profile->last_name,['class'=>'form-control']) !!}
                            <span class="error_input">
                                       <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('','Date Of Birth') !!}
                            {!! Form::date('dob',$profile->dob,['class'=>'form-control']) !!}
                            <span class="error_input">
                                       <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('phone','Telephone Number') !!}
                            {!! Form::text('phone',$profile->phone,['class'=>'form-control']) !!}
                            <span class="error_input">
                                       <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('job_title','Job Title / Company Position') !!}
                            {!! Form::text('job_title',ucfirst($profile->job_title),['class'=>'form-control']) !!}
                            <span class="error_input">
                                       <strong>{{ $errors->first('job_title') }}</strong>
                                    </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('hear_of_us','How did you hear of us') !!}
                            {!! Form::textarea('hear_of_us',$profile->hear_of_us, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('hear_of_us') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('company_name','Company Name') !!}
                            {!! Form::text('company_name',$profile->company_name, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('company_name') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('','Date Of Incorporation') !!}
                            {!! Form::date('dob_incorporation',$profile->dob_incorporation,['class'=>'form-control']) !!}
                            <span class="error_input"><strong>{{ $errors->first('dob_incorporation') }}</strong></span>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('company_reg_no','Company Reg no') !!}
                            {!! Form::text('company_reg_no',$profile->company_reg_no, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('company_reg_no') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('building_no','Building Number') !!}
                            {!! Form::text('building_no',$profile->building_no, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('building_no') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('address_1','Address 1') !!}
                            {!! Form::text('address_1',$profile->address_1, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('address_1') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('address_2','Address 2') !!}
                            {!! Form::text('address_2',$profile->address_2, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('address_2') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('address_3','Address 3') !!}
                            {!! Form::text('address_3',$profile->address_3, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('address_3') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('town','Town') !!}
                            {!! Form::text('town',$profile->town, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('town') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('post_code','Post Code') !!}
                            {!! Form::text('post_code',$profile->post_code, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('post_code') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('county','County') !!}
                            {!! Form::text('county',$profile->county, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('county') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                </div>


                <div class="form-group pb-3">
                    <h5 class="profile__content__heading">Business Details</h5>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('about_your_business','About your Business') !!}
                            {!! Form::text('about_your_business',$profile->about_your_business, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('about_your_business') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('your_company_website','Company Website') !!}
                            {!! Form::text('your_company_website',$profile->your_company_website, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('your_company_website') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">

                            {!! Form::label('','Are you authorised on behalf of the company to use Funding Joint services') !!}

                            {!! Form::checkbox('company_authorised',1,$profile->company_authorised) !!}

                            <span class="error_input">
                                   <strong>{{ $errors->first('company_authorised') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('turnover','Please state your 12 month turnover') !!}
                            {!! Form::text('turnover',$profile->turnover, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('turnover') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>


                    {!! Form::label('','Has your company been trading for more that 6 months') !!}

                    {!! Form::checkbox('trading_time',$profile->trading_time,$profile->trading_time) !!}
                    <span class="error_input">
                                        <strong>{{ $errors->first('trading_time') }}</strong>
                                </span>
                </div>



                <div class="form-group pb-3">
                    <h5 class="profile__content__heading">Ratings</h5>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <select name="experian_rating" class="custom-select mb-2 mr-sm-2 mb-sm-0" {{-- onchange="this.form.submit();" --}}>
                                <option value="">Experian rating</option>
                                <option @if( $profile->experian_rating==="Excellent") selected @endif value="Excellent">
                                    Excellent
                                </option>
                                <option @if( $profile->experian_rating==="Good") selected @endif value="Good">Good</option>
                                <option @if( $profile->experian_rating==="Fair") selected @endif value="Fair">Fair</option>
                                <option @if( $profile->experian_rating==="Poor") selected @endif value="Poor">Poor</option>
                                <option @if( $profile->experian_rating==="Very Poor") selected @endif value="Very Poor">Very
                                    Poor
                                </option>
                            </select>
                            <span class="error_input">
                                <strong>{{ $errors->first('experian_rating') }}</strong>
                            </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            {!! Form::label('credit_limit','Credit Limit') !!}
                            {!! Form::text('credit_limit',$profile->credit_limit, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                   <strong>{{ $errors->first('credit_limit') }}</strong>
                                </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>

                </div>


                <div class="form-group pb-3">
                    <h5 class="profile__content__heading">Primary Bank Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('','Bank Name') !!}
                            {!! Form::text('bank_name',isset($profile->user->bankDetails->bank_name)?$profile->user->bankDetails->bank_name:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('bank_name') }}</strong>
                                </span>
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('','Account Name') !!}
                            {!! Form::text('account_name',isset($profile->user->bankDetails->account_name)?$profile->user->bankDetails->account_name:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('account_name') }}</strong>
                                </span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('','Sort Code') !!}
                            {!! Form::text('sort_code',isset($profile->user->bankDetails->sort_code)?$profile->user->bankDetails->sort_code:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('sort_code') }}</strong>
                                </span>
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('','Account Number') !!}
                            {!! Form::text('account_number',isset($profile->user->bankDetails->account_number)?$profile->user->bankDetails->account_number:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('account_number') }}</strong>
                                </span>
                        </div>
                    </div>
                </div>

                <div class="form-group pb-3">
                    <h5 class="profile__content__heading">Second Bank Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('','Bank Name') !!}
                            {!! Form::text('bank_name_1',isset($profile->user->bankDetails->bank_name_1)?$profile->user->bankDetails->bank_name_1:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('bank_name_1') }}</strong>
                                </span>
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('','Account Name') !!}
                            {!! Form::text('account_name_1',isset($profile->user->bankDetails->account_name_1)?$profile->user->bankDetails->account_name_1:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('account_name_1') }}</strong>
                                </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('','Sort Code') !!}
                            {!! Form::text('sort_code_1',isset($profile->user->bankDetails->sort_code_1)?$profile->user->bankDetails->sort_code_1:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('sort_code_1') }}</strong>
                                </span>
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('','Account Number') !!}
                            {!! Form::text('account_number_1',isset($profile->user->bankDetails->account_number_1)?$profile->user->bankDetails->account_number_1:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('account_number_1') }}</strong>
                                </span>
                        </div>
                    </div>
                </div>

                <div class="form-group pb-3">
                <h5 class="profile__content__heading">Third Bank Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('','Bank Name') !!}
                            {!! Form::text('bank_name_2',isset($profile->user->bankDetails->bank_name_2)?$profile->user->bankDetails->bank_name_2:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('bank_name_2') }}</strong>
                                </span>
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('','Account Name') !!}
                            {!! Form::text('account_name_2',isset($profile->user->bankDetails->account_name_2)?$profile->user->bankDetails->account_name_2:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('account_name_2') }}</strong>
                                </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('','Sort Code') !!}
                            {!! Form::text('sort_code_2',isset($profile->user->bankDetails->sort_code_2)?$profile->user->bankDetails->sort_code_2:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('sort_code_2') }}</strong>
                                </span>
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('','Account Number') !!}
                            {!! Form::text('account_number_2',isset($profile->user->bankDetails->account_number_2)?$profile->user->bankDetails->account_number_2:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('account_number_2') }}</strong>
                                </span>
                        </div>
                    </div>
                </div>

                <div class="form-group pb-3">
                <h5 class="profile__content__heading">Fourth Bank Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('','Bank Name') !!}
                            {!! Form::text('bank_name_3',isset($profile->user->bankDetails->bank_name_3)?$profile->user->bankDetails->bank_name_3:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('bank_name_3') }}</strong>
                                </span>
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('','Account Name') !!}
                            {!! Form::text('account_name_3',isset($profile->user->bankDetails->account_name_3)?$profile->user->bankDetails->account_name_3:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('account_name_3') }}</strong>
                                </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::label('','Sort Code') !!}
                            {!! Form::text('sort_code_3',isset($profile->user->bankDetails->sort_code_3)?$profile->user->bankDetails->sort_code_3:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('sort_code_3') }}</strong>
                                </span>
                        </div>
                        <div class="col-md-6">
                            {!! Form::label('','Account Number') !!}
                            {!! Form::text('account_number_3',isset($profile->user->bankDetails->account_number_3)?$profile->user->bankDetails->account_number_3:'', ['class' => 'form-control']) !!}
                            <span class="error_input">
                                        <strong>{{ $errors->first('account_number_3') }}</strong>
                                </span>
                        </div>
                    </div>
                </div>

                    <!-- <h5 class="profile__content__heading">Bank Statements</h5>
                    <div class="row">
                        <div class="col">

                            <ul class="list-group w-100">

                                <?php

                                $document = $profile->user->bankStatement->first();


                                ?>

                                @if(!is_null($document))
                                    <li class="list-group-item">
                                        <a href="/bankStatements/{!! $document->id !!}">{!! $document->statement_name !!}</a>
                                    </li>
                                @endif

                            </ul>
                        </div>
                    </div>

                    <p>
                        {!! Form::checkbox('no_other_bank',$profile->no_other_bank,$profile->no_other_bank) !!}
                        <span>
                                {!! Form::label('','Confirm no other banks') !!}
                              </span>
                    </p>

                    <span class="error_input">
                                    <strong>{{ $errors->first('no_other_bank') }}</strong>
                            </span> -->

                    <p>
                        {!! Form::checkbox('agree',1,$profile->agree) !!}
                        <span>
                                {!! Form::label('','I Agree to T&Cs') !!}
                            <br>
                                <a class="font-weight-bold text-dark" href="/terms">Read Terms and Conditions and Agency Agreement</a>
                              </span>
                    </p>

                    <span class="error_input">
                                <strong>{{ $errors->first('agree') }}</strong>
                            </span>
                    <button type="submit" class="btn btn-dark ">
                        {{ __('SAVE') }}
                    </button>

                </div>


            </div><!--end card body-->
            {!! Form::close() !!}
        </div> <!--end card-->
    </div>



@endsection
