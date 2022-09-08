<?php

namespace Database\Seeders;

use App\Review;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RewievTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        $array_reviews = [
            'Ho trovato il dottore molto professionale con un ottimo ascolto attivo, mi sta aiutando in un momento particolarmente difficile della mia vita. Ottima l\'idea delle video consulenze per chi come me non può facilmente muoversi',
            'Sempre disponibile e attento! L’ascolto è un suo punto forte mi ha aiutata a superare dei momenti di sconforto.',
            'Mi sto trovando bene grazie ai suoi consigli/suggerimenti. Accurata attenzione della persona! Continuerò a seguirla in futuro.',
            'Il dottore è stato il peggior medico di base mai avuto. Cafone, maleducato, incapace, arrogante. Appena finisco la quarantena lo cambio subito',
            'Fissato un appuntamento fra i tanti che appaiono disponibili sul sito, appuntamento non confermato e presso la struttura riferiscono che non fissano ad oggi appuntamenti con il medico di cui trattasi e non ci sono disponibilità fino a Settembre. E\' la seconda volta che mi succede su questo sito, no comment',
            'Il dottore secondo me non è del tutto affidabile. Ho fatto diverse visite e per la maggior parte gentile, professionale a parole, ma lui non risolveva niente di pratico. Aggiungo poi che ho lasciato recensioni delle mie esperienze, evidenziando positività e carenze, ma me le hanno tutte censurate, e oggi non riesco più a pubblicarle',
            'Voglio scrivere poche righe ma sincere, mio padre sta molto meglio ora. Personalmente, visto la prima volta il giorno che ho ricoverato il padre, posso solo dire che si è rilevato un ottimo dottore, nonché un amico per come ci ha trattato, sinceramente persone come Lui non si incontrano tutti giorni per questo voglio ringraziarlo per quello che ha fatto per mio padre. Grazie e continui così perché si vede che il mestiere che ha scelto gli piace',
            'Dottore esaustivo, cordiale e soprattutto eccellente! A lui un grande ringraziamento.',
            'Sono dovuta ricorrere alle cure del Pronto Soccorso dopo un malore in casa, purtroppo devo segnalare la poca attenzione e sgarbatezza della dottoressa di turno, chiedere ad una persona sofferente perché avessi ritenuto di recarmi in ospedale per una semplice gastroenterite violenta che mi ha portata ad una sincope in casa è offensivo e di poca competenza, oltre che di grande arroganza verso il paziente. In scenza e coscenza,non lo dimentichi.',
            'Medico molto competente di grandissima preparazione, chiaro nelle spiegazioni e disponibile con i pazienti mettendoli a proprio agio. Lo consiglio.',
        ];
        for ($i=0; $i < 500 ; $i++) { 
            
            $review = new Review();
            $review->author = $faker->name();
            $review->user_id = $faker->numberBetween(1, 100);
            $review->text_review = $array_reviews[500 % count($array_reviews)];
            $review->rating = $faker->numberBetween(1, 5);
            $review->save();
            DB::update('update reviews set created_at = ? where id = ?',
            [$faker->dateTimeBetween('-6 months', 'now'),$review->id]);
        }

        //generiamo recensioni per l'utente di test

        for ($i=0; $i < 50 ; $i++) { 
            
            $review = new Review();
            $review->author = $faker->name();
            $review->user_id = User::where('email','=','test@example.com')->first()->id;
            $review->text_review = $array_reviews[50 % count($array_reviews)];
            $review->rating = $faker->numberBetween(1, 5);
            $review->save();
            DB::update('update reviews set created_at = ? where id = ?',
            [$faker->dateTimeBetween('-6 months', 'now'),$review->id]);
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
