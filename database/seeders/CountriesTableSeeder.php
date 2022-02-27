<?php

namespace Database\Seeders;
use App\Models\Country;

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'id' => '1',
            'name' => 'Nigeria',
        ]);

        Country::create([
            'id' => '2',
            'name' => 'Kenya',
        ]);

    }
}
