<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 19/11/2018
 * Time: 09:48
 */
?>

@extends('layouts.admin.page')

@section('content')
    <div class="profile">
        <div class="profile__content">
            <a href="{{ URL::previous() }}" class="float-right"> < Back to Auction Details</a>
            <h2 class="profile__content__heading">Trading History</h2>

            <hr>
            <h4>{{$seller->company_name}}</h4>
        </div>
    </div>
    @forelse($auctions as $auction)
        @component('components.seller.history_auction',['auction'=>$auction]) @endcomponent
    @empty
        <div class="alert alert-info" role="alert">
            <strong>No auctions found</strong><br>
            This seller does not have any history with Funding Joint.
        </div>
    @endforelse

    {{$auctions->links()}}
@endsection
