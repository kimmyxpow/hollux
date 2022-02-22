<?php

namespace Database\Seeders;

use App\Models\RoomHasFacility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomHasFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Junior Suite
        RoomHasFacility::create([
            'room_id' => 3,
            'facility_code' => '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
        ]);

        // Suite
        RoomHasFacility::create([
            'room_id' => 4,
            'facility_code' => '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
        ]);

        RoomHasFacility::create([
            'room_id' => 4,
            'facility_code' => 'd5f74d17b239ebd6a7f9accf369b0c017aae2811'
        ]);

        RoomHasFacility::create([
            'room_id' => 4,
            'facility_code' => '7f99d296472f767a6e65bf088af047d37c0f5e52'
        ]);

        // Presidential Suite
        RoomHasFacility::create([
            'room_id' => 5,
            'facility_code' => '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
        ]);

        RoomHasFacility::create([
            'room_id' => 5,
            'facility_code' => 'd5f74d17b239ebd6a7f9accf369b0c017aae2811'
        ]);

        RoomHasFacility::create([
            'room_id' => 5,
            'facility_code' => '7f99d296472f767a6e65bf088af047d37c0f5e52'
        ]);

        // Single
        RoomHasFacility::create([
            'room_id' => 6,
            'facility_code' => '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
        ]);

        // Twin
        RoomHasFacility::create([
            'room_id' => 7,
            'facility_code' => '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
        ]);

        // Double
        RoomHasFacility::create([
            'room_id' => 8,
            'facility_code' => '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
        ]);

        // Family
        RoomHasFacility::create([
            'room_id' => 9,
            'facility_code' => '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
        ]);

        // Connecting
        RoomHasFacility::create([
            'room_id' => 10,
            'facility_code' => '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
        ]);

        // Murphy
        RoomHasFacility::create([
            'room_id' => 11,
            'facility_code' => '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
        ]);

        // Accessible
        RoomHasFacility::create([
            'room_id' => 12,
            'facility_code' => '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
        ]);

        RoomHasFacility::create([
            'room_id' => 12,
            'facility_code' => '7f99d296472f767a6e65bf088af047d37c0f5e52'
        ]);

        // Cabana
        RoomHasFacility::create([
            'room_id' => 12,
            'facility_code' => '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
        ]);

        RoomHasFacility::create([
            'room_id' => 12,
            'facility_code' => '67b971a1466e3ffbf01a26fcf842bacc85feb7a2'
        ]);
    }
}
