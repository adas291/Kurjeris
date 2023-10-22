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


        // $operators = [
        //     ['name' => 'Jonas', 'city_id' => '1', 'password' => Hash::make('1234')],
        //     ['name' => 'Tomas', 'city_id' => '2', 'password' => Hash::make('1234')]
        // ];
        // foreach ($operators as $operator) {
        //     DB::table('operators')->insert($operator);
        // }

        // $admins= [
        //     ['name' => 'admin', 'password' => Hash::make('admin')]
        // ];
        // foreach ($admins as $admin) {
        //     DB::table('admins')->insert($admin);
        // }
        $users = [
            ['name' => 'Silvestras', 'email' => 'a@gmail.com', 'user_role' => '1', 'password' => Hash::make('1234')],
            ['name' => 'leonidas', 'email' => 'b@gmail.com', 'user_role' => '2', 'password' => Hash::make('1234')],
            ['name' => 'Mantas', 'email' => 'c@gmail.com', 'user_role' => '3', 'password' => Hash::make('1234')],
            ['name' => 'op2', 'email' => 'o2@gmail.com', 'user_role' => '2', 'password' => Hash::make('1234')],
            // ['name' => 'Leonidas', 'password' => Hash::make('1234')]
        ];
        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }

        $cities = [
            ['name' => 'Kaunas', 'user_id' => '2'],
            ['name' => 'Londonas', 'user_id' => '4']
        ];

        foreach ($cities as $city) {
            DB::table('cities')->insert($city);
        }

        $packages = [
            ['receiver_address' => 'vilniaus g.', 'receiver_name' => 'timas', 'user_id' => '1', 'city_id' => '1']
        ];
        foreach ($packages as $package) {
            DB::table('packages')->insert($package);
        }
        $packageStatus = [
            ["package_id" => 1, "status_id" => 1]
        ];

        DB::table('package_statuses')->insert($packageStatus[0]);

        // $operators = [
        //     ['user_id' => '2', 'city_id' => '1']
        // ];
        // foreach ($operators as $operator) {
        //     DB::table('operators')->insert($operator);
        // }
    }
}
