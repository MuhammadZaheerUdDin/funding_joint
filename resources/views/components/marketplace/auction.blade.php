<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 30/10/2018
 * Time: 12:10
 */

//echo "<pre>";
    use App\Http\Controllers\MarketplaceController;
    $bids = $auction->bids()->with('investor')
            ->orderBy('roi', 'asc')
            ->orderBy('amount','desc')
            ->orderBy('created_at','asc')
            ->get();

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
    if(count($bid_profit) == 0){
            $roi_d                = $auction->getBeforeBidROI();
            $roi            = number_format((float)$roi_d, 2, '.', '');
            $maximum_discount     = $auction->maximum_discount_limit;
            $po_value             = $auction->total_amount_of_po;
            $d_roi                = $roi;   
    }
    elseif($po > $auction->amount_funding_required)
    {
      $sum = 0;
        foreach ($bids as $key => $value){
             $current_roi[] = $value->roi;
             $current_bid_amount[] = $value->amount;
             $current_profit[] = $value->getProfitAttribute();
               $sum+= $value->getValueOfPoAttribute();
               $list_po_value[] = $value->getValueOfPoAttribute();
               if($sum > $auction->amount_funding_required)
               {
                    break;
               }
        }

        $removed = array_pop($list_po_value);
        $partial_value = $auction->amount_funding_required - array_sum($list_po_value);

        array_push($list_po_value,$partial_value);

        // public static function update_lastest(&$array, $value){
        //   array_pop($array);
        //   array_push($array, $value);     
        // }

        $user_roi       = end($current_roi);
        $user_po_value    = $partial_value;
        $user_bid_amount  = round($user_po_value / (1 + $user_roi/100));
        App\Http\Controllers\MarketplaceController::update_lastest($current_bid_amount,$user_bid_amount);
        App\Http\Controllers\MarketplaceController::update_lastest($current_profit,$user_bid_amount);
        $total_bid_amount   = array_sum($current_bid_amount);
        $po_value           = array_sum($list_po_value);
        $user_profit    = $user_po_value - $user_bid_amount;
        $user_share_of_po   = round($user_po_value / $auction->total_amount_of_po);
        $current_main_roi_d = ($po_value - $total_bid_amount) * 100 / $total_bid_amount;
        $current_main_roi   = number_format((float)$current_main_roi_d, 2, '.', '');
        // $roi                    = $current_main_roi; KK20210823
        // $d_roi                  = $current_main_roi; KK20210823
        $po_value               = $auction->total_amount_of_po;
        $maximum_discount_d     = (( ($current_main_roi) / 100  )  / ( 1 + ($current_main_roi) / 100  ) * 100 ) ;
        $maximum_discount       = number_format((float)$maximum_discount_d, 2, '.', '');
        // Begin of KK20210823
        // Work out Average Collection Fee Percentage of All Bids...if other columns required...add to array $wanted_columns= array("first","second"..etc)
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
        // print("<pre>".print_r($bid_profit,true)."</pre>"); exit;
        // End of KK20210823

    }
    else{
        $total_amount           = $auction->getBidAmountTotal($auction->id);
        foreach ($total_amount as $key => $value) {
            $total_bid_amount   = $value->total_bid;
        }
        foreach ($bid_profit as $key => $value) {
            $profit[]           = $value->getProfitAttribute();
        }
        $total_profit           = array_sum($profit);
        $decimal_roi            = $auction->getBeforeBidROI();
        $d_roi                  = number_format((float)$decimal_roi, 2, '.', '');
        //$roi_d                  = $auction->maximum_discount_limit / 1 - $auction->maximum_discount_limit / 100;
        
        // Begin of KK20210720
        // $roi_d                  = $total_profit / $total_bid_amount * 100; // KK20210720
        // Work out Average Collection Fee Percentage of All Bids...if other columns required...add to array $wanted_columns= array("first","second"..etc)
        $input_array = $bid_profit;
        $wanted_columns = array ("bid_discount");
        $result = array_fill_keys ($wanted_columns, 0);

        foreach ($input_array as $row) 
            foreach ($wanted_columns as $column_name) 
                $result[$column_name] += $row[$column_name];

        $array_size = count ($input_array);
        foreach ($result as &$value)
            $value /= $array_size;
        $roi_d                  = $value; // KK20210720
        // print("<pre>".print_r($bid_profit,true)."</pre>"); exit;
        // End of KK20210720
        
        $roi                    = number_format((float)$roi_d, 2, '.', '');
         $po_value              = $auction->total_amount_of_po;
        $maximum_discount_d     = $roi / ( 1 + $roi / 100);
        $maximum_discount       = number_format((float)$maximum_discount_d, 2, '.', '');
    }
    if($auction->amount_funding_required>0)
      $total_funded_percentage = ($po/$auction->amount_funding_required) * 100;
    else
      $total_funded_percentage=0;
    
    if($total_funded_percentage < 100){
        if($total_funded_percentage == 0)
            $width = 5; 
        elseif($total_funded_percentage > 80 && $total_funded_percentage <= 100)
            $width = 70;
        else
            $width = $total_funded_percentage; 
        $title = 'Amount Remaining';
        $progressbar_percentage = $total_funded_percentage - 10;
        $slider_text = $total_funded_percentage;
        $css = 'custom';
    }elseif($total_funded_percentage == 100){
        $width = 70; 
        $title = 'Amount Remaining';
        $progressbar_percentage = $total_funded_percentage;
        $slider_text = $total_funded_percentage;
        $css = 'custom';
    }
    elseif($total_funded_percentage > 100){
        $width = 70; 
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

    // $max_roi    = ($auction->maximum_discount_limit) / (1 - ($auction->maximum_discount_limit/100)); // KK20210720
    $max_roi    = $auction->maximum_discount_limit; // KK20210720

    $max_roi_f  = number_format((float)$max_roi, 2, '.', '');
    
    $date1=date_create($auction->start_auction);
    $date2=date_create($auction->date_repayment_due);
    $diff=date_diff($date1,$date2);
    $investment_period =  $diff->format("%a");
                           
?>

<style type="text/css">
  p.value.small span {
    font-size: 12px;
    font-weight: bold;
  }
  span.test0 {
        left: 0px!important;
        padding: 4px 22px 0px 12px !important;
    }

   @media  (max-width: 1280px){
      .row.test-auction {
        margin-left: 50% !important;
    }

    .paddingb{
      padding: 0px 0px 0px 0px !important;
    }
}
</style>
<!-- // Begin KK20210720 -->
<!-- <div class="col-md-12 marketplace__item__auction__content "> Auction number:<strong> {{$auction->id}} </strong> </div>  -->
<!-- // End KK20210720 -->
<a href="{!! url('auctions') !!}/{!! $auction->id !!}" class="marketplace__item">
  <div class="marketplace__item__auction mb-3">
    <div class="marketplace__item__auction__card__header">
      <div class="row" style='<?php if($total_funded_percentage > 100 )echo "margin-right:".$margin_right."%;"?>'>
        <div class="col" style=" margin-bottom: -16px;">
            <p class="text-right value small">
                Funding Target
                <span>
                  £ @money($auction->amount_funding_required)
                </span>
            </p>
        </div> 
      </div>
    </div>
     <!-- <div class="row" style="margin-left:{{round($width)-4}}%">
          <div class="col">  
            <p class="text-left value small">
                    {{$title}}
                    <span>
                     £ @money(str_replace('-', '', $auction->amount_funding_required-$po))
            </span>
                </p> 
          </div>  
        </div> -->
    <div class="card">
      <div class="progress <?php echo $css?>  mb-4" >
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
              <span class="marketplace__item__auction__progress__bar__total__amount" style="right : 38px">
                  <span>
                      <!-- £ @money($auction->amount_total_funded) -->
                      {{round($slider_text)}}%
                  </span>
              </span>
            <?php } ?>
        </div>
        <?php if($total_funded_percentage > 100 ){?>
            <span class="marketplace__item__auction__progress__bar__total__amount" style="right: 38px;top: -4px;">
                <span style="top: -4px;font-size: 12px;height: 25px;">
                  <!-- £ @money($auction->amount_total_funded) -->
                {{round($slider_text)}}%
                </span>
            </span>
        <?php }?>
      </div>
       <div class="row test-auction" style="margin-left:{{round($width)-8}}%; margin-top: -13px;" >
        <div class="col">
            <p class="text-left value small">
                {{$title}}
                <span>
                    £ @money(str_replace('-', '', $auction->amount_funding_required-$po))
                </span>
            </p>
        </div>            
    </div>

      <div class="card-body" style="margin-top: -22px;">
        <div class="">
          <div class="col-md-12 marketplace__item__auction__content ">
            <h4 class="marketplace__item__auction__title"><b> {{ $auction->seller->company_name }}</b> </h4>
            <!-- <p> KK20210720
              Auction number:<strong> {{$auction->id}} </strong>
            </p> -->
           
           <!--  <p>
              Funding remaining:
              <span class="marketplace__funding__remaining__amount"> @if($auction->amount_funding_remaining >= 0 ) <strong>£ @money($auction->amount_funding_remaining) </strong> @else Overfunded @endif </span>
              <span class="float-right toggleFundsRemainingDisplayType"><i class="fa fa-percent"></i></span>
              <span class="marketplace__funding__remaining__percent d-none"><strong>{{round($auction->funds_remaining_percentage) >=0? round($auction->funds_remaining_percentage) .' %' :'Overfunded'}}</strong></span>
            </p> -->
            <p>
             Investment period:<strong>  
              {{$investment_period}} Days</strong>
            </p>
            <p>
              Experian rating :<strong> {{$auction->seller->experian_rating}} </strong>
              <span class="experianrating__color {{strtolower($auction->seller->experian_rating)}}"></span>
            </p>
          </div>
          <div class="col-md-12 marketplace__item__auction__content_bottom border-top">
            <div class="row">
                <div class="col-md-6 border-bottom">
                  <div class="row" style="height: 100%">
                    <div class="col-md-12 border-1 marketplace__item__auction__square border-bottom">
                      <div class="marketplace__item__auction__square__title badge-primary">
                        <!-- Begin of KK 20210720 -->
                        <!-- Current Discount Limit -->
                        Auction Number
                      </div>
                      <!-- <div class="marketplace__item__auction__square__count text-secondary"> -->
                      <div class="marketplace__item__auction__square__count badge-primary">
                      {{$auction->id}} 
                        <!-- @if($po == 0)
                          --
                        @else
                        {{$maximum_discount}}%
                        @endif -->
                        <!-- End of KK20210720 -->
                      </div>
                    </div>
                    <div class="col-md-12 border-1 marketplace__item__auction__square border-bottom">
                      <div class="marketplace__item__auction__square__title">
                        Max Collection Fee
                      </div>
                      <div class="marketplace__item__auction__square__count">
                        {{$max_roi_f}}%
                      </div>
                    </div>
                     <div class="col-md-12 border-1 marketplace__item__auction__square">
                      <div class="marketplace__item__auction__square__title">
                        Average Collection Fee
                      </div>
                      <div class="marketplace__item__auction__square__count">
                        @if($po == 0)
                          --
                        @else
                        {{$roi}}%
                        @endif
                      </div>
                    </div>
                   <!--  <div class="col-md-12 border-1 marketplace__item__auction__square">
                      <div class="marketplace__item__auction__square__title">
                        Bids Placed
                      </div>
                      <div class="marketplace__item__auction__square__count">
                        {{$auction->bids->count()}}
                      </div>
                    </div> -->
                  </div>
                </div>
                <div class="col-md-6 border-1 marketplace__item__auction__square border-left" style="padding: 0px 0px 0px 0px !important;">
                  <div class="marketplace__item__auction__square__count border-bottom">
                    <div class="marketplace__item__auction__square__title">
                       Bids Placed
                    </div>
                    <div class="marketplace__item__auction__square__count" style="margin-bottom: 6px;">
                        {{$auction->bids->count()}}
                    </div>
                  </div>
                  <div class="marketplace__item__auction__square__title" style="margin-top: 10px;">
                      Auction Time Left
                  </div>
                  <div class="marketplace__item__auction__square__count">
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
                            <?php //echo "<pre>";;print_r($auction);?>
                            @if( $auction->time_left_before_end  > 0 )
                            <span><strong>{{ $auction->time_left_before_end }}</strong>days</span>
                            @elseif( $auction->time_left_before_end == 0 )
                            <span><strong>Last<br>Day</strong></span>
                            @elseif( $auction->time_left_before_end == -2 )
                              <span class="notstarted"><strong>Not<br>Started</strong></span>
                            @else
                            <span class="empty"><strong>Ended</strong></span>
                            @endif
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</a>
