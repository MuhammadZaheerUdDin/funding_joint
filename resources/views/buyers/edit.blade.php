@extends('layouts.admin.page')
@section('content')

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


        <div class="create_buyer">


            {!! $form->header !!}
            {!! $form->message !!}

            @if(!$form->message)

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
                         
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">Company Registration Date</div>
                    </div>
                    <div class="row">
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
                            {!! $form->render('turnover') !!}
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                </div> -->

    @if(auth()->user()->user_type === 1)
    {{-- @include(('admin.view.buyer.bottom-bar')) --}}
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <p class="address-title">
                        BUYER Ratings
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <select name="experian_rating" class="custom-select mb-2 mr-sm-2 mb-sm-0" {{-- onchange="this.form.submit();" --}}>
                        <option value="">Rating</option>
                        <option @if( $profile->experian_rating==="Excellent") selected @endif value="Excellent">
                            Excellent
                        </option>
                        <option @if( $profile->experian_rating==="Good") selected @endif value="Good">Good</option>
                        <option @if( $profile->experian_rating==="Fair") selected @endif value="Fair">Fair</option>
                        <option @if( $profile->experian_rating==="Poor") selected @endif value="Poor">Poor</option>
                        <option @if( $profile->experian_rating==="Very Poor") selected @endif value="Very Poor">Very
                            Poor
                        </option>
                    </select>
                    <span class="error_input">
                        <strong>{{ $errors->first('experian_rating') }}</strong>
                    </span>
                </div>                        
            </div>
        </div>
    @endif

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
                        <div class="col-md-6">Country / Region</div>
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
    </div>

@endsection
