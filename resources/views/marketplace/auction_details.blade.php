<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 31/10/2018
 * Time: 12:09
 */

//echo "<pre>";
    if($auction->amount_funding_required != 0 ) $total_funded_percentage = ($po/$auction->amount_funding_required) * 100;
    else $total_funded_percentage = 0;
    //echo $total_funded_percentage;die;

    if($total_funded_percentage < 100){
        if($total_funded_percentage == 0)
            $width = 5; 
        else
            $width = $total_funded_percentage ; 
        $title = 'Amount Remaining';
        $progressbar_percentage = $total_funded_percentage - 5;
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
    // begin of KK20210806
    // $agency_fee = ($accepted_bid_amount * 10 ) / 100;
    // $agency_fee = number_format((float)$agency_fee, 2, '.', '');
       $agency_fee = 0;

    // end of KK20210806

    // $funding_joint_fee = ($auction->amount_funding_required * 2.99 )/ 100; //KK20210806
    $fj_fee = preg_replace( '/[^a-z0-9]/i', '', $auction->funding_joint_fee);
    $funding_joint_fee = number_format((float)$fj_fee, 2, '.', '');

    // Begin of KK20210804
    // Calculate the totals Collection Fees for this auction, and use in calculation for Seller to see

    $total_collection_fee = 0;
    $bid_profit = App\Model\Bid::where('auction_id',$auction->id)->get();
    foreach ($bid_profit as $key => $value) 
    {
        // print("<pre>".print_r($value->roi_in_pound,true)."</pre>");
        $total_collection_fee += $value->roi_in_pound;
    }  
    $total_collection_fee = number_format((float)$total_collection_fee, 2, '.', '');
    // End of KK20210804

    // $funds_available = $accepted_bid_amount - $agency_fee - $funding_joint_fee; //KK20210806
    $funds_available = $accepted_bid_amount - $total_collection_fee - $funding_joint_fee; //KK20210806
    $funds_available = number_format((float)$funds_available, 2, '.', '');                //KK20210806
    $accepted_bid_amount = number_format((float)$accepted_bid_amount, 2, '.', '');        //KK20210806
    $amount_funding_required = number_format((float)$auction->amount_funding_required, 2, '.', '');        //KK20210806



    // echo $auction->bids[0]->roi_in_pound;die;
    //print_r('<pre>');
    //print_r($auction);
    //exit;

    $date1=date_create($auction->start_auction);
    $date2=date_create($auction->date_repayment_due);
    $diff=date_diff($date1,$date2);
    $investment_period =  $diff->format("%a");
    $funding_success = 1;
    // if ($funding_success == true)
    // {
    //     print_r("here");
    //     print("<pre>".print_r($funding_success,true)."</pre>");
    //     print("<pre>".print_r($auction->funding_success,true)."</pre>");
    // }


    // Begin of KK20210720
    // Work out Average Collection Fee Percentage of All Bids...if other columns required...add to array $wanted_columns= array("first","second"..etc)

    if(count($bid_profit) !== 0)
    {
        $input_array = $bid_profit;
        $wanted_columns = array ("bid_discount");
        $result = array_fill_keys ($wanted_columns, 0);
    
        foreach ($input_array as $row) 
            foreach ($wanted_columns as $column_name) 
                $result[$column_name] += $row[$column_name];
    
        $array_size = count ($input_array);
        foreach ($result as &$value)
                $value /= $array_size;
        $roi_d                  = $value; 
        $roi                    = number_format((float)$roi_d, 2, '.', '');
    }

    // End of KK20210720

    //$progressbar_percentage = 100;
    //$total_funded_percentage = 100;


?>



@extends('layouts.admin.page')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">

   .alert-area .alert a:hover{
    opacity : 0.5 !important;
   }
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
             <a
                    href="{{route('buyers.index')}}"> Buyer for this auction is not approved! Click here to visit buyer profile.</a>
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
                                           {{$investment_period}}
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
                                          Max Collection Fee 

                                          <span>
                                          {{$max_roi_f}}%
                                          </span>
                                           <!-- CURRENT DISCOUNT LIMIT
                                        @if($po == 0)
                                        <span>
                                           ---
                                        </span>
                                        @else
                                        <span>
                                           {{$maximum_discount}}%
                                        </span>
                                        @endif -->
                                        </p>
                                    </div>
                                    <div class="col-md-2 col-xs-12 py-3 border-left border-white border-top">
                                      <!--   <p class="text-center text-uppercase value">
                                            MAX DISCOUNT LIMIT
                                            <span class="text-center">
                                            {{$auction->maximum_discount_limit}}%
                                         </span>
                                        </p> -->
                                          <!-- <p class="value">
                                             Max Collection Fee 

                                            <span>
                                           {{$max_roi_f}}%
                                        </span>
                                        </p> -->
                                    </div>
                                    <div class="col-md-2 col-xs-12 py-3 border-left border-white border-top">
                                        <!-- <p class="text-center text-uppercase value">
                                            CURRENT DISCOUNT LIMIT
                                            <span>
                                           
                                        </span>
                                        </p> -->
                                         <p class="value">
                                            Average Collection Fee 
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
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="order-2" style="width:100%;">

                       @if( ( auth()->user()->getRole() !="admin" ) && ( auth()->user()->getRole() !="investor" ) && (auth()->id() == $auction->user_id) )
                        <div class="col-12">
                            <h3>Documents</h3>
                            <hr>
                        </div>
                        <div class="col-12">

                        <table> 
                            <tr>
                                <!-- <th>PO Document</th>
                                <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('po-link',['id' => $auction->id,'action'=>'view'])}}" target="_blank">View</a></td>
                                <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('po-link',['id' => $auction->id,'action'=>'download'])}}">Download</a></td> -->
                            </tr>
                            <tr>
                                @if($auction->invoice)
                                <th>Invoice</th>
                                <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('po-link',['id' => $auction->id,'action'=>'view'])}}" target="_blank">View</a></td>
                                <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('po-link',['id' => $auction->id,'action'=>'download'])}}">Download</a></td>
                                <!-- <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('invoice-link',['id' => $auction->invoice->id,'action'=>'view'])}}" target="_blank">View</a></td>
                                <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('invoice-link',['id' => $auction->invoice->id])}}">Download</a></td> -->
                                @endif
                                @if(!$auction->invoice && $auction->ended)
                                
                                    <th>Invoice</th>
                                    <td style="padding: 3px 5px;">
                                     {!! Form::model(array($invoice,'files' => true), ['action' => 'Auction\InvoiceController@store','files' => true]) !!}
                                            @csrf
                                            <span class="error_input">
                                                <strong>{{ $errors->first('invoice_file') }}</strong>
                                                </span>
                                             </td>
                                             <td>   
                                            <p>
                                                <input type="file" id="invoice_file" name="invoice_file">
                                                <input type="hidden" value="{{$auction->id}}" name="auction_id">
                                            </p>

                                            <p>
                                                <button type="submit" class="">
                                                    {{ __('Upload File') }}
                                                </button>
                                            </p>
                                            </form> 
                                    </td>
                                @endif
                            </tr>
                        </table><hr>
                        </div>
                        @auctionowner($auction->id)
                        @endauctionowner
                        @endif
                @if($auction->ended)


                    @if(false)
                        @auctionowner($auction->id)
                       
                        @endauctionowner
                    @else


                    @if( ( auth()->user()->getRole() !="admin" ) && (auth()->id() == $auction->user_id))
	                    @if( ( auth()->user()->getRole() !="admin" ) )
	                    <div class="col-12">
	                        <h3>Post Auction Payouts</h3>
	                     	<hr>
	                    </div>
	                    @endif
                    @if ( auth()->user()->getRole() != 'investor')
                    <div class="col-12">
                        <b style="font-size: 18px;">Seller Payouts</b>
	                    <table width="100%"> 
	                        <tr>
	                            <th style="padding: 3px 5px;width:100px;"><b>Item</b></th>
	                            <th style="padding: 3px 5px;width:100px;"><b>Amount (£)</b></th>
	                            <th style="padding: 3px 5px;width:100px;"><b>Status</b></th>
	                            <th style="padding: 3px 5px;width:100px;"><b>Date/Time</b></th>
	                            <th style="padding: 3px 5px;width:100px;"><b>Reference</b></th>
	                        </tr>
                            <tr>
                                <td>Target funding amount</td>
                                <!-- <td style="padding: 3px 5px;width:100px;">{{$auction->amount_funding_required}}</td> -->
                                <td style="padding: 3px 5px;width:100px;">{{$amount_funding_required}}</td>
                                <td style="padding: 3px 5px;width:100px;">Retained</td>
                                <td style="padding: 3px 5px;width:100px;">--</td>
                                <td style="padding: 3px 5px;width:100px;">--</td>
                            </tr>
	                        <tr>
	                            <td>Funds raised</td>
	                            <td style="padding: 3px 5px;width:100px;">{{$accepted_bid_amount}}</td>
	                            <td style="padding: 3px 5px;width:100px;">Retained</td>
	                            <td style="padding: 3px 5px;width:100px;">--</td>
	                            <td style="padding: 3px 5px;width:100px;">--</td>
	                        </tr>
	                        <tr>
	                            <td>Collection fees</td>
	                            <!-- <td style="padding: 3px 5px;">{{$agency_fee}}</td> // KK20210806 -->
                                <td style="padding: 3px 5px;">{{$total_collection_fee}}</td> 
                                @if($auction->fees_release == null)
                                    <td style="padding: 3px 5px;">Retained</td>
                                @else
                                        <td style="padding: 3px 5px;">Released</td>
                                @endif
                                @if($auction->fees_release == null)
                                    <td style="padding: 3px 5px;width:100px;">--</td>
                                    <td style="padding: 3px 5px;width:100px;">--</td>
                                @else
                                    <td style="padding: 3px 5px;width:100px;">{{ \App\Helpers\FormattedDateTime ::format($auction->fees_release_datetime)}}</td>
                                    <td style="padding: 3px 5px;width:100px;">{{$auction->fees_release_reference}}</td>
                                @endif

	                            
	                        </tr>
	                        <tr>
	                            <td>Funding Joint fees</td>
	                            <td style="padding: 3px 5px;">{{$funding_joint_fee}}</td>
	                            <td style="padding: 3px 5px;">Retained</td>
	                            <td style="padding: 3px 5px;">--</td>
	                            <td style="padding: 3px 5px;">--</td>
	                        </tr>
	                        <tr>
	                            <td>Funds available</td>
	                            <td style="padding: 3px 5px;">{{$funds_available}}</td>
	                            @if($auction->paid_out == 1)
	                                <td style="padding: 3px 5px;">Released</td>
                                    <td style="padding: 3px 5px;">{{ \App\Helpers\FormattedDateTime ::format($auction->paid_out_datetime)}}</td>
                                    <td style="padding: 3px 5px;">{{$auction->paid_out_reference}}</td>
	                            @else
	                                <td style="padding: 3px 5px;">Retained</td>
                                    <td style="padding: 3px 5px;">--</td>
                                    <td style="padding: 3px 5px;">--</td>
	                            @endif
	                        </tr>
	                    </table><br/>                    	
                    </div>
                    @endif
                    @endif
                    @endif
                @endif

                @role('admin')
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
                @if($auction->approved == 1 && auth()->user()->profileCompleted() && $auction->ended == false && auth()->user()->approved == 1)
                    <button class="btn btn-lg btn-dark" data-toggle="collapse"
                            data-target="#bid_card">{{ $auction->investor_has_bid ? 'EDIT' : 'PLACE' }} BID
                    </button>
                    @if($auction->investor_has_bid )
                        {!!  Form::open(['url'=>route('investor.bid.edit',['id'=>$auction->id]),'class' => '','method' => 'put']) !!}
                    @else
                        {!!  Form::open(['url'=>route('investor.bid',['id'=>$auction->id]),'class' => '']) !!}
                    @endif

                    {{-- @if(($errors->has('amount') ) || ( $errors->has('bid_discount') ) )show @endif --}}
                    <div class="dashboard__card enter-bid collapse " id="bid_card">
                        <div class="card pr-4 pl-4 pb-4">
                            <h4>{{ $auction->investor_has_bid ? 'EDIT' : 'ENTER' }} BID</h4>
                            <hr>
                            <?php 
                                if($auction->investor_has_bid){
                                    $has_bid = 1; ?>
                                    <input type="hidden" id="current_user_amount" value="{{$auction->investor_has_bid['amount']}}">
                                    <input type="hidden" id="current_user_roi" value="{{$auction->investor_has_bid['bid_discount']}}">
                            <?php }else{
                                    $has_bid = 2;
                                }
                            ?>
                            <input type="hidden" name="has_bid" id="has_bid" value="{{$has_bid}}">
                            <div>
                                <p>
                                    You can Bid to Fund a Share of the Invoice and Propose a Collection Fee <a href="" data-toggle="modal" data-target="#bidModel">Read more </a>
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
                                                <font color="red">Your bid amount will exceed the target funding of &pound;{{$auction->amount_funding_required}}, please try again</font>
                                                </span>
                                                 <span class="error_input" id="min_bid_amount_error">
                                                <font color="red">Please enter value greater than &pound;{{$settings->minimum_bid_amount}}
                                                    , please try again</font>
                                                </span>
                                                <span class="error_input" id="wallet_balance_error">
                                                <font color="red">Your wallet balance is less than the bid amount.</font>
                                                </span>
                                            <br>
                                            {!! Form::label('bid_discount','Collection Fee ( % )') !!}
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
                                            {{-- <span   class="error_input text-red" id="bid_discount_error">
                                                <font color="red">ROI should be less than 111 {{$settings->maximum_expected_roi}}
                                                    %, please try again</font>
                                            </span> --}}
                                            <span   class="error_input text-red" id="max_roi_error">
                                                <font color="red">Collection Fee should be less than Current Collection Fee {{$max_roi_f}}
                                                    %, please try again</font>
                                            </span>
                                            <span   class="error_input text-red" id="current_roi_error">
                                                <font color="red">Collection Fee should be less than Current Collection Fee {{$roi}}
                                                    %, please try again</font>
                                            </span>
                                            <br>
                                             {!! Form::label('roi_in_pound','Return On Investment (ROI) ( £ )') !!}
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" id="roi_in_pound"
                                                           name="roi_in_pound"
                                                           value="{{$auction->investor_has_bid['roi_in_pound']}}" placeholder="" min="1">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text"><i
                                                                    class="fa fa-gbp"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6">
                                                <!--  {!! Form::label('amount','Enter the bid amount that you want to invest.',array('class' => 'label1')) !!}
                                                  {!! Form::label('amount','Enter a proposed Collection Fee for your bid amount. At present maximum Collection Fee achievable is',array('class' => 'label2')) !!}
                                                  @if(isset($roi))
                                                  {{$roi}}%.
                                                  @endif -->
                                                   <label for="amount" class="label1">Enter the bid amount that you want to invest.</label>
                                                  <!--  <label for="amount" class="label2" id="default_dynamic">The maximum ROI for this bid amount is {{$d_roi}}%&nbsp;<div class="proposed_roi_pound_d" style="display: inline-block;"></div></label> -->
                                                    <label for="amount" class="label2" id="dynamic">The maximum Collection Fee for this bid amount is <div class="proposed_roi_data" style="display: inline-block;"></div>&nbsp;<div class="proposed_roi_pound" style="display: inline-block;"></div></label>
                                                  <!--  <label for="amount" class="label2">Enter a proposed ROI for your bid amount. At present maximum ROI achievable is {{$roi}} %.</label>  -->
                                                  <label for="amount" class="label2" style="display: none;" id="bid_discount_error">Collection Fee should be less than {{$settings->maximum_expected_roi}}%, please try again</label>

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
                                            <input type="hidden" id="wallet_balance"
                                                   value="{{auth()->user()->balance_amount + $auction->investor_has_bid['amount']}}">
                                            <input type="hidden" id="maximum_expected_roi"
                                                   value="{{$settings->maximum_expected_roi}}">
                                            <input type="hidden" id="max_roi_f"
                                                   value="{{$max_roi_f}}">
                                            <input type="hidden" id="roi_h"
                                                   value="{{$roi}}">
                                            <input type="hidden" id="po_value"
                                                   value="{{$po}}">  
                                             <input type="hidden" id="accepted_po"
                                                   value="{{$accepted_po}}">  
                                            <input type="hidden" id="total_bid_amount"
                                                   value="{{$total_bid_amount}}">
                                             <input type="hidden" id="edit_bid_amount"
                                                   value="{{$edit_bid_amount}}">
                                            <input type="hidden" id="current_bid_amount"
                                                   value="{{$current_bid_amounts}}">
                                            <input type="hidden" id="bid_last_amount"
                                                   value="{{$bid_last_amount}}">
                                            <input type="hidden" id="bid_last_roi"
                                                   value="{{$bid_last_roi}}">  
                                            <input type="hidden" id="bids"
                                                   value="{{json_encode($bid_data)}}">  
                                            <input type="hidden" id="edit_bid_data"
                                                   value="{{json_encode($edit_bid_data)}}">      
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
                                            <!-- <th>Value of PO</th> -->
                                            {{-- <th>Share of funding target (<i class="fa fa-info" aria-hidden="true" title="Rounded to 2 decimal places"></i>)</th> --}}
                                            <!-- <th>Share of funding target <img src="{{url('/').'/Information_icon.png'}}" style="width: 15px;" title="Rounded to 2 decimal places"></th> -->
                                            <th>Share of Invoice <img src="{{url('/').'/Information_icon.png'}}" style="width: 15px;" title="Rounded to 2 decimal places"></th>
                                            <th>Profit</th>
                                            <th>Collection Fee</th>
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
                                                {{-- <td>
                                                    <span class="share_po_value"></span>
                                                </td> --}}
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
                                                <!-- <div class="col">Share of funding target</div> -->
                                                <div class="col">SHARE OF INVOICE</div>
                                                <div class="col">INVOICE SHARE VALUE</div>
                                                <div class="col">BID DISCOUNT</div>
                                                <div class="col">BID AMOUNT</div>
                                                <div class="col">PROFIT</div>
                                                <div class="col">COLLECTION FEE </div>
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
                                                <!-- <div class="col">Share of funding target</div> -->
                                                <div class="col">SHARE OF INVOICE</div>
                                                <div class="col share_po_percent"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">INVOICE SHARE VALUE</div>
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
                                                <div class="col">COLLECTION FEE </div> 
                                                <div class="col roi"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">TOTAL RETURN</div>
                                                <div class="col total_return"></div>
                                            </div>
                                        </div>
                                        <!--end mobile view-->
                                        <!-- <div class="row float-md-right" style="margin-top: -100px;">
                                            <button class="btn btn-lg btn-dark" id="bid_submit">SUBMIT MY BID</button> -->
                                        <div class="row float-md-right" style="">
                                            <input type='checkbox' id='bid_submit_checkbox' style="margin-top: 25px;" required><label style="padding-top: 19px;" id='bid_submit_label'>Please Check Box To Confirm Bid </label>
                                            <button class="btn btn-lg btn-dark" id="bid_submit">SUBMIT MY BID</button>
                                        <!-- <div class="row float-md-right" style="">
                                            <input type='checkbox' id='bid_submit_checkbox' style="margin-top: 25px;" required><label style="padding-top: 19px;" id='bid_submit_label'>Please Check Box To Confirm </label>
                                            <button class="btn btn-lg btn-dark" id="bid_submit">SUBMIT MY BID</button> -->
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

        @if( ( auth()->user()->getRole() =="admin" ) || ( auth()->id() == $auction->user_id  && $auction->time_left_before_end < 0 && $auction->ended ) )
        <div class="row">
            <div class="col-12">
                    <h3>Documents</h3>
            <hr>
            </div>
            <div class="col-12">
                <table> 
                    <tr>
                        <!-- <th>PO Document</th>
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('po-link',['id' => $auction->id,'action'=>'view'])}}" target="_blank">View</a></td>
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('po-link',['id' => $auction->id])}}">Download</a></td> -->
                    </tr>
                    @role('admin')
                    <tr>
                        @if($auction->invoice) 
                       <th>Invoice</th>
                       <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('po-link',['id' => $auction->id,'action'=>'view'])}}" target="_blank">View</a></td>
                       <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('po-link',['id' => $auction->id])}}">Download</a></td>
                        <!-- <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('invoice-link',['id' => $auction->invoice->id,'action'=>'view'])}}" target="_blank">View</a></td>
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('invoice-link',['id' => $auction->invoice->id])}}">Download</a></td> -->
                    @if($auction->invoice->approved)
                        <td td style="padding: 3px 5px;color:#007bff;"> {{  $auction->invoice->approved  ? 'Approved' : '' }} </td>
                    @else 
                        <td style="padding: 3px 5px;"><a style="text-decoration:underline;" href="{{route('admin.auction.approve_invoice',['id' => $auction->id])}}">Approve</a></td>
                    </tr>
                    @endif
                    @endif
                @endrole
                </table><hr>
            </div>
        @endif
        @if( ( auth()->user()->getRole() =="admin" && auth()->id() == $auction->user_id )  || $auction->time_left_before_end < 0 && $auction->ended )
            <div class="col-12">
                <h3>Post Auction Payouts</h3>
            </div>
            <div class="col-12">
                <hr style="margin-top: 10px !important; margin-bottom: 5px !important;">
                <b style="font-size: 18px;">Seller Payouts</b>
                <a style="float: right;" href="{{route('admin.auctions.seller_export',$auction->id)}}">Export</a>
            </div>
            <div class="col-12">
                <table width=100%> 
                    <tr>
                        <th style="padding: 3px 5px;width:20%;"><b>Item</b></th>
                        <th style="padding: 3px 5px;width:15%;"><b>Amount (£)</b></th>
                        <th style="padding: 3px 5px;width:20%;"><b>Status</b></th>
                        <th style="padding: 3px 5px;width:15%;"><b>Actions</b></th>
                        <th style="padding: 3px 5px;width:15%;"><b>Date/Time</b></th>
                        <th style="padding: 3px 5px;width:15%;"><b>Reference</b></th>
                    </tr>
                    <tr>
                        <td>Target funding amount</td>
                        <!-- <td style="padding: 3px 5px;width:100px;">{{$auction->amount_funding_required}}</td> -->
                        <td style="padding: 3px 5px;width:100px;">{{$amount_funding_required}}</td>
                        <td style="padding: 3px 5px;width:100px;">Retained</td>
                        <td style="padding: 3px 5px;width:100px;"></td>
                        {{-- <td style="padding: 3px 5px;width:100px;">{{ \App\Helpers\FormattedDateTime ::format($auction->created_at)}}</td> --}}
                        <td style="padding: 3px 5px;width:100px;">--</td>
                        <td style="padding: 3px 5px;width:100px;">--</td>
                    </tr>
                    <tr>
                        <td>Funds raised</td>
                        <td style="padding: 3px 5px;width:100px;">{{$accepted_bid_amount}}</td>
                        <td style="padding: 3px 5px;width:100px;">Retained</td>
                        <td style="padding: 3px 5px;width:100px;"></td>
                        <td style="padding: 3px 5px;width:100px;">--</td>
                        <td style="padding: 3px 5px;width:100px;">--</td>
                    </tr>
                    <tr>
                        <td>Collection fees</td>
                        <!-- <td style="padding: 3px 5px;">{{$agency_fee}}</td> //KK20210806 -->
                        <td style="padding: 3px 5px;">{{$total_collection_fee}}</td>
                        @if($auction->fees_release == null)
                            <td style="padding: 3px 5px;">Retained</td>
                        @else
                            <td style="padding: 3px 5px;">Released</td>
                        @endif
                        <!-- Begin of KK20210808 - Not Needed for Collection Fees...this was left over from Agency Fees -->
                        <!-- @if($auction->fees_release == null)
                            <td style="padding: 3px 5px;"><a @if($funding_success == true && ( isset($auction->invoice) && $auction->invoice->approved == 1) ) data-toggle="modal" data-target="#creditagencyModal" style="text-decoration:underline;color: #007bff;" @else onclick="alert('Please approve invoice to release money.')" style="text-decoration:underline;color: #aba9a9;" @endif>
                        Release</a></td>
                            <td style="padding: 3px 5px;width:100px;">--</td>
                            <td style="padding: 3px 5px;width:100px;">--</td>
                        </td> 
                        @else
                            <td></td>
                            <td style="padding: 3px 5px;width:100px;">{{ \App\Helpers\FormattedDateTime ::format($auction->fees_release_datetime)}}</td>
                            <td style="padding: 3px 5px;width:100px;">{{$auction->fees_release_reference}}</td>
                        @endif -->
                        <!-- End of KK20210808 - Not Needed for Collection Fees...this was left over from Agency Fees -->
                    </tr>
                    <tr>
                        <td>Funding Joint fees</td>
                        <td style="padding: 3px 5px;">{{$funding_joint_fee}}</td>
                        <td style="padding: 3px 5px;">Retained</td>
                        <td style="padding: 3px 5px;"></td>
                        <td style="padding: 3px 5px;">--</td>
                        <td style="padding: 3px 5px;">--</td>
                    </tr>
                    <tr>
                        <td>Funds available </td>
                        <td style="padding: 3px 5px;">{{$funds_available}}</td>
                        @if($auction->paid_out == 1)
                            <td style="padding: 3px 5px;">Released</td>
                        @else
                            <td style="padding: 3px 5px;">Retained</td>
                        @endif
                        @if($auction->paid_out != 1)
                                <td style="padding: 3px 5px;"><a 
                                    @if($funding_success = true && ( isset($auction->invoice) && $auction->invoice->approved == 1) ) data-toggle="modal" data-target="#creditModal" style="text-decoration:underline;color: #007bff;" @else onclick="alert('Please approve invoice to release money.')" style="text-decoration:underline;color: #aba9a9;" @endif>Release
                            
                            </a></td>
                            <td style="padding: 3px 5px;">--</td>
                            <td style="padding: 3px 5px;">--</td>
                        @else
                            <td></td>
                            <td style="padding: 3px 5px;">{{ \App\Helpers\FormattedDateTime ::format($auction->paid_out_datetime)}}</td>
                            <td style="padding: 3px 5px;">{{$auction->paid_out_reference}}</td>
                        @endif
                        
                    </tr>
                </table>
            </div>  
           
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
                       
                        @endauctionowner
                    @endif
                @endif

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
                    <div class="dashboard__card enter-bid collapse  "  id="bid_card">
                        <div class="card pr-4 pl-4 pb-4">
                            <h4>{{ $auction->investor_has_bid ? 'EDIT' : 'ENTER' }} BID</h4>
                            <hr>
                            <div>
                                <p>
                                    You can Bid to Fund a Share of the Invoice and Propose a Collection Fee  <a href="">Read more </a>
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
                                            {!! Form::label('bid_discount','Collection Fee ( % )') !!}
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
                                            <font color="red">Your bid amount is above discount limit of 123 {{$auction->maximum_discount_limit}}
                                                %, please try again</font>
                                            </span> -->
                                            <span   class="error_input text-red" id="bid_discount_error">
                                                <font color="red">Collection Fee  should be less than {{$settings->maximum_expected_roi}}
                                                    %, please try again</font>
                                            </span>
                                            <span   class="error_input text-red" id="max_roi_error">
                                                <font color="red">Collection Fee should be less than Current Collection Fee {{$max_roi_f}}
                                                    %, please try again</font>
                                            </span>
                                            <span   class="error_input text-red" id="current_roi_error">
                                                <font color="red">Collection Fee should be less than Current Collection Fee {{$roi}}
                                                    %, please try again</font>
                                            </span>
                                            <br>
                                             {!! Form::label('roi_in_pound','Return On Investment (ROI) ( £ )') !!}
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
                                                  {!! Form::label('amount','Enter a proposed Collection Fee for your bid amount. At present maximum Collection Fee achievable is',array('class' => 'label2')) !!}
                                                  @if(isset($roi))
                                                  {{$roi}}%.
                                                  @endif -->
                                                   <label for="amount" class="label1">Enter the bid amount that you want to invest.</label>
                                                   <label for="amount" class="label2">The overall maximum Collection Fee set for the entire auction is {{$d_roi}}%. Whilst individual bids may have a higher Collection Fee than {{$d_roi}}%, the overall average Collection Fee for the auction cannot exceed {{$d_roi}}% at any given point.</label>
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
                                            <input type="hidden" id="wallet_balance"
                                                   value="{{auth()->user()->balance_amount + $auction->investor_has_bid['amount']}}">
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
                                                <font color="red">Your bid amount is above discount limit of  {{$auction->maximum_discount_limit}}
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
                                            {{-- <th>Value of Invoice</th> --}}
                                            <!-- <th>Share of funding target</th> -->
                                            <th>Share of Invoice</th>
                                            <th>Profit</th>
                                            <th>Collection Fee</th>
                                            </thead>
                                            <tbody class="text-center">
                                            <tr >
                                                <td id="showRank">
                                                   @if($auction->investor_has_bid )
                                                    <a href="javascript:void(0)" id="displayRank" name="displayRank" style="color:#007bff !important">Click Here To Get Ranking Details</a>
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
                                                <!-- <div class="col">Share of funding target</div> -->
                                                <div class="col">SHARE OF INVOICE</div>
                                                <div class="col">INVOICE SHARE VALUE</div>
                                                <div class="col">BID DISCOUNT</div>
                                                <div class="col">BID AMOUNT</div>
                                                <div class="col">PROFIT</div>
                                                <div class="col">COLLECTION FEE</div>
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
                                                <!-- <div class="col">Share of funding target</div> -->
                                                <div class="col">Share of Invoice</div>
                                                <div class="col share_po_percent"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">INVOICE SHARE VALUE</div>
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
                                                <div class="col">COLLECTION FEE</div>
                                                <div class="col roi"></div>
                                            </div>
                                            <div class="row">
                                                <div class="col">TOTAL RETURN</div>
                                                <div class="col total_return"></div>
                                            </div>
                                        </div>
                                        <!--end mobile view-->
                                        <!-- <div class="row float-md-right" style="">
                                            <input type='checkbox' id='bid_submit_checkbox' style="margin-top: 25px;" required><label style="padding-top: 19px;" id='bid_submit_label'>Once you Submitted wouldn't be reverted</label>
                                            <button class="btn btn-lg btn-dark" id="bid_submit">SUBMIT MY BID</button> -->
                                        <div class="row float-md-right" style="">
                                            <input type='checkbox' id='bid_submit_checkbox' style="margin-top: 25px;" required><label style="padding-top: 19px;" id='bid_submit_label'>Please Check Box To Confirm Bid </label>
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
         @endrole
         <?php $outstanding_balance = 0; ?>
        @if(auth()->user()->getRole() =="admin" && $auction->ended)
            <div class="">
                <b style="font-size: 18px;">Buyers Payouts</b>
                {{-- <a style="float: right;" data-toggle="modal" data-target="#creditagencyModal">Add New</a> --}}
                <a style="text-decoration:underline; color:#007bff;float: right;" href="" data-toggle="modal" data-target="#buyerTransactionModal">Add New</a>
            </div>

            <div class="" style="margin-bottom: 30px;">
            <table width="100%"> 
                <tr>
                    <th style="padding: 3px 5px;width:11%;"><b>Instalments</b></th>
                    <th style="padding: 3px 5px;width:11%;"><b>Invoice Amount (£)</b></th>
                    <th style="padding: 3px 5px;width:11%;"><b>Repayment Date</b></th>
                    <th style="padding: 3px 5px;width:11%;"><b>Amount Received (£)</b></th>
                    <th style="padding: 3px 5px;width:11%;"><b>Date Of receipt</b></th>
                    <th style="padding: 3px 5px;width:11%;"><b>Reference</b></th>
                    <th style="padding: 3px 5px;width:11%px;"><b>Outstanding </b></th>
                    {{-- <th style="padding: 3px 5px;width:15%;"><b>Overdue</b></th> --}}
                    <th style="padding: 3px 5px;width:11%;"><b>Payment Status</b></th>
                    <th style="padding: 3px 5px;width:11%;"><b>Invoice Status</b></th>
                </tr>
                 <tbody>
            @php
                $t_count = 1;
            @endphp
            @forelse($buyer_transaction as $transaction)
                <tr>
                    <td style="width:10%;">Instalment {{$t_count}}</td>
                    <td style="padding: 3px 5px;">£ @money($transaction->invoice_amount)</td>
                    <td style="padding: 3px 5px;">{{ \App\Helpers\FormattedDate ::format($transaction->invoice_repayment_due_date)}}</td>
                    <td style="padding: 3px 5px;">£ @money($transaction->amount_received)</td>
                    <td style="padding: 3px 5px;">{{ \App\Helpers\FormattedDate ::format($transaction->date_of_receipt)}}</td>
                    <td style="padding: 3px 5px;">{{$transaction->reference}}</td>
                    <td style="padding: 3px 5px;">£ @money($transaction->outstanding_balance)</td>
                    {{-- <td style="padding: 3px 5px;">{{$transaction->days_overdue}}</td> --}}
                    <td style="padding: 3px 5px;">{{$transaction->payment_status}}</td>
                    <td style="padding: 3px 5px;">{{$transaction->status}}</td>
                    
                </tr>
                @php
                $t_count = $t_count + 1;
            @endphp
            @empty
                
            @endforelse

            <?php
           	if(isset($transaction->outstanding_balance)){
           		$outstanding_balance = $transaction->outstanding_balance;
           	}else{
            	$outstanding_balance = $auction->amount_funding_required;
           	}
              ?>
            </tbody>
            </table>
        </div> 
        @endif

        @if(auth()->user()->getRole() =="admin" || auth()->user()->getRole() =="investor" && $investedInBid == 1 )
        @if($auction->ended)
        <div class="">
            <b style="font-size: 18px;">Investor Payouts</b>
            @if(auth()->user()->getRole() !="investor" )
            <a style="float: right;" href="{{route('admin.auctions.investor_export',$auction->id)}}" target="_blank">Export</a>
            @endif
        </div>
        <div class="">
            <table width="100%"> 
                <tr>
                    <th style="padding: 3px 5px;width:20%;"><b>Investors</b></th>
                    <th style="padding: 3px 5px;width:15%;"><b>Amount (£)</b></th>
                    <th style="padding: 3px 5px;width:20%px;"><b>Status</b></th>
                    @if( auth()->user()->getRole() != "investor"  )
                        <th style="padding: 3px 5px;width:15%;"><b>Actions</b></th>
                    @endif
                    <th style="padding: 3px 5px;width:15%;"><b>Date/Time</b></th>
                    <th style="padding: 3px 5px;width:15%;"><b>Reference</b></th>
                </tr>
                 <tbody>
            @forelse($array_approved_bids as $bid)
                @if( (auth()->user()->getRole() == "admin" || ( auth()->user()->getRole() == "investor" && auth()->user()->id  == $bid['bid_id']->user_id ) ) && $bid['is_accepted'] == 1)
                <tr>
                    <td style="width:120px;">{{optional($bid['bid_id']->investor)->user_name}}</td>
                    <!-- <td style="padding: 3px 13px;">£ @money($bid['value_of_po'])</td>  //KK20210814 -->
                    <td style="padding: 3px 13px;">£ @money($bid['value_of_po']+$bid['roi_in_pound'])</td>
                    <!-- <input type="hidden" id="investor_amount_{{$bid['bid_id']->user_id}}" value="@money($bid['value_of_po'])"> -->
                    <input type="hidden" id="investor_amount_{{$bid['bid_id']->user_id}}" value="@money($bid['value_of_po']+$bid['roi_in_pound'])">
                    @if( $bid['bid_id']->paid == 0  )
                        <td style="padding: 3px 5px;">Yet to be released</td>
                    @else
                        <td style="padding: 3px 5px;">Released</td>
                    @endif

                    @if( (auth()->user()->getRole() != "investor"))
                        @if($bid['bid_id']->paid == 0)
                        <!-- <td style="width:120px;">{{$auction}}</td> -->
                        <td style="padding: 3px 5px;"><a @if($funding_success = true && ( isset($auction->invoice) && $auction->invoice->approved == 1) ) data-toggle="modal" data-target="#creditInvestor" style="text-decoration:underline;color: #007bff;" @else onclick="alert('Please approve the invoice to release money.')" style="text-decoration:underline;color: #aba9a9;" @endif id="investor_{{$bid['bid_id']->user_id}}" class="investor_pay_release">
                            <!-- <td style="padding: 3px 5px;"><a @if($auction->funding_success == true && ( isset($auction->invoice) && $auction->invoice->approved == 1) ) data-toggle="modal" data-target="#creditInvestor" style="text-decoration:underline;color: #007bff;" @else onclick="alert('Please approve invoice to release money.')" style="text-decoration:underline;color: #aba9a9;" @endif id="investor_{{$bid['bid_id']->user_id}}" class="investor_pay_release"> -->
                                Release</a>
                            </td>
                        @else
                            <td style="padding: 3px 5px;"></td>
                        @endif
                    @endif

                    @if( $bid['bid_id']->paid == 0  )
                        <td style="padding: 3px 5px;">--</td>
                        <td style="padding: 3px 5px;">--</td>
                    @else
                       <td style="padding: 3px 5px;">{{ \App\Helpers\FormattedDateTime ::format($bid['bid_id']->paid_datetime)}}</td>
                       <td style="padding: 3px 5px;">{{$bid['bid_id']->reference}}</td>
                    @endif
                    
                    
                </tr>
                @endif
            @empty
                No Bids
            @endforelse
            </tbody>
            </table>
        </div> 
        
        @endif
        @endif
        <br/>
        <hr>
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
</div>
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
            <span class="marketplace__item__auction__progress__bar__total__amount 11">
                <span>
                    <!-- £ @money($auction->amount_total_funded) -->
                    {{round($slider_text)}}%
                </span>
            </span>
            <?php } ?>

            <?php if($total_funded_percentage == 100 ){?>
            <span class="marketplace__item__auction__progress__bar__total__amount 22" style="right:54px;">
                <span>
                    <!-- £ @money($auction->amount_total_funded) -->
                    {{round($slider_text)}}%
                </span>
            </span>
            <?php } ?>
        </div>
        <?php if($total_funded_percentage > 100 ){?>
            <span class="marketplace__item__auction__progress__bar__total__amount 33" style="right: 39px;top: -4px;">
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
<!-- //      Display Investor View of Auction Leaderboard -->
        <div class="table-responsive text-nowrap">
            <table class="table auction">
                <thead>
                <tr>
                    <th scope="col">Ranking</th>
                    <th scope="col">Username</th>
                    <th scope="col">Date/Time</th>
                    <th scope="col">Bid Amount</th>
                    <!-- <th scope="col">Bid Discount</th> -->
                    {{-- <th scope="col">Value of Invoice</th> --}}
                    <!-- <th scope="col">Share of funding target</th> -->
                    <th scope="col">Share of Invoice</th>
                    <th scope="col">Profit</th>
                    <th scope="col">Collection Fee</th>
                </tr>
                </thead>
                  
                @if($flag == 1)
                    <tbody>
                    @forelse($array_approved_bids as $bid)
                        @if(auth()->user()->id  == $bid['bid_id']->user_id && $bid['is_accepted'] == 1)
                           <tr class="mybid danger-color-rank" style="color:white !important;">
                        @elseif (auth()->user()->id  == $bid['bid_id']->user_id && $bid['is_accepted'] == 0)
                            <tr class="mybid danger-color-rank-light" style="color:white !important;">
                        @elseif (auth()->user()->id  != $bid['bid_id']->user_id && $bid['is_accepted'] == 0)
                            <tr class="mybid bg-white" style="color:gray !important;">
                        @else
                             <tr class="mybid bg-white">
                        @endif
                            <td data-label="Ranking" class="{{$bid['is_accepted']  == 1 ? 'mybid danger-color-rank' : 'mybid danger-color-rank-light'}} ">{{$loop->iteration}}</td>
                            <td data-label="Investor">{{optional($bid['bid_id']->investor)->user_name}} </td>
                            <td data-label="Created at">{{ \App\Helpers\FormattedDateTime ::format($bid['bid_id']->created_at)}} </td>
                            <td data-label="Bid Amount">£ @money($bid['amount'])</td>
                            <!-- <td data-label="Bid Discount">{{$bid['bid_id']->bid_discount}} %</td> -->
                            {{-- <td data-label="Value of PO">£ @money($bid['value_of_po'])</td> --}}
                            <!-- <td data-label="Share of funding target">{{$bid['share_of_po']}} %</td> -->
                            <td data-label="Share of Invoice">{{$bid['share_of_po']}} %</td>
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
                                <!-- <td data-label="Share of funding target">{{$bid->share_of_po}} %</td> -->
                                <td data-label="Share of Invoice">{{$bid->share_of_po}} %</td>
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

{{--@if(property_exists($auction->invoice(), 'approved'))--}}
    @if($auction->invoice()->exists())

        @if($funding_success == true && $auction->invoice->approved == 1)
            <div class="modal fade" id="creditModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content account__modal">
                        <div class="modal-header">
                            <h4 class="modal-title text-center"
                                id="modelTitleId">{{$auction->paid_out ? 'FUNDS ALREADY PAID OUT':'RELEASE FUNDS TO SELLER'}} </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="account__modal__content__title">Seller Account details</h3>
                                        {!! Form::open(['url'=>route('admin.transactions.payseller')]) !!}
                                        <div class="form-group">
                                            <label for="">Account No.</label>
                                            <input type="text" class="form-control" readonly
                                                   value="{{$auction->seller->bankdetails->account_number}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Sort Code</label>
                                            <input type="text" class="form-control" readonly
                                                   value="{{$auction->seller->bankdetails->sort_code}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Reference</label>
                                            <input type="text" class="form-control" name="paid_out_reference" readonly
                                                   value="{{\App\Http\Controllers\Admin\AdminTransactionsController::createReference($auction->user_id)}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Amount To Transfer (£)</label>
                                            <input type="text" name="amount" class="form-control" readonly
                                                   value="{{$funds_available}}">
                                            <input type="hidden" name="seller" value="{{$auction->seller->user_id}}">
                                            <input type="hidden" name="auction_id" value="{{$auction->id}}">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary {{$auction->paid_out ? 'disabled':''}}">
                                Transfer
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endif 


{{--@if(property_exists($auction->invoice(), 'approved'))--}}
    @if($auction->invoice()->exists())

        @if($funding_success == true && $auction->invoice->approved == 1)
            <div class="modal fade" id="creditagencyModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content account__modal">
                        <div class="modal-header">
                            <h4 class="modal-title text-center"
                                id="modelTitleId">{{$auction->paid_out ? 'FUNDS ALREADY PAID OUT':'RELEASE FUNDS TO SELLER'}} </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="account__modal__content__title">Seller Account details</h3>
                                        {!! Form::open(['url'=>route('admin.transactions.payfeesseller')]) !!}
                                        <div class="form-group">
                                            <label for="">Account No.</label>
                                            <input type="text" class="form-control" readonly
                                                   value="{{$auction->seller->bankdetails->account_number}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Sort Code</label>
                                            <input type="text" class="form-control" readonly
                                                   value="{{$auction->seller->bankdetails->sort_code}}">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Reference</label>
                                            <input type="text" class="form-control" name="agency_fee_reference" readonly
                                                   value="{{\App\Http\Controllers\Admin\AdminTransactionsController::createReference($auction->user_id)}}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Amount To Transfer (£)</label>
                                            <input type="text" name="amount" class="form-control" readonly
                                                   value="{{$agency_fee}}">
                                            <input type="hidden" name="seller" value="{{$auction->seller->user_id}}">
                                            <input type="hidden" name="auction_id" value="{{$auction->id}}">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                Transfer
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endif 

    @if($auction->invoice()->exists())

        @if($funding_success == true && $auction->invoice->approved == 1)
            <div class="modal fade" id="creditInvestor" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content account__modal">
                        <div class="modal-header">
                            <h4 class="modal-title text-center"
                                id="modelTitleId">{{$auction->paid_out ? 'FUNDS ALREADY PAID OUT':'RELEASE FUNDS TO INVESTOR'}} </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="account__modal__content__title">Investor Account details</h3>
                                        {!! Form::open(['url'=>route('admin.transactions.payinvestor')]) !!}
                                        <div class="form-group">
                                            <label for="">Account No.</label>
                                            <input type="text" class="form-control" readonly id="investor_acc_no"
                                            value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Sort Code</label>
                                            <input type="text" class="form-control" readonly id="investor_sort_code"
                                                value="">
                                        </div>

                                        <div class="form-group">
                                            <label for="">Reference</label>
                                            <input type="text" class="form-control" name="investor_reference"  readonly id="investor_reference" value="">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        

                                        <div class="form-group">
                                            <label for="">Amount To Transfer (£)</label>
                                            <input type="text" name="amount" id="investor_amount" class="form-control" readonly
                                                   value="">
                                            <input type="hidden" name="investor" id="investor_id" value="">
                                            <input type="hidden" name="auction_id" value="{{$auction->id}}">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                Transfer
                            </button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif

    @endif 

    <div class="modal fade" id="bidModel" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content account__modal">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="modelTitleId"> Bid Detail </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            

                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    {{-- <button type="submit" class="btn btn-primary">
                        Transfer
                    </button> --}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade" id="buyerTransactionModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content account__modal">
                <div class="modal-header">
                    <h4 class="modal-title text-center" id="modelTitleId">Buyer Payment </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                {!! Form::open(['url'=>route('admin.buyer.pay')]) !!}
                                <div class="form-group">
                                    <label for="">Paid Amount</label>
                                    <input type="text" class="form-control" value="" name="amount_received" id="amount_received">
                                </div>

                                <div class="form-group">
                                    <label for="">Payment Status</label>
                                    <select class="form-control" name="payment_status">
                                        <option value="On time">On time</option>
                                        <option value="Overdue">Overdue</option>
                                        <option value="Late">Late</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="">Invoice Status</label>
                                    <select class="form-control" name="status">
                                        <option value="Full paid">Full paid</option>
                                        <option value="Partial paid">Partial paid</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Reference</label>
                                    <input type="text" class="form-control" name="reference" readonly 
                                           value="{{ 'buyer_'.$auction->buyer->id.'_'.time()}}">
                                </div>
                                <div class="form-group">
                                    <label for="">Outstanding Balance</label>
                                    <input type="text" class="form-control" name="outstanding_balance" readonly 
                                           value="{{ $outstanding_balance}}" id="outstanding_balance">
                                </div>
                                
                                <input type="hidden" name="auction_id" value="{{$auction->id}}">
                                <input type="hidden" name="invoice_repayment_due_date" value="{{$auction->date_repayment_due}}">
                                <input type="hidden" name="invoice_amount" value="{{$auction->amount_funding_required}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="buyer_btn">
                        Save
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
        
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(window).keydown(function(event){

                if((event.keyCode == 13) && ($(event.target)[0]!=$("textarea")[0])) {

                    event.preventDefault();

                    return false;

                }

            });

        });
        $('.investor_pay_release').on('click', function () {
            var userData = this.id.split("_");
            var user_id = userData[1];
            var amount = $('#investor_amount_'+user_id).val();
            getUserBankDetails(user_id);
            
            $.ajax({
                type: "get",
                url: "http://3.10.169.59/funding_joint/public/json/createreference",
                data: {user_id: user_id},
                success: function (data) {
                    $('#investor_id').val(user_id);
                    $('#investor_amount').val(amount);
                    $('#investor_reference').val(data);
                }
            });


        });
        function getUserBankDetails(user_id) {
            $.ajax({
                type: "GET",
                url: "http://3.10.169.59/funding_joint/public/json/bankDetails/" + user_id,
                success: function (data) {
                    $('#investor_acc_no').val(data.account_number);
                    $('#investor_sort_code').val(data.sort_code);
                }
            });
        }

        $('#amount_received').on('keyup', function () {
            
            var amount = $('#amount_received').val();
            var outstanding_balance = $('#outstanding_balance').val();
            
            var remain_amount = outstanding_balance - amount;

            if(remain_amount < 0){
                $("#buyer_btn").hide();
            }else{
                $("#buyer_btn").show();
            }
            


        });
    </script>
@endsection