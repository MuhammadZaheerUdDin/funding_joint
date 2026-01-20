<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 07/11/2018
 * Time: 12:48
 */
?>
@extends('layouts.admin.page')

@section('content')


<div class="row">
  <div class="col-12">
    <ul class="nav filter right float-right">
      <li class="nav-item">
          <a class="nav-link @if( app('request')->input('AuctionStatus')==="all") active @endif " href="{{route('admin.auctions')}}">All</a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if( app('request')->input('AuctionStatus')==="live") active @endif" href="?AuctionStatus=live">Live</a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if( app('request')->input('AuctionStatus')==="pending") active @endif" href="?AuctionStatus=pending">Pending</a>
      </li>
      <li class="nav-item">
          <a class="nav-link @if( app('request')->input('AuctionStatus')==="complete") active @endif" href="?AuctionStatus=complete">Complete</a>
      </li>
    </ul>
    <h4 class="text-uppercase">Auctions</h4>
    <hr>
  </div>
  <div class="col-12">
    <form method="get" class="row">
      <div class="col-12 col-md-8 mb-2 mb-md-0 ">
        <div class="input-group form-sm pl-0">
          <input class="form-control my-0 py-1" type="text" name="auctionCompanyName" id="full_name" aria-describedby="emailHelp" placeholder="Search Company Name">
          <div class="input-group-append">
            <button class="input-group-text lighten-2" type="submit"><i class="fa fa-search text-grey"
                aria-hidden="true"></i></button>
          </div>
        </div>
      </div>
      <div class="col-6 col-md-2">
        <div class="form-group ">
          <a data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"
          class="btn m-0 px-3 btn-outline-secondary">
          Filter <i class="zmdi zmdi-tune"></i>
        </a>
      </div>
    </div>
    <div class="col-6 col-md-2">
        <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="SortBy">
            <option @if( app('request')->input('SortBy')==="recent") selected
                    @endif value="recent">Most Recent
            </option>
            <option @if( app('request')->input('SortBy')==="oldest") selected
                    @endif value="oldest">Oldest First
            </option>
        </select>
    </div>
    <div class="col-12 collapse  multi-collapse" id="multiCollapseExample1">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group row">
              <label  class="col-3">Date From</label>
              <div class="col-9">
                <input  class="form-control" type="date" name="dateFrom" value="{{ app('request')->input('dateFrom') }}">
              </div>
            </div>
          </div>
          <div class="col-md-4">
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
          <div class="col-md-4">
            <div class="form-group row">
              <label for="example-date-input" class="col-3">Credit Limit</label>
              <div class="col-9">
                <select name="CreditLimit" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                  <option @if( app('request')->input('CreditLimit')==="all") selected @endif value="all">Choose...</option>
                  <option @if( app('request')->input('CreditLimit')==="1000") selected @endif value="1000">&pound;0 - 1000</option>
                  <option @if( app('request')->input('CreditLimit')==="10000") selected @endif value="10000">&pound;1000 - 10,000</option>
                  <option @if( app('request')->input('CreditLimit')==="50000") selected @endif value="50000">&pound;10,000 - 50,000</option>
                  <option @if( app('request')->input('CreditLimit')==="60000") selected @endif value="60000">&pound;50,000+</option>
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
                <input class="form-control flatpickr" name="dateTo" type="date" placeholder="Date To" value="{{ app('request')->input('dateTo') }}">
              </div>
            </div>
          </div>
          <div class="col-md-4">
              <div class="form-group row">
                  <label for="example-date-input" class="col-3">Status</label>
                  <div class="col-9">
                      <select name="AuctionStatus" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                          <option @if( app('request')->input('AuctionStatus')==="all") selected @endif value="all" selected>All</option>
                          <option @if( app('request')->input('AuctionStatus')==="live") selected @endif value="live">Live</option>
                          <option @if( app('request')->input('AuctionStatus')==="pending") selected @endif value="pending">Pending</option>
                          <option @if( app('request')->input('AuctionStatus')==="complete") selected @endif value="complete">Complete</option>
                      </select>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
            <div class="form-group row">
              <label  class="col-3">Experian Rating</label>
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
        </div>
        <div class="row pb-3">
          <div class="col-6 col-md-8 form-inline pb-0 pb-md-3">
            <div class="form-check mb-2 mr-sm-2 mb-sm-0">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" value="true" name="AuctionWithPO" @if( app('request')->input('AuctionWithPO')) checked @endif> P.O Document
              </label>
            </div>
            <div class="form-check mb-2 mr-sm-2 mb-sm-0">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" value="true" name="AuctionWithInvoice" @if( app('request')->input('AuctionWithInvoice')) checked @endif> Invoice
              </label>
            </div>
          </div>
          <div class="col-6 col-md-4 text-right align-self-end align-self-md-start">
            <button class="btn btn-secondary my-0 py-2 " type="submit">Refresh</button>
          </div>
        </div>
      </div>
  </form>
</div>
</div>




@forelse($auctions  as $auction)
    @component('components.admin.auction',['auction'=>$auction]) @endcomponent
@empty
    <div class="alert alert-warning" role="alert">
        <strong>No auctions found</strong>
    </div>
@endforelse


    
@endsection

