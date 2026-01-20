@extends('layouts.admin.page')
@section('content')
<style type="text/css">
        #back_btn{
            display: none;
        }
    </style>
{!! $form->header !!}


  <div class="card form">
      <div class="card-header clearfix">
          <h3 class="float-left">CREATE NEW AUCTION</h3>
                <a data-toggle="tooltip" title="{{$page->content}}"  class="pull-right text-right" id="myPopover"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
      </div>
      <div class="step-menu">
          <div class="row">
              <div class="col-3 active-step"><a href="#" style="cursor: default;">Step One</a></div>
              <div class="col-3 active-step"><a href="#" style="cursor: default;">Step Two</a></div>
              <div class="col-3 active-step"><a href="#" style="cursor: default;">Step Three</a></div>
              <div class="col-3"><a href="#" style="cursor: default;">Step Four</a></div>
          </div>
      </div>
      <div class="card-body">
        <div class="row">
            <div class="container add-a-buyer"> 
                <p class="address-title">Funding Period</p>
            </div>
        </div>
        @if(!$form->message)
          <div class="row">
            <div class="col-md-6 col-xs-12">
              Invoice Issue Date <span class="required"></span><br>
                <span class="discount_limit_exceed" style="display:none">
                  <font color="red">Invalid Date</font>
                </span>
               {!! $form->render('expected_invoice_issue_date') !!}
                <input class="form-control" type="text" id="expected_invoice_issue_date_display" onkeyup="success()" name="expected_invoice_issue_date_display" style="background-color: blue !important; ">
{{--                <input class="" type="date" id="test"  onkeyup="success()" name="expected_invoice_issue_date_display" placeholder="Select Date.." readonly="readonly">--}}
            </div>
            <div class="col-md-6">
              Invoice Payment Term (days)<span class="required"></span><br>
                <span id="maximum_invoice_issue_error" class="limit_exceed" style="display:none">
                  <font color="red">Must be less than {{$settings[0]['maximum_invoice_issue']}} </font>
                </span>
                <span id="minimum_expected_invoice_term_error" class="limit_exceed" style="display:none">
                  <font color="red">Must be greater than {{$settings[0]['minimum_expected_invoice_term']}} </font>
                </span>
             
               <input type="text" class="form-control" id="expected_invoice_term" name="expected_invoice_term" value="" onkeypress="return event.charCode >= 48" min="1">
            </div>
          </div>
           <input type="hidden" id="admin_invoice_term" value="{{$settings[0]['maximum_time_to_invoice']}}">
          <input type="hidden" id="max_auction_length" value="{{$settings[0]['maximum_auction_length']}}">
          <input type="hidden" id="maximum_invoice_issue" value="{{$settings[0]['maximum_invoice_issue']}}">
          <input type="hidden" id="minimum_expected_invoice_term" value="{{$settings[0]['minimum_expected_invoice_term']}}">
          <?php
            $days = $settings[0]['maximum_time_to_invoice'];
            $NewDate = Date('Y-m-d', strtotime("+".$days." days"));

           ?>
          <input type="hidden" id="maximum_expected_invoice" value="{{$NewDate}}">
          <hr>
          <div class="row">
            <div class="col-md-6 col-xs-12">
              <p class="my-1 py-1">Repayment Due Date</p>
            </div>
            <div class="col-md-6 col-xs-12">
              <input class="form-control  m-0" type="text" id="date_repayment_due_display" name="date_repayment_due_display" value="" readonly>
              <input class="form-control  m-0" hidden="text" id="date_repayment_due" name="date_repayment_due" value="" readonly>
            </div>
          </div>
          <hr class="pb-2">
        @else
        {!! $form->message !!}
        @endif
        {!! $form->footer !!}
        <!-- button design
        <div class="container">
            <button type="button" class="btn float-md-right register-next">NEXT</button>
        </div>
       --->
      </div>
  </div>


      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  
      <!-- <script>
          $(document).ready(function () {
            $('#expected_invoice_issue_date_display').on('input keyup', function () {
              if ($(this).val() !== '') {
                  $('#expected_invoice_term').on('input keyup', function () {
                  
                  if($(this).val() !== ''){
                    $('#submit').prop('disabled', false);
                  }
                  else{
                    $('#submit').prop('disabled', true);
                  }
                 });
              }else{
                $('#submit').prop('disabled', true);
              }
            });
          });
      </script>   -->

  <script >
      $(function(){
          // Enables popover
          $("[data-toggle=tooltip]").tooltip();
      });
       $(document).ready(function (){
            validate();
            $('#expected_invoice_issue_date_display, #expected_invoice_term').change(validate);
        });

        function validate(){
            // if ($('#expected_invoice_issue_date_display').val().length   >   0   &&
            //     $('#expected_invoice_term').val().length  >   0  
            //     ) {
            //     $("input[type=submit]").prop("disabled", false);
            // }
            // else {
            //     $("input[type=submit]").prop("disabled", true);
            // }
        }
    </script>

 
<script type="text/javascript">
  //window.onbeforeunload = function() { return "Your work will be lost."; };
  var expected_invoice_term = document.getElementById('expected_invoice_term');
  var maximum_invoice_issue = document.getElementById('maximum_invoice_issue');

  expected_invoice_term.addEventListener('change', function(e)
  {   
    checkAmountExceed();
  }); 
  expected_invoice_term.addEventListener('keyup', function(e)
  {   
    checkAmountKeyup();
  }); 
  function checkAmountExceed(){
    str_po = $("#expected_invoice_term").val();
    max_invoice = $("#maximum_invoice_issue").val();
    minimum_expected_invoice_term = $("#minimum_expected_invoice_term").val();
      if (parseFloat(str_po) > parseFloat(max_invoice)) {
          $("#maximum_invoice_issue_error").show();
          $("#minimum_expected_invoice_term_error").hide();
          $("input[type=submit]").prop("disabled", true);
      }else if (parseFloat(str_po) < parseFloat(minimum_expected_invoice_term)) {
          $("#minimum_expected_invoice_term_error").show();
          $("#maximum_invoice_issue_error").hide();
          $("input[type=submit]").prop("disabled", true);
      }else {
          $("#maximum_invoice_issue_error").hide();
          $("#minimum_expected_invoice_term_error").hide();
          $("input[type=submit]").prop("disabled", false);
      }     
  }

  function checkAmountKeyup(){
    str_po = $("#expected_invoice_term").val();
    max_invoice = $("#maximum_invoice_issue").val();
    minimum_expected_invoice_term = $("#minimum_expected_invoice_term").val();
    if (parseFloat(str_po) > parseFloat(max_invoice)) {
      $("#maximum_invoice_issue_error").show();
    }  
  }

  //console.log(expected_invoice_term);
</script>


@endsection
