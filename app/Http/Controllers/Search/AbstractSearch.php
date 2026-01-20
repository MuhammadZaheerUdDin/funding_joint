<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 8/13/2018
 * Time: 1:25 PM
 */

namespace App\Http\Controllers\Search;


use App\Model\Users\User;

use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\Builder;


/**
 * Class MainSearch
 * @description This uses the builder pattern
 * @package BargainPond\Search\Classes
 */
class AbstractSearch
{

    const relations = ['investor', 'seller'];

    public $fields;

    const fields = [];

    /**
     *
     */
    const perPage = 10;


    public function __construct()
    {

    }

    /**
     * @method apply
     * @param Request $filters
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public static function apply(Request $filters)
    {
        $bargain = null;

        print_r('<pre>');
        print_r($filters->all());
        exit;
        $query = static::applyDecoratorsFromRequest($filters, ($bargain)->newQuery());

        return static::getResults($query, $filters);

    }


    /**
     * @method applyDecoratorsFromRequest
     * @param Request $request
     * @param Builder $query
     * @return Builder
     */
    public static function applyDecoratorsFromRequest(Request $request, Builder $query)
    {

        foreach ($request->all() as $filterName => $value) {

            $decorator = static::createFilterDecorator($filterName);

            if (static::isValidDecorator($decorator)) {

                if (is_array($value)) {

                    $query = $decorator::apply($query, $value);

                } else {

                    if (strlen($value) > 0) {

                        if(!is_null($query)){

                            $query = $decorator::apply($query, $value);

                        }

                    }
                }


            }
        }
        
        return $query;
    }

    /**
     * @method createFilterDecorator
     * @description init's the right filter class
     * @param $name
     * @return string
     */
    private static function createFilterDecorator($name)
    {
        return __NAMESPACE__ . '\\filters\\' . studly_case($name);
    }


    /**
     * @method isValidDecorator
     * @description Checks if a decorator class is valid
     * @param $decorator
     * @return bool
     */
    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    /**
     * @param Builder $query
     * @param Request $request
     * @return mixed
     */
    private static function getResults(Builder $query, Request $request)
    {
        //
        $query = $query->with(self::relations);

        //inject into paginate the current request
        $query = $query->paginate(self::perPage);

        //append to pagination the request fields
        $query->appends($request->except(['_token']));

        return $query;

    }


    /**
     * @method setSearchFields
     * @param $fields
     * @return array
     */
    public  function setSearchFields($fields)
    {
       return $this->fields = $fields;
    }


    public static function getSearchFields()
    {
        
    }
}