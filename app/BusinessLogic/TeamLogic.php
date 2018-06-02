<?php

namespace App\BusinessLogic;
use App\Rules\RequiredSelectList;
use App\Rules\Year;
use App\Rules\Category;
use App\Rules\CanEdit;
use \Validator;
use Illuminate\Validation\Rule;

class TeamLogic
{
   
    public static function validator($input, $id)
    {
        $messages = [
            'required' => 'Polje je obavezno',
            'unique' => 'Ime ekipe je već zauzeto',
            'max' => 'Previše znakova',
            'numeric' => 'Polje smije sadržavati samo brojeve'
        ];

        $rules = 
        [
                'name' => ['required', Rule::unique('teams')->ignore($id), 'max:255'],
                'coach_id' => [new RequiredSelectList],
                'yearFrom' => ['numeric', 'nullable', new Year],
                'yearUntil' => ['required', 'numeric', new Year],
                'currentStatus' => [new CanEdit]
        ];
        
        
        return Validator::make($input, $rules, $messages)->validate();
    }

    public static function validatorAddPlayer($from, $until, $birthday)
    {
        if (is_null($from))
          $from = 0;
        if ($from <= $birthday && $until >= $birthday)
          return false;
        else return true;
    }

}
