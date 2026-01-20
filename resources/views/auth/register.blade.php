@extends('layouts.auth')
@section('content')
  <div class="register-background"  style="background-image:url({{asset('uploads/register_image.png')}})">
    <div class="container">
      <div class="row justify-content-center log-in-form">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header text-center">
                <a href="/">
                  <img src="../assets/img/register-logo.png" alt="Funding Joint">
                </a>
            </div>
            <div class="card-body ">
              <h3 class="text-uppercase text-center">REGISTER AS {{$verb}} {{ $UserTypeDescription }}</h3>
              <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                @csrf
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="email" class="text-left">Email Address <span class="required"></span></label>
                    <input id="email" type="email" placeholder="" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                      name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="password" class="text-left">Password <span class="required"></span></label>
                      <input id="password" type="password" placeholder="" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                          name="password" required>
                          <span class="invalid-feedback" role="alert">
                                  <strong>{{ "Password length must be 8 characters contains 1 capital , 1 Alphanumeric, 1 Upper Case 1 Lower Case" }}</strong>
                          </span>

                      @if ($errors->has('password'))
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                      @endif
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <label for="password-confirm" class="text-left">Confirm Password <span class="required"></span></label>
                    <input id="password-confirm" type="password" placeholder="" class="form-control"
                        name="password_confirmation" required>
                  </div>
                </div>
                <input type="hidden" name="UserType" value={{$UserType}}>
                <div class="form-group row">
                  <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-purple m-0">
                      {{ __('Register') }}
                    </button>
                  </div>
                </div>
              </form>
              <div>
                <p>Have an account? <span><a href="{{route('login')}}">Login Here</a></span></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
