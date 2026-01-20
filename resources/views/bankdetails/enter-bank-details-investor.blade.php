@extends('layouts.admin.page')

@section('content')
<div class="profile">
  <div class="profile__content">
    <div class="row mb-4 align-items-center">
      <div class="col-md-12 col-sm-12 edit-button">
        <h5 class="profile__content__heading">Bank Details</h5>
        <hr>
        <h6>Your bank details are required so that we can transfer any profits from your investments to you</h5>
      </div>
    </div>


    {!! Form::model(array($bankDetails), ['action' => 'Bank\BankDetailsController@store']) !!}
    @csrf

      <div class="form-group">
        <div class="row">
          <div class="col">
              {!! Form::label('Bank name *','Bank name') !!}  <span class="required"></span>
              {!! Form::text('bank_name','', ['class' => 'form-control']) !!}
              <span class="error_input">
                 <strong>{{ $errors->first('bank_name') }}</strong>
              </span>
          </div>
          <div class="col">
              {!! Form::label('Account name *','Account name') !!}  <span class="required"></span>
              {!! Form::text('account_name','', ['class' => 'form-control']) !!}
              <span class="error_input">
                <strong>{{ $errors->first('account_name') }}</strong>
              </span>
          </div>
       </div>
      </div>
      <div class="form-group">
         <div class="row">
           <div class="col">
              {!! Form::label('Account number *','Account number') !!}  <span class="required"></span>
              {!! Form::text('account_number','', ['class' => 'form-control']) !!}
               <span class="error_input">
                  <strong>{{ $errors->first('account_number') }}</strong>
              </span>
          </div>
           <div class="col">
               {!! Form::label('Sort code','Sort code') !!} <span class="required"></span>
               {!! Form::text('sort_code','', ['class' => 'form-control']) !!}
               <span class="error_input">
                  <strong>{{ $errors->first('sort_code') }}</strong>
              </span>
           </div>
         </div>
       </div>
      <div class="form-group">
        <div class="row">
          <div class="col">
              {!! Form::label('Swift','Swift') !!}
              {!! Form::text('swift','', ['class' => 'form-control']) !!}
          </div>
          <div class="col">
              {!! Form::label('BIC','BIC') !!}
              {!! Form::text('bic','', ['class' => 'form-control']) !!}
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="row align-items-end">
          <div class="col-6 ">
              {!! Form::label('IBAN','IBAN') !!}
              {!! Form::text('iban','', ['class' => 'form-control']) !!}
          </div>
        </div>
      </div>

     <div class="form-group">
       <div class="row">
           <div class="col ">
               <button type="submit" class="btn float-left mb-0 btn-primary">
                   {{ __('SAVE') }}
               </button>
           </div>
       </div>
     </div>

    </form>

  </div>
</div>
@endsection
