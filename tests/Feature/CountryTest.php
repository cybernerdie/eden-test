<?php

namespace Tests\Feature;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Tests\TestCase;

class CountryTest extends TestCase
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
     * Get list of countries.
     *
     * @return void
     */

    public function testCountryList()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','/api/countries');

        $response->assertStatus(200);

        $response->assertJson([
            "success" => true,
            "message" => "Countries retrieved successfully",
        ]);

        // Delete user
        User::where('email','jdoe@gmail.com')->delete();
    }

}
