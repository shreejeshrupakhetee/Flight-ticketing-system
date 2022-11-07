<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GoingCity;
use App\Models\LeavingCity;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $travle_name=['Buddha Air', 'Yeti Airline','Saurya Airlines','Summit Air','Guna-Airlines'];
        $flight_type=['ATR700','Boeing777','Airbus390','Bombardiar-Dash-700'];
        foreach($flight_type as $type){
        \App\Models\FlightType::create([
            'flight_type_name'=>$type,
            'slug'=>Str::random(20),
        ]);
        }
        foreach($travle_name as $t){
            \App\Models\TravelName::create([
                'travel_name'=>$t,
                'slug'=>Str::random(20),
            ]);
        }
       
        $cityname=['Kathmandu','Pokhara','Bharatpur','Simara','Biratnagar','Janakpur','Bhairahawa','Nepalgunj'];
        foreach($cityname as $city){
            GoingCity::create([
                'city'=>$city
            ]
            );
        }
        foreach($cityname as $city){
            LeavingCity::create([
                'city'=>$city
            ]
            );
        }
        \App\Models\User::create([
            'name' => 'Shreejesh Rupakhetee',
            'email' => 'user@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'slug' => Str::random(20),
            'role'=>'0',
            'mobilenumber'=>'9866804473'
        ]);
        \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'role'=>'1',
            'mobilenumber'=>'9866804473',
            'slug' => Str::random(20)
        ]);

        \App\Models\Travel::factory(10)->create();
    }
}
