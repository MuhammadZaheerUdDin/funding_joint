@extends('layouts.auth')

@section('content')


    <div class="register-background">
      <div class="container">
        <div class="row justify-content-center log-in-form">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header text-center">
                <a href="/">
                  <img src="../public/assets/img/register-logo.png" alt="Funding Joint">
                </a>
              </div>
              <div class="card-body text-center">
                      <h3 class="text-uppercase">Confirmation</h3>
                      <div class="alert alert-success" role="alert">


                        <p>We have sent you an email confirmation.  Please click on the link in the email to activate your account.
                        </p>
                      </div>
                      <a href="{{URL::asset('/login')}}">login</a>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
