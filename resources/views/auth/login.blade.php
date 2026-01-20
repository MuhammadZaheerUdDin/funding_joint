@extends('layouts.auth')

@section('content')


<div class="register-background" style="background-image:url({{asset('uploads/login_image.png')}})">
  <div class="container">
    <div class="row justify-content-center log-in-form">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header text-center">
            <a href="{{ route('/') }}" class="navbar-brand logo">
             <img src="{{URL::asset('/assets/img/register-logo.png')}}" alt="Funding Joint">
            </a>
          </div>
          <div class="card-body text-center">
                  <h3 class="text-uppercase">LOGIN {{ isset($UserTypeDescription) ? 'AS '.$UserTypeDescription :'' }}</h3>
              <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                  @csrf
                  <div class="form-group row {{ isset($UserTypeDescription) ? '': 'mt-5'}} ">
                      <div class="col-md-12">
                          <input id="email" type="email" placeholder="Email Address" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                          @if ($errors->has('email'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <input id="password" type="password" placeholder="Password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                          @if ($errors->has('password'))
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $errors->first('password') }}</strong>
                              </span>
                          @endif
                      </div>
                  </div>
                  <div class="form-group row">
                    <div class="col text-left">
                        <a class="btn btn-link p-0 m-0" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                      <!--
                      <div class="col-6 text-right">
                          <div class="form-check">
                              <input class="form-check-input align-left" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                              <label class="form-check-label" for="remember">
                                  {{ __('Remember Me') }}
                              </label>
                          </div>
                      </div>
                      !-->
                  </div>

                  <div class="form-group row">
                      <div class="col-md-12">
                          <button type="submit" class="btn btn-primary btn-purple m-0">
                              {{ __('Login') }}
                          </button>
                      </div>
                  </div>

                  <div>
                      <p>Don't have an account? <span>Register as either a <a href="{{ route('registration',$seller) }}"> Seller </a> or <a href="{{ route('registration',$investors) }}"> Investor</a></span></p>
                      <p>The investment opportunities offered may not be suitable for all investors and there is risk that you may not get back your money.</p>
                  </div>

              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
