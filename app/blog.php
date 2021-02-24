<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
