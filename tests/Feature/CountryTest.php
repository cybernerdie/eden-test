<?php

namespace Tests\Feature;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShowForMissingCountry() {

        $this->json('get', "api/country/0")
             ->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
