<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SellerFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        if($user['user_type'] === 1) {
            return true;

        } else {
            // not seller
            return 'this account is not a seller account';
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|alpha',
            'first_name' => 'required|alpha_spaces',
            'last_name' => 'required|alpha_spaces',
            'dob' => 'required|before:-18 years',
            'phone' => 'required|numeric',
            'phone_code' => 'nullable|',
            'job_title' => 'required',
            'email' => 'required',
            'hear_of_us' => 'required',
            'dob_incorporation' => 'required',
            'company_reg_no' => 'required',
            'company_type' => 'required',
            'building_no' => 'required',
            'address_1' => 'required',
            'address_2' => 'nullable',
            'address_3' => 'nullable',
            'town' => 'required',
            'county' => 'nullable',
            'company_name' => 'required',
            'post_code' => 'required|max:100',
            'company_authorised' => 'required',
            'about_your_business' => 'required',
            'your_company_website' => 'nullable',
            'turnover' => 'required|numeric|between:0,999999999',
//            'agree' =>'required|accepted' TODO::Cleanup
        ];
    }
    public function messages()
    {
        return [
            'required'=>"This field is mandatory"
        ];
    }
}
