<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testRequiredFieldsForRegistration()
    {
        $this->json('POST', 'api/register', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    "fullname" => ["The fullname field is required."],
                    "email" => ["The email field is required."],
                    "location" => ["The location field is required."],
                    "role_id" => ["The role id field is required."],
                    "country_id" => ["The country id field is required."],
                    "password" => ["The password field is required."],

                ]
            ]);
    }

    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson([
                "message" => "The given data was invalid.",
                "errors" => [
                    'email' => ["The email field is required."],
                    'password' => ["The password field is required."],
                ]
            ]);
    }

    public function testRegister()
    {
        $response = $this->json('POST', '/api/register', [
            'fullname'  => $fullname = 'John Doe',
            'email'  => $email = 'jdoe@gmail.com',
            'password'  =>  $password = '123456789',
            'country_id' => $countryID = 1,
            'role_id' => $roleId = 9,
            'location' => $location = 'Lagos',
            'email_verified_at' => now(),
        ]);

        $response->assertStatus(203);

        $response->assertJson([
            "success" => true,
            "message" => "Registration successful",
        ]);

        $this->assertDatabaseHas('users', [
            'fullname' => $fullname,
            'email' => $email,
            'country_id' => $countryID,
            'role_id' => $roleId,
            'location' => $location,
        ]);

    }

    public function testLogin()
    {
        $response = $this->json('POST', '/api/login', [
            'email'  =>  'jdoe@gmail.com',
            'password'  =>  '123456789'
        ]);

        $response->assertStatus(200);

        $response->assertJson([
            "success" => true,
            "message" => "Login successful",
        ]);
    }

    public function testWrongLoginCredentials()
    {
        $response = $this->json('POST', '/api/login', [
            'email'  =>  'jdoe@gmail.com',
            'password'  =>  'password'
        ]);

        $response->assertStatus(400);

        $response->assertJson([
            "success" => false,
            "message" => "Invalid Login credentials",
        ]);

         // Delete user
         User::where('email','jdoe@gmail.com')->delete();
    }
}
