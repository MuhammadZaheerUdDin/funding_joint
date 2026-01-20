<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 10/15/2018
 * Time: 1:50 PM
 */

namespace App\Helpers;


use App\Model\Users\Investor;
use App\Model\Users\Seller;
use App\Model\Users\User;

class UserHelper
{

    /**
     * @method getUserType
     * @description
     * @param $model
     * @return string
     * @throws
     */
    public static function getUserType(User $model)
    {

        switch ($model->user_type) {
            case 1:
                return "Admin";
                break;

            case 2:
                return (new \ReflectionClass(new Seller()))->getShortName();
                break;

            case 3:
                return (new \ReflectionClass(new Investor()))->getShortName();
                break;

            default:
                return 'Not Set';

        }

    }

    /**
     * @param User $model
     * @return string
     */
    public static function getUserName(User $model)
    {

        try {


            if (!is_null($model->user_type)) {


                switch ($model->user_type) {


                    case 1:

                        return $model->name;

                        break;


                    case 2:

                        return $model->seller->first_name . ' ' . $model->seller->last_name;

                        break;

                    case 3:

                        return $model->investor->first_name . ' ' . $model->investor->last_name;

                        break;

                }

            }


        } catch (\Exception $e) {

            logger('Something went wrong ' . json_encode($model));

        }

    }

    /**
     * @param $model
     * @return bool
     */
    public static function getUserStatus($model)
    {

        switch ($model->approved) {

            case 1:
                return 'Approved';
                break;

            case 2:
                return 'Declined';
                break;

            default:
                return 'Pending';
        }

    }


    /**
     * @param $model
     * @return bool
     */
    public static function hadUserAgreed($model)
    {

        switch ($model->user_type) {

            case 1:
                return true;
                break;

            case 2:

                if(!is_null($model->seller)){

                    return $model->seller->agree;
                }

                return false;

                break;

            case 3:

                if(!is_null($model->investor)){

                    return $model->investor->agree;
                }

                return false;

                break;

        }


    }

    /**
     * @param $model
     * @return bool
     */
    public static function getUserCreditLimit($model)
    {

        switch ($model->user_type) {

            case 1:
                return false;
                break;

            case 2:
                if(!is_null($model->seller)){

                    return $model->seller->credit_limit;
                }

                return false;

                break;

            case 3:

                return false;
                break;

        }


    }
    /**
     * @param $model
     * @return bool
     */
    public static function getUserExperianRating($model)
    {

        switch ($model->user_type) {

            case 1:

                return false;
                break;

            case 2:
                return @$model->seller->experian_rating;
                break;

            case 3:

                return false;
                break;

        }


    }


    /**
     * @param User $model
     * @return string
     * @throws \ReflectionException
     */
    public static function getRelationID(User $model)
    {

        try {


            if (!is_null($model->user_type)) {


                switch ($model->user_type) {


                    case 1:

                        return $model->name;

                        break;


                    case 2:

                        return $model->seller->id;

                        break;

                    case 3:



                        if (!is_null($model->investor->id)) {

                            return $model->investor->id;

                        } else {

                            logger('The investor is null ' . json_encode($model->investor));
                        }

                        return $model->investor->id;

                        break;

                }

            }


        } catch (\Exception $e) {

            logger("Something went wrong getting the user id \n" . json_encode($model));

        }

    }


    /**
     * @param User $user
     * @return string
     * @throws \ReflectionException
     */
    public static function getUserProfileLink(User $user)
    {
        $userID = UserHelper::getRelationID($user);

        if(is_null($userID)){

            return '#';

        }

        return route('admin.viewUser', ['UserType' => $user->getRole(), 'id' => UserHelper::getRelationID($user)]);
    }


    /**
     * @param $user_id
     * @method getUserDocuments
     */
    public static function getUserDocuments($user_id)
    {

        $user = User::findOrFail($user_id);

        if($user->type == 2){

            $user = Seller::findOrFail($user->id);


            $document = $user->user->bankStatement->first();

            dd($document);
        }


    }
}