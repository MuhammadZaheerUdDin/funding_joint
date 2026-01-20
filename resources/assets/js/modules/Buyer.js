'use strict';

class Buyer {

    constructor() {

        $(document).ready(function () {

            // Read a page's GET URL variables and return them as an associative array.
            function getUrlVars() {
                var vars = [], hash;
                var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                for (var i = 0; i < hashes.length; i++) {
                    hash = hashes[i].split('=');
                    vars.push(hash[0]);
                    vars[hash[0]] = hash[1];
                }
                return vars;
            }

            // $("#edit_buyer").hide();
            // $("#edit_auction").hide();
            // $("#edit_funding_period").hide();
            // $("#create_buyer").hide();


            $("#choose_buyer").change(function () {
                var str = "";
                var str2 = "";
                $("select option:selected").each(function () {

                    str = $("#choose_buyer").val();

                    str2 = $("#choose_buyer option:selected").text();

                    if (str == 0) {
                        $('#mydiv').empty('');
                        $("#new_buyer").show();
                        //$("#create_buyer").show();
                    } else {
                        $('#mydiv').html('<p>' + str2 + '<a href=/step-2/' + str + ' class="btn btn-outline-dark create-button">USE THIS BUYER</a></p>');
                        $("#create_buyer").hide();
                        $("#new_buyer").hide();
                    }
                });

            });
            // step 4 edit / close
            $("#new_buyer").click(function () {
                $("#create_buyer").show();
            });

            $("#link_edit_buyer").click(function () {
                $("#edit_buyer").show();
            });

            $("#close_edit_buyer").click(function () {
                $("#edit_buyer").hide();
            });

            $("#link_edit_auction").click(function () {
                // call calculation
                alert('he');
                $.NetFundingAvailable();
                $("#edit_auction").show();

            });

            $("#close_edit_auction").click(function () {
                $("#edit_auction").hide();
            });

            $("#link_edit_funding_period").click(function () {
                $.FundingPeriod();
                $("#edit_funding_period").show();
            });

            $("#close_edit_funding_period").click(function () {

                $("#edit_funding_period").hide();
            });

            // if form posted need to keep form open
            var process = getUrlVars()["process"];

            if (process == 1) {
                $("#create_buyer").show();
            }
        });

    }

};

export default Buyer;
