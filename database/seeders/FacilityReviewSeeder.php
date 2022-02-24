<?php

namespace Database\Seeders;

use App\Models\Facility;
use App\Models\FacilityReview;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilityReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::role('user')->skip(30)->take(20)->get()->pluck('id');
        $facilityCodes = [ '67b971a1466e3ffbf01a26fcf842bacc85feb7a2', '06ab599a280090150bbbdba527ece643855842c3', 'f0903398b6625e0d2c58a6ae6a2d626ca21c8fb1', 'd5f74d17b239ebd6a7f9accf369b0c017aae2811', '8350bb155dcf4cd92716cc2c3f93e1010c49e39e', '2b7563186c78f9a2a555c82b500f62dc9a616ee4', '7f99d296472f767a6e65bf088af047d37c0f5e52'];
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < count($users); $i++) {
            for ($j = 0; $j < count($facilityCodes); $j++) {
                FacilityReview::create([
                    'code' => bin2hex(random_bytes(20)),
                    'user_id' => $users[$i],
                    'facility_code' => $facilityCodes[$j],
                    'message' => $faker->sentence(),
                    'star' => $faker->numberBetween(3, 5),
                    'date' => $faker->date()
                ]);
            }
        }

        for ($i = 0; $i < count($facilityCodes); $i++) {
            $facility = Facility::firstWhere('code', $facilityCodes[$i]);
            $allReviews = FacilityReview::where('facility_code', $facility->code)->get();

            if (count($allReviews) > 0) {
                $rate = 0;

                foreach ($allReviews as $review) {
                    $rate += $review->star;
                }

                $rate /= $allReviews->count();
            } else {
                $rate = 0;
            }

            $facility->update([
                'rate' => $rate,
                'views' => $faker->numberBetween(1000, 100000)
            ]);
        }
    }
}
