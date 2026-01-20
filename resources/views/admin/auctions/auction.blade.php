@extends('layouts.admin.page')
@section('content')
<div class="comman-card admin my-3">

    <div class="comman-card__header">
      <div class="row">
        <span class="col left">
          £ @money($auction->amount_total_funded)
        </span>
            <span class="col right">
          £ @money($auction->amount_funding_required)
        </span>
      </div>
    </div>

    <div class="card comman-card__content">
      <div class="progress custom">
        <div class="progress-bar" aria-valuenow="50%" aria-valuemin="0" aria-valuemax="1000"
             progressbar="1000" progress="{{ $auction->total_funded_percentage }}" role="progressbar" style="width:{{ $auction->total_funded_percentage }}%">
          <span>
            <span>
               {{ $auction->total_funded_percentage }}%
            </span>
          </span>
        </div>
      </div>
      <div class="col-12 card-body">
       
        <a href="{!! url('auctions/approve/') !!}/{!! $auction->id !!}">
        <div class="row full border-bottom align-items-md-center  py-2 ">
          <div class="col-12 col-md-4 title py-2 py-md-1">
            <i class="shield s"></i>
            <h4><strong>{{$auction->seller->full_name}}</strong></h4>
            <h5><strong>{{$auction->seller->company_name}}</strong></h5>
          </div>
          <div class="col">
            <p class="value text-left">
              Expected Invoice Issue Date:
              <strong>{{\App\Helpers\FormattedDate::format($auction->expected_invoice_issue_date)}}</strong>
            </p>
          </div>
          <div class="col">
            <p class="value text-left">
              Date Repayment Due:
              <strong>{{\App\Helpers\FormattedDate::format($auction->date_repayment_due)}}</strong>
            </p>
          </div>
          <div class="col">
            <p class="value text-left">
              Auction End Date:
              <strong>{{\App\Helpers\FormattedDate::format($auction->end_auction)}}</strong>
            </p>
          </div>
        </div>
        </a>
        <div class="row full border-bottom align-items-md-center py-2 ">
          <div class="col-12 col-md-4 py-2 py-md-1">
            <p class="value text-left">
              Auction Number:
              <strong>{{$auction->id}}</strong>
            </p>
          </div>
          <div class="col">
            <p class="value text-left">
              Buyer:
              <strong>{{$auction->buyer->company_name}}</strong>
            </p>
          </div>
          <div class="col">
            <p class="value text-left">
              Status:
              <strong>{{$auction->status}}</strong>
            </p>
          </div>
          <div class="col">
            <div class="button-group">
              <a href="auctions/{!! $auction->id !!}#auction-comments" class="btn btn-sm btn-outline-black mb-2 mb-md-0"><i class="fa fa-comments"></i></a>
              <a href="auctions/export/{!! $auction->id !!}" class="btn btn-sm btn-outline-black mb-2 mb-md-0"><i class="fa fa-download"></i><span class="d-none d-md-inline">EXPORT</span></a>
            </div>
          </div>
        </div>

        <div class="row full  align-items-md-center  py-2">
          <div class="col-6 py-md-1">
            <div class="button-group-text">
              <p class="value text-left">
                PO:
                <strong><a href="{{route('po-link',['id' => $auction->id])}}">1 file</a></strong>
              </p>
              @if($auction->approved != 1)
              <div class="float-right float-md-right">
                <button type="button" class="btn btn-sm m-0 btn-primary {{ $auction->approved == 1  ? 'disabled' :'' }}" data-toggle="modal" data-target="#approveAuctionModal{!! $auction->id !!}">
                  Approve
                </button>

                <button type="button" class="btn btn-sm m-0 btn-outline-dark {{ $auction->approved == 2  ? 'disabled' :'' }}" data-toggle="modal" data-target="#declineAuctionModal{!! $auction->id !!}">
                  Decline
                </button>

                <!-- Approve Modal -->
                <div class="modal fade" id="approveAuctionModal{!! $auction->id !!}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                <!-- Decline Modal -->
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

          <div class="col-6 col-md-3">
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

          <div class="col-6 ">
            <div class="button-group-text">
              <p class="value text-left">
                Funds:
                <strong>...</strong>
              </p>
              <span class="ml-auto float-right float-md-left">
                <button type="button" class="btn btn-sm btn-primary" data-target="#creditModal-auction-{{$auction->id}}" data-toggle="modal">Release</button>
              </span>
            </div>
          </div>

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
          </div>
        </div>
      </div>
      <div class="card-footer border-top ">
          {{$auction->updated_at->format('d/m/Y H:i:s')}} - {{$auction->status}}
      </div>
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
@endsection
