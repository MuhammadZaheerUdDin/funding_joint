@extends('layouts.admin.page')
@section('content')
  <div class="card form">
      <div class="card-header">
          <h3 class="container">CREATE NEW AUCTION</h3>
      </div>
      <div class="card-body">

          <div class="step-menu">
              <div class="row">
                  <div class="col-3 active-step"><a href="#">Step One</a></div>
                  <div class="col-3"><a href="#">Step Two</a></div>
                  <div class="col-3"><a href="#">Step Three</a></div>
                  <div class="col-3"><a href="#">Step Four</a></div>
              </div>
          </div>

          <div class="row">
              <div class="container add-a-buyer">
                  <p class="address-title">ADD A BUYER</p>
                  <p>Select a Buyer from the dropdown menu or create a new Buyer by clicking
                      on the button below and completing the registration process.</p>
              </div>
          </div>

          <div class="container">
              <div class="row">
                  <div class="col-md-6">Buyer name:</div>
                  <div class="col-md-6"></div>
              </div>
              <div class="row">
                  <div class="col-md-6 col-xs-12">

                      <select class="form-control select-buyer" name="title">
                          <option value="">Select a Buyer</option>
                          <option value="Mr">Buyer One</option>
                          <option value="Mrs">Buyer Two</option>
                          <option value="Ms">Buyer Three</option>
                      </select>
                  </div>
                  <div class="col-md-6">
                      <button type="button" class="btn btn-outline-dark create-button">CREATE
                          NEW BUYER</button>
                  </div>

              </div>
          </div>

          <div class="container">
              <button type="button" class="btn float-md-right register-next">NEXT</button>
          </div>

      </div>
  </div>



@endsection
