@extends('layouts.admin.page')
@section('content')
<div class="profile">
  <div class="profile__content">
      @if(Session::has('msg'))

          <div class="alert alert-primary" role="alert">
              {{ Session::get('msg') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
      @endif
    <!-- ID Verification !-->
    <div class="form-group">
        <div class="row align-items-center">
            <div class="col-md-12 col-sm-12 edit-button">
                <h5 class="profile__content__heading">ID Verification</h5>
                <h6>Please upload a valid form of ID. Acceptable forms of ID are a passport, drivers license, or other suitable photo ID.</h6>
                <hr>
            </div>
        </div>
          @if($files)
            @foreach($files as $file)
                @if($file->type_proof == "identity")
                    <div><b>Proof type:</b> {{$file->type_proof}}</div>
                    <div> <b>Filename:</b> <a href="{{route('download',$file->id)}}">{{$file->file_name}}</a></div>
                @endif
            @endforeach
          @endif
        @if(!$hasIdentity)
        <div class="form-group">

            {!! Form::model(array($docs), ['files' => true,'action' =>'Investor\IdentificationController@store']) !!}
            @csrf
            <div class="row">
                <div class="col">
                    {!! Form::file('proof_documents', ['class' => 'my-3','required'=>true]) !!}
                    <span class="error_input">
                  <strong>{{ $errors->first('proof_documents') }}</strong>
                </span>
                    {!! Form::hidden('file_type','identity') !!}
                    <br>
                    <button type="submit" class="btn btn-primary ml-0 mb-3 btn-danger">
                        {{ __('Upload File') }}
                    </button>
                </div>
                <div class="col">
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        @endif
    </div>


    <div class="form-group">
        <div class="row align-items-center">
            <div class="col-md-12 col-sm-12 edit-button">
                <h5 class="profile__content__heading">Address Verification</h5>
                <h6 class="mw-50">Please upload a proof of address - either a utility or council tax bill or a bank or credit card statement. These must not be more than 3 months old.</h6>
                <hr>
            </div>
        </div>
        @if($files)
            @foreach($files as $file)
                @if($file->type_proof == "address")
                    <div><b>Proof type:</b> {{$file->type_proof}} </div>
                    <div><b>Filename:</b> <a href="{{route('download',$file->id)}}">{{$file->file_name}}</a></div>
                @endif
            @endforeach
        @endif
        @if(!$hasAddress)
            <div class="form-group">
                {!! Form::model(array($docs), ['files' => true,'action' =>'Investor\IdentificationController@store']) !!}
                @csrf
                <div class="row">
                    <div class="col">
                        {!! Form::file('proof_documents', ['class' => 'my-3','required'=>true]) !!}
                        <span class="error_input">
                          <strong>{{ $errors->first('proof_documents') }}</strong>
                        </span>
                        {!! Form::hidden('file_type','address') !!}
                        <br>
                        <button type="submit" class="btn btn-primary ml-0 mb-3 btn-danger">
                            {{ __('Upload File') }}
                        </button>
                    </div>
                    <div class="col">
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        @endif

    </div>




    @if($proof == 1)
    File Upload Completed
    <br>
    <a class="btn btn-primary btn-danger mt-3" href="{{route('investor-confirm')}}" role="button">Proceed To
        Confirmation Page</a>
    @endif


  </div>
</div>
@endsection
