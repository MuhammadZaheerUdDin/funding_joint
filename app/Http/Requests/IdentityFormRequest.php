<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class IdentityFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();

        if($user) {
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
     *
     * TODO check file type
     */
    public function rules()
    {
        return [
            'proof_documents' => 'required|max:2048'

        ];
    }
}
