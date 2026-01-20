@extends('layouts.admin.page')
@section('content')
    <div class="container">
        <div class="profile">

            <div class="profile__content">
                @role('admin')
                <div class="row row-spacer top-profile-bar">
                    <div class="col-md-5">
                        <h4>Admin Funding Joint</h4>
                        My Profile
                    </div>
                    <!--
                    <div class="col-md-6">
                        <div class="btn-group profile-buttons" role="group" aria-label="Basic example">
                            <div class="btn btn-dark btn-md">Profile</div>
                            <div class="btn btn-dark btn-md">Account</div>
                            <div class="btn btn-dark btn-md">Auctions</div>
                            <div class="btn btn-dark btn-md">Buyer</div>
                            <div class="btn btn-dark btn-md">Activity</div>
                        </div>
                    </div>
                    !-->
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
                          <img src="https://ui-avatars.com/api/?size=100&name=A+F&background=212121&color=fff"
                          class="rounded-circle float-left" style="width:100px">
                        </div>
                        <div class="icon-text">
                          <!-- <img src="http://placehold.it/100" alt="" class="rounded-circle float-left mr-3"> -->
                          <h4 class="font-weight-bold">
                              Admin Funding Joint
                          </h4>
                          <p class="profile-label">Member Since : {{\App\Helpers\FormattedDate::format($profile->created_at)}}</p>
                        </div>
                      </div>
                        <div class="col-12  col-md-4 edit-button">
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
                        <div class="col-md-3 profile-value">{{$profile->email}}</div>
                        <div class="col-md-3 profile-label">Password:</div>
                        <div class="col-md-3 profile-value"> ***********</div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            If you wish to change your login details please click <a href="/profile/changepassword"> here</a>.
                        </div>
                    </div>

                </div>
                <hr>

                <div class="profile__content">
                    <h5 class="profile__content__heading">Company Details</h5>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Company:</div>
                        <div class="col-md-3 profile-value">Funding Joint</div>
                        <div class="col-md-3"></div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
                <hr>
                <!--
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
                        <div class="col-md-3 profile-label">County:</div>
                        <div class="col-md-3 profile-value">{{$profile->county}}</div>
                        <div class="col-md-3 profile-label">Country:</div>
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
                        <div class="col-md-6 profile-value">£{{$profile->turnover}}</div>
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
                !-->
            </div>


        </div>
    </div>
@endsection
