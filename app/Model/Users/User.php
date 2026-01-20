<?php

namespace App\Model\Users;

use App\Http\Controllers\Profile\ProfileNotCompleteRedirect;
use App\Model\AccountBalance;
use App\Model\Auction\Auction;
use App\Model\Bank\BankStatement;
use App\Model\Identification\Document;
use App\Model\Transaction;
use App\Model\Users\Seller;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Laravelista\Comments\Commenter;


class User extends Authenticatable
{
    use Notifiable, Commenter;

    use HasRoles;

    protected $table = 'users';
    /**
     * @param $guard
     * @return mixed
     */
    protected $guard_name = 'web';


    /**
     * @method setGuard
     * @param $guard
     * @return string $guard
     */
    public function setGuard($guard)
    {
        return $this->guard_name = $guard;
    }


    public function getFullNameAttribute()
    {

        try {
            if ($this->getRole() == 'admin') {
                logger('is admin');
                //return $this->email;
                return 'Admin';
            } elseif ($this->getRole() == 'seller') {

                if (!is_null($this->seller)) {

                    return $this->seller->full_name;
                }

                return '';

            } else {

                if (!is_null($this->investor)) {

                    return $this->investor->full_name;
                }

                return '';

            }
        } catch (\Exception $e) {
            \Log::error("We couldn't not extract the user full name" . $e->getMessage());

        }

    }

    /**
     * @description get user's name initials
     * @return string
     */
    public function getNameInitials()
    {
        $name = explode(" ", $this->full_name);
        
        $initials = null;
        foreach ($name as $n) {
            if(!empty($n)){
                $initials .= $n[0];
            }else{
                $initials .= 'ms';
            }   
            
        }
        return $initials;
    }

    public function getBalanceAmountAttribute()
    {
        if(Auth::user()->email=="admin@fundingjoint.com")
            return 0;
        return $this->balance->balance;
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'activation_code', 'status', 'user_type', 'approved'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function seller()
    {

        return $this->hasOne('App\Model\Users\Seller');
    }

    public function investor()
    {

        return $this->hasOne('App\Model\Users\Investor');
    }

    public function bankDetails()
    {

        return $this->hasOne('App\Model\Bank\BankDetails');
    }

    public function bankStatement()
    {

        return $this->hasMany(BankStatement::class);
    }

    public function identification()
    {

        return $this->hasMany(Document::class);
    }

    public function buyer()
    {

        return $this->hasMany('App\Model\Buyer\Buyer');
    }

    public function getRole()
    {
        return $this->getRoleNames()->first();
    }

    public function balance()
    {
        return $this->hasOne(AccountBalance::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function proof_of_address()
    {
        return $this->identification()->where('type_proof', Document::ADDRESS);
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }


    public function identities()
    {
        return $this->identification()->where('type_proof', Document::IDENTITY);
    }

    public function profileCompleted()
    {
        if (Auth::user()->investor()->exists()) {
            return $this->investor->agree;
        }
        if (Auth::user()->seller()->exists()) {
            return $this->seller->agree;
        }
        return (Auth::user()->getRole() == 'admin') ? true : false;
    }

    public function profileNotCompleteLink()
    {
        return ProfileNotCompleteRedirect::index();
    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSearchByFirstName($query, $value)
    {


        $request = Request::capture();

        if (strlen($request->get('search_name')) > 0) {

            $theQuery = $query->orWhereHas('investor', function ($q) use ($value) {
                $q->whereRaw(" CONCAT(first_name, ' ', last_name) like ?", array("%" . $value . "%"));
            })->orWhereHas('seller', function ($q) use ($value) {
                $q->whereRaw(" CONCAT(first_name, ' ', last_name) like ?", array("%" . $value . "%"));
            });

            return $theQuery;

        } else {

            return $query;
        }


    }

    /**
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeSearchByCreditLimit($query, $value)
    {
        $theQuery = $query->with('investor', function ($q) use ($value) {
            $q->where('credit_limit', '<', $value);
        });

        return $theQuery;

    }


    /**
     * @return int
     */
    public function getFilesCountAttribute()
    {
        return $this->identification()->count() + $this->bankStatement()->count();
    }

    /**
     * @description will return the current user's position in the leaderboard
     * @param Auction $auction
     * @return int|string position
     */
    public function getPositionInLeaderBoard(Auction $auction)
    {
        $user = Auth::user();
        $bids = $auction->bids()->where('user_id',$user->id)->first();

        if(isset($bids->rank) && $bids->rank != 0){
            return $bids->rank;
        }else{
            $bids = $auction->bids()->orderBy('bid_discount', 'asc')
                ->orderBy('amount', 'desc')
                ->get();
            $position = 0;
            foreach ($bids as $key => $bid) {
                if ($user->id == $bid->user_id)
                    $position = $key + 1;
            }
            return $position; 
        }
        

    }

    public function getAcceptedBidAmount(Auction $auction)
    {
        $user = Auth::user();
        $bids = $auction->bids()->where('user_id',$user->id)->first();
        return $bids->accepted_amount;
    }

    public function getBidAmount(Auction $auction)
    {
        $user = Auth::user();
        $bids = $auction->bids()->where('user_id',$user->id)->first();
        return $bids->amount;
    }

    public function getIsApprovedAttribute()
    {
        return $this->approved == 1;
    }

    public function getAdminWalletAmount()
    {
        $allCredit =  Transaction::where('confirmed', 1)->where('type', 'credit')->sum('amount');

        $allDebit =  Transaction::where('confirmed', 1)->where('type', 'debit')->sum('amount');
        $finalAmount = $allCredit - $allDebit;
        return floatval($finalAmount);
    }


}
