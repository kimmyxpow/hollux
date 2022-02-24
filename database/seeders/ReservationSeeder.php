<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::factory(500)->create();

        for ($i=1; $i <= 14; $i++) { 
            $room = Room::find($i);

            $available = (int) $room->total_rooms -  (int) array_sum($room->reservations->where('status', '<>', 'canceled')->where('status', '<>', 'check out')->pluck('total_rooms')->toArray());

            $room->update(['available' =>  $available]);
        }

    }
}
