<?php

namespace App\Repositories\RepositoryInterfaces;

interface GardenerRepositoryInterface
{
    public function getGardeners();
    public function getGardenersByCountry( int $countryId );
    public function getRandomGardener();
}
