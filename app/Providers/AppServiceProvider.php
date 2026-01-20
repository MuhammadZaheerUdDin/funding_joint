<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use App\Model\Auction\Auction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\Providers\Blade;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        \Blade::if ('auctionowner', function ($id) {
            $auction = Auction::findOrFail($id);

            return Auth::id() === $auction->user_id;
        });

        /**
         * @description Custom if blade to determine if user has completed profile
         * @return boolean
         */
        \Blade::if ('profileNotCompleted', function () {
            if(Auth::user()->getRole() == 'admin')
                return false;
            else
             return Auth::user()->profileCompleted() != 1;
        });



        //Add this custom validation rule.
        Validator::extend('alpha_spaces', function ($attribute, $value) {

            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s]+$/u', $value);

        });

        \Blade::directive('money', function ($value) {
            return "<?php echo number_format($value, 2,'.',','); ?>";
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        require_once app_path() . '/Helpers/UserHelper.php';
    }
}
