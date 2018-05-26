<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Year implements Rule
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
         if ($value == "") 
           return true;
          if ($value < 0 || $value > 9999) {
              return false;
          } else {
              return true;
          }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Polje mora biti godina';
    }
}
