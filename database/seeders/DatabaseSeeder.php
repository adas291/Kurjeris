<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Status;
use DB;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'Priimta iš kliento'],
            ['name' => 'Išleista į kelionę'],
            ['name' => 'Gauta skirstymo centre'],
            ['name' => 'Atiduota gavėjui'],
        ];

        foreach ($statuses as $status) {
            DB::table('statuses')->insert($status);
        }


        $users = [
            ['name' => 'Klientas1', 'email' => 'k1@gmail.com', 'user_role' => '1', 'password' => Hash::make('1234')],
            ['name' => 'Klientas2', 'email' => 'k2@gmail.com', 'user_role' => '1', 'password' => Hash::make('1234')],
            ['name' => 'Kauno op1', 'email' => 'o1@gmail.com', 'user_role' => '2', 'password' => Hash::make('1234')],
            ['name' => 'Kauno op2', 'email' => 'o2@gmail.com', 'user_role' => '2', 'password' => Hash::make('1234')],
            ['name' => 'Londono op3', 'email' => 'o3@gmail.com', 'user_role' => '2', 'password' => Hash::make('1234')],
            ['name' => 'Londono op4', 'email' => 'o4@gmail.com', 'user_role' => '2', 'password' => Hash::make('1234')],
            ['name' => 'Londono op5', 'email' => 'o5@gmail.com', 'user_role' => '2', 'password' => Hash::make('1234')],
            // ['name' => 'Klaipedos op6', 'email' => 'o6@gmail.com', 'user_role' => '2', 'password' => Hash::make('1234')],
            // ['name' => 'Klaipedos op7', 'email' => 'o7@gmail.com', 'user_role' => '2', 'password' => Hash::make('1234')],
            // ['name' => 'Vilniaus op4', 'email' => 'o4@gmail.com', 'user_role' => '2', 'password' => Hash::make('1234')],
            ['name' => 'Mantas', 'email' => 'a@gmail.com', 'user_role' => '3', 'password' => Hash::make('1234')],
        ];
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

        $cities = [

            ['name' => 'kaunas'],
            ['name' => 'londonas'],
            // ['name' => 'klaipeda'],
            // ['name' => 'vilnius'],
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert($city);
        }

        $packages = [
            [
                'receiver_address' => '13a-5',
                'receiver_name' => 'timas',
                'user_id' => '1',
                'is_finished' => false,
                'city_id' => '1',
                'street_id' => '1',
                'weight' => 1337
            ],
            [
                'receiver_address' => '12-3',
                'receiver_name' => 'Jonas',
                'user_id' => '2',
                'is_finished' => true,
                'city_id' => '2',
                'street_id' => '3',
                'weight' => 1337,
                'status_id' => 4
            ]
        ];
        foreach ($packages as $package) {
            DB::table('packages')->insert($package);
        }

        $streets = [
            ['name' => 'studentu g.', "city_id" => 1],
            ['name' => 'taikos pr.', "city_id" => 1],

            //vln

            ['name' => 'oxford st.', "city_id" => 2],
            ['name' => 'abbey road st.', "city_id" => 2],
            ['name' => 'downing st.', "city_id" => 2],

            // ['name' => 'vaidilutes g.', "city_id" => 4],
            // ['name' => 'gedimino pr.', "city_id" => 4],

            // ['name' => 'švyturio g.', "city_id" => 3],

        ];

        foreach ($streets as $street) {
            DB::table('streets')->insert($street);
        }

        $operators = [
            ["user_id" => 3, "city_id" => 1, "street_id" => 1],
            ["user_id" => 4, "city_id" => 1, "street_id" => 2],

            ["user_id" => 5, "city_id" => 2, "street_id" => 3],
            ["user_id" => 6, "city_id" => 2, "street_id" => 4],
            ["user_id" => 7, "city_id" => 2, "street_id" => 5],

        ];

        foreach ($operators as $operator) {
            DB::table('operators')->insert($operator);
        }

        $packageStatuses = [
            ["package_id" => 1, "status_id" => 1],
            ["package_id" => 2, "status_id" => 1, 'time' => "2023-05-05 19:00:00"],
            ["package_id" => 2, "status_id" => 2, 'time' => "2023-05-06 19:00:00"],
            ["package_id" => 2, "status_id" => 3, 'time' => "2023-05-07 19:00:00"],
            ["package_id" => 2, "status_id" => 4, 'time' => "2023-05-08 19:00:00"],
        ];

        foreach ($packageStatuses as $status) {
            DB::table('package_statuses')->insert($status);
        }
    }
}
