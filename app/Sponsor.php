<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    public function Deals(){
        return $this->hasMany('App\Deal')->orderBy('created_at','desc');
    }
    
    public function Deal(){
        return $this->hasOne('App\Deal')->orderBy('created_at','desc');
    }
}
