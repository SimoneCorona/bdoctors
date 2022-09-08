<?php

namespace Database\Seeders;

use App\Message;
use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class MessageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run(Faker $faker)
    {   
        $array_messages = [
            'Buongiorno, si può consumare la marmellata anche in condizioni di gastrite?',
            'Buonasera, prendo Fleiderina 150 da 6 anni per episodi vari di fibrillazione atriale causati forse da un prolasso intralcio moderato Vorrei proteggermi meglio con una terapia anticoagulante e prendere Lixiana da 60. Tra i due farmaci c’è interazione o posso tranquillamente prenderli insieme ? Grazie',
            'Buongiorno, da due mesi ho frequenti episodi di edema labiale, gonfiore agli occhi e pomfi cutanei, sempre associati alla somministrazione di cibi vari. Da premettere che sono già allergica agli acari e parietarie. A breve dovrò fare i test cutanei per gli alimenti, nel frattempo ho fatto anche l\' esame dell\' Elicobacter piloro ed è risultato positivo. Può dipendere tutto da questo? Devo comunque fare i test?',
            'Buongiorno, ho da mesi un problema che mi affligge: circa una volta al mese si presenta un dolore che parte dall\' ombelico e si sviluppa su tutto il lato destro dell\' addome. Il dolore non aumenta alla palpazione, ma è persistente. Questo mese ho fatto analisi del sangue sotto consiglio del medico per poter escludere appendicite (emocromo, VES, PCR) e gli esami sono risultati tutti normali, tranne un valore che il medico ha detto essere sballato perché ho fatto il prelievo durante le mestruazioni. Non ho altri sintomi immediatamente riconducibili all\'appendicite (né perdita di appetito, né febbre o altro) ma inizio a pensare che questo dolore sia riconducibile a un\' infiammazione "cronica", dato che ho notato che si presenta quando mangio in modo un po\' più "pesante" (bevande alcoliche, caffè, zuccheri, grassi). In questi giorni, inoltre, a questo dolore si è aggiunto un dolore tipo pulsazione all\'interno coscia. Tutto ciò a cosa può essere riconducibile?',
            'Salve sono ex fumatore ho 44 anni. Avendo dispnea a riposo e oppressione al petto di sono recato dallo pneumologo che mi ha riscontrato riacutizzazione da bronchite cronica. Ho fatto Spirometria ed in soli 6 mesi è peggiorata del 10%. Lo pneumologo mi ha prescritto Bentelan per 7 giorni, flixotide la mattina ed un mucolitico. Bronchite essendo cronica su che non è guaribile ma può essere tenuta sotto controllo o mi devo aspettare il peggio? Da quando sto facendo ho catarro abbondante. In attesa di un vostro riscontro vi porgo i più cordiali saluti.',
            'Mio padre soffre di cirrosi epatica associata a problematiche cardiache, ora da un po di tempo fa feci nere con sangue, da premettere che fa anche trasfusioni e prende antiemorragici, come possiamo aiutarlo? Grazie',
            'Buonasera, un uomo può cadere in depressione durante la gravidanza della moglie? Neanche la nascita del figlio e delle terapie possono attivarlo? Può volere la separazione di punto in bianco? Grazie',
            'Ho 26 anni, fatte due dosi di vaccino ho febbre 38, 7 da ieri il mio medico mi ha prescritto Zitromax ma io vorrei aspettare, ho gola rossa e basta prendo Tachipirina vorrei un consiglio',
            'Buongiorno, sto assumendo Rivotril 1/2 mg da 5 anni per risolvere un problema dovuto a mielopatia cervicale con fascicolazioni al tricipite sx, in seguito a incidente stradale con trauma cranico cervicale. All\'inizio bastavano 4/5 gocce e mi aiutavano anche per dormire senza risvegli notturni precoci senza riaddormentamento. Pertanto uno specialista neurologo mi ha prescritto di assumere 15/18 gocce di Minias al risveglio per prolungare di un paio di ore il sonno. Recentemente mi sono rivolto ad uno specialista del sonno che mi ha detto che l\'associaziome dei 2 farmaci possono portare gravi conseguenze. A chi devo credere e come posso comportarmi? Grazie',
            'Salve, il mio medico di base mi ha segnato il Metforal 500 per dimagrire peso, 135kg, non ho il diabete, appena il mio dietologo l\' ha saputo me l\'ha sospeso perche dice che fa male, ma io nel giro di un mese anche con la dieta ho perso 6 kg. Vorrei sapere se è vero che fa male non essendo diabetica. Aspetto la sua risposta',
        ];
        for ($i=0; $i < 500 ; $i++) { 
            $message = new Message();
            $message->author = $faker->name();
            $message->user_id = $faker->numberBetween(1, 100);
            $message->text_message = $array_messages[500 % count($array_messages)];
            $message->email = $faker->email();
            $message->save();
            DB::update('update messages set created_at = ? where id = ?',
            [$faker->dateTimeBetween('-6 months', 'now'),$message->id]);
        }

        // generiamo messaggi per l'utente di test
        for ($i=0; $i < 30 ; $i++) { 
            
            $message = new Message();
            $message->author = $faker->name();
            $message->user_id = User::where('email','=','test@example.com')->first()->id;
            $message->text_message = $faker->text();
            $message->email = $faker->email();
            $message->save();
            DB::update('update messages set created_at = ? where id = ?',
            [$faker->dateTimeBetween('-6 months', 'now'),$message->id]);
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
