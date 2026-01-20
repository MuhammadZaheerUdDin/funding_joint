'use strict';


window.getQueryVariable = function getQueryVariable(variable)
{
    console.log("%c@StaxoWeb 👨‍💻", 'color:pink;');

    var query = window.location.search.substring(1);
    var vars = query.split("&");
    for (var i=0;i<vars.length;i++) {
        var pair = vars[i].split("=");
        if(pair[0] == variable){return pair[1];}
    }
    return(false);
};

class FundingPeriod {

    constructor() {


        var process = getQueryVariable("process");

        /**
         *  auction object variable for future reuse
         */
        var auction= {
              maximumDiscountAvailable : 0
        };

        /**
         * Get maximum discount setting for an auction on script load
         */
        $.ajax({
            type: "get",
            url: '/ajax/settings',
            data:{data:'maximum_discount_limit'},
            success: function (data) {
                auction.maximumDiscountAvailable = data;
            },
            error: (error) => {
                console.log('Something went wrong while getting max discount', error)
            }
        });

        const flatpickr = require("flatpickr");

        const moment = require('moment');
// net funding available auto calc
        $.NetFundingAvailable = function () {

            var funding_available = "";
            var maximum_discount_limit = "";
            var po_required = "";
            var funding_joint_fee_perc = $('input[name=funding_joint_fee]').val();
            var funding_joint_fee = 0;
            maximum_discount_limit = $("#maximum_discount_limit").val();
            po_required = $("#amount_funding_required").val();
            // minus the % they are willing to give for invoice as below
            funding_available = po_required - (po_required * (maximum_discount_limit / 100));
            funding_joint_fee = funding_available * ( funding_joint_fee_perc / 100);
            funding_available = funding_available - funding_joint_fee;
            $('input[name="net_funding_available"]').val(funding_available);
        }


        $("#total_amount_of_po").keyup(function () {
            // call calculation
            $.NetFundingAvailable();
        });

// can get 90% or less for PO
        $("#amount_funding_required").keyup(function () {

            var str_po = "";
            var str_po_required = "";

            str_po = $("#total_amount_of_po").val();
            str_po_required = $("#amount_funding_required").val();
            alert(str_po_required);
            alert(str_po * 0.9);
            if (str_po_required > (str_po * 0.9)) {
                $(".limit").show("slow");
            } else {
                $(".limit").hide("slow");
            }
            // call calculation
            $.NetFundingAvailable();
        });

        $("#maximum_discount_limit").on('change keyup',function () {
            if ($("#maximum_discount_limit").val() > auction.maximumDiscountAvailable) {

                $(".discount_limit").show("slow");
            } else {
                $(".discount_limit").hide('slow');
            }

            // call calculation
            $.NetFundingAvailable();
        });

// if they don't complete and get error page back
        if (process == 1) {
            // call calculation
            $.NetFundingAvailable();
        }


        flatpickr("#expected_invoice_issue_date", {

            altFormat: "d/m/Y",
            allowInput:false,
            onChange: function (dateObj, dateStr) {

                if (dateStr === undefined || dateStr === null) {
                    // do something

                    console.log('Date is not set');

                }

                var indicative_funding_period = "";
                var date_repayment_due = "";
                var expected_invoice_issue_date = "";
                var day = "";
                var day_formated = "";
                var day_format_back = "";

                var day_format_back_db;

                var date = dateStr;

                var expected_invoice_term = $("#expected_invoice_term").val();

                day_formated = moment(date).format("YYYY-MM-DD");

                day = moment(day_formated).add(expected_invoice_term, 'days');

                day_format_back = moment(day).format("DD/MM/YYYY");

                day_format_back_db = moment(day).format("YYYY-MM-DD");


                // current day + auction time + invoice term assume 30 days auction in settings
                var current_day_and_auction_end_time = moment(day_formated).add(30, 'days');
                var b = moment(current_day_and_auction_end_time, 'DD-MM-YYYY');
                var a = moment(day_format_back, 'DD-MM-YYYY');
                var indicative_day = a.diff(b, 'days');


                $('input[name="indicative_funding_period"]').val(indicative_day);

                $('input[name="date_repayment_due"]').attr('value', day_format_back_db);

                $('input[name="date_repayment_due"]').attr('placeholder', day_format_back_db);

                $('input[name="date_repayment_due_display"]').attr('value', day_format_back);

                console.log('i should change display' + day_format_back);
                console.log('i should change ' + day_format_back_db);

            }

        });

        $("#expected_invoice_term").change(function () {

            var indicative_funding_period = "";
            var date_repayment_due = "";
            var expected_invoice_issue_date = "";
            var expected_invoice_term = 0;
            var day = "";
            var day_formated = "";
            var day_format_back = "";
            var day_now = "";
            var date;
            var day_format_back_db;

            var date = $("#expected_invoice_issue_date").val();
            var expected_invoice_term = $("#expected_invoice_term").val();


            day_formated = moment(date).format("YYYY-MM-DD");

            day = moment(day_formated).add(expected_invoice_term, 'days');

            day_format_back = moment(day).format("DD/MM/YYYY");

            day_format_back_db = moment(day).format("YYYY-MM-DD");

            day_now = moment().format("DD-MM-YYYY");

            // current day + auction time / invoice due date assume 30 days auction in settings
            var current_day_and_auction_end_time = moment(day_formated).add(30, 'days');

            var b = moment(current_day_and_auction_end_time, 'DD-MM-YYYY');
            var a = moment(day_format_back, 'DD-MM-YYYY');
            var indicative_day = a.diff(b, 'days');


            $('input[name="indicative_funding_period"]').attr('value' , indicative_day);

            $('input[name="date_repayment_due"]').attr('value', day_format_back_db);
            $('input[name="date_repayment_due"]').attr('placeholder', day_format_back_db);

            $('input[name="date_repayment_due_display"]').val(day_format_back);

        });

        $.FundingPeriod = function () {

            var indicative_funding_period = "";
            var date_repayment_due = "";
            var expected_invoice_issue_date = "";
            var expected_invoice_term = 0;
            var day = "";
            var day_formated = "";
            var day_format_back = "";
            var day_now = "";
            var date;
            var day_format_back_db;

            var date = $("#expected_invoice_issue_date").val();

            var expected_invoice_term = $("#expected_invoice_term").val();


            day_formated = moment(date).format("YYYY-MM-DD");


            console.log("I get called from the funding");


            day = moment(day_formated).add(expected_invoice_term, 'days');

            day_format_back = moment(day).format("DD/MM/YYYY");

            day_format_back_db = moment(day).format("YYYY-MM-DD");



            day_now = moment().format("DD-MM-YYYY");

            // current day + auction time / invoice due date assume 30 days auction in settings
            var current_day_and_auction_end_time = moment(day_formated).add(30, 'days');

            var b = moment(current_day_and_auction_end_time, 'DD-MM-YYYY');
            var a = moment(day_format_back, 'DD-MM-YYYY');
            var indicative_day = a.diff(b, 'days');


            $('input[name="indicative_funding_period"]').val(indicative_day);

            $('input[name="date_repayment_due"]').attr('value', day_format_back_db);

            $('input[name="date_repayment_due"]').attr('placeholder', day_format_back_db);

            $('input[name="date_repayment_due_display"]').val(day_format_back);


        };

    }

};

export default FundingPeriod;

