<?php

use App\Message;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {   
        for ($i=0; $i < 100 ; $i++) { 
            
            $message = new Message();
            $message->author = $faker->name();
            $message->user_id = $faker->numberBetween(1, 100);
            $message->text_message = $faker->text();
            $message->email = $faker->email();
            $message->save();
        }

        // generiamo messaggi per l'utente di test
        for ($i=0; $i < 10 ; $i++) { 
            
            $message = new Message();
            $message->author = $faker->name();
            $message->user_id = User::where('email','=','test@example.com')->first()->id;
            $message->text_message = $faker->text();
            $message->email = $faker->email();
            $message->save();
        }
    }
    // public function run()
    // {
    //     $messages = [
    //         [
    //             'author' => 'Antonio Giovanni',
    //             'user_id' => 1,
    //             'text_message' => 'un medico molto bravo',
    //             'email' => 'antonio@example.com',
    //         ],
    //         [
    //             'author' => 'Enrico B.',
    //             'user_id' => 1,
    //             'text_message' => 'un medico molto pessimo',
    //             'email' => 'enrico@example.com',
    //         ],
    //         [
    //             'author' => 'Alfonso Giro',
    //             'user_id' => 2,
    //             'text_message' => 'un medico molto panzone',
    //             'email' => 'alfonso@example.com',
    //         ],
    //         [
    //             'author' => 'Giannino Giovane',
    //             'user_id' => 3,
    //             'text_message' => 'un medico molto ignorante',
    //             'email' => 'giannino@example.com',
    //         ],
    //         ];
            
    //     foreach($messages as $message) {
    //         $new_message = new Message();
    //         $new_message->author = $message['author'];
    //         $new_message->user_id = $message['user_id'];
    //         $new_message->text_message = $message['text_message'];
    //         $new_message->email = $message['email'];
    //         $new_message->save(); 
    //     }
    // }
}
