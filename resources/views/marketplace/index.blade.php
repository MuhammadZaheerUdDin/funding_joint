<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 30/10/2018
 * Time: 12:03
 */
?>

@extends('layouts.admin.page')
@section('title')
  Funding Joint Marketplace
@endsection



@section('content')
    <style type="text/css">
        .alert-area .alert a:hover{
            opacity: 1 !important;
        }
    </style>
    <div class="marketplace">
        @profileNotCompleted
            @push('alerts')
            <div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                @if(auth()->user()->getRole() == 'seller')
                
                <a href="{{ url('full-registration-seller')  }}">You can browse the Marketplace, but will need to complete your profile before being able to create an auction. Click here to complete your profile.</a>
                @else
                <a href="{{ url('full-registration-investor')  }}">You can browse the Marketplace, but will need to complete your profile before being able make an investment. Click here to complete your profile.</a>
                @endif
            </div>
            @endpush
        @endprofileNotCompleted

        <h4 class="text-uppercase">{{ auth()->user()->getRole() == 'seller' ? 'Auctions' : 'AUCTIONS' }}</h4>
        @if(auth()->user()->getRole() == 'investor')
        <h6 class="text">{{ auth()->user()->getRole() !== 'seller' ? 'Browse the Auctions below to invest in a suitable opportunity' : 'Browse the Auctions below to invest in a suitable opportunity' }}</h6>
        @endif
        <hr>
        <form method="get">
            <div class="row">
                <div class="col-12">
                    <ul class="nav filter left float-left">
                        <li><a href="{{ route('marketplace') }}" class = "{{ ($auction_status == 'All' || $auction_status == '')?'selected':'' }}">All</a></li>
                        <li><a href="{{ route('marketplace', ['AuctionStatus' => 'Live']) }}" class = "{{ ($auction_status == 'Live')?'selected':'' }}">Live</a></li>
                        <li><a href="{{ route('marketplace', ['AuctionStatus' => 'Complete']) }}" class = "{{ ($auction_status == 'Ended')?'selected':'' }}">Completed</a></li>
                    </ul>
                    @if(auth()->user()->getRole() !=='seller')
                        <div class="form-group float-right ">
                            <div class="row">
                                <!-- <div class="col">
                                    <a data-toggle="collapse" href="#multiCollapseExample1" role="button"
                                       aria-expanded="false"
                                       aria-controls="multiCollapseExample1"
                                       class="btn m-0 py-2 btn-outline-secondary">
                                        Filter <i class="zmdi zmdi-tune"></i>
                                    </a>
                                </div> -->
                                <div class="col">
                                    <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="SortBy">
                                        <option @if( app('request')->input('SortBy')==="recent") selected
                                                @endif value="recent">Most Recent
                                        </option>
                                        <option @if( app('request')->input('SortBy')==="oldest") selected
                                                @endif value="oldest">Oldest First
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- <div class="col-12">
                    <div class="row">

                        <div class="col-12 collapse multi-collapse {{ isset( request()->SortBy ) ? 'show' : '' }} " id="multiCollapseExample1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="example-date-input" class="col-3">Amount</label>
                                        <div class="col-9">
                                            <select name="AuctionAmount" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                                <option value="">Choose...</option>
                                                <option @if( app('request')->input('AuctionAmount')==="1000") selected
                                                        @endif value="1000">&pound;0 - 1000
                                                </option>
                                                <option @if( app('request')->input('AuctionAmount')==="10000") selected
                                                        @endif value="10000">&pound;1000 - 10,000
                                                </option>
                                                <option @if( app('request')->input('AuctionAmount')==="50000") selected
                                                        @endif value="50000">&pound;10,000 - 50,000
                                                </option>
                                                <option @if( app('request')->input('AuctionAmount')==="60000") selected
                                                        @endif value="60000">&pound;50,000+
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="example-date-input" class="col-3">Auction Period</label>
                                        <div class="col-9">

                                            <select name="AuctionPeriod" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                                <option @if( app('request')->input('AuctionPeriod')==="all") selected
                                                        @endif value="all">All
                                                </option>
                                                <option @if( app('request')->input('AuctionPeriod')==="30") selected
                                                        @endif  value="30">30days
                                                </option>
                                                <option @if( app('request')->input('AuctionPeriod')==="60") selected
                                                        @endif  value="60">60days
                                                </option>
                                                <option @if( app('request')->input('AuctionPeriod')==="90") selected
                                                        @endif  value="90">90days
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="example-date-input" class="col-3">Experian Rating</label>
                                        <div class="col-9">
                                            <select name="Experian" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                                <option @if( app('request')->input('Experian')==="all") selected
                                                        @endif value="all">All
                                                </option>
                                                <option @if( app('request')->input('Experian')==="Excellent") selected
                                                        @endif value="Excellent">Excellent
                                                </option>
                                                <option @if( app('request')->input('Experian')==="Good") selected
                                                        @endif value="Good">Good
                                                </option>
                                                <option @if( app('request')->input('Experian')==="Fair") selected
                                                        @endif value="Fair">Fair
                                                </option>
                                                <option @if( app('request')->input('Experian')==="Poor") selected
                                                        @endif value="Poor">Poor
                                                </option>
                                                <option @if( app('request')->input('Experian')==="Very Poor") selected
                                                        @endif value="Very Poor">Very
                                                    Poor
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="example-date-input" class="col-3">Investment Period</label>
                                        <div class="col-9">
                                            <select name="AuctionInvestmentPeriod"
                                                    class="custom-select mb-2 mr-sm-2 mb-sm-0">
                                                <option @if( app('request')->input('AuctionInvestmentPeriod')==="all") selected
                                                        @endif value="all">All
                                                </option>
                                                <option @if( app('request')->input('AuctionInvestmentPeriod')==="30") selected
                                                        @endif  value="30">30days
                                                </option>
                                                <option @if( app('request')->input('AuctionInvestmentPeriod')==="60") selected
                                                        @endif  value="60">60days
                                                </option>
                                                <option @if( app('request')->input('AuctionInvestmentPeriod')==="90") selected
                                                        @endif  value="90">90days
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                            </div>

                                <div class="row pb-3">
                                    @if(auth()->user()->getRole() !=="seller" )
                                    <div class="col-6 col-md-6 form-inline pb-0 pb-md-3">
                                        <div class="input-group mb-3">
                                            <label for="">ROI</label>
                                            <input type="text" class="form-control" name="AuctionROI_Amount"
                                                   placeholder="&pound;"
                                                   value="{{app('request')->input('AuctionROI_Amount')}}">
                                            <div class="input-group-append">
                                            <span class="input-group-text" name="AuctionROI_Percent"
                                                  placeholder="&percnt;"><i class="zmdi zmdi-swap"></i></span>
                                            </div>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-3 col-md-2 text-right align-self-end align-self-md-start">
                                        <button class="btn btn-secondary my-0 py-2 " type="submit">Refresh</button>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div> -->
            </div>
            {{-- <input id="firstLoad" name="firstLoad" type="hidden" value="firstLoad"> --}}
        </form>

        <div class="row autions-items">
                    @forelse($auctions  as $auction)
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                            @component('components.marketplace.auction',['auction'=>$auction]) @endcomponent
                        </div>
                    @empty
                        <div class="alert alert-warning" role="alert">
                            <strong>No auctions found</strong>
                        </div>
                    @endforelse
                </div>
                <?php //exit;?>
            </div>
        </div>
    </div>

   {{--  <script>
        (function()
        {
          if( window.localStorage )
          {
            if( !localStorage.getItem('firstLoad') )
            {
              localStorage['firstLoad'] = true;
              window.location.reload();
            }  
            else
              localStorage.removeItem('firstLoad'); 
          }
        })();
    </script> --}}
<style type="text/css">
    .selected{
        color: blue;
        font-weight: bold;
    }
</style>
@endsection