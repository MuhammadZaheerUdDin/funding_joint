<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 11/7/2018
 * Time: 12:41 PM
 */

namespace App\Http\Controllers\Search;


use App\Http\Controllers\Search\AbstractSearch;

use App\Model\Transaction;
use Illuminate\Http\Request;

use App\Model\Users\User;


use Illuminate\Database\Eloquent\Builder;

class TransactionsSearch extends AbstractSearch
{

    public const relations = ['user'];

    /**
     * @method apply
     * @param Request $filters
     * @return mixed
     */
    public static function apply(Request $filters)
    {
        if(isset($filters->SortBy))
            $transaction = Transaction::with(self::relations);
        else
            $transaction = Transaction::with(self::relations)->orderBy('created_at','DESC');

        $query = parent::applyDecoratorsFromRequest($filters, ($transaction)->newQuery());

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

        //inject into paginate the current request
        $query = $query->paginate(parent::perPage);

        //append to pagination the request fields
        $query->appends($request->except(['_token']));

        return $query;

    }
}