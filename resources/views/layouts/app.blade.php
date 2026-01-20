<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FJ') }}</title>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://www.rapyd.com/packages/zofe/rapyd/assets/datepicker/datepicker3.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<div>

<div class="container-fluid">
    <div class="registration-seller">
        <div class="registration-header row">
            <div class="logo">
                <a href="/"><img src="/assets/img/register-logo.png" alt="Funding Joint"></a>
            </div>
            <div class="ml-auto logged-in-icons">
                <div class="row">

                @guest
                    <!--guest code to go here if needed-->

                    @else
                        <!-- if seller show auction button spatie is not used -->
                        @if(Auth::user()->user_type === 1)
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-3 icon">
                                    <a href="/step-1"><img src="assets/img/auction-icon.png" alt="Auction"></a>
                                </div>
                                <div class="col-md-7">
                                    <p class="title">Auction</p>
                                    <p class="sub-title"><a href="/step-1">Create Auction</a></p>
                                </div>
                            </div>
                        </div>
                       @endif
                        <div class="col-md-3">
                            <div class="row">
                                <div class="col-md-3 icon">
                                    <a href="#"><img src="assets/img/wallet-icon.png" alt="My Account"></a>
                                </div>
                                <div class="col-md-6">
                                    <p class="title">£0,000</p>
                                    <p class="sub-title"><a href="#">My Account</a></p>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="row">
                                <div class="col-md-3 icon">
                                    <a href="#"><img src="assets/img/person-icon.png" alt="Person"></a>
                                </div>
                                <div class="col-md-6">
                                    <li class="nav-item dropdown">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->email }} <span class="caret"></span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </div>
                            </div>

                        </div>

                </div>
            </div>

        </div>

    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 no-padding border-right">
        <div class="registration-menu ">

            <div class="registration-padding-fix">
                <ul>
                    <li class="active-heading">
                        <a class="active-link" href="#"><img src="assets/img/market-icon.png"><span class="menu-label">MARKETPLACE</span></a>
                    </li>
                    <li>
                        <a href="#"><img src="assets/img/dashboard-icon.png"><span
                                    class="menu-label">DASHBOARD</span></a>
                    </li>
                    <li>
                        <a href="#"><img src="assets/img/my-auctions-icon.png"><span
                                    class="menu-label">MY AUCTIONS</span></a>
                    </li>
                    <li>
                        <a href="/notifications"><img src="assets/img/notify-icon.png"><span class="menu-label">NOTIFICATIONS</span></a>
                    </li>
                    <li>
                        <a href="#"><img src="assets/img/buyers-icon.png"><span class="menu-label">BUYERS</span></a>
                    </li>
                </ul>
            </div>


    </div>
        </div>
        <div class="col-md-7">
            @yield('content')
        </div>
    </div>
</div>
@endguest


</div>
@include('partials.footer')


<script>
    var appUrl ="{{url("/")}}";
</script>

<!-- Scripts -->

<script src="{{ asset('js/app.js') }}"></script>

<!-- start zofe requirements !-->
{!! Rapyd::head() !!}
<!-- end zofe requirements !-->


</body>
</html>
