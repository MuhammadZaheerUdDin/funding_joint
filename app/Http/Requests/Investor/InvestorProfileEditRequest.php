<?php

namespace App\Http\Requests\Investor;

use Illuminate\Foundation\Http\FormRequest;

class InvestorProfileEditRequest extends FormRequest
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
            'address_1' => 'nullable',
            'address_2' => 'nullable',
            'address_3' => 'nullable',
            'town' => 'nullable',
            'county' => 'nullable',
            'post_code' => 'nullable|max:100',
            'country' => 'nullable|alpha-num|max:50',
            'read_investors_declaration' => 'nullable',
            'source_of_funds' => 'nullable|max:100',
            'employer_name' => 'nullable|max:100',
            'agree' =>  'nullable',
            'user_name' =>'nullable',
            'job_title' =>'nullable',
            'phone_code' =>'nullable',
            'phone' =>'nullable',
            'building_no' =>'nullable',
            'address_1' =>'nullable',
            'address_2' =>'nullable',
            'address_3' =>'nullable',
            'town' =>'nullable',
            'county' =>'nullable',
            'country' =>'nullable',
            'post_code' =>'nullable',
            'agree' =>'nullable',
            'nationality' =>'nullable',
            'gender' =>'nullable',
            'country_residence' =>'nullable',
            'read_investors_declaration' =>'nullable',
            'source_of_funds' =>'nullable',
            'job_title' =>'nullable',
            'employer_name' =>'nullable',
            'nature_employers_business' =>'nullable',
            'location_of_business' =>'nullable',
        ];
    
    }
}
