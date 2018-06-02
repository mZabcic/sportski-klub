<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Brexis\LaravelWorkflow\Traits\WorkflowTrait;

class Team extends Model
{
    use Sortable, WorkflowTrait;
    protected $fillable = [
        'name',
        'yearFrom',
        'yearUntil',
        'coach_id',
        'currentStatus'
    ];

    protected $table = 'teams';

    public $sortable = [
    'name',
    'created_at',
    'updated_at',
    'yearFrom',
    'yearUntil',
    'currentStatus'
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
