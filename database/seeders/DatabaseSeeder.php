<?php

namespace Database\Seeders;

use App\Models\RoomReview;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GalerySeeder::class,
            FacilitySeeder::class,
            RoomSeeder::class,
            RoomHasFacilitySeeder::class,
            AboutSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            AdminSeeder::class,
            ReceptionistSeeder::class,
            RoomReviewSeeder::class,
            FacilityReviewSeeder::class,
            ReservationSeeder::class
        ]);
    }
}
