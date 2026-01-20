<?php
/**
 * Created by PhpStorm.
 * User: sizdrail
 * Date: 2/20/2019
 * Time: 12:56 PM
 */

namespace App\Http\Requests\Auction;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;


class StepTwoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return true;
    }



    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'buyer_id' => 'required',
        ];
    }
}
