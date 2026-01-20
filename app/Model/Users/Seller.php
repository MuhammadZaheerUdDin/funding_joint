<?php

namespace App\Model\Users;

use App\Model\Auction\Auction;
use App\Model\Bank\BankDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Seller extends Model
{

    use HasRoles;

    /**
     * @const TYPE
     * @description This is the user type
     */
    public $user_type = 1;

    protected $table = 'sellers';

    protected $guard_name = 'seller';

    protected $appends = ['full_name'];


    /**
     * @param $guard
     * @return mixed
     */
    public function setGuard($guard)
    {

        return $this->guard_name = $guard;

    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title',
        'first_name',
        'last_name',
        'dob',
        'job_title',
        'email',
        'phone',
        'phone_code',
        'company_name',
        'company_reg_no',
        'company_type',
        'building_no',
        'your_company_website',
        'address_1',
        'address_2',
        'address_3',
        'town',
        'county',
        'hear_of_us',
        'post_code',
        'country',
        'about_your_business',
        'agree',
        'turnover',
        'trading_time',
        'company_authorised',
        'no_other_bank',
        'experian_rating',
        'credit_limit',
        'dob_incorporation'

    ];

    protected $guarded = ['id'];

    public function user()
    {

        return $this->belongsTo('App\Model\Users\User');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class, 'user_id', 'user_id');
    }



    public function bankdetails()
    {
        return $this->hasOne(BankDetails::class, 'user_id', 'user_id');
    }


    /**
     * Set the Company Authorised Attribute
     * @method setCompanyAuthorisedAttribute
     * @param  string $value
     * @return int
     */
    public function setCompanyAuthorisedAttribute($value)
    {
        if ($value == "on") {

            $this->attributes['company_authorised'] = 1;
        }

        return 0;
    }
}
