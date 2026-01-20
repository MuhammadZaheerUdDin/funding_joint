<?php

namespace App\Http\Requests\Admin;

use App\Rules\CreditLimit;
use App\Rules\ExperianRating;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SellerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        if($user->getRole() =="admin")
            return true;
        else
            return 'Not An Admin!';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'credit_limit' => [new CreditLimit()],
            'experian_rating' => [new ExperianRating]
        ];
    }
}
