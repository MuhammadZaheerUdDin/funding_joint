@extends('layouts.admin.page')
@section('content')
    <div class="container">
        <div class="profile">
            @include('admin.view.seller.top-profile-bar')
            @yield('seller_profile_content')
            @include(('admin.view.seller.bottom-bar'))
        </div>
    </div>
@endsection