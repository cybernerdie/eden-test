<?php

namespace App\Http\Controllers\API;
use App\Repositories\RepositoryInterfaces\CountryRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\CountryResource;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Cache;

class CountryController extends Controller
{
    public function __construct(CountryRepositoryInterface $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    /**
     * Get all countries with the respective customers
     */

    public function index()
    {
        $countries = $this->countryRepository->getCountries();
        $countriesResource = CountryResource::collection( $countries );
        return ApiResponse::successResponseWithData($countriesResource, 'Countries retrieved successfully');
    }
}
