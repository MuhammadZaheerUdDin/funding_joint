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
    <div class="auctions">
        <div class="profile__content">
            <h5 class="profile__content__heading">My Auctions</h5>
        </div>
        <hr>
    </div>

    @forelse($auctions as $auction)
        @component('components.seller.seller_auction',['auction'=>$auction]) @endcomponent
    @empty
        <div class="alert alert-info" role="alert">
            <strong>No auctions found</strong><br>
            You have not created any auctions. <a href="/marketplace">Create</a> and get some funds!
        </div>
    @endforelse
@endsection
