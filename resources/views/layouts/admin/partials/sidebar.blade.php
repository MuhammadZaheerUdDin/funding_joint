<a href="javascript:void(0)" class="sidebar__close__btn" id="sidebar__close__btn">&times;</a>
<div class="registration-menu {{auth()->user()->getRole()}}">
  <div class="registration-padding-fix">
      <ul class="row">
        <li class="col col-md-12 marketplace-color {{ Request::is('marketplace*') ? 'active-heading' : '' }}">
          <a class="{{ Request::is('marketplace*') ? 'active-link' : '' }}" href="{{ route('marketplace') }}">
          <i class="zmdi zmdi-city-alt"></i><span class="menu-label">MARKETPLACE</span></a>
        </li>
        @if(auth()->user()->profileCompleted() && auth()->user()->is_approved)
          <li class="col col-md-12 {{ Request::is('dashboard*') ? 'active-heading' : '' }}">
            <a  class="{{ Request::is('dashboard*') ? 'active-link' : '' }}"  href="{{ route('dashboard') }}" class="{{ Request::is('dashboard*') ? 'active-link' : '' }}"><i class="zmdi zmdi-view-dashboard"></i><span class="menu-label">DASHBOARD</span></a>
          </li>
        @endif
        @role('admin')
          <li class="col col-md-12 {{ Request::is('auctions*') ? 'active-heading' : '' }}">
              <a class="{{ Request::is('marketplace*') ? 'active-link' : '' }}"  href="{{ route('admin.auctions') }}"><i class="zmdi zmdi-view-dashboard"></i><span class="menu-label">AUCTIONS</span></a>
          </li>
          <li class="col col-md-12 {{ Request::is('users*') ? 'active-heading' : '' }}">
              <a class="{{ Request::is('users*') ? 'active-link' : '' }}"  href="{{ route('users') }}"><i class="zmdi zmdi-view-dashboard"></i><span class="menu-label">USERS</span></a>
          </li>
          <li class="col col-md-12 {{ Request::is('transactions*') ? 'active-heading' : '' }}">
              <a class="{{ Request::is('transactions*') ? 'active-link' : '' }}"  href="{{ route('admin.transactions') }}"><i class="zmdi zmdi-view-dashboard"></i><span class="menu-label">TRANSACTIONS</span></a>
          </li>
          <li class="col col-md-12 {{ Request::is('notifications*') ? 'active-heading' : '' }}">
            <a class="{{ Request::is('notifications*') ? 'active-link' : '' }}"  href="{{ route('notifications') }}"><i class="zmdi zmdi-calendar-note"></i><span class="menu-label">NOTIFICATIONS</span> @if(auth()->user()->unreadNotifications()->count() >0) <span class="badge badge-info ml-2">{{auth()->user()->unreadNotifications()->count()}}</span> @endif</a>
          </li>
          <li class="col col-md-12 {{ Request::is('buyers*') ? 'active-heading' : '' }}">
              <a class="{{ Request::is('marketplace*') ? 'active-link' : '' }}"  href="{{ route('buyers.index') }}"><i class="zmdi zmdi-view-dashboard"></i><span class="menu-label">BUYERS</span></a>
          </li>
          <li class="col col-md-12 {{ Request::is('settings*') ? 'active-heading' : '' }}">
              <a class="{{ Request::is('settings*') ? 'active-link' : '' }}"  href="{{ route('settings.edit') }}"><i class="zmdi zmdi-view-dashboard"></i><span class="menu-label">SETTINGS</span></a>
          </li>
        <li class="col col-md-12 {{ Request::is('editor*') ? 'active-heading' : '' }}">
          <a class="{{ Request::is('editor*') ? 'active-link' : '' }}"  href="{{ route('editor.index_admin') }}"><i class="zmdi zmdi-view-dashboard"></i><span class="menu-label">PAGES & FAQ</span></a>
        </li>

        <li class="col col-md-12 {{ Request::is('websitecontent*') ? 'active-heading' : '' }}">
          <a class="{{ Request::is('websitecontent*') ? 'active-link' : '' }}"  href="{{ route('websitecontent') }}"><i class="zmdi zmdi-view-dashboard"></i><span class="menu-label">WEBSITE CONTENT</span></a>
        </li>

        <li class="col col-md-12 {{ Request::is('inquiry*') ? 'active-heading' : '' }}">
          <a class="{{ Request::is('inquiry*') ? 'active-link' : '' }}"  href="{{ route('inquiry') }}"><i class="zmdi zmdi-view-dashboard"></i><span class="menu-label">INQUIRY</span></a>
        </li>
        @endrole

        @role('seller')
        @if(auth()->user()->profileCompleted() && auth()->user()->is_approved)
          <li class="col col-md-12 {{ Request::is('my-auctions*') ? 'active-heading' : '' }}">
            <a class="{{ Request::is('my-auctions*') ? 'active-link' : '' }}"  href="{{ route('seller.auctions') }} "><i class="zmdi zmdi-balance"></i><span class="menu-label">MY AUCTIONS</span></a>
          </li>
          <li class="col col-md-12 {{ Request::is('buyers*') ? 'active-heading' : '' }}">
            <a class="{{ Request::is('buyers*') ? 'active-link' : '' }}"  href="{{ route('buyers.index') }}"><i class="zmdi zmdi-card-travel"></i><span class="menu-label">BUYERS</span></a>
          </li>
        @endif
          <li class="col col-md-12 {{ Request::is('notifications*') ? 'active-heading' : '' }}">
            <a class="{{ Request::is('notifications*') ? 'active-link' : '' }}"  href="{{ route('notifications') }}"><i class="zmdi zmdi-calendar-note"></i><span class="menu-label">NOTIFICATIONS</span> @if(auth()->user()->unreadNotifications()->count() >0) <span class="badge badge-info ml-2">{{auth()->user()->unreadNotifications()->count()}}</span> @endif</a>
          </li>
        @endrole

        @role('investor')
          @if(auth()->user()->profileCompleted()  && auth()->user()->is_approved)
            <li class="col col-md-12 {{ Request::is('my-investments*') ? 'active-heading' : '' }}">
              <a class="{{ Request::is('my-investments*') ? 'active-link' : '' }}"  href="{{ route('my_investments') }}"><i class="zmdi zmdi-calendar-note"></i><span class="menu-label">MY INVESTMENTS</span></a>
            </li>
          @endif
          <li class="col col-md-12 {{ Request::is('notifications*') ? 'active-heading' : '' }}">
            <a class="{{ Request::is('notifications*') ? 'active-link' : '' }}"  href="{{ route('notifications') }}"><i class="zmdi zmdi-calendar-note"></i><span class="menu-label">NOTIFICATIONS</span> @if(auth()->user()->unreadNotifications()->count() >0) <span class="badge badge-info ml-2">{{auth()->user()->unreadNotifications()->count()}}</span> @endif</a>
          </li>
        @endrole

      </ul>
  </div>
</div>
