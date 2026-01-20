@extends('layouts.admin.page')

@section('content')


    <div class="form-loggedin">
        <!---form element-->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <h5><b>We will review your cash flow and assign you with a credit limit</b></h5>
                    <h6>So that we may do this, please upload your bank statements for the last 6 months for all accounts with all banks that you have</h6>
                    <div class="card">
                        <div class="card-header">Your Company Bank Statements</div>

                        <div class="card-body">

                            @if(Session::has('msg'))

                                <div class="alert alert-primary" role="alert">
                                    {{ Session::get('msg') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if(count($files) > 0)
                                <h5>Uploaded Statements</h5>
                                <hr>

                                @foreach($files as $file)
                                    <h6>{{$file->statement_name}}</h6>
                                @endforeach
                            @endif

                            {!! Form::model(array($bankStatement), ['files' => true,'action' => 'Bank\BankStatementController@store']) !!}
                            @csrf
                                <span class="error_input">
                                   <strong>{{ $errors->first('bank_statement_file') }}</strong>
                                </span>

                                <div class="form-group row">

                                    <div class="col">
                                        {!! Form::file('bank_statement_file') !!} <span class="required"></span>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <button type="submit" name="submit" class="ml-0 btn btn-secondary btn-danger">
                                            {{ __('Upload File') }}
                                        </button>
                                    </div>
                                </div>

                                </form>
                                @if(count($files) > 0)
                                    <p>
                                        File Upload Completed
                                    </p>

                                    <p>
                                        <a class="btn btn-primary btn-danger ml-0 " href="{{ url('/seller-confirm')  }}" role="button">Proceed To Confirmation Page</a>
                                    </p>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
