<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 07/11/2018
 * Time: 13:06
 */

    $po = 0;
    $bid_profit = App\Model\Bid::where('auction_id',$auction->id)->get();
    if(count($bid_profit) != 0)
    {
        $after_bid_total = $auction->getBidAmountTotal($auction->id);
        foreach ($bid_profit as $key => $value) {
                $get_po_value[] = $value->getValueOfPoAttribute();
        }
        $po = array_sum($get_po_value);
        foreach ($after_bid_total as $key => $value) {
             $after_total_amount   = $value->total_bid;
        }
    }
    $total_funded_percentage = 0;
    if($auction->amount_funding_required > 0){
        $total_funded_percentage = ($po/$auction->amount_funding_required) * 100;
    }
    

    if($total_funded_percentage < 100){
        if($total_funded_percentage == 0)
            $width = 7; 
        elseif($total_funded_percentage > 80 && $total_funded_percentage <= 100)
            $width = 95;
        else
        $width = $total_funded_percentage; 
        $title = 'Amount Remaining';
        $progressbar_percentage = $total_funded_percentage;
        $slider_text = $total_funded_percentage;
        $r = 0;
        $css = 'custom';
    }elseif($total_funded_percentage == 100){
        $width = 95; 
        $title = 'Amount Remaining';
        $progressbar_percentage = $total_funded_percentage;
        $slider_text = $total_funded_percentage;
        $r = 67;
        $css = 'custom';
    }
    elseif($total_funded_percentage > 100){
        $width = 95; 
        $title = 'Over-Funded By';
        $progressbar_percentage = ($auction->amount_funding_required/$po) * 100;
        $slider_text = $total_funded_percentage;
        $margin_right = (100 -$progressbar_percentage)-4;
        $r = 0;
        $css = 'custom custom-overfunded';
    }else{
        $width = 0; 
        $title = 'Over-Funded By';
        $progressbar_percentage = $total_funded_percentage;
        $slider_text = $total_funded_percentage;
        $r = 0;
        $css = 'custom';
    }




?>

<style type="text/css">
  p.value.small span {
    font-size: 12px;
    font-weight: bold;
  }

  .slidersize{
    top: 1px;
    font-size: 13px;
    height: 24px;
  }

  @media  (max-width: 1280px){
      .row.test-auctions {
        margin-left: 87% !important;
    }
 /* span.test0 {
        left: 0px!important;
        padding: 4px 22px 0px 12px !important;
    }
*/
   /*@media  (max-width: 1280px){
      .row.test-auction {
        margin-left: 39% !important;
    }*/
}
</style>

<div class="comman-card my-3 sellerAuctionCard">



    <a data-link="{{url('/auctions/'.$auction->id)}}" style="z-index: 1;">
        <div class="comman-card__header">
           <div class="row" style='<?php if($total_funded_percentage > 100 )echo "margin-right:".$margin_right."%;"?>'>
                <div class="col" style="margin-bottom: -16px;">
                    <p class="text-right value small">
                        Funding Target
                        <span>
                            £ @money($auction->amount_funding_required)
                        </span>
                    </p>
                </div>  
            </div>
        </div>
        <div class="card comman-card__content">
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
                        <span class="marketplace__item__auction__progress__bar__total__amount" style="right: 54px;top: -4px;">
                            <span style="top: -4px;font-size: 19px;height: 34px;">
                              <!-- £ @money($auction->amount_total_funded) -->
                            {{round($slider_text)}}%
                            </span>
                        </span>
                    <?php }?>
            </div>
            <div class="row test-auctions" style="margin-left:{{round($width)-8}}%; margin-top: -13px;">
                <div class="col">
                    <p class="text-left value small">
                        {{$title}}
                        <span>
                            £ @money(str_replace('-', '', $auction->amount_funding_required-$po))
                        </span>
                    </p>
                </div>            
            </div>
            <div class="col-12 card-body">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-7 left handleClick">
                        <div class="row h-100">
                            <div class="col-12 my-3 align-self-start">
                                <h4 class="title mb-3"><strong>{{$auction->buyer->company_name}}</strong></h4>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <p>
                                            <strong>Auction Number:</strong> {{$auction->id}} <br>
                                            <strong>Invoice Number:</strong> {{$auction->po_number}} <br>
                                            <strong>Invoice Issue Date:</strong> {{ \App\Helpers\FormattedDate::format($auction->expected_invoice_issue_date) ?: 'Not Set'}}
                                        </p>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <p>
                                            {{-- <strong>Funding Remaining:</strong> @if($auction->amount_funding_remaining >= 0 ) £ @money($auction->amount_funding_remaining) @else Overfunded @endif <br> --}}
                                            <strong>Funding Remaining:</strong> @if($auction->amount_funding_remaining > 0 ) £ @money(str_replace('-', '', $auction->amount_funding_required-$po)) @else Overfunded @endif <br>
                                            <strong>Auction End Date:</strong> {{ !is_null($auction->end_auction) ? \App\Helpers\FormattedDate::format($auction->end_auction) : 'Not started'}} <br>
                                            <strong>Repayment Due:</strong> {{!is_null($auction->date_repayment_due) ? \App\Helpers\FormattedDate::format($auction->date_repayment_due) : 'Not Started'}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 border-top align-self-end">
                                <p class="f-14 my-2">
                                    <strong>
                                        Status:
                                    </strong>
                                    Your auction

                                    @if($auction->status == 'Live')
                                        is Live
                                    @elseif($auction->approved == 2)
                                        was Declined
                                    @elseif($auction->status == 'Ended')
                                        was Completed
                                    @else
                                        is Pending
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-5 right border-left">
                        <div class="row">
                            <div class="col-6 handleClick">
                                <div class="row  h-100">
                                    <div class="col-12 py-3">
                                        <p class="text-center text-uppercase title">
                                            bids placed
                                            <span class="text-center value">{{$auction->total_bids_placed}}</span>
                                        </p>
                                    </div>
                                    <div class="col-12 py-3 border-top">
                                        <p class="text-center text-uppercase title">
                                            Discount Limit
                                            <span class="text-center value">{{$auction->maximum_discount_limit}}%</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 border-left half-circle py-3 handleClick">
                                <p class="value text-uppercase">
                                    Current discount
                                </p>
                                <div class="half-circle__area">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="150" width="100%" viewBox="0 0 200 200" data-value="{{$auction->max_discount}}">
                                        <path class="bg" stroke="#4a29b9" d="M41 149.5a77 77 0 1 1 117.93 0"  fill="none"/>
                                        <path class="meter" stroke="#ed2d6d" d="M41 149.5a77 77 0 1 1 117.93 0" fill="none" stroke-dasharray="350" stroke-dashoffset="350"/>
                                    </svg>
                                    <p>
                                        @if(!empty($auction->max_discount))
                                            {{ $auction->max_discount }} <span>%</span>
                                        @else
                                            No bids
                                        @endif
                                    </p>
                                </div>
                                <p class="text-uppercase value inline">
                                  Amount <strong>£ @money($auction->amount_total_funded)</strong>
                                </p>
                            </div>

                            <div class="col-12 align-self-end border-top" style="    max-height: 42px; z-index: 2; cursor: auto;">
                                <span class="openAuctionSummary btn btn-sm btn-primary" data-toggle="modal" data-target="#auctionSummaryModal-{{$auction->id}}" data-auction="{{$auction->id}}" > Summary Statement</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>


<!-- Approve Modal -->
<div    class="modal fade" id="auctionSummaryModal-{{$auction->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center w-100" id="exampleModalLabel">Summary Statement</h5>
                <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <hr>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="auctionSummary">
                    <div>
                        <strong>Buyer Name: </strong> <span class="buyerName">{{$auction->buyer->company_name?:''}}</span>
                    </div>
                    <div>
                        <strong>Invoice Number: </strong> <span class="po_number">{{$auction->po_number?:''}}</span>
                    </div>
                    <div>
                        <strong>Total Invoice Amount: </strong> <span class="po_value_perc">{{$auction->total_amount_of_po}}</span>
                    </div>
                    <div>
                        <strong>Maximum Collection Fee </strong> <span class="discount_limit">{{$auction->maximum_discount_limit?:'0'}} %</span>
                    </div>
                    <div>
                        <strong>Target Funding: </strong> <span class="amount_required_perc"> £ {{$auction->amount_funding_required}}</span>
                    </div>
                    <div>
                        <strong>Funding Joint Fee: </strong> <span class="fj_fee">{{$auction->funding_joint_fee?:''}}</span>
                    </div>

                    <div>
                        <strong>Potential Net Funding Available To You: </strong> <span class="net_available">£ {{$auction->net_funding_available}}</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

