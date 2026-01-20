@extends('layouts.admin.page')
@section('content')

  <div class="row">
    <div class="col col-lg-10">

      <h4 class="text-uppercase mt-2">
        BUYERS
      </h4>
    </div>

    <div class="col col-lg-2">

      @role("seller")

          <a href="{{ url('buyers/create')  }}" class="btn btn-outline-primary float-right m-0 px-4 btn-block mt-3">
              <i class="fa fa-plus ml-1"></i>
              ADD
          </a>
          @endrole
    </div>
  </div>
  <hr>
  <div class="row">
      <div class="col-4 col-md-3 col-lg-8">
          <!-- <ul class="nav filter">
              <li class="nav-item">
                  <a class="nav-link active" href="{!! url('buyers') !!}">All</a>
              </li>
              {!! $buyers->links() !!}

          </ul> -->
          <div class="input-group form-sm pl-0">
                <input class="form-control my-0 py-1" type="text" name="title" id="full_name" value="" aria-describedby="emailHelp" placeholder="Search Buyer">
                <div class="input-group-append">
                  <button class="input-group-text lighten-2" type="submit"><i class="fa fa-search text-grey"
                      aria-hidden="true"></i></button>
                </div>
              </div>
      </div>
      <!-- <div class="col-4 col-md-3 col-lg-2">
           <div class="form-group ">
                <a data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"
                class="btn m-0 py-2 btn-outline-secondary">
                Filter <i class="zmdi zmdi-tune"></i>
              </a>
            </div>
      </div> -->
      <div class="col-4 col-md-3 col-lg-2">
          <select name="orderBy" class="form-control pull-right float-right">
              <option value="">Select</option>
              <option value="title">Company Name - ASC</option>
              <option value="-title">Company Name - DESC</option>
          </select>
          
      </div>

      <table style="width: 90%; margin-left: 16px;margin-top: 25px;">
        <thead>
          <tr>
            <th><strong>Ref.No.</strong></th>
            <th><strong>Name</strong></th>
            <th><strong>Email</strong></th>
            <th><strong>Phone number</strong></th>
            <th><strong>Company name<strong></th>
            <th><strong>Business Type</strong></th>
            <th><strong>Status<strong></th>
              @if(auth()->user()->user_type === 1)
                <th style="text-align: center;"><strong>Actions<strong></th>
              @endif
          </tr>
      </thead>

  </div>


    <div class="buyers__sections">

        @empty($buyers)
            NOT FOUND
        @endempty

        @role("admin")
             <tbody>
         
                @include('components.buyers.buyer')
                
         
          </tbody>

        @endrole

        @role("seller")
          @include('components.buyers.buyer')
        {{-- @foreach($buyers as $buyer)
            @include('components.buyers.seller_buyer')
            <br>
        @endforeach --}}

        @endrole


    </div>


@endsection
