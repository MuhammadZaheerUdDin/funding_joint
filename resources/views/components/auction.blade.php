<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 30/10/2018
 * Time: 11:42
 */
?>


<div class="auction mb-3">
    <div class="card">
        <div class="card-body">
            <div class="progress custom">
                <div class="progress-bar" role="progressbar" style="width: 50%"
                     aria-valuenow="50%" aria-valuemin="0" aria-valuemax="100">
                    50%
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">

                        <h4 class="seller__auction__title">{{$auction->id}} </h4>
                        Auction Number : 213 <br>
                        PO Number : 123 <br>
                        Invoice issue date : NUMBER <br>
                        Funding remaining : NUMBER <br>
                        Auction end date : 123 <br>
                        Repayment due : NUMBER <br>

                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        bids placed
                                        20
                                    </div>
                                    <div class="col-md-12">
                                        Discount Limit
                                        <h3>12%</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                Current discount
                                33£
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="/auctions/2" class="btn btn-sm btn-dark float-right">View</a> Status: Your auction
            is 'Live' / 'Not Live'
        </div>
    </div>
</div>
