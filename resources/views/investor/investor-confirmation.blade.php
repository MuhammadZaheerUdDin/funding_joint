@extends('layouts.admin.page')

@section('content')
    <div class="profile">
        <div class="profile__content">
            <div class="row mb-4 align-items-center">
                <div class="col-md-12 col-sm-12 edit-button">
                    <h2 class="profile__content__heading font-weight-bold">Terms of Service</h2>
                    <hr>
                </div>
            </div>
            {!! Form::model(array($investor), ['action' => 'Investor\InvestorController@confirmation']) !!}
            <div class="form-group mb-0">
                <div class="row">
                    <div class="col-12">
                        <p class="d-inline-block pr-3">
                            {!! Form::checkbox('agree',1,false,['class' => 'form-control float-left w-auto']) !!}
                        </p>
                        <p class="d-inline-block">
                            <!-- {!! Form::label('agree','I have read and agree to the terms and conditions of service') !!} <span class="required"></span> -->
                             {!! Form::label('I have read and agree to the Terms and Conditions of service','I have read and agree to the Terms and Conditions of service') !!} <span class="required"></span>
                            <span class="error_input"><strong>{{ $errors->first('agree') }}</strong></span>
                            <br>
                            <a href="{{url('/terms')}}" target="_blank" class="font-weight-bold">Read Terms and Conditions and Agency Agreement</a>

                        </p>

                    </div>


                    <div class="col-12 mt-3">
                        <button type="submit" class="btn btn-primary ml-0">
                            {{ __('Complete Registration') }}
                        </button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
