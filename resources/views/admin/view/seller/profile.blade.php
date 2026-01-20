<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 29/10/2018
 * Time: 17:14
 */
?>

@extends('admin.view.seller_index')
@section('seller_profile_content')
    <!-- <div class="profile__content">
        <h5 class="profile__content__heading">My Profile</h5>
    </div>
    <hr> -->
    <div class="profile__content">
        <div class="row">
            <div class="col-12 col-md-8">
                  <div class="text-right" style="float: right;width: 50px;">
            <select class="custom-select" name="SortBy"style="background-image:url(http://3.10.169.59/funding_joint/public/assets/img/icon/menu-alt.png); width:16%; background-size: 50%; margin-left: 337px;">
            <option> Approve</option><!-- 
            <option> Invoice</option>
            <option> Release</option> -->
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
              
            <div class="col-12 col-md-3 edit-button">
                @role('admin')
                <a href="{{route('admin.editUser',['UserType'=>'seller','id'=>$profile->id])}}"
                   class="btn btn-dark btn-sm float-md-right">EDIT</a>
                @else
                    <!-- <a href="/profile/edit" class="btn btn-dark btn-sm float-right">EDIT</a> -->
                    @endrole
            </div>
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
        <h5 class="profile__content__heading">Company Details</h5>
        <div class="row row-spacer">
            <div class="col-md-3 profile-label">Name:</div>
            <div class="col-md-3 profile-value">{{$profile->company_name}}</div>
            <div class="col-md-3 profile-label">Website:</div>
            <div class="col-md-3 profile-value"><a href="{{$profile->your_company_website}}"
                                                   target="_blank">{{$profile->your_company_website}}</a></div>
            <div class="col-md-3 profile-label">Date of incorporation:</div>
            <div class="col-md-3 profile-value">{{\App\Helpers\FormattedDate::format($profile->dob_incorporation)}}</div>
            <div class="col-md-3 profile-label">Registration Number:</div>
            <div class="col-md-3 profile-value">{{$profile->company_reg_no}}</div>
            <div class="col-md-3 profile-label">Business details:</div>
            <div class="col-md-3 profile-value">{{$profile->about_your_business}}</div>
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
           <!--  <div class="col-md-3 profile-label">Upload Bank Statement</div>
            <div class="col-md-3"> -->
                <!-- set/get the document !-->
              <!--  @foreach($profile->user->bankStatement as $statement)
                    <a href="http://15.206.38.116/funding_joint/public/bankstatement/download/{{ ($statement->id)}}">
                                    {{$statement->statement_name}}
                                </a>
                @endforeach -->
              <!--   @foreach($profile->user->bankStatement as $statement)
                            <div class="col-md-6 profile-label">{{$statement->statement_name}}:
                                <a href="http://3.20.72.9/funding_joint/public/bankstatement/download/{{ ($statement->id)}}">
                                    <span class="badge badge-primary"><i class="fa fa-link"></i></span>
                                </a>
                            </div>
                        @endforeach -->
            <!-- </div> -->
        </div>

    </div>

    <hr>

@endsection
