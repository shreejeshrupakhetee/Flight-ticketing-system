<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\FlightType;
use App\Models\GoingCity;
use App\Models\LeavingCity;
use App\Models\TravelName;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Travel>
 */
class TravelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $time=now()->format('H:m');
        return [
            'leaving_city_id'=>LeavingCity::all()->random()->id,
            'going_city_id'=>GoingCity::all()->random()->id,
            'travel_name_id'=>TravelName::all()->random()->id,
            'flight_type_id'=>FlightType::all()->random()->id,
            'Departure'=>$time,
            'available'=>fake()->unique()->numberBetween($min = 1, $max = 56),
            'price'=>fake()->numberBetween($min=100,$max=2000),
            'image'=>'1.jpg',
            'slug'=>Str::random(20),
            'travel_date'=>fake()->dateTimeBetween($startDate = 'now', $endDate = '5 day'),
            'flight_plate_number'=>'Ba 14 PA '.Str::random(4),
        ];
    }
}
