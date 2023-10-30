<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    public function getState(){
        return $this->belongsTo('App\State', 'state_id', 'id');
    }
    
}
