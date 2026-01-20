<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/7/2018
 * Time: 12:41 PM
 */

namespace App\Http\Controllers\Search;


use App\Http\Controllers\Search\AbstractSearch;

use App\Model\Auction\Auction;
use Illuminate\Http\Request;

use App\Model\Users\User;


use Illuminate\Database\Eloquent\Builder;

class AuctionsSearch extends AbstractSearch
{

    const relations = ["user", "seller", "buyer", "bids"];

    /**
     * @method apply
     * @param Request $filters
     * @return mixed
     */
    public static function apply(Request $filters)
    {
       $userId=auth()->user()->id;

        $status = $filters->AuctionStatus;

        $auctions = Auction::with(self::relations)->where('user_id',$userId);

        if ($status == "live") {
            $auctions = $auctions

                ->where('approved', 1);
        }
//
//        if ($status == "pending") {
//            $auctions = $auctions
//                ->where('auctions.approved', null);
//        }
//
//
//        if ($status == "declined") {
//            $auctions = $auctions
//                ->where('approved', 2);
//        }
        if ($status == "complete") {
            $auctions = $auctions->EndedAuctions();
        }

        if(is_null($filters->SortBy)){
           $auctions = $auctions->orderBy('created_at','DESC');

        }

        $query = parent::applyDecoratorsFromRequest($filters, ($auctions)->newQuery());

        return static::getResults($query, $filters);

    }

    /**
     * @method getResults
     * @param Builder $query
     * @param Request $request
     * @return mixed
     */
    private static function getResults(Builder $query, Request $request)
    {
        //
        $query = $query->with(self::relations);

        //inject into paginate the current request
        $query = $query->paginate(parent::perPage);

        //append to pagination the request fields
        $query->appends($request->except(['_token']));

        return $query;

    }
}
