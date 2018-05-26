<?php

namespace App\BusinessLogic;
use App\Rules\Category;
use App\Rules\Year;
use \Validator;
use Illuminate\Validation\Rule;
use App\Rules\RequiredSelectList;

class PlayerLogic
{
   
    public static function validator($input, $birthday)
    {
        $messages = [
            'required' => 'Polje je obavezno',
            'unique' => 'Ime ekipe je već zauzeto',
            'max' => 'Previše znakova',
            'numeric' => 'Polje smije sadržavati samo brojeve'
        ];

        $rules = 
        [
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'date_of_birth' => ['required', 'date'],
                'team_id' => ['nullable',  new Category($birthday)],
                'position_id' => [new RequiredSelectList]
        ];
        
        
        return Validator::make($input, $rules, $messages)->validate();
    }

}