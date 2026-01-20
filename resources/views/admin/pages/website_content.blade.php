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
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="mt-5">
                {!! $pages !!}
            </div>
        </div>
    </div>

@endsection
