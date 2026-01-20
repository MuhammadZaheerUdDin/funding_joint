@extends('layouts.admin.frame')
@section('content')
    <div class="create_buyer">


        {!! $form->header !!}
        {!! $form->message !!}

        @if(!$form->message)

            @if(Session::has('msg'))
                @push('alerts')
                    <div class="alert alert-info">
                        <a class="close" data-dismiss="alert">×</a>
                        {!!Session::get('msg')!!}
                    </div>
                @endpush
            @endif

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

                        {!! $form->render('company_name') !!}
                    </div>
                    <div class="col-md-6">

                        {!! $form->render('company_registration') !!}
                    </div>
                     <div class="col-md-6">

                        {!! $form->render('company_registration_date') !!}
                    </div>
                </div>
                <!-- <div class="row">

                    <div class="col-md-6">Annual Turnover</div>
                    <div class="col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! $form->render('turnover_duplicate') !!}
                        {!! $form->render('turnover') !!}
                    </div>
                    <div class="col-md-6"></div>
                </div> -->
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
                        {!! $form->render('address_1') !!}
                    </div>
                    <div class="col-md-6">
                        {!! $form->render('address_2') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">Address line 3</div>
                    <div class="col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! $form->render('address_3') !!}
                    </div>
                    <div class="col-md-6"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">Town / City</div>
                    <div class="col-md-6">County / Region</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! $form->render('town') !!}
                    </div>
                    <div class="col-md-6">
                        {!! $form->render('county') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">Postcode</div>
                    <div class="col-md-6">Company Website</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! $form->render('post_code') !!}
                    </div>
                    <div class="col-md-6">
                        {!! $form->render('company_website') !!}
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
                        {!! $form->render('title') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">First name</div>
                    <div class="col-md-6">Last name</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! $form->render('first_name') !!}
                    </div>
                    <div class="col-md-6">
                        {!! $form->render('last_name') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">Job title / position in company</div>
                    <div class="col-md-6">Email address</div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {!! $form->render('job_title') !!}
                    </div>
                    <div class="col-md-6">
                        {!! $form->render('email') !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">Phone code</div>
                    <div class="col-md-4">Telephone number</div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        {!! $form->render('phone_code') !!}

                    </div>
                    <div class="col-md-4">
                        {!! $form->render('phone') !!}
                    </div>


                </div>

            </div>
        @endif

    <!-- Footer !-->
        {!! $form->footer !!}
    </div>
    <script>
        var turnover = document.getElementById('turnover');
        var turnover_original = document.getElementById('turnover_original');

        turnover.addEventListener('keyup', function(e)
        {
            turnover.value = format_number(this.value);
            turnover_original.value = parseInt(this.value.replace(/,/gi, ""));
        });

        $(document).ready(function() {
            var turnover = document.getElementById('turnover');
            var turnover_original = document.getElementById('turnover_original');


            turnover.value = format_number(turnover_original.value);

        });
    </script>
@endsection
