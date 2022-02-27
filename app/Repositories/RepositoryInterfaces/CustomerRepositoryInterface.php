<?php

namespace App\Repositories\RepositoryInterfaces;

interface CustomerRepositoryInterface
{
    public function getCustomers();
    public function getCustomersByCountry( int $countryId );
}
