<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 29/10/2018
 * Time: 17:14
 */
?>

@extends('admin.view.investor_index')
@section('investor_profile_content')
    <!-- <div class="profile__content">
        <h5 class="profile__content__heading">My Profile</h5>
    </div>
    <hr> -->
     <div class="profile__content">
        <div class="row">
            <div class="col-12 col-md-8">
                  <div class="text-right" style="float: right;width: 50px;">
            <select class="custom-select" name="SortBy" style="background-image:url(http://3.10.169.59/funding_joint/public/assets/img/icon/menu-alt.png); width:16%; background-size: 50%; margin-left: 337px;" onchange="location = this.value;">
             @role('admin')
            <option href="{{route('admin.editUser',['UserType'=>'investor','id'=>$profile->id])}}">EDIT AS ADMIN</option>
                @else
            <option href="/profile/edit" class="btn btn-dark btn-sm float-right">EDIT</option>
                    @endrole 
            <option> Invoice</option>
            <option> Release</option>
        </select>
          </div>
                <strong style="font-size: 25px;">{{$profile->first_name}}</strong>&nbsp;<strong style="font-size: 25px;">{{$profile->last_name}}</strong>
                <br>{{ucfirst($profile->user->getRole())}}
                <br>{{ $profile->user->approved ? '' : 'Profile is Pending Approval'}}
             <!--  <div class="icon">
                <img src="https://ui-avatars.com/api/?size=100&name=F+J&background=212121&color=fff"
                class="rounded-circle float-left" style="width:100px">{{ $profile->user->approved ? '' : 'Profile is Pending Approval'}}
              </div>
              <div class="icon-text">
              
                <h4 class="font-weight-bold">{{$profile->first_name}}</h4>
                <p class="profile-label">Member Since : {{ \App\Helpers\FormattedDate::format($profile->created_at)}}</p>
              </div> -->
            </div>
            <div class="col-12 col-md-3 edit-button">
             <!--    @role('admin')
                <a href="{{route('admin.editUser',['UserType'=>'seller','id'=>$profile->id])}}"
                   class="btn btn-dark btn-sm float-md-right">EDIT AS ADMIN</a>
                @else
                    <a href="/profile/edit" class="btn btn-dark btn-sm float-right">EDIT</a>
                    @endrole -->
            </div>
        </div>
    </div>
    <hr>
    <div class="profile__content">
        <h5 class="profile__content__heading">
           Personal Details:
        </h5>
        <div class="row row-spacer">
           <!--  <div class="col-md-3 profile-label">Email address:</div>
            <div class="col-md-3 profile-value">{{$profile->user->email}}</div>
            <div class="col-md-3 profile-label">Password:</div>
            <div class="col-md-3 profile-value"> ***********</div> -->
            <div class="col-md-3 profile-label">Name:</div>
            <div class="col-md-3 profile-value">{{$profile->first_name}}&nbsp;{{$profile->last_name}}</div>
            <div class="col-md-3 profile-label">Username:</div>
            <div class="col-md-3 profile-value">{{str_slug($profile->first_name)}}</div>
            <div class="col-md-3 profile-label">Date of Birth:</div>
            <div class="col-md-3 profile-value">{{\App\Helpers\FormattedDate::format($profile->dob)}}</div>
            <div class="col-md-3 profile-label">Job title:</div>
            <div class="col-md-3 profile-value">{{$profile->job_title}}</div>
        </div>

    </div>
    <hr>
   <!--  <div class="profile__content">
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
            <div class="col-md-3 profile-value">{{ \App\Helpers\FormattedDate::format($profile->dob)}}</div>
            <div class="col-md-3 profile-label">Gender:</div>
            <div class="col-md-3 profile-value">{{$profile->gender}}</div>
        </div>
        <div class="row row-spacer">
            <div class="col-md-3 profile-label">Nationality:</div>
            <div class="col-md-3 profile-value">{{$profile->nationality}}</div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
        </div>
    </div> -->
    <div class="profile__content">
        <h5 class="profile__content__heading">Contact Details</h5>
        <div class="row row-spacer">
            <div class="col-md-3 profile-label">Address:</div>
            <div class="col-md-3 profile-value">{{$profile->address_1}}</div>
            <div class="col-md-3 profile-label"></div>
            <div class="col-md-3 profile-value"></div>
            <div class="col-md-3 profile-label">Email:</div>
            <div class="col-md-3 profile-value">{{$profile->user->email}}</div>
            <div class="col-md-3 profile-label"></div>
            <div class="col-md-3 profile-value"></div>
            <div class="col-md-3 profile-label">Telephone:</div>
            <div class="col-md-3 profile-value">{{$profile->phone}}</div>
        </div>
    </div>
    <hr>

    <div class="profile__content">
        <h5 class="profile__content__heading">Rating</h5>       
        <div class="row row-spacer">
            <div class="col-md-3 profile-label">Experian rating:</div>
            <div class="col-md-3 profile-value">...</div>
            <div class="col-md-3 profile-label"></div>
            <div class="col-md-3 profile-value"></div>
            <div class="col-md-3 profile-label">Credit Limit:</div>
            <div class="col-md-3 profile-value">...</div>
            <div class="col-md-3 profile-label"></div>
            <div class="col-md-3 profile-value"></div>
        </div>
    </div>

    <hr>

  <!--   <div class="profile__content">
        <h5 class="profile__content__heading">Address Details</h5>
        <div class="row row-spacer">
            <div class="col-md-3 profile-label">Country Of Residence:</div>
            <div class="col-md-3 profile-value">{{$profile->country}}</div>
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
            <div class="col-md-3 profile-label">Telephone:</div>
            <div class="col-md-3 profile-value">{{$profile->phone}}</div>
            <div class="col-md-3"></div>
            <div class="col-md-3"></div>
        </div>
    </div>
    <hr> -->

  <!--   <div class="profile__content">
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
 -->
   @if($profile->user->bankDetails()->exists())
       <div class="profile__content bank-details">
            <h5 class="profile__content__heading">Bank Details</h5>
        <div class="row row-spacer">
            <div class="col-md-3 profile-label">Bank Name:</div>
            <div class="col-md-3 profile-value">{{$profile->user->bankDetails->bank_name}}</div>
            <div class="col-md-3 profile-label">Account Name:</div>
            <div class="col-md-3 profile-value">{{$profile->user->bankDetails->account_name}}</div>
            <div class="col-md-3 profile-label">Account Number:</div>
            <div class="col-md-3 profile-value">{{$profile->user->bankDetails->account_number}}</div>
            <div class="col-md-3 profile-label">Sort Code:</div>
            <div class="col-md-3 profile-value">{{$profile->user->bankDetails->sort_code}}</div>

       </div>
   </div>
   @else
       <div class="profile__content bank-details">
           User has not added bank details
       </div>
   @endif

    <!-- <div class="row row-spacer">


        @if($profile->user->identities)
            <div class="col-md-6">
              
                <div class="profile-label">Identities</div>
                <ul class="list-group">
                    @foreach($profile->user->identities as $key=>$identity)
                        <a class="list-group-item" href="{{route('download',$identity->id)}}">{{ucfirst($identity->type_proof)}} - {{$key + 1}}</a>
                    @endforeach
                </ul>

            </div>
        @endif

        @if($profile->user->proof_of_address)
            <div class="col-md-6">
                
                <div class="profile-label">Proof of Address</div>
                <ul class="list-group">
                    @foreach($profile->user->proof_of_address as $key=>$proof)
                        <a class="list-group-item" href="{{route('download',$proof->id)}}">{{ucfirst($proof->type_proof)}} - {{$key + 1}}</a>
                    @endforeach
                </ul>

            </div>
        @endif
    </div> -->

@endsection
