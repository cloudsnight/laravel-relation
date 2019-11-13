<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //polymorphic many2many
    public function lessons()
    {
        return $this->MorphByMany('App\Models\Lesson', 'taggable');
    }

    public function forums()
    {
        return $this->MorphByMany('App\Models\Forum', 'taggable');
    }
    
}
