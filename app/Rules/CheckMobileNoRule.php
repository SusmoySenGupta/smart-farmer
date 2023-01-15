<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckMobileNoRule implements Rule
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
        $operators = ['17', '18', '19', '16', '15', '13', '14'];

        return in_array(substr($value, 0, 2), $operators);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid mobile number.';
    }
}
