'use strict';

class Bidding {

    constructor() {

        $("#bid_discount_error").hide();
        $("#bid_amount_error").hide();
        $("#bid_submit").hide();
// if returning from edit load
        $(window).on('load', function () {

            $.BiddingCalc();
        });


// bidding restrictions
        $("#amount").on('change',function () {
            var value =  parseFloat( $("#amount").val());

            $("#amount").val(value.toFixed(1))
            $("#bid_amount_error").hide();
            $("#bid_discount_error_decimals").hide()
            $.BiddingCalc();

        });


        $("#bid_discount").on('change',function () {
            var value =  parseFloat( $("#bid_discount").val());

            $("#bid_discount").val(value.toFixed(1))
            $("#bid_discount_error").hide();
            $.BiddingCalc();

        });

        $.BiddingCalc = function () {

            // var set_auction_amount = $("#amount_funding_required_bids").val();
            // var bid_amount = $("#amount").val();
            // var bid_discount = $("#bid_discount").val();
            // var set_discount_limit = $("#max_discount_limit_bids").val();
            //
            // var total_return_profit = ((parseInt(bid_amount) * parseInt(bid_discount)) / 100);
            // var total_return = parseInt(bid_amount) + parseInt(total_return_profit);
            // var share_po_percent = (parseInt(bid_amount) / parseInt(set_auction_amount) * 100);
            //


            var auction = {
                funding_target: parseFloat($("#amount_funding_required_bids").val()),
                max_discount: parseFloat($("#max_discount_limit_bids").val())
            };

            var bid = {
                amount: parseFloat($("#amount").val()),
                discount: parseFloat($("#bid_discount").val()),
                value_of_po: 0,
                profit: 0,
                roi: 0,
                share_po_percent: 0
            }


            bid.value_of_po = Math.floor(bid.amount / (1 - ( bid.discount / 100)), 2);
            bid.share_po_percent = ( bid.value_of_po / auction.funding_target ) * 100;
            bid.profit = bid.value_of_po - bid.amount;
            bid.roi = ( bid.profit / bid.amount) * 100;
            if (parseFloat(bid.discount) > parseFloat(auction.max_discount)) {
                $("#bid_discount_error").show(250);
                $('#bid_submit').hide(250);
            } else {
                $('#bid_submit').show(250);
                $("div .bid_discount").html(bid.discount.toFixed(1) + '%');
                $("div .roi").html(bid.roi.toFixed(2) + '%');
                $("div .share_po_percent").html(bid.share_po_percent.toFixed(2) + '%');
                $("div .share_po_value").html("&pound;" + bid.value_of_po);
                $("div .bid_amount").html("&pound;" + bid.amount);
                $("div .total_return_profit").html("&pound;" + bid.profit);
                // $("div .total_return").html("&pound;" + total_return);
                $("input[name='roi']").val(bid.roi.toFixed(2)); //add value to hidden input to add in the database

            }

        }

    }

}
;

export default Bidding;