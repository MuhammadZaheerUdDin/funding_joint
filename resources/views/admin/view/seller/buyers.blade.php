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
<div class="buyers">
    <div class="profile__content">
        <h5 class="profile__content__heading">My Buyers</h5>
    </div>
    <hr>
</div>


@if(count($buyers) > 0)

@foreach($buyers as $buyer)
    @include('components.buyers.buyer')
    <br>
@endforeach


    @else

    <div class="alert alert-info" role="alert">
        <strong>No Buyers found!</strong><br>
    </div>
    <hr>
    @endif

@endsection