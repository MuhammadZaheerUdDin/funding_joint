<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/6/2018
 * Time: 11:19 AM
 */
?>

@extends('layouts.admin.page')
@section('content')

    <h5 class="text-uppercase">SETTINGS</h5>
    <hr>

    {!! $form->header !!}

    {!! $form->message !!} <br />

    @if(!$form->message)


    <div class="profile">
      <div class="profile__content">
    <div class="form-area mt-2">


      <div class="form-group pb-3">
        <div class="row">

            <!-- Left !-->
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-12 col-sm-8 pb-2">
                        {!! $form->render('minimum_auction_length') !!}
                    </div>
                    <div class="col-12 col-sm-8 pb-2">
                        {!! $form->render('maximum_auction_length') !!}
                    </div>
                    <div class="col-12 col-sm-8 pb-2">
                        {!! $form->render('maximum_discount_limit') !!}
                    </div>



                </div>

            </div>

            <!-- Right !-->
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12 pb-2">
                        {!! $form->render('maximum_time_to_invoice') !!}
                    </div>
                    <div class="col-sm-12 pb-2">
                        {!! $form->render('maximum_invoice_issue') !!}
                    </div>
                    <div class="col-sm-12 pb-2">
                        {!! $form->render('minimum_expected_invoice_term') !!}
                    </div>
                </div>
            </div>



</div></div>


          <div class="form-group pb-3">

        <h5 class="profile__content__heading mt-4">P.O Settings</h5>
        <div class="row">
            <div class="col-sm-12">
                {!! $form->render('po_settings') !!}
            </div>
        </div>
        </div>

<div class="form-group pb-3">
        <h5 class="profile__content__heading mt-4">Funding Joint Settings</h5>

        <div class="row mb-3">
            <div class="col-sm-6">
                {!! $form->render('funding_joint_admin_fee') !!}
            </div>

            <div class="col-sm-6">
                {!! $form->render('agency_fee') !!}
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-6">
                {!! $form->render('maximum_expected_roi') !!}
            </div>

            <div class="col-sm-6">
                {!! $form->render('minimum_bid_amount') !!}
            </div>
        </div>
</div></div></div></div>
    @endif

    {!! $form->footer !!}



@endsection
