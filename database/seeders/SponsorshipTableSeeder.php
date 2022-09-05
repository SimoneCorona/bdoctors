<?php

namespace Database\Seeders;

use App\Sponsorship;
use Illuminate\Database\Seeder;

class SponsorshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = [
        [
            'name' => 'bronzo',
            'price' => '2.99',
            'duration_h' => '24',
        ],
        [
            'name' => 'argento',
            'price' => '5.99',
            'duration_h' => '72',           
        ],
        [
            'name' => 'oro',
            'price' => '9.99',
            'duration_h' => '144',           
        ],
        ];
        foreach($sponsorships as $sponsorship) {
            $new_sponsorship = new Sponsorship();
            $new_sponsorship->name = $sponsorship['name'];
            $new_sponsorship->price = $sponsorship['price'];
            $new_sponsorship->duration_h = $sponsorship['duration_h'];
            $new_sponsorship->save(); 
        }
    }
}
