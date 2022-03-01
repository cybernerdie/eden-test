<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryCustomer extends TestCase
{

    /**
     * Authenticate user.
     *
     * @return void
     */

    protected function authenticate()
    {
        $user = User::create([
            'fullname' => 'John Doe',
            'email' => 'jdoe@gmail.com',
            'role_id' => 9,
            'country_id' => 1,
            'location' => 'Lagos',
            'password' => Hash::make('secret1234'),
        ]);

        if (!auth()->attempt(['email'=>$user->email, 'password'=>'secret1234'])) {
            return response(['message' => 'Login credentials are invaild']);
        }

        return $accessToken = auth()->user()->createToken('Auth Token')->plainTextToken;
    }

    /**
     * Get list of customers for a country.
     *
     * @return void
     */

    public function testCountryCustomersList()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','customers/country/1');

        $response->assertStatus(200);

        $response->assertJson([
            "success" => true,
            "message" => "Customers retrieved successfully",
        ]);

        // Delete user
        User::where('email','jdoe@gmail.com')->delete();
    }
}
