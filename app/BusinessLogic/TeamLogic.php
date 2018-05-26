<?php

namespace App\BusinessLogic;
use App\Rules\RequiredSelectList;
use App\Rules\Year;
use \Validator;

class TeamLogic
{
   
    public static function validator($input)
    {
        $messages = [
            'required' => 'Polje :attribute je obavezno',
        ];

        $rules = 
        [
                'name' => 'required|unique:teams|max:255',
                'coach_id' => [new RequiredSelectList],
                'yearFrom' => ['numeric', new Year],
                'yearUntil' => ['required', 'numeric', new Year]
        ];
        
        
        return Validator::make($input, $rules, $messages)->validate();
    }

}
