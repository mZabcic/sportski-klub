<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Player extends Model
{
    use Sortable;
    protected $fillable = [
        'first_name', 'last_name','position_id', 'date_of_birth', 'team_id'
    ];

    public $sortable = [
        'first_name', 'last_name','position_id', 'date_of_birth', 'team_id'
    ];

    protected $table = 'players';

    public function team()
    {
        return $this->hasOne('App\Team', 'team_id');
    }

    public function position()
    {
        return $this->hasOne('App\Position', 'position_id');
    }

}
