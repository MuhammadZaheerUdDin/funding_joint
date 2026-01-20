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
    <div class="activity">
        <div class="profile__content">
            <h5 class="profile__content__heading">My Activity</h5>
        </div>
        <hr>
    </div>

    <ul class="list-group w-100">

        @if(count($activity) > 0)
            @foreach($activity as $a)
                <li class="list-group-item">
                  {!! $a->created_at->format('d/m/Y H:i:s') !!}  - {!! ($a->data['title']) !!}
                </li>
            @endforeach
        @else
            <li class="list-group-item">
                No activity found
            </li>
        @endif

    </ul>
@endsection
