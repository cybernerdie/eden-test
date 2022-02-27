<?php

namespace App\Http\Controllers\API;
use App\Repositories\RepositoryInterfaces\UserRepositoryInterface;
use App\Repositories\RepositoryInterfaces\GardenerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Traits\ApiResponse;

class AuthController extends Controller
{

        public function __construct( UserRepositoryInterface $userRepository,
                                     GardenerRepositoryInterface $gardenerRepository )
                                     {

        $this->userRepository = $userRepository;
        $this->gardenerRepository = $gardenerRepository;

        }

     /**
     * Login User
     */

    public function login( LoginRequest $request )
    {

        $userData = $request->validated();

        if ( Auth::attempt( $userData ) ) {
            $accessToken = Auth::user()->createToken('Auth Token')->plainTextToken;
            $user = new UserResource( auth()->user() );

            if( $user->role_id == 9 ){
                $user->load('gardener');
            }

            if( $user->role_id == 18 ){
                $user->load('customers');
            }

            return ApiResponse::successResponseWithToken( $user, 'Login successful', 200, $accessToken );
        }

        return ApiResponse::errorResponse( 'Invalid Login credentials', 400 );
    }

    /**
     * Register user
     */

    public function register( RegisterRequest $request )
    {
        $userData = $request->validated();
        $userData['password'] = Hash::make( $userData['password'] );
        $newUser = $this->userRepository->create( $userData );

        //Assign a gardener to the new user if role of customer which is 9
        if( $newUser['role_id'] == 9 ){
            $assignGardener = $this->assignGardener( $newUser->id );
        }

        $accessToken = $newUser->createToken('Auth Token')->plainTextToken;
        $user = new UserResource( $newUser );

        return ApiResponse::successResponseWithToken( $user, 'Registration successful', 200, $accessToken );

    }

    /**
     * Assign a gardener to the newly created customer
     * Role id for customer is 9
     */

    public function assignGardener( $userId )
    {
        $gardener = $this->gardenerRepository->getRandomGardener();
        $gardenerId = $gardener->id;

        $data = [
            'gardener_id' => $gardenerId,
        ];

        $newUser = $this->userRepository->update( $userId, $data );
    }

}
