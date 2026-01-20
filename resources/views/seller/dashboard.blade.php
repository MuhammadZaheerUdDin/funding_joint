@extends('layouts.admin.page')
@section('content')

  <h2>Seller Dashboard</h2>
  <hr>
  <div class="row seller-dashboard row-eq-height">
    <div class="col-12 py-2 col-md-6">
      <div class="card cb h-100 py-4 text-center">
        <h5>Current Credit Limit</h5>
        <h3>£ @money($credit_limit)</h3>
      </div>
    </div>
    <div class="col-12 py-2 col-md-6">
      <div class="card cb h-100 py-4 text-center">
          <h5>Auctions newaring close</h5>
          <h3>16</h3>
      </div>
    </div>
    <div class="col-12 py-2 col-md-3">
      <a href="/notifications">
          <div class="card cb h-100 py-4 text-center">
              <h5>Notifications</h5>
              <h3>{{$notifications->count()}}</h3>
          </div>
      </a>
    </div>
    <div class="col-12 py-2 col-md-3">
      <a href="/repayments">
          <div class="card cb h-100 py-4 text-center">
              <h5>Repayments Due</h5>
              <h3>{{$notifications->count()}}</h3>
          </div>
      </a>
    </div>
    <div class="col-12 py-2 col-md-3">
      <a href="/repayments?overdue">
          <div class="card cb h-100 py-4 text-center">
              <h5>Repayments Overdue</h5>
              <h3>{{$notifications->count()}}</h3>
          </div>
      </a>
    </div>
    <div class="col-12 py-2 col-md-3">
      <a href="/my-auctions">
          <div class="card cb h-100 py-4 text-center">
              <h5>My Live Auctions</h5>
              <h3>{{$live_auctions->count()}}</h3>
          </div>
      </a>
    </div>
  </div>


@endsection
