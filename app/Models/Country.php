<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function customers()
    {
        return $this->hasMany( User::class, 'country_id' )->where('role_id', 9);
    }

}
