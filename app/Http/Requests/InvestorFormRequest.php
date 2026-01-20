<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class InvestorFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        $user = Auth::user();

        if ($user['user_type'] === 3 || $user['user_type'] === 1) {

            return true;

        } else {
            // not investor
            return false;
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
            'title' => 'nullable|alpha',
            'first_name' => 'nullable|alpha_spaces',
            'last_name' => 'nullable|alpha_spaces',
            'middle_name' => 'nullable|alpha_spaces',
            'user_name' => 'nullable|alpha-num',
            'dob' => 'nullable|before:-18 years',
            'nationality' => 'nullable|alpha-num',
            'gender' => 'nullable|alpha-num',
            'phone_code' => 'nullable|nullable',
            'phone' => 'nullable|nullable',
            'country_residence' => 'nullable',
            'building_no' => 'nullable',
            'address_1' => 'nullable',
            'address_2' => 'nullable',
            'address_3' => 'nullable',
            'town' => 'nullable',
            'county' => 'nullable',
            'post_code' => 'nullable|max:100',
            'country' => 'nullable|max:50',
            'read_investors_declaration' => 'nullable',
            'source_of_funds' => 'nullable|max:100',
            'job_title' => 'nullable|max:100',
            'employer_name' => 'nullable|max:100',
            'nature_employers_business' => 'nullable|max:100',
            'business_location' => 'nullable|max:100',


        ];
    }

    public function messages()
    {

        return [
            'title.required' => 'Please enter your title',
            'first_name.required' => 'Please enter your first name',
            'town.required' => 'Please enter town name',
            'last_name.required' => 'Please enter your last name',
            'user_name.required' => 'Please enter your username',
            'dob.required' => 'Please enter your date of birth',
            'nationality.required' => 'Please enter your nationality',
            'gender.required' => 'Please enter your gender',
            'phone_code.required' => 'Please enter numbers only, no + or - characters',
            'phone.required' => 'Please enter numbers only, no + or - characters',
            'country_residence.required' => 'Please enter your country of residence',
            'building_no.required' => 'Please your building or house number',
            'address_1.required' => 'Please your first line address',
            'post_code.required' => 'Please enter your postcode, only number and letters',
            'country.required' => 'Please enter your country',
            'read_investors_declaration.required' => 'Please confirm you have read the investors declaration',
            'source_of_funds.required' => 'Please enter your source of funds',
            'job_title.required' => 'Please enter your job title',
            'nature_employers_business.required' => 'Please enter your nature of employers business',
            'employer_name.required' => 'Please enter your employer name',
            'business_location.required' => 'Please enter your business location',

        ];

    }
}
