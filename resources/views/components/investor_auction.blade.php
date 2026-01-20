<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 30/10/2018
 * Time: 12:10
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

$total_funded_percentage = ($po/$auction->amount_funding_required) * 100;

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

$total_po = 0;
// KK20210807 - This calculation doesn't look right
foreach ($auction->bids as $key => $value) {
  $total_po = $total_po + ($value->amount + $value->roi_in_pound);
}


?>
<div class="comman-card my-3">
<a href="{!! url('auctions') !!}/{!! $auction->id !!}">
        <div class="comman-card__header">
          <div class="row">
            <span class="col left">
              <!-- £ @money($total_po) -->
              
            </span>
            <span class="col right">
              £ @money($auction->amount_funding_required)
            </span>
          </div>
        </div>
        <div class="card comman-card__content">
            <div class="progress <?php echo $css?> full mb-4">
              <div class="progress-bar marketplace__item__auction__progress__bar" role="progressbar"
                   style="width:{{round($progressbar_percentage)}}%"
                   aria-valuenow="50%" aria-valuemin="0" aria-valuemax="1000"
                    progressbar="1000" progress="{{round($auction->t)}}">
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
                    <div class="col-12 col-sm-6 col-md-7 left">
                        <div class="row h-100">
                          <div class="col-12 my-3 align-self-start">
                           @if($auction->ended == false )  <button class="btn btn-sm float-right">Edit Bid</button> @endif
                            <h4 class="title mb-4 mt-1"><strong>{{ $auction->seller->company_name }}</strong></h4>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <strong>Auction Number :</strong> {{$auction->id}} <br>
                                    <strong>Auction End Date :</strong> {{\App\Helpers\FormattedDate::format($auction->end_auction) }} <br>
                                    <strong>Business Type :</strong> {{$auction->seller->business_type}} <br>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <strong>Funding remaining:</strong> @if($auction->amount_funding_remaining >= 0 ) £ @money($auction->amount_funding_required-$po) @else Overfunded @endif
                                    <br>
                                    <strong>Bid Amount:</strong> £ @money( auth()->user()->getBidAmount($auction))
                                    <br>
                                    @if($auction->status == 'Ended')
                                    <strong>Accepted Bid Amount:</strong> £ @money( auth()->user()->getAcceptedBidAmount($auction))
                                    @endif
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-5 right border-left border-white">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="row h-100">
                            <div class="col-12 py-3">
                              <p class="text-center text-uppercase title">
                                MY ROI
                                <span class="text-center value">
                                  @forelse($auction->bids as $bid)
                                    @if($bid->user_id == auth()->user()->id)
                                      {{ number_format((float)$bid->bid_discount, 2, '.', '')  }} %
                                    @else

                                    @endif
                                  @empty
                                  @endforelse
                                  
                                  {{-- {{$auction->max_discount}} --}}
                              </span>
                              </p>
                            </div>
                            <div class="col-12 py-3">
                              <p class="text-center text-uppercase title">
                                bids placed
                                <span class="text-center value">{{$auction->bids->count()}}</span>
                              </p>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6  border-left border-white bar-progress py-3">
                          <p class="text-uppercase title ">
                            Auction Time Left
                              @if( $auction->time_left_before_end  > 0 )
                                <span class="text-center value my-2">
                                  {{ $auction->time_left_before_end }}
                                </span>
                                days
                              @elseif( $auction->time_left_before_end == 0 )
                                <span class="text-center value my-2">
                                  Last<br>Day
                                </span>
                              @else
                                <span class="text-center value my-2 ">Ended</span>
                              @endif
                          </p>
                          <div class="progress my-2">
                            <div class="progress-bar" role="progressbar" style="width: {{$auction->time_left_percentage}}%" aria-valuenow="{{$auction->time_left_percentage}}" aria-valuemin="0" aria-valuemax="100">
                              <span class="sr-only">{{$auction->time_left_percentage}}%</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 border-top border-white align-self-end bottom">
                      <p class="f-14 my-2">
                          <strong>
                            Status:
                          </strong>
                            @if(auth()->user()->getPositionInLeaderBoard($auction) == 1 )
                             You have the winning bid in the Auction leaderboard.
                            @else
                              {{-- Your Bid entry has been raised to {{ auth()->user()->getPositionInLeaderBoard($auction) }} in the Auction leaderboard. --}}
                              Your bid entry has been placed at rank {{ auth()->user()->getPositionInLeaderBoard($auction) }} in leaderboard.
                            @endif
                      </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</a>
