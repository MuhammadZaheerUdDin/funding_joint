@extends('layouts.admin.frame')
@section('content')


    <div class="form">
        {!! $form->header !!}

        @if(!$form->message)

            {!! $form->render('user_id') !!}
            {!! $form->render('buyer_id') !!}

            <div class="row add-a-buyer">
                <div class="col">
                    <p class="address-title">AUCTION DETAILS</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Purchase Order number <span class="required"></span></br>
                    {!! $form->render('po_number') !!}

                </div>
            </div>
            <div class="row upload-document">
                <div class="col-md-6">
                    {!! $form->render('po_file_name') !!}
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    Upload Purchase Order (PO) document
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Total Amount of the Purchase Order (£)<span class="required"></span>
                    {!! $form->render('total_amount_of_po_duplicate') !!}
                    {!! $form->render('total_amount_of_po') !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Amount of funding required  (£)<span class="required"></span><br>
                    <span class="limit" style="display: none">
                <font color="red">Funding Cannot Exceed 90% Of PO value</font>
            </span>
                    {!! $form->render('amount_funding_required_duplicate') !!}
                    {!! $form->render('amount_funding_required') !!}
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    Up to a maximum of 90% of the amount of the PO can be
                    funded
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Maximum discount limit <span class="required"></span> <br>
                    <span class="discount_limit" style="display:none">
              <font color="red">Limit is
                  {{$settings[0]['maximum_discount_limit']}}%</font>
          </span>
                    {!! $form->render('maximum_discount_limit') !!}
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    Your PO will be auctioned for sale to Investors. Please
                    state the
                    maximum amount (the Discount Limit) that you will to
                    discount the PO in
                    order to raise funding.
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Agency Fee (£)<br>
                    <input class="form-control" name=agency_fee type="text"
                           value={{$settings[0]['agency_fee']}} placeholder=""
                           readonly>
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    This is the fee that you receive to sell the goods or
                    services stated
                    on the PO and collect payment by the due date from the
                    Buyer, on behalf
                    of the investors.
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Funding Joint Fee <br>
                    <input class="form-control" type="text" name="funding_joint_fee"
                           value="{{$settings[0]['funding_joint_admin_fee']}}"
                           placeholder="" readonly>
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    This is the maximum fee that you will be charged for using
                    our service.
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Net funding available to you<br>
                    {{--<input class="form-control" type="text" name='net_funding_available'--}}
                           {{--value='' readonly>--}}
                    {!! $form->render('net_funding_available') !!}
                    {!! $form->render('net_funding_available_duplicate') !!}

                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    This is the amount you could raise if your auction is fully
                    funded and
                    depending on the Discount Limit achieved.
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    Why you require funding <span class="required"></span><br>
                    {!! $form->render('why_require_funding') !!}
                </div>
                <div class="col-md-6">
                    <p class="py-2 my-1"></p>
                    To help Investors with their decision making, tell us about
                    the PO and
                    the goods or services that you will provide, and why you
                    require funds.
                </div>
            </div>



            {!! $form->footer !!}

        @else
            {!! $form->message !!}
        @endif
    </div>



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
            amount_funding_required_original.value = parseInt(this.value.replace(/,/gi, ""));
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
