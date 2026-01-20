<section class="notification-panel {{is_null($notification->read_at)?'unread' : 'read'}}" style="padding: 0px;">
    @if($notification->read_at == NULL)
        <a href="{{route('notifications.markAsRead',$notification->id)}}" class="close float-right notification-mark-as_read"> </a>
    @endif
    <div class="row">
        <div class="col-md-10">
            <p class="notification-headline" style='float: left;'>
                @if(!is_null($notification->data['link']) && $notification->data['title'] != 'Admin Message')
                    <a href="{{$notification->data['link']}}" class=""><i class="fa fa-link"></i></a>
                @else
                    <a href="{{$notification->data['link']}}"  data-toggle="modal" data-target="#declineAuctionModal{{ $user_id }}" class="chatButton" user=1 receiver_id={{$user_id}}><i class="fa fa-comment-dots   "></i></a>
                @endif
                @if($notification->read_at != NULL)
                    <span type="text/css" style="font-weight: bold;">
                        {!! $notification->data['title'] or 'Notification Title' !!} 
                    </span>
                    @else
                    <span type="text/css">
                        {!! $notification->data['title'] or 'Notification Title' !!} 
                    </span>
                @endif
            </p>
            <p style="text-align: center;">{!! $notification->data['body'] or 'Notification Content' !!} </p>
        </div>
        <div class="col-md-2">
            <p class="notification-date">
                {{ $notification->created_at->format('d/m/Y')}}
            </p>
        </div>
    </div>
</section>
