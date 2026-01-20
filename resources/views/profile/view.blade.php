@extends('layouts.app')

<div class="container">
    <div class="container">
        <div class="profile">
            @role('admin')
            <div class="profile__admin__tabs bg-primary">
                <div class="container-fluid">
                    <div class="col-md-3">
                        <img src="http://placehold.it/40" alt="" class="src">
                        <div class="profile__tabs__name">{{$profile->first_name}}</div>
                        <div class="profile__tabs__company">{{$profile->company_name}}</div>
                    </div>
                    <div class="col-md-9">
                        <button class="btn btn-default">Profile</button>
                        <button class="btn btn-default">Account</button>
                        <button class="btn btn-default">Auctions</button>
                        <button class="btn btn-default">Buyers</button>
                        <button class="btn btn-default">Activity</button>
                    </div>
                </div>
            </div>
            @endrole


            <div class="profile__content">
                <h5 class="profile__content__heading">Login Details</h5>

                <h3 class="float-right">{{$profile->user->approved ? 'Approved': 'NOT Approved'}}</h3>
                <h3>{{$profile->first_name}}</h3>
                <hr>

                <img src="http://placehold.it/100" alt="" class="rounded-circle">
                <h3>{{$profile->first_name}}</h3>
                Email : {{$profile->user->email}} Password : ***********
                <a href="?modify={{$profile->id}}" class="btn btn-dark btn-sm float-right">EDIT</a>
                <hr>
            </div>

            <div class="profile__content">
                <h5 class="profile__content__heading">Personal Details</h5>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                                Title: {{$profile->title}}
                            </div>
                            <div class="col-md-12">
                                First Name: {{$profile->first_name}}
                            </div>
                            <div class="col-md-12">
                                Middle Name: {{$profile->middle_name}}
                            </div>
                            <div class="col-md-12">
                                DOB: {{$profile->dob}}
                            </div>

                            <div class="col-md-12">
                                Nationality: {{$profile->nationality}}
                            </div>
                        </div>
                        <div class="col-md-6">

                            <div class="col-md-12">
                                Last Name: {{$profile->last_name}}
                            </div>
                            <div class="col-md-12">
                                Username: {{$profile->username}}
                            </div>
                            <div class="col-md-12">
                                Gender: {{$profile->gender}}
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <hr>

            <div class="profile__content">
                <h5 class="profile__content__heading">Address Details</h5>
                Country Of Residence : {{$profile->country_of_residence}} <br>
                Address 1 : {{$profile->address_1}} <br>
                Address 2: {{$profile->address_2}} <br>
                Address 3: {{$profile->address_3}} <br>
                Town : {{$profile->town}} <br>
                Post Code : {{$profile->post_code}} <br>
                Telephone : {{$profile->phone}} <br>
                County : {{$profile->county}} <br>
                Country : {{$profile->country}} <br>
            </div>
            <hr>

            <div class="profile__content">
                <h5 class="profile__content__heading">Further Details</h5>
                Source of FUnds : {{$profile->source_of_funds}} <br>
                Job Title : {{$profile->job_title}} <br>
                Nature Employer Business : {{$profile->nature_employers_business}} <br>
                Employers Name : {{$profile->employer_name}} <br>
                Location : {{$profile->location_of_business}} <br>
            </div>
            <hr>

            <div class="profile__content">
                <h5 class="profile__content__heading">Bank Details</h5>
                Bank Name : {{$profile->bank_name}}
                Sort Code : {{$profile->sort_code}}
                SWIFT : {{$profile->swift}}
                IBAN : {{$profile->iban}}
                Account Name : {{$profile->account_name}}
                Account Number : {{$profile->acount_number}}
                BIC : {{$profile->bic}}
            </div>
            <hr>



            @role('admin')
            <div class="profile__admin__actions bg-dark">
                <button class="btn btn-outline-primary"><i class="fa fa-download"></i> Export</button>
                <button class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</button>
                <div class="form--group w-25">
                    <select name="" id="" class="form-control">
                        <option value="">Experian Rating</option>
                        <option value="">Good</option>
                        <option value="">Bad</option>
                    </select>
                </div>

                <div class="form--group w-25">
                    <select name="" id="" class="form-control">
                        <option value="">Experian Rating</option>
                        <option value="">Good</option>
                        <option value="">Bad</option>
                    </select>
                </div>

                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-outline-danger">Decline</button>
                    <button type="button" class="btn btn-primary">Approve</button>
                </div>
            </div>
            @endrole
        </div>

        {{$profile}}
    </div>
</div>