<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Team;
use Auth;

class CanEdit implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
   

    public function __construct()
    {
        
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
        $user = Auth::user();
        if (($user->role_id == 1 || $user->role_id == 2) && $value != 'odobren') {
            return true;
        } else if ($user->role_id == 3 && $value == 'nacrt')
          return true;
        else 
          return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ekipa se u ovom statusu s trenutnim pravima ne može mijenjati';
    }
}