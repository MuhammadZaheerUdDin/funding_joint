@include('layouts.admin.partials.header')

<div class="col-md-12 no-padding ">
    <div class="alert-area">
        <!-- please hide whole alert-area -->
    @stack('alerts')
    <!-- please hide whole alert-area -->
    </div>
    <div class="admin">
        @yield('content')
    </div>

    @yield('fixed-content')
</div>

<!-- Scripts -->

@stack('scripts')
<!-- start zofe requirements !-->
{!! Rapyd::head() !!}
<!-- end zofe requirements !-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
</body>

</html>
