<?php

namespace App\Repositories;
use App\Models\User;

class CustomerRepository implements RepositoryInterfaces\CustomerRepositoryInterface
{

    public function getCustomers( )
    {
        return User::where('role_id', 9)->orderBy('created_at', 'desc')->paginate();
    }
}
