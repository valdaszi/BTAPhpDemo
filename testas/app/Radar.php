<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Radar extends Model
{
    public function driver() {
        return $this->belongsTo(Driver::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function updator() {
        return $this->belongsTo(User::class, 'updator_id');
    }
    
}
