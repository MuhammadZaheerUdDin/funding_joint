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
      <div class="dashboard p-3">
        <h2>Investor Dashboard</h2>
        <hr>
        <div class="row row-eq-height">
          <div class="col-md-6">
            <div class="row ">
              <div class="col-md-4">
                <h3>Successfull Bids to Date</h3>
              </div>
              <div class="col-md-6 ml-auto ">
                <div class="pieRadial right p37">
                    <span>37%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-6">
                <h3>Overall ROI Achieved</h3>
                <div class="roi-buttons btn-group btn-group-sm" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-primary btn-sm">£</button>
                  <button type="button" class="btn btn-primary btn-sm">%</button>
                </div>
              </div>
              <div class="col-md-6">
                <div class="pieRadial right p75">
                    <span>75%</span>
                    <div class="slice">
                        <div class="bar"></div>
                        <div class="fill"></div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <br>
        <div class="row row-eq-height">
          <div class="col-md-6">
            <a href="#">
              @component('components.dashboardCard')
              @slot('title')
              My Account Balance
              @endslot

              @slot('content')
              $12321323
              @endslot
              @endcomponent
            </a>
          </div>
          <div class="col-md-6">
            <a href="#">
              @component('components.dashboardCard')
              @slot('title')
              Live Investments Nearing Close
              @endslot
              @slot('content')
              43
              @endslot
              @endcomponent
            </a>
          </div>
        </div>
        <br>
        <div class="row row-eq-height">
          <div class="col-md-3">
             <a href="#">
              @component('components.dashboardCard')
                  @slot('title')
                      Notifications
                  @endslot
                  @slot('content')
                      {{$notifications}}
                  @endslot
              @endcomponent
            </a>
          </div>
          <div class="col-md-3">
             <a href="#">
              @component('components.dashboardCard')
                  @slot('title')
                      Repayments Due
                  @endslot
                  @slot('content')
                      43
                  @endslot
              @endcomponent
            </a>
          </div>

          <div class="col-md-3">
            <a href="#">
              @component('components.dashboardCard')
                  @slot('title')
                      Repayments Overdue
                  @endslot
                  @slot('content')
                      43
                  @endslot
              @endcomponent
            </a>
          </div>
          <div class="col-md-3">
            <a href="#">
              @component('components.dashboardCard')
                  @slot('title')
                      Live Investments
                  @endslot
                  @slot('content')
                      43
                  @endslot
              @endcomponent
            </a>
          </div>
        </div>
      </div>
@endsection
