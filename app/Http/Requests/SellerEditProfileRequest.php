<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerEditProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "hear_of_us" => "nullable",
            "your_company_website" => "nullable",
//            "dob" => "required",
//            'dob_incorporation' => 'required',
            "agree" => "required|accepted",
            'address_1' => 'required',
            'address_2' => 'nullable',
            'address_3' => 'nullable',
            'town' => 'required',
            'county' => 'nullable',
            'post_code' => 'required|max:100',
            'no_other_bank' => 'nullable',
            'company_authorised'=>'required',
//            'password' => 'required|min:6|confirmed',
//            'password_confirmation' => 'required|min:6',
        ];
    }

}
