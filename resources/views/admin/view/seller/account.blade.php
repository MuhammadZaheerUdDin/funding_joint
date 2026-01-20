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
    <div class="profile__content">
        <h5 class="profile__content__heading">My Account</h5>
    </div>
    @include('components.users.transactions')
    <hr>
@endsection
