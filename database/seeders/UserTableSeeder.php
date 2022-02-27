<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $admin = [
            [
                'id' => 1,
                'fullname' => 'Joshua Paul',
                'email' => 'veecthorpaul@gmail.com',
                'password' => bcrypt('password'),
                'role_id' => 1,
                'country_id' => 1,
                'location' => 'Lagos',
                'email_verified_at' => now(),
                'created_at' => now()
            ]

        ];

        $gardeners = [

            [
                'id' => 2,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 18,
                'country_id' => 1,
                'location' => 'Lagos',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],

            [
                'id' => 3,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 18,
                'country_id' => 1,
                'location' => 'Abuja',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],

            [
                'id' => 4,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 18,
                'country_id' => 1,
                'location' => 'Calabar',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],

            [
                'id' => 5,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 18,
                'country_id' => 2,
                'location' => 'Marsabit',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],

            [
                'id' => 6,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 18,
                'country_id' => 2,
                'location' => 'Mwingi',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],

            [
                'id' => 7,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 18,
                'country_id' => 2,
                'location' => 'Meru',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],

        ];

        $customers = [

            [
                'id' => 8,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 9,
                'gardener_id' => 2,
                'country_id' => 1,
                'location' => 'Lagos',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],

            [
                'id' => 9,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 9,
                'country_id' => 1,
                'gardener_id' => 3,
                'location' => 'Abuja',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],

            [
                'id' => 10,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 9,
                'country_id' => 1,
                'gardener_id' => 4,
                'location' => 'Calabar',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],

            [
                'id' => 11,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 9,
                'country_id' => 2,
                'location' => 'Marsabit',
                'gardener_id' => 5,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],

            [
                'id' => 12,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 9,
                'country_id' => 2,
                'location' => 'Mwingi',
                'gardener_id' => 6,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],

            [
                'id' => 13,
                'fullname' => $faker->name,
                'email' => $faker->unique()->email,
                'role_id' => 9,
                'country_id' => 2,
                'gardener_id' => 7,
                'location' => 'Meru',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'created_at' => now()
            ],
        ];

        User::insert( $admin );
        User::insert( $gardeners );
        User::insert( $customers );

    }
}
