<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Carbon;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'fullname',
        'email',
        'gardener_id',
        'role_id',
        'country_id',
        'location',
        'password',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gardener()
    {
        return $this->belongsTo( User::class );
    }

    public function customers()
    {
        return $this->hasMany( User::class, 'gardener_id' );
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function getCreatedAtAttribute( $date )
    {
         return Carbon::createFromFormat( 'Y-m-d H:i:s', $date )->format('M d Y');
    }

    public static function boot()
    {

        parent::boot();

        self::created(function ($model) {
            Cache()->forget('customers');
            Cache()->forget('gardeners');
        });
    }
}
