<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 31/10/2018
 * Time: 12:09
 */

//echo "<pre>";
    $total_funded_percentage = ($po/$auction->amount_funding_required) * 100;

    //echo $total_funded_percentage;die;

    if($total_funded_percentage < 100){
        if($total_funded_percentage == 0)
            $width = 5; 
        else
            $width = $total_funded_percentage; 
        $title = 'Amount Remaining';
        $progressbar_percentage = $total_funded_percentage;
        $slider_text = $total_funded_percentage;
        $css = 'custom';
    }elseif($total_funded_percentage == 100){
        $width = 95; 
        $title = 'Amount Remaining';
        $progressbar_percentage = $total_funded_percentage;
        $slider_text = $total_funded_percentage;
        $css = 'custom';
    }elseif($total_funded_percentage > 100){
        $width = 95; 
        $title = 'Over-Funded By';
        $progressbar_percentage = ($auction->amount_funding_required/$po) * 100;
        $slider_text = $total_funded_percentage;
        $margin_right = (100 -$progressbar_percentage)-8;
        $css = 'custom custom-overfunded';
    }else{
        $width = 0; 
        $title = 'Over-Funded By';
        $progressbar_percentage = $total_funded_percentage;
        $slider_text = $total_funded_percentage;
        $css = 'custom';
    }


    //echo $auction->bids[0]->roi_in_pound;die;
?>



@extends('layouts.admin.page')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">

   
   .progress-circle .progress-circle-container {
        width: 75% !important;
        margin-left: 25px !important;
        margin-top: -66px !important;
    }
    .order-2 {
        margin-bottom: 20px !important;
        margin-top: 20px !important;
    }
    .label1{
        margin-top: 35px;
        margin-left: 20px;
    }
    .label2{
        margin-top: 65px;
        margin-left: 20px;
    }
    @media only screen and (max-width: 600px) {
      .progress-circle .progress-circle-container {
       margin-top: 0px!important;
      }
    }

    /*.table.auction tbody tr td:first-child {
        background-color: #ed51da !important;
    }*/



   /* .experianrating__color {
        margin-right: 313px !important;
        margin-top: 2px !important;
    }
*/

    </style>
    <style type="text/css">
        
    </style>


    @if(Session::has('msg'))
        @push('alerts')
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">×</a>
            {!!Session::get('msg')!!}
        </div>
        @endpush
    @endif





    @role('admin')
    @if($auction->buyer->approved !== 1)
        @push('alerts')
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">×</a>
            Buyer for this auction is not approved! Click <a
                    href="{{route('buyers.show',['id'=>$auction->buyer->id])}}"> here </a> to visit buyer profile.
        </div>
        @endpush
    @endif
    @endrole





    @role('seller')
    @if($auction->approved == 2)
        @push('alerts')
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">×</a>
            Your auction has been declined please check the <a target="_blank" href="{{ url('notifications')  }}">notifications</a>
            for more information.
        </div>
        @endpush
    @endif
    @if($auction->approved == 0 && auth()->user()->approved  == 1)
        @push('alerts')
        <div class="alert alert-info">
            <a class="close" data-dismiss="alert">×</a>
            Your auction will be posted on the Marketplace once it has been approved
{{--            Your auction will start when approval is made by admin and will run for --}}
            {{--<span> within {{$settings->maximum_auction_length}}</span> day(s).--}}
        </div>
        @endpush
    @endif
    @endrole


    <div class="container-fluid">
        <div class="row investment-details">
            <div class="col-12 col-sm-8 col-md-9 col-lg-10 ">
                <h3>AUCTION DETAILS</h3>
                <h5>Auction Number: <span>{{$auction->id}}</span></h5>
            </div>
            @role('seller')
                @if($auction->approved == 0 || is_null($auction->approved) )
                <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                    <a href="{{url('/step-4/')  }}/{!! $auction->id !!}"
                       class="btn btn-block btn-black mt-3">Edit</a>
                </div>
            @endif
            @endrole
        </div>
        <hr>
        <div class="row">
        	<style type="text/css">
        		.col-12.col-md-6.seller-details {
				    float: left;
				}
				.col-12.col-md-6.seller-details p {
				    float: left;
				    width: 100%;
				}
        	</style>
            <div class="col-12 col-md-6 seller-details">
                <p class="seller-type" style="margin-top: -12px;">SELLER</p>
                <p class="seller-name">{{$auction->seller->company_name}}</p>
                <hr>
                <p><strong>Business type :</strong><span>{{$auction->seller->business_type}}</span></p>
              <!--   <p>Annual Turnover: <span>£ @money($auction->seller->turnover)</span></p> -->
                <p><strong>Company registration date : </strong>
                    <span>{{ \App\Helpers\FormattedDate::format($auction->seller->created_at)}}</span></p>
                <p><strong>Company registration number : </strong><span>{{$auction->seller->company_reg_no}}</span></p>
                <p><strong style="float: left;">Experian rating :</strong><span style="float: left; margin-left: 5px;">{{$auction->seller->experian_rating?:'Not Set'}}</span> <span style="float: left!important;margin-left: 5px;" class="experianrating__color {{strtolower($auction->seller->experian_rating)}}"></span></p>
                <p><strong>Website :</strong><span>{{$auction->seller->your_company_website}}</span></p>
                <strong>Purpose of funding</strong>:
                <p>{{$auction->why_require_funding}}</p>
            </div>

            <div class="col-12 col-md-6 seller-details">
                <p class="seller-type" style="margin-top: -12px;">BUYER</p>
                <p class="seller-name">{{$auction->buyer->company_name}}</p>
                <hr>
                <p><strong>Business type :</strong> <span>{{$auction->buyer->business_type}}</span></p>
                <p><strong>Company registration date : </strong><span>{{ \App\Helpers\FormattedDate::format($auction->buyer->company_registration_date)}}</span></p>
                <p><strong>Company registration number :</strong> <span>{{$auction->buyer->company_registration}}</span></p>
                <p><strong style="float: left;">Experian rating :</strong> <span style="float: left; margin-left: 5px;">{{$auction->buyer->experian_rating?:'Not Set'}}</span> <span style="float: left!important;margin-left: 5px;" class="experianrating__color {{strtolower($auction->buyer->experian_rating)}}"></span></p>
                <p><strong>Website :</strong><span>{{$auction->buyer->your_company_website}}</span></p>
            </div>
        </div>
        <hr>
        <div class="row">
           <!--  <div class="col-12">
                <p class="seller-name">{{$auction->seller->company_name}}</p>
               <!--  <p>{{$auction->seller->about_your_business}}</p> --> 
              <!--   <p>
                    <a href="{{$auction->seller->your_company_website}}">
                        {{$auction->seller->your_company_website}}
                    </a>
                </p>
            </div> -->
             <div class="col-12">
                <a href="{!! url('auctions') !!}/{!! $auction->id !!}">
                    <div class="card comman-card__content">
                        <div class="col-12 card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-3 col-xs-12 py-3">
                                          <p class="value">
                                            po value
                                            <span>
                                             £@money($po_value)
                                        </span>
                                        </p>
                                    </div>
                                    <div class="col-md-3 col-xs-12 py-3 border-left border-white">
                                        </p>
                                          <p class="value">
                                            funding target
                                            <span>
                                           £@money($auction->amount_funding_required)
                                        </span>
                                        </p>
                                    </div>
                                    <div class="col-md-3 col-xs-12 py-3 border-left border-white">
                                        <p class="text-uppercase value">
                                            Auction Time Left
                                        </p>
                                    </div>
                                    <div class="col-md-3 col-xs-12 py-3 border-left border-white">
                                         <p class="value">
                                            Investment Period (day/s)
                                            <span>
                                           {{$auction->investment_period}} {{ str_plural('', $auction->investment_period) }}
                                        </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row h-100 border-white">
                                    <div class="col-md-2 col-xs-12 py-3 border-top border-white">
                                      <!--   <p class="text-center text-uppercase value">
                                            MAX DISCOUNT LIMIT
                                            <span class="text-center">
                                            {{$auction->maximum_discount_limit}}%
                                         </span>
                                        </p> -->
                                          <p class="value">
                                           CURRENT DISCOUNT LIMIT
                                        @if($po == 0)
                                        <span>
                                           ---
                                        </span>
                                        @else
                                        <span>
                                           {{$maximum_discount}}%
                                        </span>
                                        @endif
                                        </p>
                                    </div>
                                    <div class="col-md-2 col-xs-12 py-3 border-left border-white border-top">
                                      <!--   <p class="text-center text-uppercase value">
                                            MAX DISCOUNT LIMIT
                                            <span class="text-center">
                                            {{$auction->maximum_discount_limit}}%
                                         </span>
                                        </p> -->
                                          <p class="value">
                                             Max ROI

                                            <span>
                                           {{$max_roi_f}}%
                                        </span>
                                        </p>
                                    </div>
                                    <div class="col-md-2 col-xs-12 py-3 border-left border-white border-top">
                                        <!-- <p class="text-center text-uppercase value">
                                            CURRENT DISCOUNT LIMIT
                                            <span>
                                           
                                        </span>
                                        </p> -->
                                         <p class="value">
                                            current roi
                                            @if($po == 0)
                                        <span>
                                           ---
                                        </span>
                                        @else
                                        <span>
                                           {{$roi}}%
                                        </span>
                                        @endif
                                        </p>
                                    </div>
                                    <div class= "col-md-3 col-xs-12 py-3 border-left border-white">
                                        <div class="progress-circle">
                                            <div class="progress-circle-container">
                                                <svg viewBox="0 0 36 36" class="circular-chart">
                                                    <path class="circle-bg"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"

                                                    />
                                                    <path class="circle-white"
                                                          stroke-dasharray="{{round($auction->time_left_percentage)}}, 100"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    />
                                                    <path class="circle"
                                                          stroke-dasharray="{{round($auction->time_left_percentage)}}, 100"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    />
                                                </svg>
                                                <div class="percentage">
                                                    @if( $auction->time_left_before_end  > 0 )
                                                        <span><strong>{{ $auction->time_left_before_end }}</strong>days</span>
                                                    @elseif( $auction->time_left_before_end == 0 )
                                                        <span><strong>Last<br>Day</strong></span>
                                                    @elseif( $auction->time_left_before_end == -2 )
                                                        <span><strong>Not<br>Started</strong></span>
                                                    @else
                                                        <span class="empty"><strong>Ended</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-xs-12 py-3 border-left border-white border-top">
                                         <p class="text-center text-uppercase value">
                                            Date repayment due
                                            <span class="text-center auction__details__repayment"> {{ \App\Helpers\FormattedDate::format($auction->date_repayment_due) }}</span>
                                        </p>
                                    </div>
                                </div>
                                <!-- div class="row  border-top border-white">
                                    <div class="col-md-12  bar-progress py-3">
                                        <p class="text-uppercase value">
                                            Auction Time Left
                                        </p>
                                        <div class="progress-circle">
                                            <div class="progress-circle-container">
                                                <svg viewBox="0 0 36 36" class="circular-chart">
                                                    <path class="circle-bg"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"

                                                    />
                                                    <path class="circle-white"
                                                          stroke-dasharray="{{round($auction->time_left_percentage)}}, 100"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    />
                                                    <path class="circle"
                                                          stroke-dasharray="{{round($auction->time_left_percentage)}}, 100"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    />
                                                </svg>
                                                <div class="percentage">
                                                    @if( $auction->time_left_before_end  > 0 )
                                                        <span><strong>{{ $auction->time_left_before_end }}</strong>days</span>
                                                    @elseif( $auction->time_left_before_end == 0 )
                                                        <span><strong>Last<br>Day</strong></span>
                                                    @elseif( $auction->time_left_before_end == -2 )
                                                        <span><strong>Not<br>Started</strong></span>
                                                    @else
                                                        <span class="empty"><strong>Ended</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                               <!--  <div class="row h-100 border-top border-white">
                                    <div class="col-6 py-3">
                                        <p class="text-center text-uppercase value">
                                            Investment Period (day)
                                            <span class="text-center">
                                        {{$auction->investment_period}} {{ str_plural('', $auction->investment_period) }}
                                        </span>
                                        </p>
                                    </div>
                                    <div class="col-6 border-left py-3 border-white">
                                        <p class="text-center text-uppercase value">
                                            Date repayment due
                                            <span class="text-center auction__details__repayment"> {{ \App\Helpers\FormattedDate::format($auction->date_repayment_due) }}</span>
                                        </p>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!--  <div class="col-12">
                <a href="{!! url('auctions') !!}/{!! $auction->id !!}">
                    <div class="card comman-card__content">
                        <div class="col-12 card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-sm-6 py-3">
                                        <p class="value">
                                            funding target
                                            <span>
                                         £ ($auction->amount_funding_required)
                                        </span>
                                        </p>
                                    </div>
                                    <div class="col-12 col-sm-6 py-3 border-left border-white">
                                        <p class="value">
                                            po value
                                            <span>
                                            £ ($auction->total_amount_of_po)
                                        </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row h-100  border-top border-white">
                                    <div class="col-6 py-3">
                                        <p class="text-center text-uppercase value">
                                            MAX DISCOUNT LIMIT
                                            <span class="text-center">
                                            {{$auction->maximum_discount_limit}}%
                                         </span>
                                        </p>
                                    </div>
                                    <div class="col-6 py-3 border-left border-white">
                                        <p class="text-center text-uppercase value">
                                            CURRENT DISCOUNT LIMIT
                                            <span>
                                           
                                        </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row  border-top border-white">
                                    <div class="col-md-12  bar-progress py-3">
                                        <p class="text-uppercase value">
                                            Auction Time Left
                                        </p>
                                        <div class="progress-circle">
                                            <div class="progress-circle-container">
                                                <svg viewBox="0 0 36 36" class="circular-chart">
                                                    <path class="circle-bg"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"

                                                    />
                                                    <path class="circle-white"
                                                          stroke-dasharray="{{round($auction->time_left_percentage)}}, 100"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    />
                                                    <path class="circle"
                                                          stroke-dasharray="{{round($auction->time_left_percentage)}}, 100"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    />
                                                </svg>
                                                <div class="percentage">
                                                    @if( $auction->time_left_before_end  > 0 )
                                                        <span><strong>{{ $auction->time_left_before_end }}</strong>days</span>
                                                    @elseif( $auction->time_left_before_end == 0 )
                                                        <span><strong>Last<br>Day</strong></span>
                                                    @elseif( $auction->time_left_before_end == -2 )
                                                        <span><strong>Not<br>Started</strong></span>
                                                    @else
                                                        <span class="empty"><strong>Ended</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row h-100 border-top border-white">
                                    <div class="col-6 py-3">
                                        <p class="text-center text-uppercase value">
                                            Investment Period (day)
                                            <span class="text-center">
                                        {{$auction->investment_period}} {{ str_plural('', $auction->investment_period) }}
                                        </span>
                                        </p>
                                    </div>
                                    <div class="col-6 border-left py-3 border-white">
                                        <p class="text-center text-uppercase value">
                                            Date repayment due
                                            <span class="text-center auction__details__repayment"> {{ \App\Helpers\FormattedDate::format($auction->date_repayment_due) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> -->
            <div class="col-12 order-2">


                @if($auction->ended)



                    @if(!$auction->invoice)
                        @auctionowner($auction->id)
                        <p>Upload Invoice</p>
                        {!! Form::model(array($invoice,'files' => true), ['action' => 'Auction\InvoiceController@store','files' => true]) !!}
                        @csrf
                        <span class="error_input">
                            <strong>{{ $errors->first('invoice_file') }}</strong>
                            </span>

                        <p>
                            <input type="file" id="invoice_file" name="invoice_file">
                            <input type="hidden" value="{{$auction->id}}" name="auction_id">
                        </p>

                        <p>
                            <button type="submit" class="btn btn-primary btn-danger">
                                {{ __('Upload File') }}
                            </button>
                        </p>
                        </form>

                        @endauctionowner
                    @else

                        @auctionowner($auction->id)
                        <p>Invoice Uploaded - <a href="{{route('invoice-link',['id' => $auction->invoice->id,'action'=>'view'])}}" target="_blank">View Invoice</a>
                                    - <a href="{{route('invoice-link',['id' => $auction->invoice->id])}}">Download Invoice</a>
                        @endauctionowner
                    @endif

                @endif

                @role('admin')
                <!-- <p>
                    <a href="{{route('po-link',['id' => $auction->id])}}">Download P.O Document</a>
                </p>
                @if($auction->invoice)
                    <p>
                         Invoice {{  $auction->invoice->approved  ? '( Approved )' : '' }}

                        - <a href="{{route('invoice-link',['id' => $auction->invoice->id,'action'=>'view'])}}" target="_blank">View</a>
                        - <a href="{{route('invoice-link',['id' => $auction->invoice->id])}}">Download</a>
                    </p>
                @endif -->
                @endrole

                @role('investor')
                @if($auction->ended)
                    @push('alerts')
                    <div class="alert alert-info">
                        <a class="close" data-dismiss="alert">×</a>
                        This Auction has come to an end. No more bids allowed!
                    </div>
                    @endpush
                @endif
                @if($auction->approved == 1 && auth()->user()->profileCompleted() && $auction->ended == false)
                    <button class="btn btn-lg btn-dark" data-toggle="collapse"
                            data-target="#bid_card">{{ $auction->investor_has_bid ? 'EDIT' : 'PLACE' }} BID
                    </button>
                    @if($auction->investor_has_bid )
                        {!!  Form::open(['url'=>route('investor.bid.edit',['id'=>$auction->id]),'class' => '','method' => 'put']) !!}
                    @else
                        {!!  Form::open(['url'=>route('investor.bid',['id'=>$auction->id]),'class' => '']) !!}
                    @endif
                    <div class="dashboard__card enter-bid collapse @if(($errors->has('amount') ) || ( $errors->has('bid_discount') ) )show @endif "
                         id="bid_card">
                        <div class="card pr-4 pl-4 pb-4">
                            <h4>{{ $auction->investor_has_bid ? 'EDIT' : 'ENTER' }} BID</h4>
                            <hr>
                            <div>
                                <p>
                                    You can bid to purchase a share of the PO at a discounted price. <a href="">Read more </a>
                                </p>
                                <div class="container-fluid">
                                   <div class="enter-bid-details">
                                        <div class="row row-spacer">
                                            <div class="col-12 col-lg-4">
                                                
                                                {!! Form::label('amount','Bid Amount ( £ )') !!}
                                               <!--  {!! Form::number('amount',$auction->investor_bid_amount,['class'=>'form-control']) !!} -->
                                                <!--  <input type="text" value="{{ $auction->investor_has_bid['amount']}}" class="form-control" id="amount" name="amount"> -->
                                                <input type="text" class="form-control" id="amount" name="amount" value="{{$auction->investor_has_bid['amount']}}">
                                                <span class="error_input">
                                               <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                                <span class="error_input" id="bid_amount_error">
                                                <font color="red">Your bid amount is above the set limit of &pound;{{$auction->amount_funding_required}}, please try again</font>
                                                </span>
                                                 <span class="error_input" id="min_bid_amount_error">
                                                <font color="red">Please enter value greater than &pound;{{$settings->minimum_bid_amount}}
                                                    , please try again</font>
                                                </span>
                                            <br>
                                            {!! Form::label('bid_discount','ROI in percentage ( % )') !!}
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="bid_discount" name="bid_discount" value="{{$auction->investor_has_bid['bid_discount']}}" >
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                                <span class="error_input">
                                               <strong>{{ $errors->first('bid_discount') }}</strong>
                                            </span>
                                           <!--  <span   class="error_input text-red" id="bid_discount_error">
                                            <font color="red">Your bid amount is above discount limit of {{$auction->maximum_discount_limit}}
                                                %, please try again</font>
                                            </span> -->
                                            <span   class="error_input text-red" id="bid_discount_error">
                                                <font color="red">ROI should be less than {{$settings->maximum_expected_roi}}
                                                    %, please try again</font>
                                            </span>
                                            <span   class="error_input text-red" id="max_roi_error">
                                                <font color="red">ROI should be less than Current ROI {{$max_roi_f}}
                                                    %, please try again</font>
                                            </span>
                                            <span   class="error_input text-red" id="current_roi_error">
                                                <font color="red">ROI should be less than Current ROI {{$roi}}
                                                    %, please try again</font>
                                            </span>
                                            <br>
                                             {!! Form::label('roi_in_pound','ROI in pound ( £ )') !!}
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="roi_in_pound"
                                                           name="roi_in_pound"
                                                           value="{{$auction->investor_has_bid['roi_in_pound']}}" placeholder="" onkeypress="return event.charCode >= 48" min="1">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                    class="fa fa-gbp"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <!--  {!! Form::label('amount','Enter the bid amount that you want to invest.',array('class' => 'label1')) !!}
                                                  {!! Form::label('amount','Enter a proposed ROI for your bid amount. At present maximum ROI achievable is',array('class' => 'label2')) !!}
                                                  @if(isset($roi))
                                                  {{$roi}}%.
                                                  @endif -->
                                                   <label for="amount" class="label1">Enter the bid amount that you want to invest.</label>
                                                  <!--  <label for="amount" class="label2" id="default_dynamic">The maximum ROI for this bid amount is {{$d_roi}}%&nbsp;<div class="proposed_roi_pound_d" style="display: inline-block;"></div></label> -->
                                                    <label for="amount" class="label2" id="dynamic">The maximum ROI for this bid amount is <div class="proposed_roi_data" style="display: inline-block;"></div>&nbsp;<div class="proposed_roi_pound" style="display: inline-block;"></div></label>
                                                  <!--  <label for="amount" class="label2">Enter a proposed ROI for your bid amount. At present maximum ROI achievable is {{$roi}} %.</label>  -->
                                            </div>

                                            <input type="hidden" id="total_amount_of_po"
                                                   value="{{$auction->total_amount_of_po}}">
                                            <input type="hidden" id="amount_funding_required_bids"
                                                   value="{{$auction->amount_funding_required}}">
                                            <input type="hidden" id="max_discount_limit_bids"
                                                   value="{{$auction->maximum_discount_limit}}">
                                            <input type="hidden" id="auction_id"
                                                   value="{{$auction->id}}">
                                            <input type="hidden" id="user_id"
                                                   value="{{auth()->user()->id}}">
                                            <input type="hidden" id="minimum_bid_amount"
                                                   value="{{$settings->minimum_bid_amount}}">
                                            <input type="hidden" id="maximum_expected_roi"
                                                   value="{{$settings->maximum_expected_roi}}">
                                            <input type="hidden" id="max_roi_f"
                                                   value="{{$max_roi_f}}">
                                            <input type="hidden" id="roi_h"
                                                   value="{{$roi}}">
                                            <input type="hidden" id="po_value"
                                                   value="{{$po}}">  
                                            <input type="hidden" id="total_bid_amount"
                                                   value="{{$total_bid_amount}}">
                                            <input type="hidden" id="current_bid_amount"
                                                   value="{{$current_bid_amounts}}">
                                            <input type="hidden" id="bid_last_amount"
                                                   value="{{$bid_last_amount}}">
                                            <input type="hidden" id="bid_last_roi"
                                                   value="{{$bid_last_roi}}">  
                                            <input type="hidden" id="bids"
                                                   value="{{json_encode($bid_data)}}">      
                                            <input type="hidden" name="roi" value="">

                                          <!--   <div class="col-12 col-lg-4">
                                                {!! Form::label('bid_discount','Bid Discount (%)') !!}
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="bid_discount"
                                                           name="bid_discount"
                                                           value="{{$auction->investor_bid_discount}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                                <span class="error_input">
                                               <strong>{{ $errors->first('bid_discount') }}</strong>
                                            </span>
                                                <span   class="error_input text-red" id="bid_discount_error">
                                                <font color="red">Your bid amount is above discount limit of {{$auction->maximum_discount_limit}}
                                                    %, please try again</font>
                                            </span>
                                            </div> -->
                                        </div>

                                        <div class="row c">
                                            <div class="results-title">BID SUMMARY AND ESTIMATED RETURN</div>
                                        </div>
                                        <table class="table d-none d-md-table" style="width: 75% !important">
                                            <thead class="row-headings">
                                            <th>Rank</th>
                                            <th>Bid Amount</th>
                                            <th>Value of PO</th>
                                            <th>Share of PO</th>
                                            <th>Profit</th>
                                            <th>ROI</th>
                                            </thead>
                                            <tbody class="text-center">
                                            <tr >
                                                <td id="showRank">
                                                   @if($auction->investor_has_bid )
                                                    <a href="javascript:void(0)" id="displayRank" name="displayRank" style="color:#007bff !important">Click here to get ranking details</a>
                                                   @endif
                                                </td>
                                                <td>
                                                    <span class="ranking"></span>
                                                </td>
                                                <td>
                                                    <span class="bid_amount"></span>
                                                </td>
                                                <td>
                                                    <span class="share_po_value"></span>
                                                </td>
                                                <td>
                                                    <span class="share_po_percent"></span>
                                                </td>
                                                <td>
                                                    <span class="total_return_profit"></span>
                                                </td>
                                                <td>
                                                    <span class="roi"></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                          
                                             
                                        </table>

                                        <!--desktop view-->
                                        <div class="d-none auction__calculations">
                                            <div class="row row-spacer row-headings">
                                                <div class="col">SHARE OF PO</div>
                                                <div class="col">PO SHARE VALUE</div>
                                                <div class="col">BID DISCOUNT</div>
                                                <div class="col">BID AMOUNT</div>
                                                <div class="col">PROFIT</div>
                                                <div class="col">ROI</div>
                                                <div class="col">TOTAL RETURN</div>
                                            </div>

                                            <div class="row row-spacer row-values">
                                                <div class="col share_po_percent"></div>
                                                <div class="col share_po_value"></div>
                                                <div class="col bid_discount"></div>
                                                <div class="col bid_amount"></div>
                                                <div class="col total_return_profit"></div>
                                                <div class="col roi"></div>
                                                <div class="col total_return"></div>
                                            </div>
                                        </div>
                                        <!--end desktop view-->

                                        <!--mobile view-->
                                        <div class="d-md-none auction__calculations">
                                            <div class="row">
                                                <div class="col">SHARE OF PO</div>
                                                <div class="col share_po_percent"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">PO SHARE VALUE</div>
                                                <div class="col share_po_value"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">BID DISCOUNT</div>
                                                <div class="col bid_discount"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">BID AMOUNT</div>
                                                <div class="col bid_amount"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">PROFIT</div>
                                                <div class="col total_return_profit"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">ROI</div>
                                                <div class="col roi"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">TOTAL RETURN</div>
                                                <div class="col total_return"></div>
                                            </div>
                                        </div>
                                        <!--end mobile view-->
                                        <div class="row float-md-right" style="margin-top: -100px;">
                                            <button class="btn btn-lg btn-dark" id="bid_submit">SUBMIT MY BID</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                @endif
                @endrole

            </div>
        </div>
        @role('admin')
       
        @if($auction->ended) 
         <hr>
        @if(auth()->user()->getRole() =="admin" || auth()->id() == $auction->user_id )
        <div class="row">
            <div class="col-12">
                <h3>Post Auction Summary</h3>
                 <hr>
            </div>
            <div class="col-12">
                    <p class="seller-name" style="font-size: 18px;margin-top: 0;margin-bottom: 0px;">Documents</p>
            </div>
            <div class="col-12">
                <table> 
                    <tr>
                        <th>PO Document</th>
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('po-link',['id' => $auction->id,'action'=>'view'])}}" target="_blank">View</a></td>
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('po-link',['id' => $auction->id])}}">Download</a></td>
                    </tr>
                    @role('admin')
                    <tr>
                        @if($auction->invoice) 
                       <th>Invoice</th>
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('invoice-link',['id' => $auction->invoice->id,'action'=>'view'])}}" target="_blank">View</a></td>
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('invoice-link',['id' => $auction->invoice->id])}}">Download</a></td>
                    @if($auction->invoice->approved)
                        <td td style="padding: 3px 5px;color:#007bff;"> {{  $auction->invoice->approved  ? 'Approved' : '' }} </td>
                    @else 
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('admin.auction.approve_invoice',['id' => $auction->id])}}">Approve</a></td>
                    </tr>
                    @endif
                    @endif
                @endrole
                </table>
            </div>
            <div class="col-12">
                <hr style="margin-top: 10px !important; margin-bottom: 5px !important;">
                <b style="font-size: 18px;">Seller Payouts</b>
                <a style="float: right;" href="">Export</a>
            </div>
            <div class="col-12">
                <table width=100%> 
                    <tr>
                        <th><b>Item</b></th>
                        <th style="padding: 3px 5px;"><b>Amount (£)</b></th>
                        <th style="padding: 3px 5px;"><b>Status</b></th>
                        <th style="padding: 3px 5px;"><b>Actions</b></th>
                        <th style="padding: 3px 5px;"><b>Date/Time</b></th>
                        <th style="padding: 3px 5px;"><b>Reference</b></th>
                    </tr>
                    <tr>
                        <td>Funding received</td>
                        <td style="padding: 3px 5px;">{{$po}}</td>
                        <td style="padding: 3px 5px;">Received</td>
                        <td style="padding: 3px 5px;"></td>
                        <td style="padding: 3px 5px;">{{ \App\Helpers\FormattedDateTime ::format($auction->created_at)}}</td>
                        <td style="padding: 3px 5px;">abcd-1234</td>
                    </tr>
                    <tr>
                        <td>Agency fees</td>
                        <?php 
                            $agency_fee = trim($auction->agency_fee,"£");
                        ?>
                        <td style="padding: 3px 5px;">{{$agency_fee}}</td>
                        <td style="padding: 3px 5px;">Retained</td>
                        @if($auction->invoice == null)
                            <td style="padding: 3px 5px;"><a style="text-decoration:underline; color:#007bff;" href="" data-toggle="modal" data-target="#creditModal" onclick="alert('Cannot release funds at the moment')">
                        Release</a></td>
                        @else
                            <td style="padding: 3px 5px;"><a style="text-decoration:underline; color:#007bff;"
                            @if($auction->funding_success == true && $auction->invoice->approved == 1) data-toggle="modal" data-target="#creditModal" @else onclick="alert('Cannot release funds at the moment')" @endif>
                        Release
                    </a></td>
                        @endif
                        <td style="padding: 3px 5px;">{{ \App\Helpers\FormattedDateTime ::format($auction->created_at)}}</td>
                        <td style="padding: 3px 5px;">abcd-1234</td>
                    </tr>
                    <tr>
                        <td>Funding Joint fees</td>
                        <?php 
                            $funding_joint_fee = trim($auction->funding_joint_fee,"£");
                        ?>
                        <td style="padding: 3px 5px;">{{$funding_joint_fee}}</td>
                        <td style="padding: 3px 5px;">Retained</td>
                        <td style="padding: 3px 5px;"></td>
                        <td style="padding: 3px 5px;">{{ \App\Helpers\FormattedDateTime ::format($auction->created_at)}}</td>
                        <td style="padding: 3px 5px;">abcd-1234</td>
                    </tr>
                    <tr>
                        <td>Funding available to seller</td>
                        <td style="padding: 3px 5px;">{{$auction->net_funding_available}}</td>
                        <td style="padding: 3px 5px;">Retained</td>
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="">Release</a></td>
                        <td style="padding: 3px 5px;">{{ \App\Helpers\FormattedDateTime ::format($auction->created_at)}}</td>
                        <td style="padding: 3px 5px;">abcd-1234</td>
                    </tr>
                </table>
            </div>
            <div class="col-12">
                <hr style="margin-top: 10px !important; margin-bottom: 5px !important;">
                <b style="font-size: 18px;">Investor Payouts</b>
                <a style="float: right;" href="">Export</a>
            </div>
            <div class="col-12">
                <table width="100%"> 
                    <tr>
                        <th><b>Investor</b></th>
                        <th style= "padding: 3px 13px;width: 221px !important;"><b>Amount (£)</b></th>
                        <th style="padding: 3px 5px;"><b>Status</b></th>
                        <th style="padding: 3px 5px; width: 133px !important;"><b>Actions</b></th>
                        <th style="padding: 3px 5px; width: 249px !important;"><b>Date/Time</b></th>
                        <th style="padding: 3px 5px; width: 142px !important;"><b>Reference</b></th>
                    </tr>
                     <tbody>
                @forelse($bids as $bid)
                    <tr>
                        <td>{{optional($bid->investor)->first_name}}&nbsp;{{optional($bid->investor)->last_name}}</td>
                        <td style="padding: 3px 13px;">£ @money($bid->value_of_po)</td>
                        <td style="padding: 3px 5px;">Yet to be released</td>
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="">Release</a></td>
                        <td style="padding: 3px 5px;">{{ \App\Helpers\FormattedDateTime ::format($bid->created_at)}}</td>
                        <td style="padding: 3px 5px;">abcd-1234</td>
                    </tr>
                @empty
                    No Bids
                @endforelse
                </tbody>
                   <!--  <tr>
                        <td>Bhavin Vora</td>
                        <td style="padding: 3px 13px;">1140</td>
                        <td style="padding: 3px 5px;">Yet to be released</td>
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="">Release</a></td>
                        <td style="padding: 3px 5px;">10/01/2020 14:05:42</td>
                        <td style="padding: 3px 5px;">abcd-1234</td>
                    </tr>
                    <tr>
                        <td>Manthan Vora</td>
                        <td style="padding: 3px 13px;">1250</td>
                        <td style="padding: 3px 5px;">Released</td>
                        <td style="padding: 3px 5px;"></td>
                        <td style="padding: 3px 5px;">10/01/2020 14:05:42</td>
                        <td style="padding: 3px 5px;">abcd-1234</td>
                    </tr>
                    <tr>
                        <td>Prince Sharma</td>
                        <td style="padding: 3px 13px;">1820</td>
                        <td style="padding: 3px 5px;">Yet to be released</td>
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="">Release</a></td>
                        <td style="padding: 3px 5px;">10/01/2020 14:05:42</td>
                        <td style="padding: 3px 5px;">abcd-1234</td>
                    </tr> -->
                </table>

            </div> 
            <div class="col-12">
                <a style="float: right;" href="">See more..</a>
            </div>  
           
            <!--  <div class="col-12">
                <a href="{!! url('auctions') !!}/{!! $auction->id !!}">
                    <div class="card comman-card__content">
                        <div class="col-12 card-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-12 col-sm-6 py-3">
                                        <p class="value">
                                            funding target
                                            <span>
                                         £ ($auction->amount_funding_required)
                                        </span>
                                        </p>
                                    </div>
                                    <div class="col-12 col-sm-6 py-3 border-left border-white">
                                        <p class="value">
                                            po value
                                            <span>
                                            £ ($auction->total_amount_of_po)
                                        </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row h-100  border-top border-white">
                                    <div class="col-6 py-3">
                                        <p class="text-center text-uppercase value">
                                            MAX DISCOUNT LIMIT
                                            <span class="text-center">
                                            {{$auction->maximum_discount_limit}}%
                                         </span>
                                        </p>
                                    </div>
                                    <div class="col-6 py-3 border-left border-white">
                                        <p class="text-center text-uppercase value">
                                            CURRENT DISCOUNT LIMIT
                                            <span>
                                           
                                        </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row  border-top border-white">
                                    <div class="col-md-12  bar-progress py-3">
                                        <p class="text-uppercase value">
                                            Auction Time Left
                                        </p>
                                        <div class="progress-circle">
                                            <div class="progress-circle-container">
                                                <svg viewBox="0 0 36 36" class="circular-chart">
                                                    <path class="circle-bg"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"

                                                    />
                                                    <path class="circle-white"
                                                          stroke-dasharray="{{round($auction->time_left_percentage)}}, 100"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    />
                                                    <path class="circle"
                                                          stroke-dasharray="{{round($auction->time_left_percentage)}}, 100"
                                                          d="M18 2.0845
                                              a 15.9155 15.9155 0 0 1 0 31.831
                                              a 15.9155 15.9155 0 0 1 0 -31.831"
                                                    />
                                                </svg>
                                                <div class="percentage">
                                                    @if( $auction->time_left_before_end  > 0 )
                                                        <span><strong>{{ $auction->time_left_before_end }}</strong>days</span>
                                                    @elseif( $auction->time_left_before_end == 0 )
                                                        <span><strong>Last<br>Day</strong></span>
                                                    @elseif( $auction->time_left_before_end == -2 )
                                                        <span><strong>Not<br>Started</strong></span>
                                                    @else
                                                        <span class="empty"><strong>Ended</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row h-100 border-top border-white">
                                    <div class="col-6 py-3">
                                        <p class="text-center text-uppercase value">
                                            Investment Period (day)
                                            <span class="text-center">
                                        {{$auction->investment_period}} {{ str_plural('', $auction->investment_period) }}
                                        </span>
                                        </p>
                                    </div>
                                    <div class="col-6 border-left py-3 border-white">
                                        <p class="text-center text-uppercase value">
                                            Date repayment due
                                            <span class="text-center auction__details__repayment"> {{ \App\Helpers\FormattedDate::format($auction->date_repayment_due) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div> -->
            <div class="col-12 order-2">


                @if($auction->ended)



                    @if(!$auction->invoice)
                        @auctionowner($auction->id)
                        <p>Upload Invoice</p>
                        {!! Form::model(array($invoice,'files' => true), ['action' => 'Auction\InvoiceController@store','files' => true]) !!}
                        @csrf
                        <span class="error_input">
                            <strong>{{ $errors->first('invoice_file') }}</strong>
                            </span>

                        <p>
                            <input type="file" id="invoice_file" name="invoice_file">
                            <input type="hidden" value="{{$auction->id}}" name="auction_id">
                        </p>

                        <p>
                            <button type="submit" class="btn btn-primary btn-danger">
                                {{ __('Upload File') }}
                            </button>
                        </p>
                        </form>

                        @endauctionowner
                    @else

                        @auctionowner($auction->id)
                       <!--  <p>Invoice Uploaded - <a href="{{route('invoice-link',['id' => $auction->invoice->id,'action'=>'view'])}}" target="_blank">View Invoice</a>
                                    - <a href="{{route('invoice-link',['id' => $auction->invoice->id])}}">Download Invoice</a> -->
                        @endauctionowner
                    @endif

                @endif

               <!--  @role('admin')
                <p>
                    <a href="{{route('po-link',['id' => $auction->id])}}">Download P.O Document</a>
                </p>
                @if($auction->invoice)
                    <p>
                         Invoice {{  $auction->invoice->approved  ? '( Approved )' : '' }}

                        - <a href="{{route('invoice-link',['id' => $auction->invoice->id,'action'=>'view'])}}" target="_blank">View</a>
                        - <a href="{{route('invoice-link',['id' => $auction->invoice->id])}}">Download</a>
                    </p>
                @endif
                @endrole -->

                @role('investor')
                @if($auction->ended)
                    @push('alerts')
                    <div class="alert alert-info">
                        <a class="close" data-dismiss="alert">×</a>
                        This Auction has come to an end. No more bids allowed!
                    </div>
                    @endpush
                @endif
                @if($auction->approved == 1 && auth()->user()->profileCompleted() && $auction->ended == false)
                    <button class="btn btn-lg btn-dark" data-toggle="collapse"
                            data-target="#bid_card">{{ $auction->investor_has_bid ? 'EDIT' : 'PLACE' }} BID
                    </button>
                    @if($auction->investor_has_bid )
                        {!!  Form::open(['url'=>route('investor.bid.edit',['id'=>$auction->id]),'class' => '','method' => 'put']) !!}
                    @else
                        {!!  Form::open(['url'=>route('investor.bid',['id'=>$auction->id]),'class' => '']) !!}
                    @endif
                    <div class="dashboard__card enter-bid collapse @if(($errors->has('amount') ) || ( $errors->has('bid_discount') ) )show @endif "
                         id="bid_card">
                        <div class="card pr-4 pl-4 pb-4">
                            <h4>{{ $auction->investor_has_bid ? 'EDIT' : 'ENTER' }} BID</h4>
                            <hr>
                            <div>
                                <p>
                                    You can bid to purchase a share of the PO at a discounted price. <a href="">Read more </a>
                                </p>
                                <div class="container-fluid">
                                   <div class="enter-bid-details">
                                        <div class="row row-spacer">
                                            <div class="col-12 col-lg-4">
                                                
                                                {!! Form::label('amount','Bid Amount ( £ )') !!}
                                               <!--  {!! Form::number('amount',$auction->investor_bid_amount,['class'=>'form-control']) !!} -->
                                                <!--  <input type="text" value="{{ $auction->investor_has_bid['amount']}}" class="form-control" id="amount" name="amount"> -->
                                                <input type="text" class="form-control" id="amount" name="amount" value="{{$auction->investor_has_bid['amount']}}">
                                                <span class="error_input">
                                               <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                                <span class="error_input" id="bid_amount_error">
                                                <font color="red">Your bid amount is above the set limit of &pound;{{$auction->amount_funding_required}}
                                                    , please try again</font>
                                                </span>
                                                 <span class="error_input" id="min_bid_amount_error">
                                                <font color="red">Please enter value greater than &pound;{{$settings->minimum_bid_amount}}
                                                    , please try again</font>
                                                </span>
                                            <br>
                                            {!! Form::label('bid_discount','ROI in percentage ( % )') !!}
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="bid_discount" name="bid_discount" value="{{$auction->investor_has_bid['bid_discount']}}" >
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                                <span class="error_input">
                                               <strong>{{ $errors->first('bid_discount') }}</strong>
                                            </span>
                                           <!--  <span   class="error_input text-red" id="bid_discount_error">
                                            <font color="red">Your bid amount is above discount limit of {{$auction->maximum_discount_limit}}
                                                %, please try again</font>
                                            </span> -->
                                            <span   class="error_input text-red" id="bid_discount_error">
                                                <font color="red">ROI should be less than {{$settings->maximum_expected_roi}}
                                                    %, please try again</font>
                                            </span>
                                            <span   class="error_input text-red" id="max_roi_error">
                                                <font color="red">ROI should be less than Current ROI {{$max_roi_f}}
                                                    %, please try again</font>
                                            </span>
                                            <span   class="error_input text-red" id="current_roi_error">
                                                <font color="red">ROI should be less than Current ROI {{$roi}}
                                                    %, please try again</font>
                                            </span>
                                            <br>
                                             {!! Form::label('roi_in_pound','ROI in pound ( £ )') !!}
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="roi_in_pound"
                                                           name="roi_in_pound"
                                                           value="{{$auction->investor_has_bid['roi_in_pound']}}" placeholder="" onkeypress="return event.charCode >= 48" min="1">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                    class="fa fa-gbp"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <!--  {!! Form::label('amount','Enter the bid amount that you want to invest.',array('class' => 'label1')) !!}
                                                  {!! Form::label('amount','Enter a proposed ROI for your bid amount. At present maximum ROI achievable is',array('class' => 'label2')) !!}
                                                  @if(isset($roi))
                                                  {{$roi}}%.
                                                  @endif -->
                                                   <label for="amount" class="label1">Enter the bid amount that you want to invest.</label>
                                                   <label for="amount" class="label2">The overall maximum ROI set for the entire auction is {{$d_roi}}%. Whilst individual bids may have a higher ROI than {{$d_roi}}%, the overall average ROI for the auction cannot exceed {{$d_roi}}% at any given point.</label>
                                                  <!--  <label for="amount" class="label2">Enter a proposed ROI for your bid amount. At present maximum ROI achievable is {{$roi}} %.</label>  -->
                                            </div>

                                            <input type="hidden" id="total_amount_of_po"
                                                   value="{{$auction->total_amount_of_po}}">
                                            <input type="hidden" id="amount_funding_required_bids"
                                                   value="{{$auction->amount_funding_required}}">
                                            <input type="hidden" id="max_discount_limit_bids"
                                                   value="{{$auction->maximum_discount_limit}}">
                                            <input type="hidden" id="auction_id"
                                                   value="{{$auction->id}}">
                                            <input type="hidden" id="user_id"
                                                   value="{{auth()->user()->id}}">
                                            <input type="hidden" id="minimum_bid_amount"
                                                   value="{{$settings->minimum_bid_amount}}">
                                            <input type="hidden" id="maximum_expected_roi"
                                                   value="{{$settings->maximum_expected_roi}}">
                                            <input type="hidden" id="max_roi_f"
                                                   value="{{$max_roi_f}}">
                                            <input type="hidden" id="roi_h"
                                                   value="{{$roi}}">
                                            <input type="hidden" id="po_value"
                                                   value="{{$po}}">
                                            <input type="hidden" id="total_bid_amount"
                                                   value="{{$total_bid_amount}}">
                                            <input type="hidden" name="roi" value="">

                                          <!--   <div class="col-12 col-lg-4">
                                                {!! Form::label('bid_discount','Bid Discount (%)') !!}
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="bid_discount"
                                                           name="bid_discount"
                                                           value="{{$auction->investor_bid_discount}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                    class="fa fa-percent"></i></span>
                                                    </div>
                                                </div>
                                                <span class="error_input">
                                               <strong>{{ $errors->first('bid_discount') }}</strong>
                                            </span>
                                                <span   class="error_input text-red" id="bid_discount_error">
                                                <font color="red">Your bid amount is above discount limit of {{$auction->maximum_discount_limit}}
                                                    %, please try again</font>
                                            </span>
                                            </div> -->
                                        </div>

                                        <div class="row c">
                                            <div class="results-title">BID SUMMARY AND ESTIMATED RETURN</div>
                                        </div>
                                        <table class="table d-none d-md-table" style="width: 75% !important">
                                            <thead class="row-headings">
                                            <th>Rank</th>
                                            <th>Bid Amount</th>
                                            <th>Value of PO</th>
                                            <th>Share of PO</th>
                                            <th>Profit</th>
                                            <th>ROI</th>
                                            </thead>
                                            <tbody class="text-center">
                                            <tr >
                                                <td id="showRank">
                                                   @if($auction->investor_has_bid )
                                                    <a href="javascript:void(0)" id="displayRank" name="displayRank" style="color:#007bff !important">Click here to get ranking details</a>
                                                   @endif
                                                </td>
                                                <td>
                                                    <span class="ranking"></span>
                                                </td>
                                                <td>
                                                    <span class="bid_amount"></span>
                                                </td>
                                                <td>
                                                    <span class="share_po_value"></span>
                                                </td>
                                                <td>
                                                    <span class="share_po_percent"></span>
                                                </td>
                                                <td>
                                                    <span class="total_return_profit"></span>
                                                </td>
                                                <td>
                                                    <span class="roi"></span>
                                                </td>
                                            </tr>
                                            </tbody>
                                          
                                             
                                        </table>

                                        <!--desktop view-->
                                        <div class="d-none auction__calculations">
                                            <div class="row row-spacer row-headings">
                                                <div class="col">SHARE OF PO</div>
                                                <div class="col">PO SHARE VALUE</div>
                                                <div class="col">BID DISCOUNT</div>
                                                <div class="col">BID AMOUNT</div>
                                                <div class="col">PROFIT</div>
                                                <div class="col">ROI</div>
                                                <div class="col">TOTAL RETURN</div>
                                            </div>

                                            <div class="row row-spacer row-values">
                                                <div class="col share_po_percent"></div>
                                                <div class="col share_po_value"></div>
                                                <div class="col bid_discount"></div>
                                                <div class="col bid_amount"></div>
                                                <div class="col total_return_profit"></div>
                                                <div class="col roi"></div>
                                                <div class="col total_return"></div>
                                            </div>
                                        </div>
                                        <!--end desktop view-->

                                        <!--mobile view-->
                                        <div class="d-md-none auction__calculations">
                                            <div class="row">
                                                <div class="col">SHARE OF PO</div>
                                                <div class="col share_po_percent"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">PO SHARE VALUE</div>
                                                <div class="col share_po_value"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">BID DISCOUNT</div>
                                                <div class="col bid_discount"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">BID AMOUNT</div>
                                                <div class="col bid_amount"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">PROFIT</div>
                                                <div class="col total_return_profit"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">ROI</div>
                                                <div class="col roi"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">TOTAL RETURN</div>
                                                <div class="col total_return"></div>
                                            </div>
                                        </div>
                                        <!--end mobile view-->
                                        <div class="row float-md-right" style="margin-top: -100px;">
                                            <button class="btn btn-lg btn-dark" id="bid_submit">SUBMIT MY BID</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                @endif
                @endrole

            </div>
        </div>
        @endif 
        @endif
         @endrole

       <!--  @if(auth()->user()->getRole() =="admin" || auth()->id() == $auction->user_id )
            <div id="auction-comments">
                <h3>Comments</h3>
                <hr>
                @comments(['model' => $auction])
                @endcomments
            </div>
        @endif -->

        <hr style="margin-top: -24px !important; margin-bottom: 12px !important;">
        <h3>Auction Leaderboard</h3>
        <hr>

      <!--   <div class="progress custom full mb-4">
            <div class="progress-bar" role="progressbar" style="width: {{$auction->total_funded_percentage}}%"
                 aria-valuenow="{{$auction->total_funded_percentage}}" aria-valuemin="0" aria-valuemax="100"
                 progressbar="{{$auction->total_funded_percentage}}">
        <span>
          <span>
            {{$auction->total_funded_percentage}}%
          </span>
        </span>
            </div>
        </div> -->
       <!--  <div class="progress custom full mb-4">
  <div class="progress-bar" role="progressbar" style="width:{{$auction->total_funded_percentage}}%" aria-valuenow="{{$auction->total_funded_percentage}}" aria-valuemin="0" aria-valuemax="100"  progressbar="{{$auction->total_funded_percentage}}" >
   {{$auction->total_funded_percentage}}%
  </div>
</div> -->

    <div class="row" style='<?php if($total_funded_percentage > 100 )echo "margin-right:".$margin_right."%;"?>'>
        <div class="col">
            <p class="text-right value small">
                Funding Target
                <span>
          £ @money($auction->amount_funding_required)
        </span>
            </p>
        </div>
        
    </div>
    <div class="progress <?php echo $css?> full mb-4" >
        <div class="progress-bar marketplace__item__auction__progress__bar" role="progressbar"
             style="width: {{round($progressbar_percentage)}}%"
             aria-valuenow="50%" aria-valuemin="0" aria-valuemax="100" progress="{{round($auction->t)}}">
            <?php if($total_funded_percentage < 100 ){?>
            <span class="marketplace__item__auction__progress__bar__total__amount">
                <span>
                    <!-- £ @money($auction->amount_total_funded) -->
                    {{round($slider_text)}}%
                </span>
            </span>
            <?php } ?>

            <?php if($total_funded_percentage == 100 ){?>
            <span class="marketplace__item__auction__progress__bar__total__amount" style="right:54px;">
                <span>
                    <!-- £ @money($auction->amount_total_funded) -->
                    {{round($slider_text)}}%
                </span>
            </span>
            <?php } ?>
        </div>
        <?php if($total_funded_percentage > 100 ){?>
            <span class="marketplace__item__auction__progress__bar__total__amount" style="right: 39px;top: -4px;">
                <span style="top: -4px;font-size: 19px;height: 34px;">
                  <!-- £ @money($auction->amount_total_funded) -->
                {{round($slider_text)}}%
                </span>
            </span>
        <?php }?>
    </div>
    <div class="row" style="margin-left:{{round($width)-8}}%">
        <div class="col">
            <p class="text-left value small">
                {{$title}}
                <span>
                    £ @money(str_replace('-', '', $auction->amount_funding_required-$po))
                </span>
            </p>
        </div>            
    </div>

        <div class="table-responsive text-nowrap">
            <table class="table auction">
                <thead>
                <tr>
                    <th scope="col">Ranking</th>
                    <th scope="col">Username</th>
                    <th scope="col">Date/Time</th>
                    <th scope="col">Bid Amount</th>
                    <!-- <th scope="col">Bid Discount</th> -->
                    <th scope="col">Value of PO</th>
                    <th scope="col">Share of PO</th>
                    <th scope="col">Profit</th>
                    <th scope="col">ROI</th>
                </tr>
                </thead>

                @if($flag == 1)
                    <tbody>
                    @forelse($array_approved_bids as $bid)
                        @if(auth()->user()->id  == $bid['bid_id']->user_id && $bid['is_accepted'] == 1)
                           <tr class="mybid danger-color-rank" style="color:white !important;">
                        @elseif (auth()->user()->id  == $bid['bid_id']->user_id && $bid['is_accepted'] == 0)
                            <tr class="mybid danger-color-rank-light" style="color:white !important;">
                        @else
                             <tr class="mybid bg-white">
                        @endif
                        
                            <td data-label="Ranking" class="{{$bid['is_accepted']  == 1 ? 'mybid danger-color-rank' : 'mybid danger-color-rank-light'}} ">{{$loop->iteration}}</td>
                            <td data-label="Investor">{{optional($bid['bid_id']->investor)->user_name}} </td>
                            <td data-label="Created at">{{ \App\Helpers\FormattedDateTime ::format($bid['bid_id']->created_at)}} </td>
                            <td data-label="Bid Amount">£ @money($bid['amount'])</td>
                            <!-- <td data-label="Bid Discount">{{$bid['bid_id']->bid_discount}} %</td> -->
                            <td data-label="Value of PO">£ @money($bid['value_of_po'])</td>
                            <td data-label="Share of PO">{{$bid['share_of_po']}} %</td>
                            <td data-label="Profit">£ @money($bid['profit'])</td>
                            <td data-label="ROI">{{$bid['bid_id']->bid_discount}} %</td>
                        </tr>
                    @empty
                        No Bids
                    @endforelse
                    </tbody>
                @endif
                @if($flag == 0)
                    <tbody>
                        @forelse($bids as $bid)
                            <tr class="{{auth()->user()->id  == $bid->user_id ? 'mybid bg-white' : ''}}">
                                <td data-label="Ranking" class="{{auth()->user()->id  == $bid->user_id ? 'mybid bg-danger' : ''}} dark">{{$loop->iteration}}</td>
                                <td data-label="Investor">{{optional($bid->investor)->user_name}} </td>
                                <td data-label="Created at">{{ \App\Helpers\FormattedDateTime ::format($bid->created_at)}} </td>
                                <td data-label="Bid Amount">£ @money($bid->amount)</td>
                                <!-- <td data-label="Bid Discount">{{$bid->bid_discount}} %</td> -->
                                <td data-label="Value of PO">£ {{$bid->value_of_po}}</td>
                                <td data-label="Share of PO">{{$bid->share_of_po}} %</td>
                                <td data-label="Profit">£ @money($bid->profit)</td>
                                <td data-label="ROI">{{$bid->roi}} %</td>
                            </tr>
                        @empty
                            No Bids
                        @endforelse
                        </tbody>
                @endif
            </table>
        </div>

    </div>


@endsection