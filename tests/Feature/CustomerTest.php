<?php

namespace Tests\Feature;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Tests\TestCase;

class CustomerTest extends TestCase
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
            'email' => rand(123,456).'test@gmail.com',
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
     * Get list of customers
     *
     * @return void
     */

    public function testCustomerList()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','/api/customers');

        $response->assertStatus(200);

        $response->assertJson([
            "success" => true,
            "message" => "Customers retrieved successfully",
        ]);
    }

}
