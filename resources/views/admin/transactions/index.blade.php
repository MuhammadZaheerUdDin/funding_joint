<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 05/11/2018
 * Time: 10:45
 */
?>

@extends('layouts.admin.page')
@section('adhoc-btn')
  <button class="btn float-right" data-toggle="modal" data-target="#adhoc_transaction" style="margin-top: 5px !important;padding: 0.4rem 1.6rem;background-color:#212121;">
    <i class="fa fa-download"></i> ADHOC Transaction
  </button>
@endsection

@section('content')
    
<div class="row">
  <div class="col-12">
    <ul class="nav filter right float-right">
      <li class="nav-item">
          <a class="nav-link @if($transactionType == '') active @endif " href="{{route('admin.transactions')}}">All</a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($transactionType == 'credit') active @endif "" href="?TransactionType=credit">Deposits</a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if($transactionType == 'debit') active @endif "" href="?TransactionType=debit">Withdrawals</a>
      </li>
    </ul>
    <h4 class="text-uppercase">Transactions</h4>
    <hr>
  </div>
  <div class="col-12">
    <form method="get" class="row">
      <div class="col-12 col-md-8 mb-2 mb-md-0 ">
        <div class="input-group form-sm pl-0">
          <input class="form-control my-0 py-1" type="text" name="title" id="full_name" aria-describedby="emailHelp" placeholder="Search Users">
          <div class="input-group-append">
            <button class="input-group-text lighten-2" type="submit"><i class="fa fa-search text-grey"
                aria-hidden="true"></i></button>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-2">
        <div class="form-group ">
          <a data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"
          class="btn m-0 py-2 btn-outline-secondary">
          Filter <i class="zmdi zmdi-tune"></i>
          </a>
        </div>
      </div>

      <div class="col-6 col-md-2">
        <select name="SortBy" id="" class="custom-select mb-2 mr-sm-2 mb-sm-0">
            <option @if(app('request')->input('SortBy') == 'name') selected @endif value="name">Name A-Z</option>
            <option @if(app('request')->input('SortBy') == 'amount') selected @endif value="amount">Amount</option>
            <option @if(app('request')->input('SortBy') == 'oldest') selected @endif value="oldest">Date ASC</option>
            <option @if(app('request')->input('SortBy') == 'recent') selected @endif value="recent">Date DESC</option>
            <option @if(app('request')->input('SortBy') == 'status') selected @endif value="status">Status</option>
        </select>
      </div>


    <div class="col-12 collapse multi-collapse" id="multiCollapseExample1">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group row">
              <label for="example-date-input" class="col-3">Date From</label>
              <div class="col-9">
                <input class="form-control flatpickr" type="date" name="dateFrom" value="">
              </div>
            </div>
          </div>
          <div class="col-md-4">
              <div class="form-group row">
                  <label for="example-date-input" class="col-3">Type</label>
                  <div class="col-9">
                      <select name="transactionType" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                          <option  @if(app('request')->input('transactionType') == 'all') selected @endif value="all" selected>All</option>
                          <option  @if(app('request')->input('transactionType') == 'debit') selected @endif value="deposit">Deposits</option>
                          <option  @if(app('request')->input('transactionType') == 'credit') selected @endif value="withdraw">Withdrawals</option>
                      </select>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="form-group row">
                  <label for="example-date-input" class="col-3">Amount</label>
                  <div class="col-9">
                      <select name="TransactionAmount" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                          <option @if(app('request')->input('TransactionAmount') == 'all') selected @endif value="all">Choose between</option>
                          <option @if(app('request')->input('TransactionAmount') == '1000') selected @endif  value="1000">&pound;0 - 1000</option>
                          <option @if(app('request')->input('TransactionAmount') == '10000') selected @endif  value="10000">&pound;1000 - 10,000</option>
                          <option @if(app('request')->input('TransactionAmount') == '50000') selected @endif  value="50000">&pound;10,000 - 50,000</option>
                          <option @if(app('request')->input('TransactionAmount') == '60000') selected @endif  value="60000">&pound;50,000+</option>
                      </select>
                  </div>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group row">
              <label class="col-3">Date To</label>
              <div class="col-9">
                <input class="form-control flatpickr" name="dateFrom" type="date" value="{{app('request')->input('dateFrom')}}">
              </div>
            </div>
          </div>
          <div class="col-md-4">
              <div class="form-group row">
                  <label for="example-date-input" class="col-3">Status</label>
                  <div class="col-9">
                      <select name="auctionstatus" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                          <option value="all" selected>All</option>
                          <option value="live">Live</option>
                          <option value="pending">Pending</option>
                          <option value="complete">Complete</option>
                      </select>
                  </div>
              </div>
          </div>

          <div class="col-md-4">
              <div class="form-group row">
                  <label for="example-date-input" class="col-3">Transaction</label>
                  <div class="col-9">
                      <select name="TransactionSort" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                          <option @if(app('request')->input('TransactionSort') == 'all') selected @endif value="all">Choose</option>
                          <option @if(app('request')->input('TransactionSort') == 'Internal') selected @endif  value="Internal">Internal</option>
                          <option @if(app('request')->input('TransactionSort') == 'External') selected @endif  value="External">External</option>
                          
                      </select>
                  </div>
              </div>
          </div>

          <div class="col-md-4">
            <div class="form-group row">
              <label class="col-3">Aution No</label>
              <div class="col-9">
                <input class="form-control" name="auctionId" type="text" value="{{app('request')->input('auctionId')}}">
              </div>
            </div>
          </div>
        </div>
        <div class="row pb-3">
          <div class="col-6 col-md-8 form-inline pb-0 pb-md-3">
          </div>
          <div class="col-6 col-md-4 text-right align-self-end align-self-md-start">
            <button class="btn btn-secondary my-0 py-2 " type="submit">APPLY</button>
          </div>
        </div>
      </div>
  </form>

</div>
</div>

 

    @if($transactions)
        @component('components.admin.transaction',['transactions'=>$transactions]) @endcomponent
    @else
        No transactions found
    @endif

        {{$transactions->links()}}
    <!-- Modal -->
    <div class="modal fade" id="adhoc_transaction" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelTitleId">Add a new transaction</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                {!! Form::open(['url'=>route('admin.transactions.create')]) !!}
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label for="user">Find User</label>
                            <select name="user" id="users" class="w-100 form-control">
                                <option value="">Please Select a user</option>
                            </select>
                        </div>
                        <input type="hidden" id="user_type">
                        <div class="form-group">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Account No: <span class="ajax_bank_number"></span></li>
                                <li class="list-group-item">Sort Code: <span class="ajax_sort_code"></span></li>
                                <li class="list-group-item">Reference: <span class="ajax_reference"></span></li>
                            </ul>
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="inlineRadio1"
                                       value="debit">
                                <label class="form-check-label" for="inlineRadio1">Debit</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type" id="inlineRadio2"
                                       value="credit">
                                <label class="form-check-label" for="inlineRadio2">Credit</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="user">Auction</label>
                            <select name="auction_id" id="auction_list" class="w-100 form-control">
                                <option value="">Please Select a auction</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" class="form-control">
                        </div>
                        <input type="hidden" name="reference" value="">
                        <textarea name="description" class="form-control" placeholder="Comment" id="" cols="30"
                                  rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

{{-- @section('fixed-content')
    <div class="bg-dark sticky-bar">
       <div class="row">
           <div class="col align-self-end profile__admin__actions">
               <button class="btn btn-outline-white float-right" data-toggle="modal" data-target="#adhoc_transaction"><i
                           class="fa fa-download"></i> ADHOC Transaction
               </button>
           </div>
       </div>
    </div>
@endsection --}}
