<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 30/10/2018
 * Time: 09:52
 */
?>

@extends('layouts.admin.page')

@section('content')


      <div class="dashboard">
        
        <h4 class="text-uppercase">Seller Dashboard</h4>
        <hr>

        <div class="row row-eq-height">
          <div class="col-md-6">
            <div class="row ">
              <div class="col-md-4">
                <h4>Overall Funding Achieved</h4>
              </div>
              <div class="col-md-6 ml-auto ">
                <div class="progress-circle">
                  <div class="progress-circle-container">
                    <svg viewBox="0 0 36 36" class="circular-chart">
                      <path class="circle-bg"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                      <path class="circle-white"
                        stroke-dasharray="{{'0'}}, 100"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                      <path class="circle"
                        stroke-dasharray="{{'100'}}, 100"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                    </svg>
                    <div class="percentage">
                      <span class="empty"><strong>£ @money($total_funding_achieved)</strong></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 border-left">
            <div class="row">
              <div class="col-md-6">
                <h4>Overall Collection Fees</h4>
                <div class="roi-buttons btn-group btn-group-sm" role="group" aria-label="Basic example">
                  {{-- <button type="button" class="btn btn-primary btn-sm">£</button>
                  <button type="button" class="btn btn-primary btn-sm">%</button> --}}
                </div>
              </div>
              <div class="col-md-6">
                <div class="progress-circle">
                  <div class="progress-circle-container">
                    <svg viewBox="0 0 36 36" class="circular-chart">
                      <path class="circle-bg"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                      <path class="circle-white"
                        stroke-dasharray="{{$overall_discount}}, 100"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                      <path class="circle"
                        stroke-dasharray="{{$overall_discount}}, 100"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                    </svg>
                    <div class="percentage">
                      <span class="empty"><strong>{{$overall_discount}}%</strong></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>

        <div class="row row-eq-height">
            @foreach($cards as $card)
                <div class="col-{!! $card->width !!} float-left mb-3">
                    @component('components.dashboardCard')
                    @slot('link')
                      {!! $card->link !!}
                    @endslot
                      @slot('title')
                            {!! $card->title !!}
                        @endslot
                        @slot('content')
                            {!! $card->value !!}
                        @endslot
                    @endcomponent
                </div>
            @endforeach
        </div>
      </div>
  </div>


@endsection
