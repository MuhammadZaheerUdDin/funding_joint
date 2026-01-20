<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/7/2018
 * Time: 12:41 PM
 */

namespace App\Http\Controllers\Search;


use App\Http\Controllers\Search\AbstractSearch;

use Illuminate\Http\Request;

use App\Model\Users\User;


use Illuminate\Database\Eloquent\Builder;

class UsersSearch extends AbstractSearch
{

    const relations = ['investor', 'seller'];

    /**
     * @method apply
     * @param Request $filters
     * @return mixed
     */
    public static function apply(Request $filters)
    {

        $user = User::with(self::relations)->where('user_type','!=',1)->where('is_completed','!=',0);

        $query = parent::applyDecoratorsFromRequest($filters, ($user)->newQuery());

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
        $query = $query->orderBy('created_at', 'desc')->with(self::relations);

        //inject into paginate the current request
        $query = $query->paginate(parent::perPage);

        //append to pagination the request fields
        $query->appends($request->except(['_token']));

        //print_r($query);die;

        return $query;

    }


}