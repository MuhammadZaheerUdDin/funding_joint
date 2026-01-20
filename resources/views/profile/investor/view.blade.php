@extends('layouts.admin.page')
@section('content')
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script type="text/javascript"> 
    $(function(){
         setTimeout(function(){
            $("#alertMessage").hide();
        }, 1000);
    });
</script>
 @if(!empty($successMsg))
 @push('alerts')
    <div  id="alertMessage" class="alert alert-info">
        <a class="close" data-dismiss="alert">×</a>
       {{ $successMsg }}
    </div>
@endpush
@endif
<!--  <div class="alert-area">
    @if(!empty($successMsg))
        <div id="alertMessage" class="alert alert-info"> {{ $successMsg }}</div>
    @endif
    </div> -->
<div class="container">
   <div class="profile">
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
                    <p class="profile-label">Member Since : {{\App\Helpers\FormattedDate::format($profile->created_at)}}</p>
                  </div>
                </div>
                <div class="col-12  col-md-4 edit-button">
                    @role('admin')
                        <a href="{{route('admin.editUser',['UserType'=>'investor','id'=>$profile->id])}}" class="btn btn-dark btn-sm float-md-right">EDIT AS ADMIN</a>
                    @else
                        <a href="{{route('profile.edit')}}" class="btn btn-dark btn-sm float-md-right">EDIT</a>
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
                    <div class="col-md-2 profile-label">Email address: </div>
                    <div class="col-md-3 profile-value">{{$profile->user->email}}</div>
                    <div class="col-md-2 profile-label" style="margin-left: 84px;text-align:right;">Password :</div>
                    <div class="col-md-3 profile-value"> ***********</div>
                   <!--  style="margin-left: 84px;" -->
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
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Middle Name:</div>
                        <div class="col-md-3 profile-value">{{$profile->middle_name}}</div>
                        <div class="col-md-3 profile-label">Username:</div>
                        <div class="col-md-3 profile-value">{{$profile->user_name}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Date of birth:</div>
                        <div class="col-md-3 profile-value">{{\App\Helpers\FormattedDate::format($profile->dob)}}</div>
                        <div class="col-md-3 profile-label">Gender:</div>
                        <div class="col-md-3 profile-value">{{$profile->gender}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Nationality:</div>
                        <div class="col-md-3 profile-value">{{$profile->nationality}}</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                    </div>
            </div>
            <hr>

            <div class="profile__content">
                <h5 class="profile__content__heading">Address Details</h5>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Country Of Residence:</div>
                        <div class="col-md-3 profile-value">{{$profile->country_of_residence}}</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">House number / name:</div>
                        <div class="col-md-3 profile-value">244</div>
                        <div class="col-md-3 profile-label"></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Address line 1:</div>
                        <div class="col-md-3 profile-value">{{$profile->address_1}}</div>
                        <div class="col-md-3 profile-label">Address line 2:</div>
                        <div class="col-md-3 profile-value">{{$profile->address_2}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Address line 3:</div>
                        <div class="col-md-3 profile-value">{{$profile->address_3}}</div>
                        <div class="col-md-3 profile-label"></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Town / City:</div>
                        <div class="col-md-3 profile-value">{{$profile->town}}</div>
                        <div class="col-md-3 profile-label">County / Region:</div>
                        <div class="col-md-3 profile-value">{{$profile->county}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Postcode:</div>
                        <div class="col-md-3 profile-value">{{$profile->post_code}}</div>
                        <div class="col-md-3 profile-label">Country:</div>
                        <div class="col-md-3 profile-value">{{$profile->country}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Code:</div>
                        <div class="col-md-3 profile-value">{{$profile->phone_code}}</div>
                        <div class="col-md-3 profile-label">Telephone:</div>
                        <div class="col-md-3 profile-value">{{$profile->phone}}</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                    </div>
            </div>
            <hr>

            <div class="profile__content">
                <h5 class="profile__content__heading">Further Details</h5>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Source of Funds:</div>
                        <div class="col-md-3 profile-value">{{$profile->source_of_funds}}</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Job Title:</div>
                        <div class="col-md-3 profile-value">{{$profile->job_title}}</div>
                        <div class="col-md-3 profile-label">Employers Name:</div>
                        <div class="col-md-3 profile-value">{{$profile->employer_name}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Nature Employer Business:</div>
                        <div class="col-md-3 profile-value">{{$profile->nature_employers_business}}</div>
                        <div class="col-md-3 profile-label">Location of business:</div>
                        <div class="col-md-3 profile-value">{{$profile->location_of_business}}</div>
                    </div>

            </div>
            <hr>

            <div class="profile__content bank-details">
                <h5 class="profile__content__heading">Bank Details</h5>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Bank Name:</div>
                        <div class="col-md-3 profile-value">{{$profile->user->bankDetails->bank_name or ''}}</div>
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
                        <div class="col-md-3 profile-label">SWIFT:</div>
                        <div class="col-md-3 profile-value">{{$profile->user->bankDetails->swift}}</div>
                        <div class="col-md-3 profile-label">BIC:</div>
                        <div class="col-md-3 profile-value">{{$profile->user->bankDetails->bic}}</div>
                    </div>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">IBAN:</div>
                        <div class="col-md-3 profile-value">{{$profile->user->bankDetails->iban}}</div>
                        <div class="col-md-3 profile-label"></div>
                        <div class="col-md-3"></div>
                    </div>

            </div>
            @role('admin')
        <div class="profile__admin__actions bg-dark">
            {!! Form::model($profile, ['action' => 'Seller\SellerController@adminUpdate'])!!}
            <a class="btn btn-outline-primary"><i class="fa fa-download"></i> Export</a>
            <a type="submit" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</a>

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
