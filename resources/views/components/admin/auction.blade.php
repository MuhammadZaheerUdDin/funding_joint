<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 07/11/2018
 * Time: 12:52
 */

$po = 1;
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

   //print_r($auction->id);die;
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


/*.custom-select select {
  max-width: 100%!important;
  width: 100%!important;
  right: auto!important;
  direction: ltr!important;
  padding-left: 0!important;
}*/


</style> 


<div class="comman-card admin my-3">

    <div class="comman-card__header">
      <!-- <div class="row">
        <span class="col left">
          £ @money($auction->amount_total_funded)
        </span>
            <span class="col right">
          £ @money($auction->amount_funding_required)
        </span>
      </div> -->
    </div>

    <div class="card comman-card__content">
     
      <div class="col-12 card-body">
       
       
        <div class="row full border-bottom align-items-md-center  py-2 ">
         <!--  <div class="col-12 col-md-4 title py-2 py-md-1">
            <i class="shield s"></i>
            <h4><strong>{{$auction->seller->full_name}}</strong></h4>
            <h5><strong>{{$auction->seller->company_name}}</strong></h5>
          </div> -->
          <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
             <a href="{{url('auctions')}}/{!! $auction->id !!}">
            <p class="value text-left">
              Auction No.
              <strong>{{$auction->id}}</strong>
            </p>
          </a>
          </div>
          <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
            <p class="value text-left">
              Seller
              <strong>{{$auction->seller->company_name}}</strong>
            </p>
          </div>
          <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
            <p class="value text-left">
              Buyer
              <strong>{{$auction->buyer->company_name}}</strong>
              <!-- <strong>{{$auction->buyer->first_name}}&nbsp;{{$auction->buyer->last_name}}</strong> -->
            </p>
          </div>
          <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
            <p class="value text-left" style="float: left;width: 100px;">
              Status
               @if($auction->status)
                <strong>{{$auction->status}}</strong>
              @else
                <strong>Pending</strong>              
              @endif
            </p> 
            <div class="text-right" style="float: right;width: 43px;">
            <select class="custom-select" dir="ltr" style=" width:18%; background-size: 50%; padding-left: 17px;cursor: pointer;background-image:url({{asset('/assets/img/icon/menu-alt.png')}});" onmousedown="this.value='';" auction-id = "{{ $auction->id }}">
                <option id-value="declineAuctionModal{!! $auction->id !!}" value="1">Approve </option>
                <option id-value="declineAuctionModal{!! $auction->id !!}" value="2">Decline </option>
             <!--  <option class="invoice_approve" data-auction="{{$auction->id}}" data-toggle="modal" data-target="#"value="3">Approve Invoice</option>  -->
           <!--    <option id-value="creditModal-auction-{{$auction->id}}" value="4">Release</option> -->
            </select>
          </div> 
          
          <!--  <button type="button" class="btn btn-sm m-0 btn-primary {{ $auction->approved == 1  ? 'disabled' :'' }}" data-toggle="modal" data-target="#approveAuctionModal{!! $auction->id !!}">Approve </button> -->
          </div>
        </div>
          
        <div class="row full border-bottom align-items-md-center py-2 ">
          <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
            <p class="value text-left">
              Created date:
              <strong>{{\App\Helpers\FormattedDate::format($auction->created_at)}}</strong>
            </p>
          </div>
          <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
            <p class="value text-left">
              Auction end date:
              @if($auction->end_auction)
                <strong>{{\App\Helpers\FormattedDate::format($auction->end_auction)}}</strong>
              @else
                <strong>...</strong>
              @endif
            </p>
          </div>
          <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
            <p class="value text-left">
              Expected invoice issue date:
              <strong>{{\App\Helpers\FormattedDate::format($auction->expected_invoice_issue_date)}}</strong>
            </p>
          </div>
          <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
             <p class="value text-left">
              Repayment due date:
              <strong>{{\App\Helpers\FormattedDate::format($auction->date_repayment_due)}}</strong>
            </p>
           <!--  <div class="button-group">
              <a href="auctions/{!! $auction->id !!}#auction-comments" class="btn btn-sm btn-outline-black mb-2 mb-md-0"><i class="fa fa-comments"></i></a>
              <a href="auctions/export/{!! $auction->id !!}" class="btn btn-sm btn-outline-black mb-2 mb-md-0"><i class="fa fa-download"></i><span class="d-none d-md-inline">EXPORT</span></a>
            </div> -->
          </div>
        </div>

        <div class="row full  align-items-md-center  py-2">
          <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
            <p class="value text-left">
              Funding required:
              <strong>{{$auction->amount_funding_required}}</strong>
            </p>
          </div>
          <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
            <p class="value text-left">
              Funding Remaining:
              <strong>{{($auction->amount_funding_remaining > 0)?$auction->amount_funding_remaining:0}}</strong>
            </p>
          </div>
          <div class="col-lg-3 col-sm-3 col-md-6 col-xs-12">
            <p class="value text-left">
              Bids placed:
              <strong>{{$auction->bids->count()}}</strong>
            </p>
          </div>
          <div class="col">
            <p class="value text-left">
              Time Left:
              @if( $auction->time_left_before_end  > 0 )
              <span><strong>{{ $auction->time_left_before_end }}</strong>days</span>
              @elseif( $auction->time_left_before_end == 0 )
              <span><strong>Last<br>Day</strong></span>
              @elseif( $auction->time_left_before_end == -2 )
                <span class="notstarted"><strong>Not Started</strong></span>
              @else
              <span class="empty"><strong>Ended</strong></span>
              @endif
            </p>
          </div>
          <div class="col-6 py-md-1">
            <div class="button-group-text">
             <!--  <p class="value text-left">
                PO:
                <strong><a href="{{route('po-link',['id' => $auction->id])}}">1 file</a></strong>
              </p> -->
              @if($auction->approved != 1)

              <div class="float-right float-md-right">
               <!--  <button type="button" class="btn btn-sm m-0 btn-primary {{ $auction->approved == 1  ? 'disabled' :'' }}" data-toggle="modal" data-target="#approveAuctionModal{!! $auction->id !!}">
                  Approve
                </button>

                <button type="button" class="btn btn-sm m-0 btn-outline-dark {{ $auction->approved == 2  ? 'disabled' :'' }}" data-toggle="modal" data-target="#declineAuctionModal{!! $auction->id !!}">
                  Decline
                </button> -->

              
                <div class="modal fade approve" id="approveAuctionModal{!! $auction->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-center" id="exampleModalLabel">Approve Auction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">

                        <p class="text-center">
                          Are you sure you want to approve this auction? Approving this auction will push it live on the marketplace.
                        </p>

                      </div>
                      <div class="modal-footer">


                        <button type="button" class="btn btn-secondary btn-outline-black" data-dismiss="modal">
                          Cancel
                        </button>


                        <form action="{{ url("auctions/{$auction->id}/approve") }}" method="POST">
                          @csrf

                          <input type="hidden" name="id" value="{!! $auction->id !!}">

                          <button type="submit" class="btn btn-primary">
                            Approve Auction
                          </button>

                        </form>

                      </div>
                    </div>
                  </div>
                </div>

              
                <div class="modal fade" id="declineAuctionModal{!! $auction->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reason for declining </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <form action="{{ url("auctions/{$auction->id}/decline") }}" method="POST">
                        <div class="modal-body">


                          <textarea name="message" class="form-control"></textarea>

                          @csrf
                          <input type="hidden" name="id" value="{!! $auction->id !!}">
                        </div>

                        <div class="modal-footer">

                          <button type="button" class="btn btn-outline-dark pull-left" data-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary ">Decline</button>

                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              @endif


            </div>
          </div>

         <!--  <div class="col-6 col-md-3">
            <div class="button-group-text">
              <p class="value text-left">
                Invoice:
                <strong>...</strong>
              </p>
              <span class="ml-auto float-right float-md-left2">
                <button type="button" class="btn btn-sm btn-primary invoice_approve" data-auction="{{$auction->id}}" data-toggle="modal" data-target="#">Approve</button>
              </span>


            </div>
          </div>
 -->
         <!--  <div class="col-6 ">
            <div class="button-group-text">
              <p class="value text-left">
                Funds:
                <strong>...</strong>
              </p>
              <span class="ml-auto float-right float-md-left">
                <button type="button" class="btn btn-sm btn-primary" data-target="#creditModal-auction-{{$auction->id}}" data-toggle="modal">Release</button>
              </span>
            </div>
          </div> -->
<!-- 
          <div class="col-6 col-md-3 disable">
            <div class="button-group-text">
              <p class="value text-left">
                Repayment:
                <strong>...</strong>
              </p>

              <span class="ml-auto float-right float-md-lefts">
                <button type="button" class="btn btn-sm btn-primary confirm-repayment" data-auction="{{$auction->id}}" data-toggle="modal">Confirm</button>
              </span>
            </div>
          </div> -->
        </div>
      </div>
      <!-- <div class="progress custom">
        <div class="progress-bar" aria-valuenow="50%" aria-valuemin="0" aria-valuemax="1000"
             progressbar="1000" progress="{{ $auction->total_funded_percentage }}" role="progressbar" style="width:{{ $auction->total_funded_percentage }}%">
          <span>
            <span>
               {{ $auction->total_funded_percentage }}%
            </span>
          </span>
        </div>
      </div>   -->
      <div class="progress <?php echo $css?> full" >
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
           <!--  <div class="row test-auctions" style="margin-left:{{round($width)-8}}%; margin-top: -13px;">
                <div class="col">
                    <p class="text-left value small">
                        {{$title}}
                        <span>
                            £ @money(str_replace('-', '', $auction->amount_funding_required-$po))
                        </span>
                    </p>
                </div>            
            </div> -->
      <!-- <div class="card-footer border-top ">
          <div class="row">    
          </div>
      </div> -->
    </div>

</div>

<!-- release paymeasasasdnts Modal -->
<div class="modal fade" id="creditModal-auction-{{$auction->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
     aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content account__modal">
      <div class="modal-header">
        <h4 class="modal-title text-center" id="modelTitleId">RELEASE FUNDS TO SELLER</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <hr>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h3 class="account__modal__content__title">Seller Account details</h3>

              <div class="form-group">
                <label for="">Account No.</label>
                <input type="text" class="form-control" readonly value="{{$auction->seller->bankdetails->account_number}}">
              </div>

              <div class="form-group">
                <label for="">Sort Code</label>
                <input type="text" class="form-control" readonly value="{{$auction->seller->bankdetails->sort_code}}">
              </div>

              <div class="form-group">
                <label for="">Reference</label>
                <input type="text" class="form-control" readonly value="{{\App\Http\Controllers\Admin\AdminTransactionsController::createReference(1)}}">
              </div>
            </div>

            <div class="col-md-6">
              {!! Form::open(['url'=>route('admin.transactions.payseller')]) !!}

              <div class="form-group">
                <label for="">Amount To Transfer (£)</label>
                <input type="text" name="amount" class="form-control" readonly value="{{\App\Helpers\WinningBids::transferAmountToSeller($auction->id)}}">
                <input type="hidden" name="seller" value="{{$auction->seller->user_id}}">
                <input type="hidden" name="auction_id" value="{{$auction->id}}">

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Transfer</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<!-- Stop Auction-->
<div class="modal fade" id="stopAuctionModal{!! $auction->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reason for stop </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url("auctions/{$auction->id}/stop") }}" method="POST">
        <div class="modal-body">
          <textarea name="message" class="form-control"></textarea>
          @csrf
          <input type="hidden" name="id" value="{!! $auction->id !!}">
        </div> 
      </form>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">  
  $('.custom-select').on('change',function(){
    value = $(this).val();
    if(value == 1)
    {
       var id = $(this).attr('auction-id');
       $('#approveAuctionModal'+id).modal('show');
    }
    if(value == 2)
    {
      var id = $(this).attr('auction-id');
      $('#declineAuctionModal'+id).modal('show');
    }
    if(value == 3)
    {
       var id = $(this).attr('auction-id');
      $.ajax({
            type: "GET",
            url: 'http://3.10.169.59/funding_joint/public/auctions/' + id + '/approve_invoice',
            data: { id: id },
            success: function success(data) {
                console.log(data);
                setTimeout(function(){ alert(data.msg); }, 2000);
                
               
            },
            error: function error(_error3) {
                console.log(_error3);
            }
        });
    }
    if(value == 4)
    {
       var id = $(this).attr('auction-id');
      $('#creditModal-auction-'+id).modal('show');
    }
  });
</script>