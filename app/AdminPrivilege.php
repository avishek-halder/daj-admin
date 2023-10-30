<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminPrivilege extends Model
{
    protected $with = ['privileges'];

    function privileges()
    {
        return $this->hasMany(AdminPrivilegeRole::class, 'id_admin_privileges', 'id');
    }
}
