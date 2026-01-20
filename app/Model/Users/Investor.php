<?php

namespace App\Model\Users;

use App\Model\Auction\Auction;
use App\Model\Bid;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Spatie\Permission\Traits\HasRoles;

class Investor extends Model
{
    use HasRoles;
    /**
     * @const TYPE
     * @description This is the user type
     */
    public $user_type = 2;

    protected $guard_name = 'investor';

    protected $guarded = ['id'];

    protected $hidden = ['_token'];

    protected $appends = ['full_name'];

    /**
     * @param $guard
     * @return mixed
     */
    public function setGuard($guard)
    {

        return $this->guard_name = $guard;

    }

    //
    protected $table = 'investors';

    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'middle_name',
        'user_name',
        'dob',
        'job_title',
        'phone_code',
        'phone',
        'building_no',
        'address_1',
        'address_2',
        'address_3',
        'town',
        'county',
        'country',
        'post_code',
        'agree',
        'nationality',
        'gender',
        'country_residence',
        'read_investors_declaration',
        'source_of_funds',
        'job_title',
        'employer_name',
        'nature_employers_business',
        'location_of_business'];


    public function user()
    {

        return $this->belongsTo('App\Model\Users\User');
    }

    public function bids()
    {

        return $this->hasMany(Bid::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function canBid($bid_amount)
    {
        return $this->user->balance_amount > $bid_amount;
    }

    public function investments(){
        $bids = Bid::where('user_id','=', $this->user_id )->pluck('auction_id')->toArray();

        //Get Auctions that the currently logged in user has bid on
        return Auction::whereIn('id', $bids)->get();

    }

    public function liveInvestments()
    {
        return $this->investments()->where('end_auction','>', Carbon::now());
    }

    /**
     * Check if investor has been paid for his bid 
     * @param $auction_id
     * @return mixed
     */
    public function auctionRepaid($auction_id){

        $bid =  Bid::where('user_id','=',$this->user_id)->where('user_id','=',$this->user_id)->first();
        return $bid->paid;
    }

}
