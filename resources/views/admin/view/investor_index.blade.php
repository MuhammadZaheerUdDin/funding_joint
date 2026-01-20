@extends('layouts.admin.page')
@section('content')
    <div class="container">
        <div class="profile">
            @include('admin.view.investor.top-profile-bar')
            @yield('investor_profile_content')
            @include(('admin.view.investor.bottom-bar'))
        </div>
    </div>
@endsection