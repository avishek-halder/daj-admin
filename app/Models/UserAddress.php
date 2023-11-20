<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_addresses';
    public function getCountry(){
        return $this->belongsTo('App\Country', 'country_id', 'id');
    }
    public function getState(){
        return $this->belongsTo('App\State', 'state_id', 'id');
    }
    public function getCity(){
        return $this->belongsTo('App\City', 'city_id', 'id');
    }
}
