<?php

namespace App\Repositories;
use App\Models\User;

class CustomerRepository implements RepositoryInterfaces\CustomerRepositoryInterface
{

    public function getCustomers()
    {
        return User::where( 'role_id', 9 )->with('gardener')->orderBy( 'created_at', 'desc' )->paginate();
    }

    public function getCustomersByCountry( int $countryId )
    {
        return User::where([ 'role_id' =>  9, 'country_id' => $countryId ])->with('gardener')->orderBy( 'created_at', 'desc' )->paginate();
    }
}
