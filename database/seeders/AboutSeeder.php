<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::create([
            'title' => 'Starting From the Travelers',
            'text' => 'Berawal dari kami para traveler bernama lala, lili, lele, lolo, lulu yang sedang menjelajah antartika menggunakan sepeda mobil dan dibakar ke hutan amazon oleh kucing oren dan akhirnya bertemu dengan hotel transilvania yang berada di afrika tapi ternyata yang punya orang utan, bukan orang cina. Dari situ kami terus bersama sampai alien datang ke merkurius dan mencuri dragon ball untuk dijadikan sayur sop kaum milenial. Akhirnya jadilah hotel ini.',
            'image' => 'img/about/about.jpg'
        ]);
    }
}
