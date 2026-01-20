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
    <div class="account">
        <div class="profile__content">
            <h5 class="profile__content__heading">My Profile</h5>
        </div>
        <hr>
        <div class="profile__content">
            <img src="{{ asset('/assets/img/wallet-icon.png') }}" alt="">
            Balance of Account
            <h3 class="float-right">£ @money($profile->user->balance_amount)</h3>
            <div class="profile__content__date">
                {{ \App\Helpers\FormattedDate::format($profile->user->balance->created_at) }}
            </div>
        </div>


       @include('components.users.transactions')


    </div>
@endsection