<div class="investments">
    <div class="profile__content">
        <h4 class="profile__content__heading text-uppercase">My Investments</h4>
    </div>
    <hr>
    <div class="profile__content marketplace">
        <div class="row">
            <div class="col-12 col-sm-8 col-md-9 col-lg-12">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link @if( app('request')->input('status')!=='live') active @endif" href="http://3.10.169.59/funding_joint/public/my_investments">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if( app('request')->input('status')==='live') active @endif"  href="?status=live">Live</a>
                    </li>
                </ul>
            </div>
        </div>

        <br>

        <div class="auctions">
            @forelse($auctions as $auction)
                @component('components.investor_auction',['auction'=>$auction]) @endcomponent
            @empty
                <div class="alert alert-warning" role="alert">
                    <strong>No Investments found</strong><br>
                </div>
            @endforelse
        </div>

    </div>
    <hr>
</div>
