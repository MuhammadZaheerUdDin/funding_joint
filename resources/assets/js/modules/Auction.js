/**
 * Created by pkociaj on 07/11/2018.
 */
'use strict';

class Auction {

    constructor() {

        let csrf_token = $('meta[name=csrf-token]').attr("content");

        $(document).ready(function () {
            $('.auction_decline').on('click', (event) => {
                event.preventDefault()
                let auction_id = event.target.dataset.auction;
                declineAuction(auction_id);
            })

            $('.auction_approve').on('click', (event) => {
                event.preventDefault()
                let auction_id = event.target.dataset.auction;
                approveAuction(auction_id);
            })

            $('.invoice_approve').on('click', (event) => {
                event.preventDefault()
            let auction_id = event.target.dataset.auction;
            approveInvoice(auction_id);
        })

        });

        function approveAuction(auction_id) {

            $.ajax({
                type: "POST",
                url: `/auctions/${auction_id}/approve`,
                data: {id: auction_id, _token: csrf_token},
                success: function (data) {
                    console.log(data)
                    alert(data.msg)
                    window.location.reload();

                },
                error: (error) => {
                    console.log(error)
                }
            });
        }
        function declineAuction(auction_id) {

            $.ajax({
                type: "POST",
                url: `/auctions/${auction_id}/decline`,
                data: {id: auction_id, _token: csrf_token},
                success: function (data) {
                    console.log(data)
                    alert(data.msg)
                    window.location.reload();
                },
                error: (error) => {
                    console.log(error)
                }
            });
        }

        function approveInvoice(auction_id) {

            $.ajax({
                type: "GET",
                url: `/auctions/${auction_id}/approve_invoice`,
                data: {id: auction_id, _token: csrf_token},
                success: function (data) {
                    console.log(data)
                    alert(data.msg)
                    if(data.status ==="success"){
                        window.location.reload();
                    }

                },
                error: (error) => {
                console.log(error)
        }
        });
        }


    }

}
;

export default Auction;