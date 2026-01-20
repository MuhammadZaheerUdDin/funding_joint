

<div class="container-fluid logout d-none d-sm-block">
  <div class="row">
    <div class="col ">
        <a class="btn small float-right" href="{{ route('logout') }}"
          onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          {{ __('Logout') }}
        </a>
    </div>
  </div>
</div>

<nav  class="navbar navbar-expand-lg  registration-seller">
  <div class="container-fluid registration-header">
      <button class="navbar-toggler d-md-none" type="button" id="sidebar__open__btn">
          <span class="navbar-toggler-icon"><i class="fa fa-lg fa-bars"></i></span>
      </button>
    <a href="{{ route('/') }}" class="navbar-brand logo">
        <img src="{{url('assets/img/register-logo.png')}}" alt="Funding Joint">
    </a>
    <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#headerSeller"
            aria-controls="headerSeller" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fa fa-lg fa-user-circle"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="headerSeller">
      <ul class="navbar-nav ml-auto logged-in-icons right-nav-list">
          @auth
          @role("seller")
              @if( auth()->user()->is_completed  == 1 && auth()->user()->approved == 1)
                <div class="nav-item">
                    <a href="{{route('first')}}">
                        <div class="icon">
                            <img src="{{asset('assets/img/auction-icon.png')}}" alt="Auction">
                        </div>
                        <div class="icon-right">
                            <p class="title">Auction</p>
                            <p class="sub-title">Create Auction</p>
                        </div>
                    </a>
                </div>
              @else
                <div class="nav-item">
                    <a href="{{route('first')}}" title="tet"><a title="You need to complete your profile before creating auction">
                        <div class="icon">
                            <img src="{{asset('assets/img/auction-icon.png')}}" alt="Auction">
                        </div>
                        <div class="icon-right">
                            <p class="title">Auction</p>
                            <p class="sub-title">Create Auction</p>
                        </div>
                    </a>
                </div>
              @endif
              
         
          @endif
              @if(auth()->user()->profileCompleted() && auth()->user()->getRole() !== "admin" && auth()->user()->approved == 1 )
                  <div class="nav-item">
                    <a href="{{ route('user.account')}}">
                      <div class="icon">
                        <img src="{{asset('assets/img/wallet-icon.png')}}" alt="My Account">
                      </div>
                      <div class="icon-right">
                        <p class="title"> £ @money(auth()->user()->balance_amount)</p>
                        <p class="sub-title">My Account</p>
                      </div>
                    </a>
                  </div>
              @elseif(auth()->user()->getRole() == "admin")
                <div class="nav-item">
                    <a href="{{ route('admin.transactions')}}">
                      <div class="icon">
                        <img src="{{asset('assets/img/wallet-icon.png')}}" alt="My Account">
                      </div>
                      <div class="icon-right">
                        {{-- <p class="title"> £ @money(auth()->user()->getAdminWalletAmount())</p> --}}
                        <p class="title"> £ @money(auth()->user()->balance_amount)</p>
                        <p class="sub-title">My Account</p>
                      </div>
                    </a>
                  </div>

              @endif
              @if(!auth()->user()->bankDetails()->exists())
              <div class="nav-item">
                <!-- <a class="nav-link " href="#"  data-toggle="modal" data-target="#noBankDetailsFound"> -->
              		@if(auth()->user()->user_type == 2)
                      	<a class="nav-link " href="{{ route('full-registration-seller') }}">
              	  @endif
              		@if(auth()->user()->user_type == 3)
                      <a class="nav-link " href="{{ route('full-registration-investor') }}" >
              	  @endif
                      <a class="nav-link " href="#" >
                        <div class="icon">
                          <img src="{{asset('assets/img/person-icon.png')}}" alt="Person">
                        </div>
                        <div class="icon-right">
                          <p class="title" >{{ Auth::user()->full_name }}</p>
                          {{-- <p class="sub-title">My Profile</p> --}}
                        </div>
                    </a>


                  <!-- Button trigger modal -->

                  <!-- Modal -->
                  <div class="modal fade" id="noBankDetailsFound" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Profile Incomplete</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>
                              <div class="modal-body">
                                  <p>
                                      No bank details found! <br>
                                  </p>
                                  <p>
                                      Profile Incomplete. Please <a style="display:initial;padding:0px;text-decoration: underline" href="{{ url('enter-bank-details')  }}">complete your profile</a>
                                  </p>

                              </div>
                          </div>
                      </div>
                  </div>

              </div>
              @else

              <div class="nav-item">
                  <a class="nav-link " href="{{route('profile.view')}}">
                      <div class="icon">
                          <img src="{{asset('assets/img/person-icon.png')}}" alt="Person">
                      </div>
                      <div class="icon-right">
                          <p class="title">{{ Auth::user()->full_name }}</p>
                          <p class="sub-title">My Profile</p>
                      </div>
                  </a>
              </div>

              @endif

              <div class="nav-item  d-block d-sm-none">
                <a class="btn small " href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                  style="display: none;">
                  @csrf
                </form>
            </div>
          @endauth
        </ul>
      </div>
    </div>
</nav>
