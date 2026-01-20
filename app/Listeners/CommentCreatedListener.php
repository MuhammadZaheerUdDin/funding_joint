<?php
namespace App\Listeners;

/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/28/2018
 * Time: 2:25 PM
 */

use App\Http\Controllers\Admin\NotificationsController;
use App\Model\Auction\Auction;
use App\Model\Users\User;
use App\Notifications\UserNotification;
use Laravelista\Comments\Events\CommentCreated;

class CommentCreatedListener
{


    /**
     * Handle the event.
     *
     * @param  CommentCreated  $event
     * @return boolean
     */
    public function handle(CommentCreated $event)
    {

        $user = User::findOrFail($event->comment->commenter_id);

        $auction = Auction::findOrFail($event->comment->commentable_id);

        $not_title = config('notifications.user.comment_created');

        $not_link = route('auction.details',['id'=>$auction->id]);

        $not_body = $user->full_name . ' added a new question on your auction '. $auction->buyer->company_name;

        $notification = new UserNotification($not_title, $not_body, $not_link);

        NotificationsController::sendToUser($user, $notification);

    }
}