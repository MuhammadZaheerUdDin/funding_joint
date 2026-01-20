<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BankFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();

        if ($user) {
            return true;

        } else {
            // not investor
            redirect('/');
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
            'bank_name' => 'required',
            'account_name' => 'required',
            'sort_code' => 'required|numeric|digits_between:6,10',
            'account_number' => 'required|numeric|digits_between:5,10',
        ];
    }

    public function messages()
    {

        return [
            'bank_name.required' => 'Please enter your bank name',
            'account_name.required' => 'Please enter your account name',
            'account_number.required' => 'Please enter your account number',
            'sort_code.required' => 'Please enter sort code',
        ];

    }
}
