<?php

namespace App\Http\Controllers\API;
use App\Repositories\RepositoryInterfaces\GardenerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Cache;
use App\Traits\ApiResponse;

class GardenerController extends Controller
{
    public function __construct(GardenerRepositoryInterface $gardenerRepository )
    {
    $this->gardenerRepository = $gardenerRepository;
    }


    /**
     * Get all gardeners
     */
    public function index()
    {
        $cachedGardeners = Cache::get('gardeners');

        if( $cachedGardeners ){
            $gardeners = $cachedGardeners;
        } else{
            $gardeners = $this->gardenerRepository->getGardeners();
        }

        $gardenersResource = UserResource::collection( $gardeners );
        return ApiResponse::successResponseWithData( $gardenersResource, 'Gardeners retrieved successfully');
    }

    /**
     * Get all gardeners for a specific country
     */

    public function getGardenersByCountry( $countryId )
    {
        $gardeners = $this->gardenerRepository->getGardenersByCountry( $countryId );
        if( count( $gardeners ) ){
            $gardenersResource = UserResource::collection( $gardeners );
            return ApiResponse::successResponseWithData( $gardenersResource, 'Gardeners retrieved successfully');
        } else {

            return ApiResponse::successResponse('No gardener found for the specified country');
        }
    }
}
