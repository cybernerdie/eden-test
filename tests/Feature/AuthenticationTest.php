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

    public function testUserDuplication()
    {
        $user1 = User::make([
            'fullname' => 'John Doe',
            'email' => 'jdoe@gmail.com'
        ]);

        $user2 = User::make([
            'fullname' => 'Mary Doe',
            'email' => 'mdoe@gmail.com'
        ]);

        $this->assertTrue($user1->fullname != $user2->fullname);
    }
}
