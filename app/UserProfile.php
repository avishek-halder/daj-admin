<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';
    public function getUser(){
        return $this->belongsTo('App\AdminUser', 'user_id', 'id');
    }
}
