<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\NotificationsController;
use App\Model\Auction\Auction;
use App\Model\Users\User;
use App\Notifications\UserNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AuctionFullyFunded extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auction:isFunded';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "This commands is run daily and check's if the auction is fully funded";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //

        $auctions = Auction::whereNotNull('date_repayment_due')->get();

        foreach ($auctions as $auction){

            $endDate = $auction->end_date;

            $today = Carbon::now();

            if($today->gt($endDate)){

                $auction->update(['status'=>'Successfully funded']);

                //send the notification
                $auction = Auction::findOrFail($auction->id);

                $user = User::findOrFail($auction->user_id);

                $not_title = config('notifications.seller.auction_fully_funded');

                $not_link = route('auction.details',['id'=>$auction->id]);

                $not_body = ' Your auction has been fully funded';

                $notification = new UserNotification($not_title, $not_body, $not_link);

                NotificationsController::sendToUser($user, $notification);

            }

        }
    }
}
