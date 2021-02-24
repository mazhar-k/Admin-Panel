<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model
{
    public function Sponsor()
    {
        return $this->belongsTo('App\Sponsor');
    }
}
