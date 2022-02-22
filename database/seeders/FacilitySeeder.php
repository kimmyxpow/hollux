<?php

namespace Database\Seeders;

use App\Models\Facility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facilities = [
            [
                'Swimming Pool',
                'room',
                'Swim in a private pool with your friends!',
                'Massa dictumst ipsum eget sodales dolor aptent metus facilisi potenti dictum vestibulum. Justo quam volutpat potenti rhoncus nascetur. Purus mus finibus condimentum venenatis inceptos tempus suspendisse. Penatibus ac ligula et vivamus dictumst neque felis urna egestas. Consequat lobortis metus rhoncus egestas ut lectus sit integer ante dictumst. Ipsum netus vivamus eu sem pellentesque pede. Non class cursus ornare finibus vestibulum condimentum.',
                '67b971a1466e3ffbf01a26fcf842bacc85feb7a2'
            ],
            [
                'Library',
                'public',
                'Read as many books as you want for free here!',
                'Sem cras dapibus proin felis faucibus vivamus scelerisque. Praesent sit efficitur maximus luctus facilisis torquent suspendisse. Convallis quis mollis inceptos congue eget morbi conubia praesent ad velit. Suscipit ullamcorper commodo non venenatis tempus netus. Senectus aptent feugiat tincidunt facilisi integer enim libero rhoncus convallis. Commodo scelerisque suscipit sem turpis blandit aenean. Magnis vestibulum bibendum nam maecenas rutrum fusce vehicula ligula.',
                '06ab599a280090150bbbdba527ece643855842c3'
            ],
            [
                'Marketplace',
                'public',
                'Shop easily in the market that we have provided!',
                'Consectetuer tempor ac nisi class maecenas letius tortor pharetra. Venenatis massa mattis fusce luctus non in lacinia ex dictum orci leo. Eleifend platea facilisi nunc ad vivamus integer commodo interdum inceptos dis. Eros sollicitudin phasellus dis per dictumst.',
                'f0903398b6625e0d2c58a6ae6a2d626ca21c8fb1'
            ],
            [
                'Kitchen',
                'room',
                'Want a private kitchen in your room? We\'ve provided it!',
                'Ullamcorper faucibus nam tincidunt quam eros sodales pede aptent maximus cursus. Vivamus turpis morbi eleifend hac accumsan penatibus dolor lobortis velit. Ultricies a id auctor commodo dignissim ad fusce imperdiet facilisi rhoncus. Velit pulvinar urna imperdiet ligula vestibulum class. Tempor magna tristique dui viverra erat nostra et vehicula lorem. Velit porttitor aptent laoreet hendrerit urna. Mattis id volutpat diam suspendisse proin fusce.',
                'd5f74d17b239ebd6a7f9accf369b0c017aae2811'
            ],
            [
                'Cafe',
                'public',
                'Rest by looking at the beautiful scenery at our cafe!',
                'Platea etiam cursus condimentum pretium amet eros aliquet odio nunc. Ridiculus nisl lacinia ullamcorper nascetur cubilia finibus ad penatibus vel ex aliquam. Viverra eleifend et commodo curabitur facilisi sed pellentesque suscipit posuere penatibus. Bibendum leo rhoncus facilisis velit integer gravida. Ridiculus sapien per hendrerit blandit ligula nulla cras malesuada. Si parturient etiam blandit tortor penatibus iaculis consectetuer justo a. Tincidunt mattis velit amet mollis scelerisque magnis nibh aliquet. Consequat luctus pellentesque mauris libero mattis praesent.',
                '8350bb155dcf4cd92716cc2c3f93e1010c49e39e'
            ],
            [
                'Bathroom',
                'room',
                'Clean up in our fully equipped private bathroom!',
                'Placerat ex litora volutpat maximus viverra euismod ultrices ultricies nisi. Eget lorem quisque adipiscing ac sociosqu urna. Molestie eleifend aenean porta vulputate ex taciti. Ac consectetur leo sapien nibh morbi malesuada ultrices potenti sodales. Consectetur primis natoque sed integer curae. Quisque mi eros viverra condimentum himenaeos amet inceptos quam.',
                '2b7563186c78f9a2a555c82b500f62dc9a616ee4'
            ],
            [
                'Living room',
                'room',
                'Welcome your friends to your hotel room\'s living room!',
                'Montes arcu suscipit felis egestas consequat interdum dignissim. Laoreet aliquet augue accumsan maximus molestie nisi. Sed massa conubia at consectetur morbi facilisis libero consectetuer. Netus nullam a dictumst dis penatibus finibus congue curabitur tellus neque. Lectus placerat erat justo luctus purus letius consequat efficitur cubilia. Fusce congue magnis cubilia litora ultrices in mattis venenatis efficitur ut. Tincidunt metus fermentum sagittis libero vulputate. Ornare rhoncus vivamus natoque hac placerat.',
                '7f99d296472f767a6e65bf088af047d37c0f5e52'
            ],
        ];

        for ($i=1; $i <= count($facilities); $i++) { 
            Facility::create([
                'code' => $facilities[$i - 1][4],
                'name' => $facilities[$i - 1][0],
                'type' => $facilities[$i - 1][1],
                'image' => 'img/facilities/fasilitas-' . $i . '.jpg',
                'description' => $facilities[$i - 1][2],
                'explanation' => '<p>' . $facilities[$i - 1][3] . '</p>',
            ]);
        }
    }
}
