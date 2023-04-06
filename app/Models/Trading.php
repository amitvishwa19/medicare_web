<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Trading extends Model
{
    use HasFactory, HasRoles;

    

    public function trades()
    {
        return $this->hasMany('App\Models\Trade');
    }

}
