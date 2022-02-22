<?php

namespace Database\Seeders;

use App\Models\Galery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GalerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $galeries = ['Hotel Building 1', 'Café 1', 'Hotel room living room 1', 'Hotel room living room 2', 'Hotel room with shades of red', 'Swimming pool', 'Hotel Building 2', 'Café 2', 'Hotel Building 3', 'Café 3', 'Café 4', 'Library'];

        for ($i=1; $i <= count($galeries); $i++) { 
            Galery::create([
                'code' => bin2hex(random_bytes(20)),
                'title' => $galeries[$i - 1],
                'image' => 'img/galeries/g-' . $i . '.jpg'
            ]);
        }
    }
}
