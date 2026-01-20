@extends('layouts.admin.page')

@section('content')
<div class="profile">
  <div class="profile__content">
    <div class="row mb-4 align-items-center">
      <div class="col-md-12 col-sm-12 edit-button">
        <h5 class="profile__content__heading">Bank Details</h5>
        <hr>
        <h6 >Your Company bank details are required so that we can transfer funds raised from investors to you</h5>
      </div>
    </div>

    <div class="form-area mt-5">
      <div class="form-group pb-3">
                      <h5 class="profile__content__heading">Primary Bank Details</h5>
        <!-- <div class="form-group"> -->
          {!! Form::model(array($bankDetails), ['action' => 'Bank\BankDetailsController@store']) !!}
          @csrf
            <div class="row">
                <div class="col-6">
                    {!! Form::label('Bank name','Primary Bank name') !!}
                    <span class="required"></span>
                    {!! Form::text('bank_name','', ['class' => 'form-control']) !!}
                    <span class="error_input">
                      <strong>{{ $errors->first('bank_name') }}</strong>
                    </span>
                </div>
            </div>
            <div class="row">

                <div class="col-6">

                    {!! Form::label('Account name','Account name') !!} <span class="required"></span>
                    {!! Form::text('account_name','', ['class' => 'form-control']) !!}
                <span class="error_input">
                  <strong>{{ $errors->first('account_name') }}</strong>
                </span>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    {!! Form::label('Sort code','Sort code') !!} <span class="required"></span>
                    {!! Form::text('sort_code','', ['class' => 'form-control']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('sort_code') }}</strong>
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    {!! Form::label('Account number','Account number') !!} <span class="required"></span>
                    {!! Form::text('account_number','', ['class' => 'form-control']) !!}
                    <span class="error_input">
                        <strong>{{ $errors->first('account_number') }}</strong>
                    </span>
                </div>
            </div>
          </div>
        <!-- </div> -->

        <div class="form-group pb-3">
                      <h5 class="profile__content__heading">Additional Bank Details</h5>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Second Bank name','Second Bank name') !!}
                <!-- <span class="required"></span> -->
                {!! Form::text('bank_name_1','', ['class' => 'form-control']) !!}
                <span class="error_input">
                   <strong>{{ $errors->first('bank_name_1') }}</strong>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Second Account name','Second Account name') !!} 
                {!! Form::text('account_name_1','', ['class' => 'form-control']) !!}
            <span class="error_input">
              <strong>{{ $errors->first('account_name_1') }}</strong>
            </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Second Sort code','Second Sort code') !!} 
                {!! Form::text('sort_code_1','', ['class' => 'form-control']) !!}
                <span class="error_input">
                    <strong>{{ $errors->first('sort_code_1') }}</strong>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Second Account number','Second Account number') !!}
                {!! Form::text('account_number_1','', ['class' => 'form-control']) !!}
                <span class="error_input">
                    <strong>{{ $errors->first('account_number_1') }}</strong>
                </span>
            </div>
        </div>
        <div class="divider-new"></div>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Third Bank name','Third Bank name') !!}
                <!-- <span class="required"></span> -->
                {!! Form::text('bank_name_2','', ['class' => 'form-control']) !!}
                <span class="error_input">
                   <strong>{{ $errors->first('bank_name_2') }}</strong>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Third Account name','Third Account name') !!} 
                {!! Form::text('account_name_2','', ['class' => 'form-control']) !!}
            <span class="error_input">
              <strong>{{ $errors->first('account_name_2') }}</strong>
            </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Third Sort code','Third Sort code') !!} 
                {!! Form::text('sort_code_2','', ['class' => 'form-control']) !!}
                <span class="error_input">
                    <strong>{{ $errors->first('sort_code_2') }}</strong>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Third Account number','Third Account number') !!}
                {!! Form::text('account_number_2','', ['class' => 'form-control']) !!}
                <span class="error_input">
                    <strong>{{ $errors->first('account_number_2') }}</strong>
                </span>
            </div>
        </div>
        <div class="divider-new"></div>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Fourth Bank name','Fourth Bank name') !!}
                <!-- <span class="required"></span> -->
                {!! Form::text('bank_name_3','', ['class' => 'form-control']) !!}
                <span class="error_input">
                   <strong>{{ $errors->first('bank_name_3') }}</strong>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Fourth Account name','Fourth Account name') !!} 
                {!! Form::text('account_name_3','', ['class' => 'form-control']) !!}
            <span class="error_input">
              <strong>{{ $errors->first('account_name_3') }}</strong>
            </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Fourth Sort code','Fourth Sort code') !!} 
                {!! Form::text('sort_code_3','', ['class' => 'form-control']) !!}
                <span class="error_input">
                    <strong>{{ $errors->first('sort_code_3') }}</strong>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                {!! Form::label('Fourth Account number','Fourth Account number') !!}
                {!! Form::text('account_number_3','', ['class' => 'form-control']) !!}
                <span class="error_input">
                    <strong>{{ $errors->first('account_number_3') }}</strong>
                </span>
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn float-right btn-primary  mb-0 ">
                    {{ __('SAVE') }}
                </button>
            </div>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
