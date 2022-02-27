<?php

namespace App\Repositories;
use App\Models\User;

class GardenerRepository implements RepositoryInterfaces\GardenerRepositoryInterface
{

    public function getGardeners( )
    {
        return User::where( 'role_id', 18 )->with('customers')->orderBy('created_at', 'desc')->paginate();
    }

    public function getGardenersByCountry( int $countryId )
    {
        return User::where([ 'role_id' =>  18, 'country_id' => $countryId ])->with('customers')->orderBy( 'created_at', 'desc' )->paginate();
    }

    public function getRandomGardener()
    {
        return User::where( 'role_id', 18 )->inRandomOrder()->first();
    }
}
