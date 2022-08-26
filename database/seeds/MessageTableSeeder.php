<?php

use App\Message;
use Illuminate\Database\Seeder;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = [
            [
                'author' => 'Antonio Giovanni',
                'user_id' => 1,
                'text_message' => 'un medico molto bravo',
                'email' => 'antonio@example.com',
            ],
            [
                'author' => 'Enrico B.',
                'user_id' => 1,
                'text_message' => 'un medico molto pessimo',
                'email' => 'enrico@example.com',
            ],
            [
                'author' => 'Alfonso Giro',
                'user_id' => 2,
                'text_message' => 'un medico molto panzone',
                'email' => 'alfonso@example.com',
            ],
            [
                'author' => 'Giannino Giovane',
                'user_id' => 3,
                'text_message' => 'un medico molto ignorante',
                'email' => 'giannino@example.com',
            ],
            ];
            
        foreach($messages as $message) {
            $new_message = new Message();
            $new_message->author = $message['author'];
            $new_message->user_id = $message['user_id'];
            $new_message->text_message = $message['text_message'];
            $new_message->email = $message['email'];
            $new_message->save(); 
        }
    }
}
