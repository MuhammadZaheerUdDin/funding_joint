<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 29/10/2018
 * Time: 10:51
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
    <div class="profile">
        @include('admin.view.investor.top-profile-bar')
        <div class="profile__content">
            {!! Form::open(['url'=>route('admin.editUser',['UserType'=>'investor','id'=>$profile->id])], ['action' => 'Admin\EditUsersController@postEdit','class' => '']) !!}
            <div class="row mb-4 align-items-center">
                <div class="col-12 edit-button">
                    <h5 class="profile__content__heading">Edit Investor Profile</h5>
                    <hr>
                </div>
                <div class="col-12 col-md-9">
                    <div class="icon">
                        <img src="https://ui-avatars.com/api/?size=100&name=F+J&background=212121&color=fff"
                             class="rounded-circle float-left" style="width:100px">
                    </div>
                    <div class="icon-text">
                        <!-- <img src="http://placehold.it/100" alt="" class="rounded-circle float-left mr-3"> -->
                        <h4 class="font-weight-bold">{{$profile->first_name}}</h4>
                        <p class="profile-label">Member Since : {{\App\Helpers\FormattedDate::format($profile->created_at)}}</p>
                    </div>
                </div>
                <div class="col-12 col-md-3 edit-button">
                <!-- {!! Form::submit('Save',['class' => 'btn btn-dark float-right']) !!} -->
                    <button type="submit" class="btn btn-dark float-right">
                        {{ __('SAVE') }}
                    </button>
                </div>
            </div>

            <div class="form-area mt-5">


                <div class="form-group pb-3">
                    <h5 class="profile__content__heading">Personal Details</h5>
                    <div class="row">
                        <div class="col">
                            {!! Form::label('Title', 'Title') !!} <span class="required"></span>
                            <select class="form-control" name="title">
                                <option @if(empty($profile->title)) selected @endif value=""></option>
                                <option @if($profile->title =='Mr') selected @endif value="Mr">Mr</option>
                                <option @if($profile->title =='Mrs') selected @endif value="Mrs">Mrs</option>
                                <option @if($profile->title =='Ms') selected @endif value="Ms">Ms</option>
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
                            {!! Form::label('First name','First name') !!} <span class="required"></span>
                            {!! Form::text('first_name',$profile->first_name, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                 <strong>{{ $errors->first('first_name') }}</strong>
                              </span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Last name','Last name') !!} <span class="required"></span>
                            {!! Form::text('last_name',$profile->last_name, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                 <strong>{{ $errors->first('last_name') }}</strong>
                              </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Middle name','Middle name') !!}
                            {!! Form::text('middle_name',$profile->middle_name, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                 <strong>{{ $errors->first('middle_name') }}</strong>
                              </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('User name (visible to others)','User name  (visible to others)') !!}
                            {!! Form::text('user_name',$profile->user_name, ['class' => 'form-control']) !!}
                            <span class="error_input">
                             <strong>{{ $errors->first('user_name') }}</strong>
                          </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            {!! Form::label('Date Of Birth','Date Of Birth') !!}
                            {!! Form::date('dob',$profile->dob, ['class' => 'form-control flatpickr']) !!}
                            <span class="error_input">
                                 <strong>{{ $errors->first('dob') }}</strong>
                              </span>
                        </div>
                        <div class="col">

                            {!! Form::label('Gender','Gender') !!}
                            <br>
                            <select class="form-control" name="gender">
                                <option value=""></option>
                                <option @if($profile->gender =='male') selected @endif value="male">Male
                                </option>
                                <option @if($profile->gender =='female') selected @endif value="female">Female
                                </option>
                                <option <?php if($profile->gender =='not_to_say'): ?> selected <?php endif; ?> value="not_to_say">Prefer not to say</option>

                            </select>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Nationality','Nationality') !!}
                            <select class="form-control" name="nationality">
                                <option value=""></option>
                                @foreach($nationalities as $nationality)
                                    <option @if($profile->nationality == $nationality) selected
                                            @endif value="{{$nationality}}">{{$nationality}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">

                        </div>
                    </div>

                </div>

                <div class="form-group  pb-3">
                    <h5 class="profile__content__heading">Address Details</h5>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Country Of Residence','Country Of Residence') !!}
                            <select class="form-control" name="country_residence">
                                <option value="">Select</option>
                                @foreach($countries as $country)
                                    <option @if($profile->country_residence == $country) selected
                                            @endif  value="{{$country}}">{{$country}}</option>
                                    }
                                @endforeach
                            </select>
                            <span class="error_input">
                                 <strong>{{ $errors->first('country_residence') }}</strong>
                                 </span>
                        </div>
                        <div class="col">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Building Number  Name','Building Number  Name') !!}
                            {!! Form::text('building_no',$profile->building_no, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                      <strong>{{ $errors->first('building_no') }}</strong>
                              </span>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Address Line 1','Address Line 1') !!}
                            {!! Form::text('address_1',$profile->address_1, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                  <strong>{{ $errors->first('address_1') }}</strong>
                                  </span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Address Line 2','Address Line 2') !!}
                            {!! Form::text('address_2',$profile->address_2, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                  <strong>{{ $errors->first('address_2') }}</strong>
                                  </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Address Line 3','Address Line 3') !!}
                            {!! Form::text('address_3',$profile->address_3, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                  <strong>{{ $errors->first('address_3') }}</strong>
                              </span>
                        </div>
                        <div class="col"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Town / City','Town / City') !!}
                            {!! Form::text('town',$profile->town, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                      <strong>{{ $errors->first('town') }}</strong>
                                  </span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('County / Region','County / Region') !!}
                            {!! Form::text('county',$profile->county, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Post code','Post code') !!}
                            {!! Form::text('post_code',$profile->post_code, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                      <strong>{{ $errors->first('post_code') }}</strong>
                                  </span>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Country','Country') !!}
                            <select class="form-control" name="country">
                                <option value="">Select</option>
                            @foreach($countries as $country)
                                    <option @if($profile->country == $country) selected
                                            @endif  value="{{$country}}">{{$country}}</option>
                                @endforeach
                            </select>
                            <span class="error_input">
                                          <strong>{{ $errors->first('country') }}</strong>
                                      </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-12">

                            <div class="row">
                                <div class="col-md-4 col-sm-4">
                                    {!! Form::label('Country Code','Country Code') !!}
                                    {!! Form::text('phone_code',$profile->phone_code, ['class' => 'form-control']) !!}
                                    <span class="error_input">
                                          <strong>{{ $errors->first('phone_code') }}</strong>
                                         </span>
                                </div>
                                <div class="col-md-5 col-sm-12">
                                    {!! Form::label('Phone Number','Phone Number') !!}
                                    {!! Form::text('phone',$profile->phone, ['class' => 'form-control']) !!}
                                    <span class="error_input">
                                          <strong>{{ $errors->first('phone') }}</strong>
                                         </span>
                                </div>
                            </div>
                            <div class="col">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group pb-3">
                    <h5 class="profile__content__heading">Declaration For Sophisticated Investors</h5>


                    <h6><i>The content of this promotion has not been approved
                            by an authorised person within the meaning of the Financial Services Act 2000.
                            Reliance on this promotion for the purpose of engaging in any investment activity may
                            expose an individual to a significant risk of losing all of the property or other assets
                            invested.
                        </i></h6>

                    <h6>
                        {!! Form::checkbox('read_investors_declaration',1,$profile->read_investors_declaration) !!}

                        I have read the sophisticated invester/High Net Worth individual declaration
                        form and declare that I ma a self-certified sophisticated investor for the purposes of the
                        Financial Services and Markets Act (Financial Promotion) Order
                        2005. </h6>
                    <!-- <a href="high-net-worth-form">Read sophisticated investor / High Net Worth individual declaration form</a> -->



                    <span class="error_input">
                        <strong>{{ $errors->first('read_investors_declaration') }}</strong>
                      </span>
                </div>

                <div class="form-group  pb-3">
                    <h5 class="profile__content__heading">Further Details</h5>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Source of funds','Source of funds') !!}
                            {!! Form::text('source_of_funds',$profile->source_of_funds, ['class' => 'form-control']) !!}
                            <span class="error_input">
                                      <strong>{{ $errors->first('source_of_funds') }}</strong>
                                     </span>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Job title / Position in company','Job title / Position in company') !!}
                            {!! Form::text('job_title',$profile->job_title, ['class' => 'form-control']) !!}
                            {{-- <select class="form-control" name="job_title">
                                @foreach($occupations as $occupation)
                                    <option @if($profile->job_title == $occupation) selected
                                            @endif  value="{{$occupation}}">{{ucfirst($occupation)}}</option>
                                @endforeach
                            </select> --}}
                        </div>
                        <div class="col">
                            {!! Form::label('Employer name','Employer name') !!}
                            {!! Form::text('employer_name',$profile->employer_name, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            {!! Form::label('Nature of employers business','Nature of employers business') !!}
                            {!! Form::text('nature_employers_business',$profile->nature_employers_business, ['class' => 'form-control']) !!}
                        </div>
                        {{-- <div class="col-md-6 col-sm-12">
                            {!! Form::label('Location of business','Location of business') !!}
                            <select class="form-control" name="location_of_business">
                                @foreach($locations as $location)
                                    <option @if($profile->location_of_business) selected
                                            @endif value="{{$location}}">{{$location}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                    </div>
                    <button type="submit" class="mt-5 btn btn-dark">
                        {{ __('SAVE') }}
                    </button>
                </div>


            </div><!--end card body-->
            {!! Form::close() !!}
        </div> <!--end card-->
    </div>



@endsection
