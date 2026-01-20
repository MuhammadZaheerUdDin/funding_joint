@extends('layouts.admin.page')
@section('content')
    <div class="container buyer__info">

        <div class="row align-items-middle">
            <div class="col-8">
                <h4>BUYERS</h4>
            </div>
            <!-- <div class="col-4">
                <a href="{{ url('buyers')  }}" class="btn btn-link float-right pull-right mr-0 pr-0">
                    
                    Back to Buyers Page
                </a>
            </div> -->
        </div>
        <hr>




        {{-- {!! $form->header !!}

        {!! $form->message !!} <br/>

        {!! $form->render('user_id') !!} --}}
        {!! Form::model(array($buyer), ['action' => 'Buyers\BuyersController@submitData','class' => '','files'=>true]) !!}

        {{-- @if(!$form->message) --}}

        <div class="profile">
          <div class="profile__content">

            <div class="form-area ">


              <div class="form-group pb-3">
                    <div class="row">
                      <div class="col">

                        <p class="buyer-detail mt-0 mb-4">Please enter the details of your buyer (the
                          company that has raised the purchase order and will purchase your
                          goods or services). Your buyer must be a UK registered company
                          having traded for at least 3 years.</p>
                      </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">Company name (as it appears on the company
                            documents) <span class="required"></span>
                        </div>
                        <div class="col-md-6">Company Registration Number <span class="required"></span></div>

                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            {{-- {!! $form->render('company_name') !!} --}}
                            {!! Form::text('company_name','',['class'=>'form-control','required'=>true]) !!}
                            <span class="error_input">
                               <strong>{{ $errors->first('company_name') }}</strong>
                            </span>
                        </div>
                        <div class="col-md-6">
                            {{-- {!! $form->render('company_registration') !!} --}}
                            {!! Form::text('company_registration','',['class'=>'form-control','required'=>true]) !!}
                        </div>
                        
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6">Company Registration Date</span></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{-- {!! $form->render('company_registration_date') !!} --}}
                            <input class="form-control" type="text" id="company_registration_date" name="company_registration_date" autocomplete="off">
                        </div>
                    </div>
                </div>


                <div class="form-group pb-3">

                    <div class="row">
                        <div class="col-12">
                            <p class="address-title mt-0">
                                BUYER ADDRESS DETAILS
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">Address line 1 <span class="required"></span></div>
                        <div class="col-md-6">Address line 2</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{-- {!! $form->render('address_1') !!} --}}
                            {!! Form::text('address_1','',['class'=>'form-control','required'=>true]) !!}
                        </div>
                        <div class="col-md-6">
                            {{-- {!! $form->render('address_2') !!} --}}
                            {!! Form::text('address_2','',['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Address line 3</div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{-- {!! $form->render('address_3') !!} --}}
                            {!! Form::text('address_3','',['class'=>'form-control']) !!}
                        </div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Town / City <span class="required"></span></div>
                        <div class="col-md-6">Country / Region</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{-- {!! $form->render('town') !!} --}}
                            {!! Form::text('town','',['class'=>'form-control','required'=>true]) !!}
                        </div>
                        <div class="col-md-6">
                            {{-- {!! $form->render('county') !!} --}}
                            {!! Form::text('county','',['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Postcode <span class="required"></span></div>
                        <div class="col-md-6">Company Website</div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{-- {!! $form->render('post_code') !!} --}}
                            {!! Form::text('post_code','',['class'=>'form-control','required'=>true]) !!}
                        </div>
                        <div class="col-md-6">
                            {{-- {!! $form->render('company_website') !!} --}}
                            {!! Form::text('company_website','',['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="form-group pb-3">
                    <div class="row">
                        <dic class="col-12">
                            <p class="address-title mt-0">
                                BUYER CONTACT DETAILS
                            </p>
                            <p>We will need to verify your Buyer, so please provide the details of
                                the person in that company that we can contact to do this. We will
                                not contact your Buyer without your prior permission.</p>
                        </dic>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Title <span class="required"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{-- {!! $form->render('title') !!} --}}
                            <select class="form-control form-control" type="select" id="title" name="title">
                                <option value="0">Mr</option>
                                <option value="1">Mrs</option>
                                <option value="2">Miss</option>
                                <option value="3">Dr</option>
                                <option value="4">Prof</option>
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">First name <span class="required"></span></div>
                        <div class="col-md-6">Last name <span class="required"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{-- {!! $form->render('first_name') !!} --}}
                            {!! Form::text('first_name','',['class'=>'form-control','required'=>true]) !!}

                        </div>
                        <div class="col-md-6">
                            {{-- {!! $form->render('last_name') !!} --}}
                            {!! Form::text('last_name','',['class'=>'form-control','required'=>true]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">Job title <span class="required"></span></div>
                        <div class="col-md-6">Email address <span class="required"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            {{-- {!! $form->render('job_title') !!} --}}
                            {!! Form::text('job_title','',['class'=>'form-control','required'=>true]) !!}
                        </div>
                        <div class="col-md-6">
                           {{--  {!! $form->render('email') !!} --}}
                            {!! Form::text('email','',['class'=>'form-control','required'=>true]) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">Phone code <span class="required"></span></div>
                        <div class="col-md-4">Telephone number <span class="required"></span></div>

                        <div class="col-md-3">
                            Business Type <span class="required"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            {{-- {!! $form->render('phone_code') !!} --}}
                            {!! Form::text('phone_code','',['class'=>'form-control','required'=>true]) !!}
                        </div>
                        <div class="col-md-4">
                            {{-- {!! $form->render('phone') !!} --}}
                            {!! Form::text('phone','',['class'=>'form-control','required'=>true]) !!}
                        </div>

                        <div class="col-md-6">
                            {{-- {!! $form->render('business_type') !!} --}}
                            {!! Form::text('business_type','',['class'=>'form-control','required'=>true]) !!}
                        </div>

                    </div>
                </div>
            </div>
            </div>
        {{-- @endif --}}
        {{-- {!! $form->footer !!} --}}
        <button type="submit" class="btn btn-primary float-left">
            {{ __('SAVE') }}
        </button>
           

    </div>
    
@endsection
