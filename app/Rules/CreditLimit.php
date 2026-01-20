<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CreditLimit implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $creditLimits = [
            '1000','10000','50000','50000+'
        ];
        return in_array($value,$creditLimits);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Credit Limit must be within the given limits!';
    }
}
