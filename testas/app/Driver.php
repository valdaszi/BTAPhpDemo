<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public function radars() {
        return $this->hasMany(Radar::class);
    }
    
}
