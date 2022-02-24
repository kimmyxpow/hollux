<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $statuses = ['waiting', 'confirmed', 'check in', 'check out', 'canceled'];

        return [
            'code' => str(uniqid('HLX-') . date('Ymd'))->upper(),
            'user_id' => $this->faker->numberBetween(1, 200),
            'room_id' => $this->faker->numberBetween(1, 14),
            'date' => $this->faker->dateTimeBetween('-2 months'),
            'check_in' => $this->faker->dateTimeBetween('-2 months'),
            'check_out' => $this->faker->dateTimeBetween('-2 months'),
            'status' => Arr::random($statuses),
            'total_rooms' => $this->faker->numberBetween(1, 5),
            'total_price' => $this->faker->numberBetween(400, 100000),
            'message' => $this->faker->sentence()
        ];
    }
}
