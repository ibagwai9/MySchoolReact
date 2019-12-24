<?php namespace App;

use App\Model;

class Admin extends Model {

    protected $table = "admins";

    public function user()
    {
        return $this->morphOne('App\User', 'userable');
    }

}
