@extends('layouts.admin.page')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
  .btn {
    background-color: #33b5e5;
    border: none;
    color: white;
    padding: 0px 4px;
    font-size: 16px;
    cursor: pointer;
  }

  /* Darker background on mouse-over */
  .btn:hover {
    background-color: DodgerBlue;
  }
  </style>

<div class="row">
        <div class="col-12">
          <ul class="nav filter right float-right">
            <li><a href="{{route('users',array('type'=>'All'))}}">All</a></li>
            <li><a href="{{route('users',array('type'=>'Investor'))}}">Investors</a></li>
            <li><a href="{{route('users',array('type'=>'Seller'))}}">Sellers</a></li>
          </ul>
          <h4>Users</h4> 
          <hr>
        </div>

        <div class="col-12">
          <form method="get" class="row">
            <div class="col-12 col-md-8 mb-2 mb-md-0 ">
              <div class="input-group form-sm pl-0">
                <input class="form-control my-0 py-1" type="text" name="title" id="full_name" value="{!! $fields['title'] !!}" aria-describedby="emailHelp" placeholder="Search Users">
                <div class="input-group-append">
                  <button class="input-group-text lighten-2" type="submit"><i class="fa fa-search text-grey"
                      aria-hidden="true"></i></button>
                </div>
              </div>
            </div>
            <div class="col-6 col-md-2">
              <div class="form-group ">
                <a data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1"
                class="btn m-0 py-2 btn-outline-secondary">
                Filter <i class="zmdi zmdi-tune"></i>
              </a>
            </div>
          </div>
          
          <div class="col-12 collapse multi-collapse" id="multiCollapseExample1">
              <div class="row">
               
                <div class="col-md-4">
                  <div class="form-group row">
                    <label for="example-date-input" class="col-3">User Status</label>
                    <div class="col-9">
                      <select name="userStatus" class="custom-select mb-2 mr-sm-2 mb-sm-0">
                        <option @if ($fields['userStatus'] == "") selected="selected" @endif value="All" selected>All</option>
                        <option @if ($fields['userStatus'] ==  'New') selected="selected" @endif value="New">Incomplete</option>
                        <option @if ($fields['userStatus'] ==  'ToApprove') selected="selected" @endif value="ToApprove">Pending</option>
                        <option @if ($fields['userStatus'] ==  'Approved') selected="selected" @endif value="Approved">Approved</option>
                        <option @if ($fields['userStatus'] ==  'Declined') selected="selected" @endif value="Declined">Declined</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="col-6 col-md-2">
                  <select class="custom-select mb-2 mr-sm-2 mb-sm-0" name="sortBy" >
                    <option @if ($fields['sortBy'] == '') selected="selected" @endif>Choose</option>
                    <option @if ($fields['sortBy'] == 'recent') selected="selected" @endif value="recent">Sort by: Most Recent</option>
                    <option  @if ($fields['sortBy'] == 'oldest') selected="selected" @endif value="oldest">Sort by: Oldest First</option>
                  </select>
                </div>
                 <div class="row pb-3">
                <div class="col-6 col-md-8 form-inline pb-0 pb-md-3">
                  <div class="form-check mb-2 mr-sm-2 mb-sm-0">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" value="All" @if ($fields['type'] ==  'All') checked @endif checked name="type"> All
                    </label>
                  </div>
                  <div class="form-check mb-2 mr-sm-2 mb-sm-0">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" value="Investor" @if ($fields['type'] ==  'Investor') checked @endif name="type"> Investor
                    </label>
                  </div>
                  <div class="form-check mb-2  mr-sm-2 mb-sm-0">
                    <label class="form-check-label">
                      <input class="form-check-input" type="radio" value="Seller"   @if ($fields['type'] ==  'Seller') checked @endif name="type"> Seller
                    </label>
                  </div>
                </div>
                <div class="col-6 col-md-4 text-right align-self-end align-self-md-start">
                  <button class="btn btn-secondary my-0 py-2 " type="submit">Refresh</button>
                </div>
              </div>
               
              </div>
              <div class="row">
              
              
              </div>
            </div>
        </form>
      </div>
    </div>

    <table style="width: 100%;">
        <thead>
          <tr>
            <th><strong>Ref.No.</strong></th>
            <th><strong>Name</strong></th>
            <th><strong>Type</strong></th>
            <th><strong>Email</strong></th>
            <th><strong>Phone number</strong></th>
            <th><strong>Files</strong></th>
            <th><strong>Credit Limit(£)</strong></th>
            <th><strong>Wallet Amount(£)</strong></th>
            <th><strong>Status</strong></th>
            <!-- <th><strong>Last Communicated</strong></th> -->
            <th style="text-align: center;"><strong>Actions</strong></th>
          </tr>
      </thead>
   

    @if(count($results) > 0)
    <?php foreach ($results as $item):?>

    

        <tr>
         <td style="padding: 5px 0px;"><a href="{{ UserHelper::getUserProfileLink($item) }}" style="color:#212529;">{{$item->id}}</a></td>
          @if($item->user_type == 2)
            @if($item['seller']['first_name'] && $item['seller']['last_name'])
              <td><a href="{{ UserHelper::getUserProfileLink($item) }}" style="color:#212529;">{!! $item['seller']['first_name'] !!}&nbsp;{!! $item['seller']['last_name'] !!}</a></td>
            @else
              <td>...</td>
            @endif
         @endif
         @if($item->user_type == 3)
          @if($item['investor']['first_name'] && $item['investor']['last_name'] )
            <td><a href="{{ UserHelper::getUserProfileLink($item) }}" style="color:#212529;">{!! $item['investor']['first_name'] !!}&nbsp;{!! $item['investor']['last_name'] !!}</a></td>
          @else
            <td>...</td>
          @endif
         @endif
         @if($item->user_type == 2)
         <td><a href="{{ UserHelper::getUserProfileLink($item) }}" style="color:#212529;">Seller</a></td>
         @endif
         @if($item->user_type == 3)
         <td><a href="{{ UserHelper::getUserProfileLink($item) }}" style="color:#212529;">Investor</a></td>
         @endif
         <td><a href="{{ UserHelper::getUserProfileLink($item) }}" style="color:#212529;">{!! $item->email !!}</a></td>
         @if($item->user_type == 2)
          @if($item['seller']['phone'])
            <td><a href="{{ UserHelper::getUserProfileLink($item) }}" style="color:#212529;">{!! $item['seller']['phone'] !!}</a></td>
          @else
            <td>...</td>
          @endif
         @endif
         @if($item->user_type == 3)
            @if($item['investor']['phone'])
              <td><a href="{{ UserHelper::getUserProfileLink($item) }}" style="color:#212529;">{!! $item['investor']['phone'] !!}</a></td>
            @else
              <td>...</td>
            @endif
         @endif
         <td>1</td>
         @if($item->user_type == 2)
            <td><a href="{{ UserHelper::getUserProfileLink($item) }}" style="color:#212529;">{!! $item['seller']['credit_limit'] !!}</a></td>
          @else
            <td>...</td>
         @endif
          
          <td><a href="{{ UserHelper::getUserProfileLink($item) }}" style="color:#212529;">{{ $item->balance_amount}}</a></td> 
            
         <td><a href="{{ UserHelper::getUserProfileLink($item) }}" style="color:#212529;">{!! UserHelper::getUserStatus($item) !!}</a></td>
         <!-- <td>03/19/2020</td> -->
         @if($item->is_completed == 1)
         <td style="float: right;">
            <a class="btn" href="{{URL::asset( UserHelper::getUserProfileLink($item))}}"><i class="fa fa-edit"></i></a>
            <a class="btn" href="{{route('approve-user',array($item->id,1))}}"><i class="fa fa-check"></i></a>
            <a class="btn" href="{{route('approve-user',array($item->id,2))}}"><i class="fa fa-close"></i></a>
            <a class="btn" href="{!! url('users/export') !!}/{!! $item->id !!}"><i class="fa fa-download"></i></a>
              <button type="button" class="btn chatButton" data-toggle="modal" data-target="#declineAuctionModal{{$item['id']}}" user={{$item['id']}}>
                  <i class="fa fa-comment"></i>
                </button>
          </td>
          @endif
        </tr>

    <div class="modal fade" id="declineAuctionModal{{$item['id']}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Comments</h5>
            </div>
            <div class="modal-body">
              @comments(['model' => $item])
              @endcomments
         
          </div>
        </div>
      </div>
    </div>
    <?php endforeach; ?>
    @else
    <p>
      Your search returned 0 results.
    </p>
    @endif
  </table>
  <br>


  {{ $results->links() }} 


  

<!-- @if(count($results) > 0)
<?php foreach ($results as $item):
  //print_r($item);die;
 ?>

    <div class="comman-card admin my-3">

      <div class="card comman-card__content">
        <div class="col-12 card-body">
          <div class="row full py-2 ">
            <div class="col-12 col-md-4 title py-2 py-md-1">
              <a href="{{ UserHelper::getUserProfileLink($item) }}">
                <div class="row">
                  <div class="col-12">
                    <div class="mb-1 w-100 pb-1 align-self-start">
                      <i class="shield {{$item->getRole() == 'seller' ? 's' : 'i'}}"></i>
                      @if($item->user_type == 2)
                      <h4 class="d-inline-block mt-2"><strong>{!! $item['seller']['company_name'] !!}</strong></h4>
                      @endif
                       @if($item->user_type == 3)
                      <h4 class="d-inline-block mt-2"><strong>{!! $item->full_name !!}</strong></h4>
                      @endif
                    </div>
                  </div>
                  <div class="col">
                    <p><strong>{!! $item->username !!}</strong></p>
                    <p><strong>{!! $item->email !!}</strong></p>
                    <p>Reference Number <span class="ref darker">{!! $item->id !!}</span></p>
                  </div>
                </div>
              </a>
            </div>
            <div class="col-12 col-md-4 py-2 py-md-1">
              <a @if(UserHelper::hadUserAgreed($item)) href="{{ UserHelper::getUserProfileLink($item) }}" @endif>
                <div class="row">
                  <div class="col-6">User Type:</div>
                  <div class="col-6 darker">
                    <strong>
                      {!! UserHelper::getUserType($item) !!}
                    </strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">Files:</div>
                  <div class="col-6 darker">
                    <strong>1</strong>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">Status:</div>
                  <div class="col-6 darker"><strong>
                    {!! UserHelper::getUserStatus($item) !!}</strong>
                  </div>
                </div>
                @if($item->user_type == 3)
                @if (UserHelper::getUserExperianRating($item) != false)
                <div class="row">
                  <div class="col-6">Experian Rating:</div>
                  <div class="col-6 darker"><strong>
                    {!! UserHelper::getUserExperianRating($item) !!}</strong>
                  </div>
                </div>
                @endif
                @endif
                @if($item->user_type == 2)
                @if(UserHelper::getUserCreditLimit($item) == false)
                <div class="row">
                  <div class="col-6">Credit Limit:</div>
                  <div class="col-6 darker"><strong>&pound;{!! number_format(UserHelper::getUserCreditLimit($item),2,'.','')  !!}</strong></div>
                </div>
                @endif
                @endif
              </a>
            </div>
            @if(UserHelper::hadUserAgreed($item))
                  <div class="col-12 col-md-4 py-2 py-md-1">
                    <div class="btn-group w-100" role="group">
                        <a href="{{route('approve-user',array($item->id,2))}}" class="btn btn-darkred {{  $item->approved == 2   ? 'disabled' : '' }}  decline-button m-0 w-50">Decline</a>
                        <a href="{{route('approve-user',array($item->id,1))}}" class="btn {{ $item->approved == 1 ? 'btn-primary disabled' :'btn-primary' }}  approve-button m-0 w-50">Approve</a>
                    </div>
                    <a
                    href="{!! url('users/export') !!}/{!! $item->id !!}"
                    class="btn btn-outline-secondary m-0 w-100 export-button">
                    <i class="fa fa-download"></i>
                    Export
                  </a>
                </div>
              @else
                  <div class="col-12 col-md-4 py-2 py-md-1">
                    <div class="btn-group w-100" role="group">
                      <p>
                        User did not complete any details yet!
                      </p>
                    </div>
                  </div>
            @endif
        </div>
      </div>
      <div class="card-footer border-top ">
        <a href="{{ UserHelper::getUserProfileLink($item) }}">
          @if($item->approved == 1)
          <span class="approval-notice">{{\App\Helpers\FormattedDate::format($item->created_at)}} - Profile has been approved </span>
          @elseif($item->approved == 0 )
          <span class="approval-notice">{{\App\Helpers\FormattedDate::format($item->created_at)}} - Profile is pending approval </span>
          @else
          <span class="approval-notice">{{\App\Helpers\FormattedDate::format($item->created_at)}} - Profile has been declined </span>
          @endif
        </a>
      </div>
    </div>
  </div>

<?php endforeach; ?>

@else

  <p>
    Your search returned 0 results.
  </p>

@endif


{{ $results->links() }} -->



<style type="text/css">
.main-content{
  margin:20px 0px auto 14px !important;
}
.main-content.admin{padding-left: 0 !important;}
</style>


@endsection
