@extends('layouts.admin.page')
@section('content')

  <div class="row">
    <div class="col col-lg-10">

      <h4 class="text-uppercase mt-2">
        {{$title}}
      </h4>
    </div>

    <div class="col col-lg-2">

      
    </div>
  </div>
  <hr>
  <div class="row">
      <div class="col-4 col-md-3 col-lg-8">
          
          
      </div>
      <!-- <div class="col-4 col-md-3 col-lg-2">
           <div class="form-group ">
                <a data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"
                class="btn m-0 py-2 btn-outline-secondary">
                Filter <i class="zmdi zmdi-tune"></i>
              </a>
            </div>
      </div> -->
      

      <table style="width: 90%; margin-left: 16px;margin-top: 25px;">
        <thead>
          <tr>
            @if(auth()->user()->user_type === 1 || auth()->user()->user_type === 3)
              <th style="text-align: left;padding-left: 10px;"><strong>Seller<strong></th>
            @endif
            <th><strong>Auction</strong></th>
            <th><strong>Buyer</strong></th>
            <th><strong>Buyer Email</strong></th>
            <th><strong>Buyer Phone Number</strong></th>
            <th><strong>Due Date<strong></th>
            <th><strong>Overdue Amount (£)</strong></th>
            <th><strong>Due By (days)<strong></th>
              
          </tr>
      </thead>

  </div>


    <div class="buyers__sections">
        <tbody>
            @include('components.buyers.due')
        </tbody>
        
        {{-- @empty($allBuyer)
            NOT FOUND
        @endempty --}}

        {{-- @role("admin")
              <tbody>
                  @include('components.buyers.due')
              </tbody>

        @endrole --}}

        {{-- @role("seller")
          @include('components.buyers.due')
            @foreach($buyers as $buyer)
              @include('components.buyers.seller_buyer')
              <br>
            @endforeach
        @endrole --}}


    </div>


@endsection
