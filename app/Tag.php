<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function blogs(){
        return $this->belongsToMany('App\blog');
    }
}
