import jquery from 'jquery/dist/jquery.min';
import Order from  './modules/Order';
import Buyer from './modules/Buyer';
import Bidding from './modules/Bidding';
import Auction from './modules/Auction';
import FundingPeriod from './modules/FundingPeriod';
import Popper from './popper.min.js';


require('./bootstrap.min.js');
require('./libraries/mdb.js');
// const flatpickr = require("flatpickr");

window.Popper = Popper;
window.jQuery = jquery;
window.$ = jquery;

window.jquery = jquery;




$(document).ready(function () {
    /**
     * add the ability to add other input for nature of employers
     * @type {JQuery<TElement>|jQuery|HTMLElement}
     */
    var natureofEmployerSelect = $('select[name=nature_employers_business]');
    natureofEmployerSelect.on('change',function(){
        var value = natureofEmployerSelect.val();
        if(value ==="Other")
            $('#otherNatureOfEmployers').removeClass('d-none');
        else {
            $('#otherNatureOfEmployers').addClass('d-none');
            $('#otherNatureOfEmployers input').val('')
        }

    });

    /**
     * add ability to add other input for hear of us field
     * @type {JQuery<TElement>|jQuery|HTMLElement}
     */
    var hearOfUsSelect = $('select[name=hear_of_us]');
    hearOfUsSelect.on('change',function(){
        var value = hearOfUsSelect.val();
        if(value ==="Other")
            $('#otherHearOfUs').removeClass('d-none');
        else {
            $('#otherHearOfUs').addClass('d-none');
            $('#otherHearOfUs').val('')
        }

    });


    /**
     * Disable forms submit on enter
     */
    // $("form input").keypress(
    //     function(event){
    //         if (event.which == '13') {
    //             event.preventDefault();
    //         }
    // });


    // flatpickr(".flatpickr",{
    //     altInput: true,
    //     altFormat: "d.m.Y",
    //     dateFormat: "Y-m-d",
    // });

  $('#users').ready(function(){
      $.ajax({
          type: "GET",
          url: "/json/users",
          success: function (data) {
              $.each(data, function (i, d) {
                  $('#users').append(`<option value="${d.id}">${d.email} ( ${d.id} ) </option>`);
              });
          }
      });
  })
    $('#users').on('change', function () {
        getUserBankDetails(this.value);
        var user_id = this.value;

        $.ajax({
            type: "get",
            url: "/json/createreference",
            data: {user_id: user_id},
            success: function (data) {

                $('.ajax_reference').text(data);
                $('input[name="reference"]').val(data);
            }
        });


    });
    function getUserBankDetails(user_id) {
        $.ajax({
            type: "GET",
            url: "/json/bankDetails/" + user_id,
            success: function (data) {
                $('span.ajax_bank_number').text(data.account_number)
                $('span.ajax_sort_code').text(data.sort_code)
            }
        });
    }

    /**
     * Click event to change funds remaining display type, will show amount or percent
     */
    $('.toggleFundsRemainingDisplayType').on('click', function (e) {
      e.preventDefault();
        $(this).siblings('.marketplace__funding__remaining__amount').toggleClass('d-none').fadeIn("slow");
        $(this).siblings('.marketplace__funding__remaining__percent').toggleClass('d-none').fadeIn("slow");
        $(this).children('.fa').toggleClass('fa-pound-sign fa-percent')
    });

    /**
     * show on load the complete profile or continue to marketplace modal.
     * Actual modal element is show if the user has not complete profile
     */
    $('#completeProfileModal').modal('show');
    /**
     * Admin auction, comments button scroll to comments section
     */
    $("#comments_btn_link").click(function() {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#auction-comments").offset().top
        }, 1000);
    });

    $('#sidebar__close__btn').on('click',function(evt){
       $('.sidebar').css('width','0px') ;
        $('body').removeClass("sidebarmenu__open");
    });
    $('#sidebar__open__btn').on('click',function(evt){
        $('.sidebar').css('width','100%');
        $('body').addClass("sidebarmenu__open");
    });

    /**
     * Add required attribute on podocument
     */
    $('#po_document').attr('required','required')


});

/**
 * WIll make sure the turnover be two decimals max
 */
$('input[name=turnover]').on('blur',function(ev){
    let theval = parseFloat($(ev.target).val())
    $(ev.target).val(theval.toFixed(2))
})


/**
 * Handles auction card click event on seller's auctions.
 * will not open if the open modal button is clicked
 */
$('.sellerAuctionCard .handleClick').on('click',function(event){
    if( ! $(event.target).hasClass('openAuctionSummary')){
        window.location = $(this).closest('a').data('link');
    }
});


//order By JS Logic
new Order();




// Get all the Meters
const meters = document.querySelectorAll('svg[data-value] .meter');

meters.forEach( (path) => {
  // Get the length of the path
  let length = path.getTotalLength();
  // console.log(length) once and hardcode the stroke-dashoffset and stroke-dasharray in the SVG if possible
  // or uncomment to set it dynamically
  // path.style.strokeDashoffset = length;
  // path.style.strokeDasharray = length;

  // Get the value of the meter
  let value = parseInt(path.parentNode.getAttribute('data-value'));
  // Calculate the percentage of the total length
  let to = length * ((100 - value) / 100);
  // Trigger Layout in Safari hack https://jakearchibald.com/2013/animated-line-drawing-svg/
  path.getBoundingClientRect();
  // Set the Offset
  path.style.strokeDashoffset = Math.max(0, to);
});
new Buyer();
new Bidding();
new FundingPeriod();
new Auction();


//start the admin frontend editor
require('./bootstrap');
window.Vue = require('vue');

Vue.component('inlineManager', require('./components/laravel-inline-editor/manager'));
Vue.component('inlineContentBlock', require('./components/laravel-inline-editor/contentBlock.vue'));


/**
 * FIx the modal not displaying properly 
 */
$('.modal').appendTo('body');

// $("a.btn").removeClass("waves-effect waves-light");
// PREVENT INSIDE MEGA DROPDOWN
$('[data-toggle=dropdown]').dropdown();


