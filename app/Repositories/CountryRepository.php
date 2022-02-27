<?php

namespace App\Repositories;
use App\Models\Country;

class CountryRepository implements RepositoryInterfaces\CountryRepositoryInterface
{

    public function getCountries()
    {
        return Country::with('customers')->orderBy('created_at', 'desc')->paginate();
    }
}
