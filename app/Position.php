<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Position extends Model
{
    use Sortable;
    protected $fillable = [
        'name'
    ];

    public $sortable = [
        'name',
        'created_at',
        'updated_at'
    ];

    protected $table = 'positions';
}
