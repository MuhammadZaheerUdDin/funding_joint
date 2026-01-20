<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/6/2018
 * Time: 11:19 AM
 */
?>

@extends('layouts.admin.page')
@section('content')
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">
                Faq Editor
            </a>
        </li>


        <li class="nav-item">
            <a class="nav-link " id="home-tab"   href="{{route('auth.edit')}}" role="tab" aria-controls="home" aria-selected="true">
                Login/Register
            </a>
        </li>

    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="mt-5">
                {!! $faqs !!}
            </div>
            <div class="mt-5">
                {!! $pages !!}
            </div>
        </div>
    </div>

@endsection
