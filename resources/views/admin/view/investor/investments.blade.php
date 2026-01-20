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
    <div class="investments">
        <div class="profile__content">
            <h5 class="profile__content__heading">{{$profile->full_name}} Investments</h5>
        </div>
        <hr>
        <div class="profile__content">

            <div class="auctions">
                @forelse($auctions as $auction)
                    @component('components.admin.auction',['auction'=>$auction]) @endcomponent
                @empty
                    <div class="alert alert-warning" role="alert">
                        <strong>No Investments found!</strong><br>
                        Investor has not placed any bids.
                    </div>
                @endforelse
            </div>

        </div>
        <hr>
    </div>
@endsection
