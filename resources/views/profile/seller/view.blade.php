@extends('layouts.admin.page')
@section('content')
    <div class="container">
        <div class="profile">

            <div class="profile__content">
                @role('admin')
                <div class="row row-spacer top-profile-bar">
                    <div class="col-md-5">
                        <h4>Tom Bradly</h4>
                        My Profile
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group profile-buttons" role="group" aria-label="Basic example">
                            <div class="btn btn-dark btn-md">Profile</div>
                            <div class="btn btn-dark btn-md">Account</div>
                            <div class="btn btn-dark btn-md">Auctions</div>
                            <div class="btn btn-dark btn-md">Buyer</div>
                            <div class="btn btn-dark btn-md">Activity</div>
                        </div>
                    </div>
                </div>
                @endrole

                <div class="profile__content">
                    <h5 class="profile__content__heading">My Profile</h5>
                </div>
                <hr>
                <div class="profile__content">
                    <div class="row">
                      <div class="col-12  col-md-8">
                        <div class="icon">
                          <img src="https://ui-avatars.com/api/?size=100&name={{$profile->first_name}}+{{$profile->last_name}}&background=212121&color=fff"
                          class="rounded-circle float-left" style="width:100px">
                        </div>
                        <div class="icon-text">
                          <!-- <img src="http://placehold.it/100" alt="" class="rounded-circle float-left mr-3"> -->
                          <h4 class="font-weight-bold">{{$profile->first_name}} {{$profile->last_name}}</h4>
                          <p class="profile-label">Member Since : {{$profile->created_at->format('d/m/Y')}}</p>
                        </div>
                      </div>
                        <div class="col-12  col-md-4 edit-button">
                            @role('admin')
                            <a href="{{route('admin.editUser',['UserType'=>'seller','id'=>$profile->id])}}"
                               class="btn btn-dark btn-sm float-md-right">EDIT AS ADMIN</a>
                            @else
                                <a href="{{route('profile.edit')}}" class="btn btn-dark btn-sm float-right">EDIT</a>
                                @endrole
                        </div>
                    </div>
                </div>
                <hr>
                <div class="profile__content">
                    <h5 class="profile__content__heading">
                        Login Details
                    </h5>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Email address:</div>
                        <div class="col-md-3 profile-value">{{$profile->user->email}}</div>
                        <div class="col-md-2 profile-label" style="text-align:right;">Password:</div>
                        <div class="col-md-3 profile-value"> ***********</div>
                    </div>

                </div>
                <hr>
                <div class="profile__content">
                    <h5 class="profile__content__heading">Personal Details</h5>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Title:</div>
                        <div class="col-md-3 profile-value">{{$profile->title}}</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">First Name:</div>
                        <div class="col-md-3 profile-value">{{$profile->first_name}}</div>
                        <div class="col-md-3 profile-label">Last Name:</div>
                        <div class="col-md-3 profile-value">{{$profile->last_name}}</div>
                    </div>
                    <!--
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Middle Name:</div>
                        <div class="col-md-3 profile-value">{{$profile->middle_name}}</div>
                        <div class="col-md-3 profile-label">Username:</div>
                        <div class="col-md-3 profile-value">{{$profile->username}}</div>
                    </div>
                    !-->
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Date of birth:</div>
                        <div class="col-md-3 profile-value">{{$profile->dob}}</div>
                        <div class="col-md-3 profile-label">Code:</div>
                        <div class="col-md-3 profile-value">{{$profile->phone_code}}</div>
                        <div class="col-md-3 profile-label">Telephone:</div>
                        <div class="col-md-3 profile-value">{{$profile->phone}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Job Title:</div>
                        <div class="col-md-3 profile-value">{{$profile->job_title}}</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">How did you hear about Funding Joint?:</div>
                        <div class="col-md-3 profile-value">{{$profile->hear_of_us}}</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <hr>


                <div class="profile__content">
                    <h5 class="profile__content__heading">Company Details</h5>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Company:</div>
                        <div class="col-md-3 profile-value">{{$profile->company_name}}</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <hr>

                <div class="profile__content">
                    <h5 class="profile__content__heading">Address Details</h5>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Company:</div>
                        <div class="col-md-3 profile-value">{{$profile->company_name}}</div>
                        <div class="col-md-3 profile-label">Country Of Residence:</div>
                        <div class="col-md-3 profile-value">{{$profile->country_of_residence}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Address 1:</div>
                        <div class="col-md-3 profile-value">{{$profile->address_1}}</div>
                        <div class="col-md-3 profile-label">Address 2:</div>
                        <div class="col-md-3 profile-value">{{$profile->address_2}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Address 3:</div>
                        <div class="col-md-3 profile-value">{{$profile->address_3}}</div>
                        <div class="col-md-3 profile-label">Town:</div>
                        <div class="col-md-3 profile-value">{{$profile->town}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Post Code:</div>
                        <div class="col-md-3 profile-value">{{$profile->post_code}}</div>
                        <div class="col-md-3 profile-label">Telephone:</div>
                        <div class="col-md-3 profile-value">{{$profile->phone}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Town / City:</div>
                        <div class="col-md-3 profile-value">{{$profile->town}}</div>
                        <div class="col-md-3 profile-label">County:</div>
                        <div class="col-md-3 profile-value">{{$profile->county}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">About your Business:</div>
                        <div class="col-md-9 profile-value">{{$profile->about_your_business}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Company Website:</div>
                        <div class="col-md-9 profile-value"><a href="{{$profile->your_company_website}}"
                                                               target="_blank">{{$profile->your_company_website}}</a>
                        </div>
                    </div>
                </div>
                <hr>

                <div class="profile__content">
                    <h5 class="profile__content__heading">Further Details</h5>
                    <div class="row row-spacer">
                        <div class="col-md-6 profile-label">Please State your company's turnover in the last 12 months:
                        </div>
                        <div class="col-md-6 profile-value">£ @money($profile->turnover)</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-6 profile-label">Has your company been trading for more than 6 months:</div>
                        <div class="col-md-6 profile-value">
                            @if($profile->trading_time == 1)
                                Yes
                                @else
                                No
                            @endif
                        </div>
                    </div>

                </div>
                <hr>
                <div class="profile__content bank-details">
                    <h5 class="profile__content__heading">Bank Details</h5>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Bank Name:</div>
                        <div class="col-md-3 profile-value">{{ $profile->user->bankDetails->bank_name or ''}}</div>
                        <div class="col-md-3 profile-label">Account Name:</div>
                        <div class="col-md-3 profile-value">{{$profile->user->bankDetails->account_name or ''}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Sort Code:</div>
                        <div class="col-md-3 profile-value">{{$profile->user->bankDetails->sort_code or ''}}</div>
                        <div class="col-md-3 profile-label">Account Number:</div>
                        <div class="col-md-3 profile-value">{{$profile->user->bankDetails->account_number or ''}}</div>
                    </div>

                    <div class="row row-spacer">
                        <div class="col-md-12 profile-value">
                            Bank Statements
                        </div>
                    </div>

                    <div class="row row-spacer">
                        @foreach($profile->user->bankStatement as $statement)
                            <div class="col-md-6 profile-label">{{$statement->statement_name}}:
                                <a href="http://3.20.72.9/funding_joint/public/bankstatement/download/{{ ($statement->id)}}">
                                    <span class="badge badge-primary"><i class="fa fa-link"></i></span>
                                </a>
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
            <hr>


            @role('admin')
            <div class="profile__admin__actions bg-dark">
                {!! Form::model($profile, ['action' => 'Seller\SellerController@adminUpdate'])!!}
                <button class="btn btn-outline-primary"><i class="fa fa-download"></i> Export</button>
                <button type="submit" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</button>

                <div class="float-right" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-outline-danger">Decline</button>
                    <button type="button" class="btn btn-primary">Approve</button>
                </div>

                <div class="form--group w-25 float-right">
                    <select name="experian_rating" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                        <option value="">Experian rating</option>
                        <option value="All">All</option>
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

                <input type="hidden" name="type" value="<?php echo $_GET['type'];?>">
                <input type="hidden" name="show" value="<?php echo $_GET['show'];?>">
                {!! Form::close() !!}
            </div>
            @endrole
        </div>
    </div>
@endsection
