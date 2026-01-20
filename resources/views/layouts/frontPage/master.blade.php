
@include('layouts.frontPage.partials.header')


<main>
    @include('laravel-inline-editor::html-manager')
    @include('layouts.frontPage.partials.navigation')
    @yield('content')
</main>


@include('layouts.frontPage.partials.footer')

</div>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
<script>
    jQuery.noConflict();
jQuery(document).ready(function() {
    jQuery(".login-popup-container").delay(5000).fadeIn(500);
    jQuery(".loginOverlay").delay(5000).fadeIn(500);
    jQuery('.close-popup').on('click', function(){
        jQuery(".login-popup-container").fadeOut(500);
        jQuery(".loginOverlay").fadeOut(500);
    })
});
</script>
<!-- Initializations -->
@stack('scripts')

</body>
</html>
