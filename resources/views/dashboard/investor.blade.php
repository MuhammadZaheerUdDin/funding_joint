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
        
        <h4 class="text-uppercase">Investor Dashboard</h4>
        <hr>

        <div class="row row-eq-height">
          <div class="col-md-6">
            <div class="row ">
              <div class="col-md-4 text-center text-sm-left">
                <h4>Total Amount Invested</h4>
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
                        stroke-dasharray="{{ $total_amount_invested_percentage }}, 100"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                      <path class="circle"
                        stroke-dasharray="{{ $total_amount_invested_percentage}}, 100"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                    </svg>
                    <div class="percentage">
                      <span class="empty"><strong> £ @money($total_amount_invested)</strong></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 border-left">
            <div class="row">
              <div class="col-md-6 text-center text-sm-left">
                <h4>Overall ROI Achieved</h4>
                <div class="roi-buttons btn-group btn-group-sm" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-primary btn-sm" id="btn_roi_amount">£</button>
                  <button type="button" class="btn btn-primary btn-sm" id="btn_roi_per">%</button>
                </div>
              </div>
              <div class="col-md-6">
                <div class="progress-circle" id="roi_amount">
                  <div class="progress-circle-container">
                    <svg viewBox="0 0 36 36" class="circular-chart">
                      <path class="circle-bg"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                      <path class="circle-white"
                        stroke-dasharray="{{$roi_value_in_per}}, 100"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                      <path class="circle"
                        stroke-dasharray="{{$roi_value_in_per}}, 100"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                    </svg>
                    <div class="percentage">
                      <span class="empty"><strong>£ {{$roi_value_in_pound}}</strong></span>
                    </div>
                  </div>
                </div>

                <div class="progress-circle" id="roi_per" style="display: none;">
                  <div class="progress-circle-container">
                    <svg viewBox="0 0 36 36" class="circular-chart">
                      <path class="circle-bg"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                      <path class="circle-white"
                        stroke-dasharray="{{$roi_value_in_per}}, 100"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                      <path class="circle"
                        stroke-dasharray="{{$roi_value_in_per}}, 100"
                        d="M18 2.0845
                          a 15.9155 15.9155 0 0 1 0 31.831
                          a 15.9155 15.9155 0 0 1 0 -31.831"
                      />
                    </svg>
                    <div class="percentage">
                      <span class="empty"><strong>{{$roi_value_in_per}} %</strong></span>
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
                <div class="col-sm-{!! $card->width !!} float-left mb-3">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script type="text/javascript">
    $("#btn_roi_amount").click(function(){
      $('#roi_amount').show();
      $('#roi_per').hide();
    });

    $("#btn_roi_per").click(function(){
      $('#roi_per').show();
      $('#roi_amount').hide();
    });
  </script>

@endsection
