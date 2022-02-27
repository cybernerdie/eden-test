<?php

namespace App\Repositories;
use App\Models\User;

class GardenerRepository implements RepositoryInterfaces\GardenerRepositoryInterface
{

    public function getGardeners( )
    {
        return User::where('role_id', 18)->orderBy('created_at', 'desc')->paginate();
    }

    public function getRandomGardener()
    {
        return User::where( 'role_id', 18 )->inRandomOrder()->first();
    }
}
