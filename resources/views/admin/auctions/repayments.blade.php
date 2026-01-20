@extends('layouts.admin.page')

@section('content')


    @if(Session::has('msg'))
        @push('alerts')
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">×</a>
            {!!Session::get('msg')!!}
        </div>
        @endpush
    @endif

    <div class="container">


        <h1>
            Repayments for the investors in the auction. #{{ $auction->id }}

        </h1>


        <?php

        foreach ($users as $user): ?>

        <div class="comman-card admin my-3">

            <div class="card comman-card__content">
                <div class="col-12 card-body">
                    <div class="row full py-2 ">
                        <div class="col-12 col-md-4 title py-2 py-md-1">
                            <a href="#">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-1 w-100 pb-1 align-self-start">
                                            <i class="shield S"></i>
                                            <h4 class="d-inline-block mt-2"><strong>{!! $user->full_name !!}</strong></h4>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <p><strong>{!! $user->username !!}</strong></p>
                                        <p><strong>{!! $user->email !!}</strong></p>
                                        <p>Reference Number <span class="ref darker">{!! $user->id !!}</span></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12 col-md-4 py-2 py-md-1">
                            <a href="{{ UserHelper::getUserProfileLink($user) }}">
                                <div class="row">
                                    <div class="col-6">User Type:</div>
                                    <div class="col-6 darker">
                                        <strong>
                                            {!! UserHelper::getUserType($user) !!}
                                        </strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">Status:</div>
                                    <div class="col-6 darker"><strong>
                                            {!! UserHelper::getUserStatus($user) !!}</strong>
                                    </div>
                                </div>

                                @if (UserHelper::getUserExperianRating($user) != false)
                                    <div class="row">
                                        <div class="col-6">Experian Rating:</div>
                                        <div class="col-6 darker"><strong>
                                                {!! UserHelper::getUserExperianRating($user) !!}</strong>

                                        </div>
                                    </div>
                                @endif


                            </a>
                        </div>

                        <div class="col-12 col-md-4 py-2 py-md-1">
                            <div class="btn-group w-100" role="group">
                                <a @if($user->investor->auctionRepaid($auction->id) !==1) href="http://3.10.169.59/funding_joint/public/pay-investor/{{$user->id}}/{{ $auction->id }}" @endif class="btn {{ $user->approved !== 1 || $user->investor->auctionRepaid($auction->id) === 1 ? 'btn-primary disabled' :'btn-primary' }}  approve-button m-0 w-50">Pay</a>

                                <!--
                               <a href="/pay-investor/{{$user->id}}/{{ $auction->id }}" class="btn approve-button m-0 w-50">Pay Unaproved</a>
                                !-->

                            </div>
                            <div>{{$user->investor->auctionRepaid($auction->id) === 1 ? 'Investor already paid out' :''}} </div>
                       <div>{{$user->approved !==1 ? 'Investor has not been approved' :''}}</div>

                        </div>
                    </div>
                </div>
                <div class="card-footer border-top ">
                    <a href="{{ UserHelper::getUserProfileLink($user) }}">
                        @if($user->approved == 1)
                            <span class="approval-notice">{{\App\Helpers\FormattedDate::format($user->created_at)}} - Profile has been approved </span>
                        @elseif($user->approved == 0 )
                            <span class="approval-notice">{{\App\Helpers\FormattedDate::format($user->created_at)}} - Profile is pending approval </span>
                        @else
                            <span class="approval-notice">{{\App\Helpers\FormattedDate::format($user->created_at)}} - Profile has been declined </span>
                        @endif
                    </a>
                </div>
            </div>
        </div>

        <?php endforeach; ?>


    </div>

@endsection
