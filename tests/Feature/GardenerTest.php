<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class GardenerTest extends TestCase
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
     * Get list of gardeners.
     *
     * @return void
     */

    public function testGardenerList()
    {
        $token = $this->authenticate();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '. $token,
        ])->json('GET','/api/gardeners');

        $response->assertStatus(200);

        $response->assertJson([
            "success" => true,
            "message" => "Gardeners retrieved successfully",
        ]);
    }

}
