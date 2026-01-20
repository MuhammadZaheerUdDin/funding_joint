<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\NotificationsController;
use App\Model\Auction\Auction;
use App\Model\Users\User;
use App\Notifications\UserNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RepaymentDueChecker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'repayment:due';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This checks every 3 days the system and sends a notification to the seller for his due payments';

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

            $threeDaysBefore = $auction->date_repayment_due->subDay(3);

            $today = Carbon::now();

            if($today->gt($threeDaysBefore)){

                //send the notification
                $auction = Auction::findOrFail($auction->id);

                $user = User::findOrFail($auction->user_id);

                $not_title = config('notifications.seller.repayment_due');

                $not_link = route('auction.details',['id'=>$auction->id]);

                $not_body = ' You need to start the payment process for your due auction.';

                $notification = new UserNotification($not_title, $not_body, $not_link);

                NotificationsController::sendToUser($user, $notification);

            }

        }
    }
}
