'use strict';




class Order {


    constructor() {

        var windowLocation = (window.location);
        //init the toggle
        console.log("Location href is " + windowLocation .href);

        console.log('Order By JS module loaded');

        $('select[name="orderBy"]').change(function() {

            const selectedValue = $(this).val();

            const currentUrl = (document.location.href);

            const urlClass = new URL(currentUrl);

            const order = urlClass.searchParams.get("order");

            console.log(order);

            if (order === undefined || order === null) {
                // do something
                return window.location = "?&order=" + selectedValue;

            }else{

                if(order.length > 0){

                    return window.location = "?&order=" + selectedValue;

                }else{

                    return window.location = "?order=" + selectedValue;

                }

            }




        });


        /**
         * Submit form on change.
         * This will ensure that other filter fields are parsed as well
         */
        $('select[name="SortBy"]').change(function() {
            this.form.submit();
        });


    }


};

export default Order;