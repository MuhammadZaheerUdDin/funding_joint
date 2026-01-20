@extends('layouts.admin.page')
@section('content')


<h4 class="text-uppercase">My Auctions</h4>
<hr>
<ul class="nav filter">
    <li class="nav-item">
        <a class="nav-link {{is_null(request()->AuctionStatus) ? 'active': ''}}" href="my-auctions">All</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->AuctionStatus =='Live' ? 'active' : ''}} " href="?AuctionStatus=Live">Live</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->AuctionStatus =='Pending' ? 'active' : ''}}" href="?AuctionStatus=Pending">Pending</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->AuctionStatus =='Complete' ? 'active' : ''}}" href="?AuctionStatus=Complete">Completed</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->AuctionStatus =='Declined' ? 'active' : ''}}" href="?AuctionStatus=Declined">Declined</a>
    </li>

</ul>



    @forelse($auctions as $auction)
      @component('components.seller.seller_auction',['auction'=>$auction]) @endcomponent
    @empty
        <div class="alert alert-info" role="alert">
            <strong>No auctions found</strong><br>
            <!-- You have not created any auctions. <a href="{{url('/marketplace')}}">Create</a> and get some funds! -->
        </div>
    @endforelse

@endsection
