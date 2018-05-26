<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Team;

class Category implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    protected $year;

    public function __construct($year_of_birth)
    {
        $this->year = $year_of_birth;
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
        $team = Team::where('id', $value)->firstOrFail();
        if (is_null($team->yearFrom)) 
           $team->yearFrom = 0;
        if ($this->year >= $team->yearFrom && $this->year <= $team->yearUntil) 
          return true;
        else return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Igrač ne može igrati u ovoj ekipi zbog godišta';
    }
}
