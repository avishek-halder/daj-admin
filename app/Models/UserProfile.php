<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';
    public function getUser(){
        return $this->belongsTo('App\Models\AdminUser', 'user_id', 'id');
    }
}
