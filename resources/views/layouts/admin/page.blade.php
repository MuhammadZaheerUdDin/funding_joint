@extends('layouts.admin.master')
{{-- Add global notification on each page if the user hasnot been approved by the admin--}}
@if( auth()->user()->is_completed  != 1 )
    @if(Request::is(['full-registration-seller','enter-bank-details','upload-bank-statement','seller-confirm','seller-confirmation']))
        @push('alerts')
            <div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                {{--You have not been approved by the admin! You will receive a notification as soon as you have been approved!--}}
                Complete your profile and you will receive a Notification when you have been approved. Please allow up to one business day.
            </div>
        @endpush
    @endif
    @if(Request::is(['full-registration-investor','enter-bank-details-investor','upload-bank-statement']))
        @push('alerts')
            <div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                {{--You have not been approved by the admin! You will receive a notification as soon as you have been approved!--}}
                Complete your profile. You can browse the Marketplace, but will need to complete your profile and be approved before being able to make an Investment.
            </div>
        @endpush
     @endif
@endif

@if( Session::has('message') )
    @push('alerts')
    <div class="alert alert-info">
        <a class="close" data-dismiss="alert">×</a>
        {{ Session::get('message') }}
    </div>
    @endpush
@endif
