<?php

namespace Database\Seeders;

use App\Review;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class RewievTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        for ($i=0; $i < 500 ; $i++) { 
            
            $review = new Review();
            $review->author = $faker->name();
            $review->user_id = $faker->numberBetween(1, 100);
            $review->text_review = $faker->text();
            $review->rating = $faker->numberBetween(1, 5);
            $review->save();
        }

        //generiamo recensioni per l'utente di test

        for ($i=0; $i < 10 ; $i++) { 
            
            $review = new Review();
            $review->author = $faker->name();
            $review->user_id = User::where('email','=','test@example.com')->first()->id;
            $review->text_review = $faker->text();
            $review->rating = $faker->numberBetween(1, 5);
            $review->save();
        }
    }
    // public function run()
    // {
    // //     $reviews = [
    // //         [
    // //             'author' => 'Antonio Giovanni',
    // //             'user_id' => 1,
    // //             'text_review' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic',
    // //             'rating' => 4,
    // //         ],
    // //         [
    // //             'author' => 'Enrico B.',
    // //             'user_id' => 1,
    // //             'text_review' => 'un medico molto antipatico shshshhhhs',
    // //             'rating' => 1,
    // //         ],
    // //         [
    // //             'author' => 'Ettore Scola',
    // //             'user_id' => 1,
    // //             'text_review' => 'La migliore esperienza mai avuta',
    // //             'rating' => 5,
    // //         ],
    // //         [
    // //             'author' => 'Alfonso Giro',
    // //             'user_id' => 2,
    // //             'text_review' => 'ciao ciao ciao ciao',
    // //             'rating' => 5,
    // //         ],
    // //         [
    // //             'author' => 'Giannino Giovane',
    // //             'user_id' => 3,
    // //             'text_review' => 'un medico molto ignorante',
    // //             'rating' => 3,
    // //         ],
    // //         [
    // //             'author' => 'Paolo Bortolaso',
    // //             'user_id' => 4,
    // //             'text_review' => 'mai più',
    // //             'rating' => 1,
    // //         ],
    // //         ];
            
    // //     foreach($reviews as $review) {
    // //         $new_review = new Review();
    // //         $new_review->author = $review['author'];
    // //         $new_review->user_id = $review['user_id'];
    // //         $new_review->text_review = $review['text_review'];
    // //         $new_review->rating = $review['rating'];
    // //         $new_review->save(); 
    // //     }
    // // }
}
