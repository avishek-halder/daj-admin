<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    //
    public function getCountry(){
        return $this->belongsTo('App\Country', 'country_id', 'id');
    }
}
