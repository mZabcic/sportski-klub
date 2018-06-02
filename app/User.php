<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;
use App\Role;

class User extends Authenticatable
{
    use Notifiable, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password','last_name','role_id'
    ];

    public $sortable = ['first_name', 'email','last_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function coach() {
        if ($this->role_id == 3) 
          return true;
        else 
          return false;
    }

    public function board() {
        if ($this->role_id == 2 || $this->role_id == 1) 
          return true;
        else 
          return false;
    }

    public function role() {
        $role = Role::where('id', $this->role_id)->firstOrFail();
        return $role->name;
    }
}
