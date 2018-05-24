<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Team extends Model
{
    use Sortable;
    protected $fillable = [
        'name',
        'yearFrom',
        'yearUntil',
        'coach_id'
    ];

    protected $table = 'teams';

    public $sortable = [
    'name',
    'created_at',
    'updated_at',
    'yearFrom',
    'yearUntil'
];
    

    public function players()
    {
        return $this->hasMany('App\Player');
    }

    public function coach()
    {
        return $this->hasOne('App\User', 'id',  'coach_id');
    }
}
