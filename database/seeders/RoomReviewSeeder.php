<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\RoomReview;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::role('user')->skip(1)->take(20)->get()->pluck('id');
        $roomCodes = ['6d0929022a3f483cee01a71c8bb07cd497e12a2a', 'a325d27311d54f329d8efc903fa29147c87cb474', 'b04ccf712c8bf355b8d6ffbd8677190c52e5e1af', 'c004fc694adae94c9915ce4908d331fee3ac2e16', '0d512be37d5472ffad8b38e631b1f6d4ac52406e', '7ecf1c829efcf26958228f456ea648f07407e4c6', 'ef96f87eb0697be3d8f8d3338528752542d0fe18', 'd2e35973667acbcc21bf806fa9c4816811f93480', 'e68df0c1d217535de4a78bfac1935024187dad2c', 'd38e58c1f31900d29e1f95f729bab3e78f96a366', '92a4173c7dfd3fddbf45506ddd46d9bfaf706299', 'd0694a03e5dd6aac9814f28bb14a90effea15b01', '85dfe0fe296ce37d036a48e28e1dffd7037d0fd3', 'd3535f13cb58a761833f745c69cee5d8d689125b'];
        $faker = \Faker\Factory::create();

        for ($i=0; $i < count($users); $i++) { 
            for ($j=0; $j < count($roomCodes); $j++) { 
                RoomReview::create([
                    'code' => bin2hex(random_bytes(20)),
                    'user_id' => $users[$i],
                    'room_code' => $roomCodes[$j],
                    'message' => $faker->sentence(),
                    'star' => $faker->numberBetween(3, 5),
                    'date' => $faker->date()
                ]);
            }
        }

        for ($i=0; $i < count($roomCodes); $i++) { 
            $room = Room::firstWhere('code', $roomCodes[$i]);
            $allReviews = RoomReview::where('room_code', $room->code)->get();

            if (count($allReviews) > 0) {
                $rate = 0;

                foreach ($allReviews as $review) {
                    $rate += $review->star;
                }

                $rate /= $allReviews->count();
            } else {
                $rate = 0;
            }

            $room->update([
                'rate' => $rate,
                'views' => $faker->numberBetween(1000, 100000)
            ]);
        }
    }
}
