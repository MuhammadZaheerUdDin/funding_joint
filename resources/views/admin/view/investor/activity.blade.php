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
    <div class="activity">
        <div class="profile__content">
            <h5 class="profile__content__heading">Activity</h5>
        </div>
        <hr>
        <div class="profile__content">
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
        </div>
    </div>
@endsection

