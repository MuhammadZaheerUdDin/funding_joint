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
<body>

<!-- <div class="container-fluid">
    <div class="registration-seller">
        <div class="registration-header row">
            <div class="logo">
                <a href="/"><img src="/assets/img/register-logo.png" alt="Funding Joint"></a>
            </div>
        </div>
    </div>
</div> -->

@yield('content')


@include('layouts.frontPage.partials.footer')


<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- start zofe requirements !-->
{!! Rapyd::head() !!}
<!-- end zofe requirements !-->


</body>
</html>
