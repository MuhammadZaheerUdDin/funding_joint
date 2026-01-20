<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 30/10/2018
 * Time: 09:52
 */
?>

@extends('layouts.admin.page')

@section('content')

    <h4 class="text-uppercase">Admin Dashboard</h4>
    <hr>

    <div class="dashboard">
        <div class="row row-eq-height">
          <div class="col-9">
              <h5>
                  Auctions
              </h5>
          </div>
          <div class="col-3 text-right">
              <p>
                  <a class="text-dark text-uppercase" href="{!! url('actions') !!}">
                      See all Auctions
                  </a>
              </p>
          </div>
          <hr>
            @foreach($cards as $card)
                <div class="col-md-{!! $card->width !!} col-sm-4  mb-3 col-12">
                    @component('components.dashboardCard')
                        @slot('link')
                            {!! $card->link !!}
                        @endslot
                        @slot('title')
                            {!! $card->title !!}
                        @endslot
                        @slot('content')
                            {!! $card->value !!}
                        @endslot
                    @endcomponent
                </div>
            @endforeach
        </div>

        <!-- start the users !-->
        <div class="row mt-2">
            <div class="col-8 ">
                <h5>
                    Users
                </h5>
            </div>
            <div class="col-4 text-right">
                <p>
                    <a class="text-dark text-uppercase" href="{!! url('users') !!}">
                        See all users
                    </a>
                </p>
            </div>

            <hr>
            @foreach($usersCards as $card)
                <div class="col-lg-{!! $card->width !!} float-left mb-2 col-6">
                    @component('components.dashboardCard')
                        @slot('link')
                            {!! $card->link !!}
                        @endslot
                            @slot('title')
                                {!! $card->title !!}
                            @endslot
                        @slot('content')
                            {!! $card->value !!}
                        @endslot
                    @endcomponent
                </div>
            @endforeach
        </div>



        <!-- start the transactions !-->
        <div class="row mt-2">
            <div class="col-6">
                <h5>
                    Transactions
                </h5>
            </div>
            <div class="col-6 text-right">
                <p>
                    <a class="text-dark text-uppercase" href="{!! url('transactions') !!}">
                        See all Transactions
                    </a>
                </p>
            </div>
            <hr>
            @foreach($transactionCards as $card)
                <div class="col-{!! $card->width !!} float-left mb-2">
                    @component('components.dashboardCard')
                        @slot('link')
                            {!! $card->link !!}
                        @endslot
                            @slot('title')
                                {!! $card->title !!}
                            @endslot
                        @slot('content')
                            {!! $card->value !!}
                        @endslot

                    @endcomponent
                </div>
            @endforeach
        </div>


        <div class="row mt-2 notifications">


            <div class="col-6">
                <h5>
                    Notifications
                </h5>
            </div>
            <div class="col-6 text-right">
                <p>
                    <a class="text-dark text-uppercase" href="{!! url('notifications') !!}">
                        See all Notifications
                    </a>
                </p>
            </div>
            <hr>

            <div class="col-12">
                @if($notifications->count() >0 )
                    @foreach($notifications as  $notification)
                        @component('components.notification',['notification' =>$notification,'user_id'=>Auth::user()->id]) @endcomponent
                    @endforeach
                @else
                    <div class="alert alert-primary" role="alert">
                        No Notifications found
                    </div>
                @endif
            </div>
            <hr>

        </div>




    </div>

@endsection
