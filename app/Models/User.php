<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function passport()
    {
        return $this->hasOne('App\Models\Passport');
    }

    public function forums()
    {
        return $this->hasMany('App\Models\Forum');
    }
}
