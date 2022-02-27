<?php

namespace App\Http\Controllers\API;
use App\Repositories\RepositoryInterfaces\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Cache;

class CustomerController extends Controller
{
    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * Get all customers
     */

    public function index()
    {
        $cachedCustomers = Cache::get('customers');

        if( $cachedCustomers ){
            $customers = $cachedCustomers;
        } else{
            $customers = $this->customerRepository->getCustomers();
        }

        $customersResource = UserResource::collection($customers);
        return ApiResponse::successResponseWithData($customersResource, 'Customers retrieved successfully');
    }

    /**
     * Get all customers for a specific country
     */

    public function getCustomersByCountry( $countryId )
    {
        $customers = $this->customerRepository->getCustomersByCountry( $countryId );
        if( count( $customers ) ){
            $customersResource = UserResource::collection( $customers );
            return ApiResponse::successResponseWithData( $customersResource, 'Customers retrieved successfully');
        } else {

            return ApiResponse::successResponse('No customer found for the specified country');
        }
    }
}
