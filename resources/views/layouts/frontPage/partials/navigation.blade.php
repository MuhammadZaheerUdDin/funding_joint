6<!-- Main navigation -->
<header class="home">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-website fixed-top scrolling-navbar">
        <div class="container-fluid">
          <a class="navbar-brand mr-auto logo " href='{{route("/")}}'>
            <img src="{{url('assets/img/logo.png')}}" alt="Funding joint"/>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-7"
                  aria-controls="navbarSupportedContent-7" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"><i class="fa fa-lg fa-bars"></i></span>
          </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent-7">
                <!-- <ul class="navbar-nav ml-auto left-nav-list">
                </ul> -->
                <ul class="navbar-nav ml-auto right-nav-list">
                  <li class="nav-item">
                      <a class="btn {{ Request::is('who_we_are') ? 'page-active' : '' }}" href="{{route('who_we_are')}}">Who we are</a>
                  </li>
                  <li class="nav-item">
                      <a class="btn {{ Request::is('how_it_works') ? 'page-active' : '' }}" href="{{route('how_it_works')}}">How it works</a>
                  </li>
                  <li class="nav-item">
                      <a class="btn {{ Request::is('faq') ? 'page-active' : '' }}" href="{{route('faq')}}">FAQ</a>
                  </li>
                  @auth
                    <li class="nav-item">
                        <a class="btn " href="{{route('marketplace')}}">Marketplace</a>
                      </li>
                      <li class="nav-item">
                        <a class="btn" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        Logout
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST"
                      style="display: none;">
                      @csrf
                    </form>
                  </li>
                  @else
                    <li class="nav-item">
                      <!-- <a class="btn login-btn" href="{{route('login')}}"><s>Login</s><br><small>(Coming Soon)</small> -->
                      <a class="btn login-btn" href="{{route('login')}}">Login</a> 
                      </a>
                    </li>
                    {{-- <li class="nav-item dropdown  keep-inside-clicks-open">

                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle login-button"
                                    data-disabled="true"
                                    dropdown-toggle
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                LOGIN
                            </button>
                            <div class="dropdown-menu">

                              @php
                              $seller = "seller";
                              $investors = "investers";
                              @endphp
                            
                          
                            
                            <a class="dropdown-item" href="{{ route('user-login',$seller) }}">SELLER</a>
                            
                                
                                <a class="dropdown-item" href="{{ route('user-login',$investors) }}">INVESTOR</a>
                            </div>
                        </div>
                    </li> --}}
                    {{-- <li class="nav-item dropdown  keep-inside-clicks-open">
                        <div class="btn-group">
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown"
                                    data-disabled="true"
                                    dropdown-toggle
                                    aria-haspopup="true" aria-expanded="true">
                                REGISTER
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('registration',$seller) }}">SELLER</a>
                                <a class="dropdown-item" href="{{ route('registration',$investors) }}">INVESTOR</a>
                            </div>
                        </div>
                    </li> --}}
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar -->
</header>
<!-- Main navigation -->
