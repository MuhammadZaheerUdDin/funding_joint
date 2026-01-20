@include('layouts.admin.partials.header')

@include('layouts.admin.partials.top-bar')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 no-padding border-right sidebar">
            @include('layouts.admin.partials.sidebar')
        </div>
        <div class="col-md-10 no-padding ">




            <div class="alert-area"><!-- please hide whole alert-area -->
                @stack('alerts')
            </div><!-- please hide whole alert-area -->


            <div class="main-content admin">
                <div class="clearfix">
                    {{-- <button onclick="javascript: window.history.back();" class="btn btn-dark btn-sm float-right" id="back_btn">Back</button> --}}
                    @yield('adhoc-btn')
                </div>

                @yield('content')
            </div>
            @yield('fixed-content')
        </div>

    </div>
</div>


@profileNotCompleted
    @if(Request::is(['marketplace']))

        <?php


        $user = \App\Model\Users\User::with('seller')->find(\Illuminate\Support\Facades\Auth::user()->id);

        $userHasAgreed = (\App\Helpers\UserHelper::hadUserAgreed($user));

        $user_type = $user->user_type;
        ?>

        @if($userHasAgreed == false)
            <div class="alert-area"><!-- please hide whole alert-area -->
                <div class="alert alert-info">
                    <a class="close" data-dismiss="alert">×</a>
                    You need to complete your <a href="{{ url('profile')  }}" style="color:lightskyblue">profile</a>
                </div>
            </div>
        @endif

        {{--Complete profile or continue to market place modal--}}
        <div class="modal fade" id="completeProfileModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <a href="#" class="close float-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                    <div class="modal-body">
                        <h4 class="modal-titsle">COMPLETE YOUR PROFILE.</h4>
                        @if($user_type == 2)
                        <p class="p-4">
                            You can browse the Marketplace, but will need to complete your profile before being able to create an auction. Click here to complete your profile.
                        </p>
                        <a href="{{route('full-registration-seller')}}" class="btn btn-primary btn-block mb-3">COMPLETE MY PROFILE</a>
                        @endif
                        @if($user_type == 3)
                         <p class="p-4">
                            You can browse the Marketplace, but will need to complete your profile before being able to make an investment. Click here to complete your profile.
                        </p>
                         <a href="{{route('full-registration-investor')}}" class="btn btn-primary btn-block mb-3">COMPLETE MY PROFILE</a>
                        @endif
                        <!-- <a href="{{auth()->user()->profileNotCompleteLink()}}" class="btn btn-primary btn-block mb-3">COMPLETE MY PROFILE</a> -->
                        <a href="{{route('marketplace')}}" class="btn btn-outline-primary btn-block" data-dismiss="modal">CONTINUE TO MARKETPLACE
                        <input id="sub" type="hidden" name="formvar" value="clicked">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endprofileNotCompleted


    @include('layouts.admin.partials.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
   {{--  <script type="text/javascript">
        $('#sub').click(function(event){
            add("hello");
            $.ajax({
               'url':{{ route('marketplace') }}
               success:function(response){
                 if(response=='ok'){
                   alert('session saved.');
                 }else{
                   alert('session Not saved!');
                 }
               }
            });
        });
    </script> --}}
    @stack('scripts')
    <!-- start zofe requirements !-->
    {!! Rapyd::head() !!}
    <!-- end zofe requirements !-->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    </body>

    </html>
