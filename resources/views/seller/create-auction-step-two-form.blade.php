@extends('layouts.admin.page')
@section('content')
    <style type="text/css">
        #back_btn{
            display: none;
        }
    </style>
    
    <div class="card form">
    {!! $form->header !!}
    @if(!$form->message)

        {!! $form->render('user_id') !!}
        {!! $form->render('buyer_id') !!}
        <!---form element-->
            <div class="card-header clearfix">
              <h3 class="float-left">CREATE NEW AUCTION</h3>
                    <a data-toggle="tooltip" title="{{$page->content}}"  class="pull-right text-right" id="myPopover"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
            </div>
            <div class="step-menu ">
                <div class="row">
                    <div class="col-3 active-step"><a href="#" style="cursor: default;">Step One</a></div>
                    <div class="col-3 active-step"><a href="#" style="cursor: default;">Step Two</a></div>
                    <div class="col-3"><a href="#" style="cursor: default;">Step Three</a></div>
                    <div class="col-3"><a href="#" style="cursor: default;">Step Four</a></div>
                </div>
            </div>
            <div class="card-body">
                <div class="row add-a-buyer">
                    <div class="col">
                        <p class="address-title">AUCTION DETAILS</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        Invoice Number <span class="required"></span></br>
                        {!! $form->render('po_number') !!}

                    </div>
                </div>

                <div class="row upload-document">
                    <div class="col-md-6">
                        Invoice Document<span class="required"></span></br>
                        {!! $form->render('po_document') !!}
                        @if (Session::has('po_error'))
                            <span class="help-block"><span class="glyphicon glyphicon-warning-sign"></span>
                                {{ Session::get('po_error') }}</span>
                            </span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <p class="py-2 my-1"></p>
                        <!-- Upload Purchase Order (PO) document.  As an alternative to an official PO, you may upload correspondence such as a letter or email from your buyer confirming an order to purchase goods or services from you. -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        Total Invoice Amount(£)<span class="required"></span>
                       {!! $form->render('total_amount_of_po') !!}
                      <!--   <input type="text" class="form-control" id="total_amount_of_po" s> -->
                       {!! Form::hidden('total_amount_of_po','', ['class' => 'form-control','id'=>'total_amount_of_po_original']) !!}

                    </div>
                </div>

                  <div class="row">
                    <div class="col-md-6">
                        Amount of Funding Required (£)<span class="required"></span><br>
                        <span class="limit_exceed" style="display:none">
                          <font color="red">Amount of funding required can not exceed {{$settings[0]['po_settings']}}% Of Invoice value. <br></font>
                        </span>

                        <span class="credit_limit_exceed" style="display:none">
                          <font color="red">Amount of funding required can not exceed your credit limit.</font>
                        </span>

                        <input type="hidden" id="credit_limit" value="{{$user->seller->credit_limit}}">
                        <input type="hidden" id="po_settings" value="{{$settings[0]['po_settings']}}">
                       {!! $form->render('amount_funding_required') !!}
                      <!--   <input type="text" class="form-control" id="total_amount_of_po" s> -->
                        {!! Form::hidden('amount_funding_required','', ['class' => 'form-control','id'=>'amount_funding_required_original']) !!}

                    </div>
                     <div class="col-md-6">
                        <p class="py-2 my-1"></p>
                        <!-- Up to a maximum of {{$settings[0]['po_settings']}}% of the amount of the Invoice can be
                        funded -->
                    </div>
                </div>

               <!--  <div class="row">
                    <div class="col-md-6">
                       Percentage of invoice to be funded (%)<span class="required"></span>
                       {!! $form->render('total_amount_of_po') !!}
                        <input type="text" class="form-control" id="total_amount_of_po" s>
                        {!! Form::hidden('total_amount_of_po','', ['class' => 'form-control','id'=>'total_amount_of_po_original']) !!}

                    </div>
                </div> -->

                  <div class="row">
                    <div class="col-md-6">
                        Percentage of Invoice to be Funded (%)<span class="required"></span><br>
                        {!! $form->render('percentage_invoice') !!}
                       
                       

                    </div>
                   <!--  <div class="col-md-6">
                        <p class="py-2 my-1"></p>
                        This is the amount you could raise if your auction is fully
                        funded and
                        depending on the Discount Limit achieved.
                    </div> -->
                </div>

               <!--  <div class="row">
                    <div class="col-md-6">
                        Amount of funding required (£)<span class="required"></span><br>
                        <span class="limit" style="display: none">
                <font color="red">Funding Cannot Exceed 90% Of PO value</font>
            </span>
                        {!! $form->render('amount_funding_required') !!}
                        <input type="text" class="form-control" id="amount_funding_required">
                        {!! Form::hidden('amount_funding_required','', ['class' => 'form-control','id'=>'amount_funding_required_original']) !!}

                    </div>
                    <div class="col-md-6">
                        <p class="py-2 my-1"></p>
                        Up to a maximum of 90% of the amount of the PO can be
                        funded
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-md-6">
                    Maximum Collection Fee<span class="required"></span> <br>
                        <span class="discount_limit_exceed" style="display:none">
              <font color="red">Limit is
                  {{$settings[0]['maximum_discount_limit']}}%</font>
          </span>
                        {!! $form->render('maximum_discount_limit') !!}
                    </div>
                    <div class="col-md-6">
                        <p class="py-2 my-1"></p>
                        <!-- Your PO will be auctioned for sale to Investors. Please state the maximum percentage (the Collection Fee) that you are willing to pay from the PO, in order to raise funding. -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6" hidden="">
                        Agency fee at {{$settings[0]['agency_fee']}} %<br>
                       {!! $form->render('agency_fee') !!}
                        <input type="hidden" name="agency_fees" value="{{$settings[0]['agency_fee']}}">
                    </div>
                    <div class="col-md-6">
                        <p class="py-2 my-1"></p>
                        <!-- This is the fee that you'll receive for acting as an agent on behalf of the investors to sell the goods or services stated on the PO to your buyer.<a href="" data-toggle="modal" data-target="#debitModal">Read more</a>. -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        Funding Joint fee at {{$settings[0]['funding_joint_admin_fee']}} %<br>
                          {{--<input class="form-control" type="text" name='funding_joint_fee'--}}
                               {{--value='' readonly>--}}
                        {!! $form->render('funding_joint_fee') !!}
                        <input type="hidden" name="funding_joint_fees" value="{{$settings[0]['funding_joint_admin_fee']}}">

                    </div>
                    <div class="col-md-6">
                        <p class="py-2 my-1"></p>
                        <!-- This is the maximum fee that you will be charged for using
                        our service. -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        Potential Net Funding Available To You (£)<br>
                        
                        {!! $form->render('net_funding_available') !!}
                        {!! $form->render('net_funding_available_duplicate') !!}

                    </div>
                    <div class="col-md-6">
                        <p class="py-2 my-1"></p>
                        <!-- This is the amount you could raise if your auction is fully
                        funded and
                        depending on the level of Collection Fee achieved(if lower than your maximum set, you will receive more). -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        Purpose of funding <span class="required"></span><br>
                        <!-- {!! $form->render('why_require_funding') !!} -->
                        <!-- <textarea class="form-control" name="why_require_funding" placeholder="Describe yourself here..." style="background-color: #e9ecef;opacity: 1;">
                        </textarea> -->
                        <textarea rows="8" cols="53" name="why_require_funding" id="why_require_funding" class="form-control" placeholder="Require funding for business growth, expansion, acquisition of new clients, etc." style="background-color: white;"></textarea>
                    </div>
                    <div class="col-md-6">
                        <p class="py-2 my-1"></p>
                        <!-- To help Investors with their decision making, tell us about
                        the PO and
                        the goods or services that you will provide, and why you
                        require funds.
                    </div> -->
                </div>
            </div>
          
            <div class="card-footer">
                {!! $form->footer !!}
               <!--  <div class="btn-toolbar" role="toolbar">
                    <div class="pull-left">
                        <span class="waves-input-wrapper waves-effect waves-light">
                            <input class="btn btn-primary"   type="submit" value="NEXT" id="submit">
                        </span>
                    </div>
                </div> -->
            </div>
    </div>
    <!--end container-->
    @else
        {!! $form->message !!}
    @endif

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!-- <script>
 
  $(document).ready(function () {
        $('#po_number').on('input change', function () {
            if ($(this).val() != '') {

                   $('#po_document').on('input change', function () {
                    if ($(this).val() != '') {

                    $('#total_amount_of_po').on('input change', function () {
                    if ($(this).val() != '') { 
                       
                    $('#amount_funding_required').on('input change', function () {
                    if ($(this).val() != '') { 

                    $('#maximum_discount_limit').on('input change', function () {
                    if ($(this).val() != '') { 

                     $('#why_require_funding').on('textarea keyup', function () {
                    if ($(this).val() != '') { 
                        $('#submit').prop('disabled', false);
                    }
                    else { 
                        $('#submit').prop('disabled', true);
                    }
                    });
                    }
                    else { 
                        $('#submit').prop('disabled', true);
                    }
                    });
                    }
                    else { 
                        $('#submit').prop('disabled', true);
                    }
                    });
                    }
                    else { 
                        $('#submit').prop('disabled', true);
                    }
                    });
                    }
                    else { 
                        $('#submit').prop('disabled', true);
                    }
                    });
            }
            else { 
                $('#submit').prop('disabled', true);
            }
        });

    });
</script> -->


  <script >
        $(function(){
            // Enables popover
            $("[data-toggle=tooltip]").tooltip();
        });
        //window.onbeforeunload = function() { return "Your work will be lost."; };
        $(document).ready(function (){
            validate();
            $('#po_number, #po_document, #total_amount_of_po, #amount_funding_required, #maximum_discount_limit, #why_require_funding').change(validate);
        });

        function validate(){
            if ($('#po_number').val().length   >   0   &&
                $('#po_document').val().length  >   0   &&
                $('#total_amount_of_po').val().length    >   0 &&
                $('#amount_funding_required').val().length    >   0 &&
                $('#maximum_discount_limit').val().length    >   0 &&
                $('#why_require_funding').val().length    >   0
                ) {
                $("input[type=submit]").prop("disabled", false);
            }
            else {
                $("input[type=submit]").prop("disabled", true);
            }
        }
    </script>


    <script type="text/javascript">
        var total_amount_of_po 			= document.getElementById('total_amount_of_po');
        var total_amount_of_po_original = document.getElementById('total_amount_of_po_original');
       
        //console.log(total_amount_of_po);
       
        total_amount_of_po.addEventListener('keyup', function(e)
        {   

            checkAmountExceed();
            total_amount_of_po.value = format_number(this.value);
            total_amount_of_po_original.value = parseInt(this.value.replace(/,/gi, ""));
        });

        var amount_funding_required = document.getElementById('amount_funding_required');
        var amount_funding_required_original = document.getElementById('amount_funding_required_original');
        amount_funding_required.addEventListener('keyup', function(e)
        {
            checkAmountExceed();
            amount_funding_required.value = format_number(this.value);
            amount_funding_required_original.value = parseInt(this.value.replace(/,/gi, ""));
        });

        maximum_discount_limit.addEventListener('keyup', function(e)
        { 
            discountLimitExceed();
        });


        var percentage_invoice = document.getElementById('percentage_invoice');
        percentage_invoice.addEventListener('keyup', function(e)
        { 
            total_po_value = $("#total_amount_of_po").val().replace(/,/gi, "");
            percentage_value = (this.value * total_po_value) / 100;
            document.getElementById('amount_funding_required').value=percentage_value;
            checkPercentageExceed();
        });

      
        function checkAmountExceed(){

            str_po = $("#total_amount_of_po").val().replace(/,/gi, "");
            str_po_required = $("#amount_funding_required").val().replace(/,/gi, "");
            str_credit_limit = $("#credit_limit").val().replace(/,/gi, "");
            str_po_setting = ($("#po_settings").val())/100;
            
            
            if (parseFloat(str_po_required)  >= parseFloat((str_po * str_po_setting) + 1 )) {
                console.log('oooo');
                $(".limit_exceed").show();
            } else {
                $(".limit_exceed").hide();
            } 

            if (parseFloat(str_po_required) > parseFloat(str_credit_limit) + 0.1) {
                $(".credit_limit_exceed").show();
            } else {
                $(".credit_limit_exceed").hide();
            }   
        }

        function checkPercentageExceed(){

            percentage_invoice = $("#percentage_invoice").val();
            str_po_setting = ($("#po_settings").val());
            str_po_required = $("#amount_funding_required").val().replace(/,/gi, "");
            str_credit_limit = $("#credit_limit").val().replace(/,/gi, "");
            
            console.log(parseFloat(percentage_invoice));
            console.log(parseFloat(str_po_setting) + 0.1);
            console.log('ttt');
            if (parseFloat(percentage_invoice,2) >= (parseFloat(str_po_setting) + 0.1)) {
                console.log('innnn');
                $(".limit_exceed").show();
            } else {
                $(".limit_exceed").hide();
            }
            
            if (parseFloat(str_po_required) > (parseFloat(str_credit_limit) + 1)) {
                $(".credit_limit_exceed").show();
            } else {
                $(".credit_limit_exceed").hide();
            }  
        }

        function discountLimitExceed(){
            var maximum_discount_limit = $("#maximum_discount_limit").val();
            $.ajax({
                type: "get",
                url: '../ajax/settings',
                data:{data:'maximum_discount_limit'},
                success: function (data) {
                    if ( maximum_discount_limit > data) {
                        $(".discount_limit_exceed").show();
                    } else {
                        $(".discount_limit_exceed").hide();
                    }
                }
            });
        }
    </script>

     <div class="modal fade" id="debitModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content account__modal" style="position: static;top: 50%;left: 50%;margin-top: 200px;margin-left: 0px;">
                    <!-- <div class="modal-header">
                        <h4 class="modal-title text-center" id="modelTitleId">Sophisticated investor / HNW Individual Declaration</h4>
                        <button type="button" style="margin: -1rem -26rem -1rem auto !important;" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <hr>
                    </div> -->
                    <div class="modal-body" style=" text-align: justify;text-justify: inter-word !important;">
                        <p>
                        <center>Funding Joint dummy text</center>
                        <br>
                        <br>
                      </p>
                    </div>
                     <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>



@endsection
