@extends('layouts.admin.page')
@section('content')

    {{-- @include('admin.view.seller.top-profile-bar') --}}
    

    <div class="container-fluid">
        <div class="profile">

            <div class="profile__content row">
                <div class="col-md-8">

                    <h5 class="profile__content__heading">Buyers</h5>
                </div>

                <!-- <div class="col-md-4">
                    <a href="{{ url('buyers')  }}" class="btn btn-link float-right pull-right">
                        <i class="fa fa-arrow-left ml-1"></i>
                        Back to Buyers Page
                    </a>
                </div> -->

            </div>
            <hr>
            <div class="profile__content">
                <div class="row">
                    <div class="col-md-2">
                        <img src="https://ui-avatars.com/api/?size=100&name={{$profile->first_name}}+{{$profile->last_name}}&background=212121&color=fff"
                             class="rounded-circle float-left" style="width:100px">
                    </div>
                    <div class="col-md-6">
                        <h3 class="ml-0">{{$buyer->company_name}}</h3>
                        <p class="profile-label">Created On : {{$profile->created_at->format('d/m/Y')}}</p>
                    </div>
                    <div class="col-md-4 edit-button">
                        @role('admin')
                        <a href="{{route('buyers.edit',['id'=>$profile->id])}}"
                           class="btn btn-dark btn-sm float-md-right">EDIT AS ADMIN</a>
                        @else
                            <a href="{{route('buyers.edit',['id'=>$profile->id])}}" class="btn btn-dark btn-sm float-right">EDIT</a>
                        @endrole
                    </div>
                </div>
            </div>
            <hr>
            <div class="profile__content">
                <h5 class="profile__content__heading">
                    BUYER DETAILS
                </h5>
                <div class="row row-spacer">
                    <div class="col-md-3 profile-label">Company Name:</div>
                    <div class="col-md-3 profile-value">{{$buyer->company_name}}</div>
                    <div class="col-md-3 profile-label">UK company registration:</div>
                    <div class="col-md-3 profile-value"> {{$buyer->company_registration}}</div>
                    <div class="col-md-3 profile-label">Company Registration Date:</div>
                    <div class="col-md-3 profile-value"> {{$buyer->company_registration_date}}</div>
                </div>
            <hr>
            <div class="profile__content">
                <h5 class="profile__content__heading">BUYER ADDRESS DETAILS</h5>

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
                   <!--  <div class="col-md-3 profile-label">Country:</div>
                    <div class="col-md-3 profile-value">{{$profile->county}}</div> -->
                </div>
            </div>
            <hr>

            <!-- BUYER CONTACT DETAILS !~-->
            <div class="profile__content">
                <h5 class="profile__content__heading">BUYER CONTACT DETAILS</h5>

                <p style="margin-left:0px;">
                    We will need to verify your Buyer, so please provide the details of the person in that company that we can contact to do this. We will not contact your Buyer without your prior permission.
                </p>
                <div class="row row-spacer">
                    <div class="col-md-3 profile-label">Title:</div>
                    <div class="col-md-3 profile-value">{{$profile->the_title}}</div>
                    <div class="col-md-3 profile-label">Business Type:</div>
                    <div class="col-md-3 profile-value">{{$profile->business_type}}</div>
                </div>
                <div class="row row-spacer">
                    <div class="col-md-3 profile-label">First Name:</div>
                    <div class="col-md-3 profile-value">{{$profile->first_name}}</div>
                    <div class="col-md-3 profile-label">Last Name:</div>
                    <div class="col-md-3 profile-value">{{$profile->last_name}}</div>
                </div>
                <div class="row row-spacer">
                    <div class="col-md-3 profile-label">Job Title:</div>
                    <div class="col-md-3 profile-value">{{$profile->job_title}}</div>

                    <div class="col-md-3 profile-label">Telephone:</div>
                    <div class="col-md-3 profile-value">{{$profile->phone}}</div>
                </div>
            </div>

            @if(auth()->user()->user_type === 1)
                <hr>
                <div class="profile__content">
                    <h5 class="profile__content__heading">
                        Ranking
                    </h5>
                    <div class="row row-spacer">
                        <div class="col-md-3 profile-label">Buyer Ranking:</div>
                        <div class="col-md-3 profile-value">{{$buyer->experian_rating}}</div>
                    </div>

                </div>
            @endif  
        </div>
    </div>

    <!-- Approve Modal -->
    <div class="modal fade" id="approveBuyer-{!! $buyer->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel">Approve Buyer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <p class="text-center">
                        Are you sure you want to approve {{$buyer->company_name ?: ' this buyer '}}?
                    </p>

                </div>
                <div class="modal-footer">


                    <button type="button" class="btn btn-secondary btn-outline-black" data-dismiss="modal">
                        Cancel
                    </button>


                    <form action="{{ url("buyers/approve/{$buyer->id}") }}" method="POST">
                        @csrf

                        <input type="hidden" name="id" value="{!! $buyer->id !!}">

                        <button type="submit" class="btn btn-primary">
                            Approve Buyer
                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Decline Modal -->
    <div class="modal fade" id="declineBuyer-{!! $buyer->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reason for declining </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ url("buyers/decline/{$buyer->id}") }}" method="POST">
                    <div class="modal-body">


                        <textarea name="message" class="form-control"></textarea>

                        @csrf
                        <input type="hidden" name="id" value="{!! $buyer->id !!}">
                    </div>

                    <div class="modal-footer">

                        <button type="button" class="btn btn-outline-dark pull-left" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary ">Decline</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
