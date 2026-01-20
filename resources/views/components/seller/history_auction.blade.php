<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 07/11/2018
 * Time: 13:06
 */
?>
<div class="comman-card my-3">
    <div class="card comman-card__content">
        <div class="col-12 card-body">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-7 left">
                    <div class="row h-100">
                        <div class="col-12 my-3 align-self-start">
                            <h4 class="title mb-3"><strong>{{$auction->seller->company_name}}</strong></h4>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <p>
                                        <strong>Auction Number:</strong> {{$auction->id}} <br>
                                        <strong>Auction end date:</strong> {{\App\Helpers\FormattedDate::format($auction->end_auction)}} <br>
                                        <strong>Repayment overdue:</strong> {{$auction->repayment_overdue_days}} days
                                    </p>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <p>
                                        <strong>Amount Funded:</strong> £ @money($auction->amount_total_funded) <br>
                                        <strong>Target Amount:</strong> £ @money($auction->amount_funding_required) <br>
                                        <strong>Investment
                                            Period:</strong> {{ $auction->indicative_funding_period ? $auction->indicative_funding_period .' days' : ''}}
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-5 right border-left">
                    <div class="row">
                        <div class="col-6 border-right half-circle py-3">
                            <p class="value text-uppercase">
                                Percentage Funded
                            </p>
                            <div class="progress-circle">
                                <div class="progress-circle-container">
                                    <svg viewBox="0 0 36 36" class="circular-chart">
                                        <path class="circle-bg"
                                              d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                        />
                                        <path class="circle-white"
                                              stroke-dasharray="{{round($auction->total_funded_percentage)}}, 100"
                                              d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                        />
                                        <path class="circle"
                                              stroke-dasharray="{{round($auction->total_funded_percentage)}}, 100"
                                              d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831"
                                        />
                                    </svg>
                                    <div class="percentage">
                                        <span><strong>{{ $auction->total_funded_percentage }}</strong>%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row  h-100">
                                <div class="col-12 py-3">
                                    <p class="text-center text-uppercase title">
                                        max roi set
                                        <span class="text-center value">{{$auction->maximum_discount_limit}} %</span>
                                    </p>
                                </div>
                                <div class="col-12 py-3 border-top">
                                    <p class="text-center text-uppercase title">
                                      Roi achieved
                                        <span class="text-center value">{{$auction->average_bid_discount}}%</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
