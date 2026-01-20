@extends('layouts.admin.page')

@section('content')
  <div class="notifications">
    <h4 class="text-uppercase">My Notifications</h4>
    <hr>

      <div class="row">
          <div class="col-lg-10">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item">
                      <a class="nav-link " id="home-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#unread" role="tab" aria-controls="unread" aria-selected="false">Unread messages</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#read" role="tab" aria-controls="read" aria-selected="false">Read messages</a>
                  </li>
              </ul>
          </div>
          <div class="col-lg-2">
              {!! Form::open(['url' => route('notifications'),'method'=>'GET']) !!}
              <select name="SortBy" class="form-control pull-right float-right" onchange="this.form.submit()">
                  <option @if(app('request')->input('SortBy')==="recent") selected @endif value="recent">Recent</option>
                  <option @if(app('request')->input('SortBy')==="oldest") selected @endif  value="oldest">Oldest</option>
              </select>
              {!! Form::close() !!}
          </div>
      </div>


      <div class="row">
          <div class="col-12 col-md-12">
              <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="home-tab">
                      @if($notifications->count() >0 )
                          @foreach($notifications as $key => $notification)
                              @component('components.notification',['notification' =>$notification,'user_id'=>$user_id]) @endcomponent
                          @endforeach
                      @else
                          <div class="alert alert-primary mt-5" role="alert">
                              No Notifications found
                          </div>
                      @endif
                      {!! $notifications->links() !!}
                  </div>
                  <div class="tab-pane fade  show active" id="unread" role="tabpanel" aria-labelledby="profile-tab">
                      @if($unRead->count() >0 )
                          @foreach($unRead as $key => $notification)
                              @component('components.notification',['notification' =>$notification,'user_id'=>$user_id]) @endcomponent
                          @endforeach
                      @else
                          <div class="alert alert-primary mt-5" role="alert">
                              No unread notifications found
                          </div>
                      @endif
                      {!! $notifications->links() !!}
                  </div>
                  <div class="tab-pane fade" id="read" role="tabpanel" aria-labelledby="contact-tab">
                      @if($read->count() >0 )
                          @foreach($read as $key => $notification)
                              @component('components.notification',['notification' =>$notification,'user_id'=>$user_id]) @endcomponent
                          @endforeach
                      @else
                          <div class="alert alert-danger mt-5" role="alert">
                              No read notifications found
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                      @endif
                      {!! $notifications->links() !!}
                  </div>
              </div>
          </div>
      </div>


  </div>


    <div class="modal fade" id="declineAuctionModal{{ $user_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Comment</h5>
              </div>
              <div class="modal-body">

                <div class="comments">
                  <div class="row" style="padding-left: 20px;">
                    
                    </div>
                </div>
                <!-- FORM --> 
                <div class="">
                    <div class="card">
                        <div class="card-body">
                            <!-- <form method="POST" action="{{ url('comments') }}"> -->
                            <form method="POST" action="">
                                @csrf
                                <div class="form-group">
                                    <label for="message">Enter your message here:</label>
                                    <textarea class="commentText{{ $user_id }} form-control @if($errors->has('message')) is-invalid @endif" name="message" rows="3"></textarea>
                                    <div class="invalid-feedback">
                                        Your message is required.
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-outline-success text-uppercase submitComment" user="{{ $user_id }}" receiver_id='1'>Submit</button>
                            </form>
                        </div>
                    </div>
                  </div>     
                  <!-- FORM --> 


            </div>
          </div>
        </div>
    </div>
@endsection
