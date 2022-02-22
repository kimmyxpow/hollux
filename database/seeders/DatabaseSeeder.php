<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);
        Role::create(['name' => 'receptionist']);

        $user = User::create([
            'name' => 'Abi Noval Fauzi',
            'email' => 'novalabi612@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone_number' => '08174835153', // password
            'remember_token' => Str::random(10),
            'avatar' => 'img/avatar/a.png'
        ]);

        $user->syncRoles('admin');

        $this->call(GalerySeeder::class);
        $this->call(FacilitySeeder::class);
        $this->call(RoomSeeder::class);
        $this->call(RoomHasFacilitySeeder::class);
        $this->call(AboutSeeder::class);
    }
}
