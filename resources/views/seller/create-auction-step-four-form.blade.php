@extends('layouts.admin.page')
@section('content')

    <style type="text/css">
        .input-disabled{
            background-color:#FFF;
        }
        #back_btn{
            display: none;
        }
    </style>

    @if(Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(Session::has('msg_f'))
        <div class="alert alert-success">
            {{ Session::get('msg_f') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!---form element-->

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
                <div class="col-3 active-step"><a href="#" style="cursor: default;">Step Four</a></div>
            </div>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col add-a-buyer">
                    <p class="address-title">SUMMARY</p>
                </div>
            </div>

            <div class="row custom-collapse">
                <div class="col-md-6 col-xs-12">
                    <p class="mb-0">BUYER DETAILS</p>
                </div>
                <div class="col-md-6 col-xs-12">
                    <p class="float-md-right mb-0"><a href="#" id="link_edit_buyer">EDIT</a> / <a href="#"
                                                                                                  id="close_edit_buyer">CLOSE</a>
                    </p>
                </div>
            </div>
            <hr>
            <div id="edit_buyer" style="display: none">
                   <div class="container-fluid buyer__info">
                   		<div class="row" style="margin-top: 2vh">
				            <div class="col-8">
				                <h4>BUYERS</h4>
				            </div>
				            <!-- <div class="col-4">
				                <a href="{{ url('buyers')  }}" class="btn btn-link float-right pull-right">
				                    
				                    Back to Buyers Page
				                </a>
				            </div> -->
				        </div>
				        <hr>
                   </div>
                   <div class="create_buyer">
                   		{!! $buyer_form->header !!}
            			{!! $buyer_form->message !!}

            			@if(!$buyer_form->message)
                   		<div class="container-fluid">
                   			<div class="row">
		                        <div class="col-12">
		                            <p class="buyer-detail">Please enter the details of your buyer (the
		                                company that has raised the purchase order and will purchase your
		                                goods or services). Your buyer must be a UK registered company
		                                having traded for at least 3 years.</p>
		                        </div>
		                    </div>
		                    <div class="row">
		                        <div class="col-md-6">Company name (as it appears on the company
		                            documents)
		                        </div>
		                        <div class="col-md-6">Company Registration Number</div>
		                    </div>
		                    <div class="row">
		                        <div class="col-md-6">
		                        	{!! $buyer_form->render('company_name') !!}
		                        </div>
		                        <div class="col-md-6">
		                        	{!! $buyer_form->render('company_registration') !!}                           
		                        </div> 
                    		</div>
		                    <br>
		                    <div class="row">
		                        <div class="col-md-6">Company Registration Date</div>
		                    </div>
		                    <div class="row">
		                        <div class="col-md-6">
		                             {!! $buyer_form->render('company_registration_date') !!}
		                        </div>
		                    </div>
		                    <div class="container-fluid">
			                    <div class="row">
			                        <div class="col-12">
			                            <p class="address-title">
			                                BUYER ADDRESS DETAILS
			                            </p>
			                        </div>
			                    </div>

			                    <div class="row">
			                        <div class="col-md-6">Address line 1</div>
			                        <div class="col-md-6">Address line 2</div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">
			                            {!! $buyer_form->render('address_1') !!}
			                        </div>
			                        <div class="col-md-6">
			                          	{!! $buyer_form->render('address_2') !!}
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">Address line 3</div>
			                        <div class="col-md-6"></div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">
			                           {!! $buyer_form->render('address_3') !!}
			                        </div>
			                        <div class="col-md-6"></div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">Town / City</div>
			                        <div class="col-md-6">Country / Region</div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">
			                            {!! $buyer_form->render('town') !!}
			                        </div>
			                        <div class="col-md-6">
			                            {!! $buyer_form->render('county') !!}
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">Postcode</div>
			                        <div class="col-md-6">Company Website</div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">
			                           {!! $buyer_form->render('post_code') !!}
			                        </div>
			                        <div class="col-md-6">
			                           {!! $buyer_form->render('company_website') !!}
			                        </div>
			                    </div>
			                </div>
			                <div class="container-fluid">
			                    <div class="row">
			                        <dic class="col-12">
			                            <p class="address-title">
			                                BUYER CONTACT DETAILS
			                            </p>
			                            <p>We will need to verify your Buyer, so please provide the details of
			                                the person in that company that we can contact to do this. We will
			                                not contact your Buyer without your prior permission.</p>
			                        </dic>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">Title</div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">
			                           {!! $buyer_form->render('title') !!}
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">First name</div>
			                        <div class="col-md-6">Last name</div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">
			                            {!! $buyer_form->render('first_name') !!}
			                        </div>
			                        <div class="col-md-6">
			                            {!! $buyer_form->render('last_name') !!}
			                        </div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">Job title / position in company</div>
			                        <div class="col-md-6">Email address</div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-6">
			                            {!! $buyer_form->render('job_title') !!}
			                        </div>
			                        <div class="col-md-6">
			                           	{!! $buyer_form->render('email') !!}
			                        </div>
			                    </div>
			                   
			                    <div class="row">
			                        <div class="col-md-2">Phone code</div>
			                        <div class="col-md-4">Telephone number</div>
			                    </div>
			                    <div class="row">
			                        <div class="col-md-2">
			                            {!! $buyer_form->render('phone_code') !!}
			                        </div>
			                        <div class="col-md-4">
			                          	 {!! $buyer_form->render('phone') !!}
			                        </div>
			                    </div>

			                </div>
		                </div>
		                <br>
		                 @endif

				        <!-- Footer !-->
				            {!! $buyer_form->footer !!}
		            </div>
            </div>

            <!-- end buyer form -->

            <div class="row custom-collapse">
                <div class="col-md-6 col-xs-12 ">
                    <p class="mb-0">AUCTION DETAILS</p>
                </div>
                <div class="col-md-6 col-12">
                    <p class="float-md-right mb-0">

                        <a href="#" id="link_edit_auction">EDIT</a> / <a href="#" id="close_edit_auction">CLOSE</a>
                    </p>
                </div>
            </div>
            <hr>
            <div id="edit_auction" style="display: none;">
                 <div class="form">

        {!! $auction_form->header !!}

        @if(!$auction_form->message)

            {!! $auction_form->render('user_id') !!}
            {!! $auction_form->render('buyer_id') !!}

            <div class="row add-a-buyer">
                <div class="col">
                    <p class="address-title">AUCTION DETAILS</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Invoice Number <span class="required"></span></br>
                    {!! $auction_form->render('po_number') !!}

                </div>
            </div>
            <div class="row upload-document">
                <div class="col-md-6">
                    {!! $auction_form->render('po_file_name') !!}
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    Upload Invoice Document
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Total Amount of the Invoice (£)<span class="required"></span>
                    {!! $auction_form->render('total_amount_of_po_duplicate') !!}
                    {!! $auction_form->render('total_amount_of_po') !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Amount of Funding Required  (£)<span class="required"></span><br>
                    <span class="limit" style="display: none">
                <font color="red">Funding Cannot Exceed 90% Of Invoice value</font>
            </span>
                    {!! $auction_form->render('amount_funding_required_duplicate') !!}
                    {!! $auction_form->render('amount_funding_required') !!}
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    <!-- Up to a maximum of 90% of the amount of the PO can be
                    funded -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Maximum Collection Fee <span class="required"></span> <br>
                    <span class="discount_limit" style="display:none">
              <font color="red">Limit is
                  {{$settings[0]['maximum_discount_limit']}}%</font>
          </span>
                    {!! $auction_form->render('maximum_discount_limit') !!}
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    <!-- Your PO will be auctioned for sale to Investors. Please
                    state the
                    maximum amount (the Discount Limit) that you will to
                    discount the PO in
                    order to raise funding. -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" hidden>
                    Agency Fee (£)<br>
                    <input class="form-control" name=agency_fee id="agency_fee_original" type="text"
                           value="{{$auction['agency_fee']}}" placeholder=""
                           readonly>
                        <input type="hidden" name="agency_fees" value="{{$settings[0]['agency_fee']}}">
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    <!-- This is the fee that you receive to sell the goods or
                    services stated
                    on the PO and collect payment by the due date from the
                    Buyer, on behalf
                    of the investors. -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Funding Joint Fee <br>
                    <input class="form-control" type="text" id="funding_joint_fee_original" name="funding_joint_fee"
                           value="{{$auction['funding_joint_fee']}}"
                           placeholder="" readonly>
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    <!-- This is the maximum fee that you will be charged for using
                    our service. -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Potential Net funding available to you<br>
                    <input class="form-control" type="text" id="net_funding_available_original" name='net_funding_available' value="{{$auction['net_funding_available']}}" readonly>
                      <input type="hidden" name="funding_joint_fees" value="{{$settings[0]['funding_joint_admin_fee']}}">
                    <!-- {!! $auction_form->render('net_funding_available') !!}
                    {!! $auction_form->render('net_funding_available_duplicate') !!} -->

                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    <!-- This is the amount you could raise if your auction is fully
                    funded and
                    depending on the Discount Limit achieved. -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Why you require funding <span class="required"></span><br>
                    {!! $auction_form->render('why_require_funding') !!}
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    <!-- To help Investors with their decision making, tell us about
                    the PO and
                    the goods or services that you will provide, and why you
                    require funds. -->
                </div>
            </div>



            {!! $auction_form->footer !!}

        @else
            {!! $auction_form->message !!}
        @endif
    </div>
            </div>

            <div class="row custom-collapse">
                <div class="col-md-6 col-12">
                    <p class="mb-0">FUNDING PERIOD</p>
                </div>
                <div class="col-md-6 col-12">
                    <p class="float-md-right mb-0"><a href="#" id="link_edit_funding_period">EDIT</a> / <a href="#"
                                                                                                           id="close_edit_funding_period">CLOSE</a>
                    </p>
                </div>
            </div>
            <hr>
             <div id="edit_funding_period" style="display: none;">
                {!! $form['funding_period_form']->header !!}

{{--                @if(!$form['funding_period_form']->message)--}}

                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            Expected invoice issue date <span class="required"></span><br>
                            {!! $form['funding_period_form']->render('expected_invoice_issue_date') !!}
                            <input class="form-control" type="text" id="expected_invoice_issue_date_display" name="expected_invoice_issue_date_display" value="{{$form['funding_period_form']->model->expected_invoice_issue_date}}">
                        </div>
                        <div class="col-md-6">
                            Expected Invoice Term (days)<br>
                            {!! $form['funding_period_form']->render('expected_invoice_term') !!}
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <p class="my-1 py-1">Date repayment due</p>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <input class="form-control  m-0" type="text" id="date_repayment_due_display" name="date_repayment_due_display" value="" readonly>
                            <input class="form-control  m-0" hidden="text" id="date_repayment_due" name="date_repayment_due" value="" readonly> 
                        </div>
                    </div>
                    <hr class="pb-2">
            {{--@else--}}
                {{--{!! $form['funding_period_form']->message !!}--}}
            {{--@endif--}}
            {!! $form['funding_period_form']->footer !!}

            </div>

            {{ Form::open(array('url' => 'create-auction-confirm')) }}
            @if(!(Request::segment(2)))
            <div class="row">
                <div class="col-md-1">
                    <input type="checkbox" required name=auction_confirmed
                           aria-label="Checkbox for following text input" value="1">
                    
                </div>
                <div class="col-md-11">Please confirm that the goods or services being
                    provided on this PO meet the requirements of Funding Joint's compliancy
                    policy. <a href="{{route('compliance_policy')}}" target="_blank">Read our policy</a>.
                </div>
            </div>
            @endif
            <input type="hidden" name="auction_id" value="{{$id}}">
            <!-- if i have the auction id then this means i'm editing !-->
            @if((Request::segment(2)))
                <button type="submit" class="btn float-md-right register-next">UPDATE AUCTION</button>
            @else
                <button type="submit" class="btn float-md-right register-next">CREATE AUCTION</button>
            @endif

            {{ Form::close() }}
        </div>
    </div>



    <!-- Approve Modal -->
    <div class="modal fade" id="privacyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center w-100" id="exampleModalLabel">Privacy Policy</h5>
                    <button type="button" class="close float-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
                <hr>

                <!-- Modal body -->
                <div class="modal-body" style="max-height: 500px; overflow-x: auto;">
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet excepturi facere laudantium
                        molestiae molestias quae quidem sequi suscipit voluptatem voluptatum. Alias animi atque aut
                        corporis debitis deleniti doloribus enim error eum explicabo facilis id in ipsa iste, maiores

                </div>

            </div>
        </div>
    </div>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script type="text/javascript">
        //window.onbeforeunload = function() { return "Your work will be lost."; };
    $(document).ready(function() {

    	$('#expected_invoice_issue_date').datepicker();
        $('#expected_invoice_issue_date').attr('readonly', true);
        $('#expected_invoice_issue_date').addClass('input-disabled');
    });
    </script>

    <script type="text/javascript">

        var total_amount_of_po = document.getElementById('total_amount_of_po');
        var total_amount_of_po_original = document.getElementById('total_amount_of_po_original');


        total_amount_of_po.addEventListener('keyup', function(e)
        {
            total_amount_of_po.value = format_number(this.value);
            total_amount_of_po_original.value = parseInt(this.value.replace(/,/gi, ""));
        });

        var amount_funding_required = document.getElementById('amount_funding_required');
        var amount_funding_required_original = document.getElementById('amount_funding_required_original');
        amount_funding_required.addEventListener('keyup', function(e)
        {
            amount_funding_required.value = format_number(this.value);
            alert(amount_funding_required.value);
            amount_funding_required_original.value = parseInt(this.value.replace(/,/gi, ""));
        });

        $("#total_amount_of_po_original").keyup(function () {
            // alert("test");
                // call calculation
            alert('z');
            calculations();
        });

        $(document).ready(function() {
            var total_amount_of_po = document.getElementById('total_amount_of_po');
            var amount_funding_required = document.getElementById('amount_funding_required');

            var total_amount_of_po_original = document.getElementById('total_amount_of_po_original');
            var amount_funding_required_original = document.getElementById('amount_funding_required_original');

            total_amount_of_po.value = format_number(total_amount_of_po_original.value);

            amount_funding_required.value = format_number(amount_funding_required_original.value);


        });

    </script>
   

@endsection
