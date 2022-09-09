<?php

namespace Database\Seeders;

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {   
        $male_pics_array = [
            'profile_pics/fake_profiles/male/image001.jpg',
            'profile_pics/fake_profiles/male/image002.jpg',
            'profile_pics/fake_profiles/male/image003.jpg',
            'profile_pics/fake_profiles/male/image004.jpg',
            'profile_pics/fake_profiles/male/image005.jpg',
            'profile_pics/fake_profiles/male/image006.jpg',
            'profile_pics/fake_profiles/male/image007.jpg',
            'profile_pics/fake_profiles/male/image008.jpg',
            'profile_pics/fake_profiles/male/image009.jpg',
            'profile_pics/fake_profiles/male/image010.jpg',
            'profile_pics/fake_profiles/male/image011.jpg',
            'profile_pics/fake_profiles/male/image012.jpg',
            'profile_pics/fake_profiles/male/image013.jpg',
            'profile_pics/fake_profiles/male/image014.jpg',
            'profile_pics/fake_profiles/male/image015.jpg',
            'profile_pics/fake_profiles/male/image016.jpg',
            'profile_pics/fake_profiles/male/image017.jpg',
            'profile_pics/fake_profiles/male/image018.jpg',
            'profile_pics/fake_profiles/male/image019.jpg',
            'profile_pics/fake_profiles/male/image020.jpg',
            'profile_pics/fake_profiles/male/image021.jpg',
            'profile_pics/fake_profiles/male/image022.jpg',
        ];
        $female_pics_array = [
            'profile_pics/fake_profiles/female/image001.jpg',
            'profile_pics/fake_profiles/female/image002.jpg',
            'profile_pics/fake_profiles/female/image003.jpg',
            'profile_pics/fake_profiles/female/image004.jpg',
            'profile_pics/fake_profiles/female/image005.jpg',
            'profile_pics/fake_profiles/female/image006.jpg',
            'profile_pics/fake_profiles/female/image007.jpg',
            'profile_pics/fake_profiles/female/image008.jpg',
            'profile_pics/fake_profiles/female/image009.jpg',
            'profile_pics/fake_profiles/female/image010.jpg',
            'profile_pics/fake_profiles/female/image011.jpg',
            'profile_pics/fake_profiles/female/image012.jpg',
            'profile_pics/fake_profiles/female/image013.jpg',
            'profile_pics/fake_profiles/female/image014.jpg',
            'profile_pics/fake_profiles/female/image015.jpg',
            'profile_pics/fake_profiles/female/image016.jpg',
            'profile_pics/fake_profiles/female/image017.jpg',
            'profile_pics/fake_profiles/female/image018.jpg',
            'profile_pics/fake_profiles/female/image019.jpg',
            'profile_pics/fake_profiles/female/image020.jpg',
            'profile_pics/fake_profiles/female/image021.jpg',
        ];
        $cv_array = [
            'Laurea in Medicina e Chirurgia, Università degli Studi di Bari Aldo Moro, Bari. Votazione di 110/110 e lode con plauso accademico
            Specializzazione in Ginecologia e Ostetricia, Università degli Studi di Bari Aldo Moro, Bari. Votazione 70/70 e lode
            International Fellowship Program for Advanced Training in Obstetrics and Gynecology, 2013-2016, Soroka University Medical Center, Beer Sheva, Israele',
            
            'Ho conseguito la Laurea quinquennale in Psicologia (vecchio ordinamento) nel 2008.
            Ho svolto il tirocinio formativo presso il centro diurno Il Mandala di San Donato Milanese.
            Mi sono specializzato dal 2010 al 2012 in Counselling Psicologico corso tenuto da Obiettivo Psicologia scuola con sede a Roma.
            A partire da Gennaio 2010 ho svolto la libera professione collaborando con Stimulus Italia S.r.l. socetà che si occupa del benessere psicologico in azienda e di gestione e prevenzione dello stress lavoro-correlato.
            In particolare mi sono occupato della gestione delle chiamate entranti al numero verde messo a disposizione dei dipendenti di aziende convenzionate che possono contattare il servizio 24 ore su 24 per ricevere supporto psicologico o effettuare video consulenze per problematiche riguardanti la sfera personale piuttosto che professionale.
            Durante questi 11 anni di esperienza mi sono confrontato con tantissime persone a cui ho dato supporto psicologico su diverse tematiche tra cui ad esempio la gestione dello stress in ambito lavorativo, problematiche di coppia, ansia, gestione del cambiamento, gestione dei conflitti, empowerment, disabilità, identità di genere work life balance a interventi in azienda in situazioni di emergenza.
            La mia metodologia di lavoro si basa sul qui ed ora, sul momento presente.
            In base alla problematica che viene portata all\'interno dei colloqui si troverà la strategia più efficace per ritrovare il benessere psicologico.
            Il mio è un approccio centrato sulla persona, dove poter parlare delle proprie problematiche con un professionista competente e pronto ad ascoltarti nel pieno rispetto dei tuoi tempi.
            Troveremo durante il percorso le strategie e le risorse per gestire al meglio le situazioni problematiche e ritrovare il benessere psicofisico.
            Il primo colloquio è gratuito, dura 30 minuti e ha la finalità di valutare la possibilità di lavorare insieme rispetto alla problematica che viene portata.
            È possibile anche acquistare pacchetti di visite per una maggiore convenienza.',
            
            'Medico abilitato alla professione dall’età di 24 anni. Specialista otorinolaringoiatra. Dottore di ricerca in scienze mediche cliniche e sperimentali. Master in Citologia Nasale. Esperta in rinoallergologia e in disturbi respiratori del sonno dell’età adulta e pediatrica.',
            
            'Laurea in Medicina e Chirurgia nel 2004.
            Specializzazione in Endocrinologia e Malattia del Ricambio nel 2009.
            Dottorato di Ricerca nel 2014 in "Scienze Endocrinologiche: Basi Molecolari dell\'Azione Ormonale".
            Esperto in Oncologia Endocrina perfezionatosi presso l\'Istituto Gustave Roussy di Parigi per la diagnosi, cura e monitoraggio dei pazienti affetti da cancro tiroideo, tumori neuroendocrini del tratto gastroenteropancreatico e carcinoma corticosurrenalico.',
            
            'Sono un medico-chirurgo specialista in Urologia.
            Mi sono laureata in Medicina e Chirurgia a Bologna nel 1998 e specializzata con lode nel 2003 sempre a Bologna.
            Mi occupo di prevenzione, diagnosi e trattamento delle patologie dell’apparato urogenitale maschile e femminile: calcolosi renale, le cistiti,prostatiti,incontinenza urinaria maschile e femminile, tumori delle vie genito urinarie ( prostata, vescica, rene, testicolo ) impotenza, infertilità maschile, iperplasia prostatica benigna, varicocele,fimosi,idrocele',
            
            'Sono un psicologo iscritta all\'Ordine degli Psicologi del Piemonte (n° 9064).
            Mi sono laureata in Psicologia Criminologica e Forense presso l\'Università di Torino e attualmente sono specializzanda in psicoterapia cognitiva-comportamentale presso la CBT Academy di Torino.
            Al mio percorso di studi ho affiancato diverse esperienze lavorative in comunità psichiatriche ed educative (area adolescenti e genitore-bambino); sono tirocinante presso il reparto di Neuropsichiatria infantile dell\'ASL AT, sede di Nizza Monferrato.
            Nella pratica clinica adotto un approccio costruttivista che prevede l\'esplorazione del significato profondo che il paziente attribuisce alle sue esperienze, guidandolo alla scoperta delle sue emozioni nel corpo, elementi fondamentali per accedere alla consapevolezza e al cambiamento.
            Offro attività di consulenza e percorsi terapeutici per i principali sintomi di disagio psicologico: ansia, fobie, attacchi di panico, depressione, bassa autostima, problemi relazionali e/o contestuali a particolari fasi di vita.
            Gli interventi di sostegno e supporto psicologico sono rivolti ad adolescenti, adulti e genitori con percorsi di sostegno alla genitorialità.
            Ricevo su appuntamento presso l\'associazione "La compagnia del Cambiamento" ad Asti.',
            
            'Attraverso il colloquio offro uno spazio di ascolto, di riflessione e di comprensione. Ti aiuterò a confrontarti con le richieste interiori che possono nascere in particolari momenti della vita. La finalità è quella di promuovere il benessere nel rapporto con te stesso e con l\'altro (la tua/il tuo partner, la tua famiglia, i tuoi amici, il tuo lavoro).
            L\'emergenza che attualmente viviamo è una situazione stressante che ha messo e mette a dura prova la quotidianità di ognuno, aumentando talvolta situazioni psicologicamente difficili da attraversare. Momenti di ansia, di confusione, di non comprensione sono normali. Attraverso i colloqui ti permetterò di riflettere su strategie di adattamento ad una realtà cambiata, facendoti apprezzare la necessità dell\'evoluzione personale attraverso l\'ascolto interiore.
            Mi occupo anche di Psicologia della salute organizzativa e del rischio di stress correlato al lavoro. Da molti anni studio l\'etica della comunicazione in ambito medico e psicologico. Offro consulenza aziendale e formazione in ambito comunicativo a tutti quei professionisti che avvertono la necessità di apprendere nuovi modi di avvicinarsi alla propria utenza. Ho formalizzato l\'esperienze acquisita in questi campi attraverso pubblicazioni e convegni nazionali e internazionali (Tel Aviv, Budapest, Lisbona, Saragozza, Pisa, Lecce).
            Queste esperienze mi hanno permesso di sviluppare, inoltre, metodologie innovative nell\'ambito della progettazione in ambito sociale (locale, nazionale ed europeo). Per questo motivo, assieme al colloquio individuale, propongo interventi dedicati al gruppo, per attraversare ostacoli che possono presentarsi in ambito comunicativo.
            Infine, mi occupo di Communication Assessment per l\'impresa, fornendo analisi di valenza etica ed efficacia strategica nei piani di comunicazione adottati dalle aziende. Quest\' intervento si innesta nell\' ambito della Psicologia del lavoro.',
            
            'Dopo la laurea in scienze infermieristiche, il tirocinio in ospedale, e una tesi riguardante il bambino diabetico di tipo 1 e lo sport, ho capito che la nutrizione poteva fare la differenza nella prevenzione, nella gestione e nel trattamento di differenti problemi di salute, ma anche in altri ambiti, come quello sportivo.
            Ho deciso così di continuare gli studi di Biologia iniziati dopo il liceo, frequentando il corso di laurea magistrale in Biological Sciences presso l’università di Camerino e laureandomi con 110 e lode. Parallelamente ho frequentato anche il master SANIS con durata biennale spinta dalla mia passione per lo sport, che pratico da sempre.
            Durante questi anni mi sono interessata alla dieta zona, partecipando anche al convegno “Zone consultant”; così, insieme ad una collega, abbiamo studiato e commercializzato per 2 anni “La piadina della nutrizionista”, che rispettava i principi di una dieta bilanciata.
            Concluso il percorso universitario, ho lavorato per i 2 anni successivi in un’azienda alimentare dove mi occupavo di Ricerca e Sviluppo e Controllo Qualità, esperienza che mi ha permesso di studiare e mettere in pratica la tecnologia che si trova dietro gli alimenti e mi ha dato una visione a 360° del mondo alimentare.
            Terminata anche quest’esperienza che cerco di utilizzare anche nel mio attuale lavoro, ho deciso di dedicarmi a tempo pieno al lavoro di Nutrizionista continuando a formarmi in tutti i campi, con un\' attenzione particolare, soprattutto nell’ultimo anno alla Dieta chetogenica, VLCKD e frequentando il 18° corso di alimentazione e nutrizione umana dove sono stati trattati i seguenti argomenti: Approccio nutrizionale nel bambino, nell\'adulto e nell\'anziano, dieta chetogenica, ciclizzazione, digiuno intermittente, dieta mima digiuno, alimentazione nella donna in condizioni fisiologiche e patologiche, protocollo autoimmune, alimentazione vegetale e disturbi del comportamento alimentare.
            Attualmente iscritta al primo anno di Scienze e tecniche psicologiche.',

            'Sono Dirigente Medico di I livello, in servizio presso l\'Unità Operativa Complessa di Otorinolaringoiatria del Presidio Ospedaliero " R. Dimiccoli".
            Mi sono laureato in Medicina e Chirurgia nel 2013 presso l\'Università di Bari e specializzato in Otorinolaringoiatria e Chirurgia Cervico-Facciale nel 2018 nella medesima Università.
            Ho lavorato presso Unità Operativa Complessa di Otorinolaringoiatria degli Spedali Civili di
            Brescia e ho frequentato numerosi centri di Otorino in Italia e all\'estero (Francia, Inghilterra, Germania, Malta).',

            'Dottore con laurea in Medicina e chirurgia dal 1991 ottenuta a Torino. Sono iscritto all\'albo Provinciale dei Medici Chirurghi di TORINO dal 25/05/1992. Attualmente lavora in provincia di TO.
            Mi occupo della prevenzione, della valutazione e della cura delle malattie che coinvolgono la popolazione anziana (Malattia di Alzheimer e Demenze, Malattia di Parkinson e Disturbi del Movimento, Malattie Cerebrovascolari,valutazione della non autosufficienza con certificazione per pensione d\'invalidità e di accompagno e legge 104, completi di scale di valutazione ),effettuando Test per Disturbi della Memoria e della Cognitività, dell\'Umore e del Comportamento, affrontando non solo le problematiche cliniche acute, post-acute e croniche , ma anche quelle psicologiche e socio-economiche.
            Effettuo refertazioni e counseling di test genetici per la valutazione del rischio di sviluppare patologie neurodegenerative.
            Nel 2016 mi sono perfezionato in Medicina Preventiva Potenziativa Anti- Aging che è una medicina predittiva in quanto, grazie ai tests genetici, può predire lo sviluppo di un processo patologico, in qualsiasi cellula dell’organismo; è una medicina integrale perchè analizza globalmente ed in tempo reale i fenomeni fisiologici e/o patologici delle nostre cellule; è una medicina preventiva perchè grazie alla conoscenza di ciò che sta o può verificarsi nell’immediato o prossimo o lontano futuro, può consentire di mettere in atto interventi capaci di prevenire, modificare, rallentare, annullare o spostare nel tempo, tali fenomeni biologici; è una medicina rigenerativa in quanto capace di intervenire direttamente sui meccanismi di rigenerazione cellulare; è medicina complementare e integrativa perchè si collega direttamente alla medicina convenzionale, con tempi e modalità di estrinsecazione diverse.
            Effettuo inoltre trattamenti con ossigeno-ozonoterapia.',
        ];

        for ($i=0; $i < 300 ; $i++) { 
            
            $user = new User();
            $user->name = $i % 2 ? $faker->firstNameMale() : $faker->firstNameFemale();
            $user->surname = $faker->lastName();
            $user->email = $faker->email();
            $user->address = $faker->address();
            $user->slug = User::generateUserSlugFromName($user->name, $user->surname);
            $user->cv = $cv_array[$i % count($cv_array)];
            $user->phone_number = $faker->phoneNumber();
            $user->password = $faker->password();
            $user->photo = $i % 2 ? $male_pics_array[$i % count($male_pics_array)] : $female_pics_array[$i % count($female_pics_array)];
            $user->save();
            $user->specialties()->attach($faker->numberBetween(1, 29));
            if (substr( $user['name'], 0, 1 ) === "G") {
                $user->sponsorships()->attach([1 => ['date_start'=>now(), 'date_end'=>now()->addDays(10)]]);
            }
        }
        // Creiamo un utente "Mario Rossi"
        $new_user = new User();
            $new_user->name = 'Mario';
            $new_user->surname = 'Rossi';
            $new_user->email = 'test@example.com';
            $new_user->address = 'Via del Corso 123, Roma';
            $new_user->slug = User::generateUserSlugFromName($new_user->name, $new_user->surname);
            $new_user->password = Hash::make('asdfasdf');
            $new_user->cv = 'Sono Mario Rossi, un Geriatra con 40 anni di esperienza, laureato in Medicina e Chirurgia nel 1988, si è poi specializzato in Geriatria nel 1994 (a Torino); è Medico di Famiglia dal 1993 e svolge anche la professione di agopuntore dal 1998. , ma non ha mai fermato il suo percorso verso l’apprendimento: si è diplomato in Ultrasonologia Vascolare, è diventato Animatore di Formazione di Medicina Generale, ha conseguito un Master su “Uso e applicazione delle carte del rischio cardiovascolare” e altro ancora. Oggigiorno, coordina il Corso di Formazione Specifica in Medicina Generale della Regione Piemonte; è Tutor sia per la Formazione specifica in Medicina Generale che per l’Esame di Stato abilitante all’Esercizio Professionale per laureati in Medicina e Chirurgia presso l’Università degli Studi di Torino.';
            $new_user->phone_number = '051 8060';
            $new_user->save(); 
            $new_user->specialties()->attach(2);
            $new_user->sponsorships()->attach([1 => ['date_start'=>now()->subDays(4), 'date_end'=>now()->subSeconds(1)]]);
            $new_user->sponsorships()->attach([1 => ['date_start'=>now(), 'date_end'=>now()->addDays(10)]]);
    }
}
    
    // public function run()
    // {
    //     $users = [
    //         [
    //             'name' => 'Babbo',
    //             'surname' => 'Natale',
    //             'email' => 'PoloNord@gmail.com',
    //             'address' => 'Via le Dita dal naso, 89',
    //             'specialty_id' => 2,
    //             'slug' => 'babbo-natale',
    //             'cv' => 'lorem ipsum',
    //             'phone_number' => '3456789512',
    //             'password' => '34567html',
    //         ],
    //         [
    //             'name' => 'Gianni',
    //             'surname' => 'Babboleone',
    //             'email' => 'GianniGianni@gmail.com',
    //             'address' => 'Via da qui, 77',
    //             'specialty_id' => 8,
    //             'slug' => 'gianni-babboleone',
    //             'cv' => 'lorem ipsum ipsum ipsum',
    //             'phone_number' => '3446781345',  
    //             'password' => '34567html',         
    //         ],
    //         [
    //             'name' => 'Giovanni',
    //             'surname' => 'Giolitti',
    //             'email' => 'ggiolitti@example.com',
    //             'address' => 'Via Giolitti, 89',
    //             'specialty_id' => 1,
    //             'slug' => 'giovanni-giolitti',
    //             'cv' => 'Sono un medico eccezionale, provare per credere',
    //             'phone_number' => '064653843',
    //             'password' => '34567html',           
    //         ],
            
    //         [
    //             'name' => 'Marco',
    //             'surname' => 'Polo',
    //             'email' => 'qubilaikhan@example.com',
    //             'address' => 'Via Pechino, 1600',
    //             'specialty_id' => 10,
    //             'slug' => 'marco-polo',
    //             'cv' => 'Esperto in medicina cinese',
    //             'phone_number' => '0287651384', 
    //             'password' => '34567html',          
    //         ],    
            
    //         [
    //             'name' => 'Bello',
    //             'surname' => 'Figo',
    //             'email' => 'swag@gmail.com',
    //             'address' => 'Vicolo Corto, 77',
    //             'specialty_id' => 7,
    //             'slug' => 'bello-figo',
    //             'cv' => 'il miglior swag italiano',
    //             'phone_number' => '3456789666', 
    //             'password' => '34567html',          
    //         ],    
            
    //         [
    //             'name' => 'Giulio',
    //             'surname' => 'Cesare',
    //             'email' => 'tuquoque@example.com',
    //             'address' => 'Via Calende Greche, 89',
    //             'specialty_id' => 18,
    //             'slug' => 'giulio-cesare',
    //             'cv' => 'Esperto in medicina antica',
    //             'phone_number' => '061377821',  
    //             'password' => '34567html',         
    //         ],    
            
    //         [
    //             'name' => 'Montgomery',
    //             'surname' => 'Burns',
    //             'email' => 'conquertheworld@hotmail.it',
    //             'address' => 'Via dalle scatole, 33',
    //             'specialty_id' => 2,
    //             'slug' => 'montgomery-b',
    //             'cv' => 'lorem ipsum',
    //             'phone_number' => '3456789512',
    //             'password' => '34567html',           
    //         ],    
    //         [
    //             'name' => 'Emilio',
    //             'surname' => 'Sfasciacarrozze',
    //             'email' => 'spaccalampioni94@hotmail.com',
    //             'address' => 'Via da qui, 33',
    //             'specialty_id' => 8,
    //             'slug' => 'emilio-sfasciacarrozze',
    //             'cv' => 'lorem ipsum',
    //             'phone_number' => '3456559512',
    //             'password' => '34567html',           
    //         ],    
    //         [
    //             'name' => 'TrattoreMotoZappa',
    //             'surname' => 'Cappato',
    //             'email' => 'conquer',
    //             'address' => 'Via le Dita dal naso, 89',
    //             'specialty_id' => 2,
    //             'slug' => 'trattore-cappato',
    //             'cv' => 'lorem ipsum',
    //             'phone_number' => '3490789512',  
    //             'password' => '34567html',         
    //         ],    
    //         [
    //             'name' => 'Camillo',
    //             'surname' => 'Benso',
    //             'email' => 'cavour@example.com',
    //             'address' => 'Via Risorgimento, 12',
    //             'specialty_id' => 40,
    //             'slug' => 'camillo-benso',
    //             'cv' => 'Esperto in medicina moderna',
    //             'phone_number' => '0365616846',  
    //             'password' => '34567html',         
    //         ],    
    //     ];
    //     foreach($users as $user) {
    //         $new_user = new User();
    //         $new_user->name = $user['name'];
    //         $new_user->surname = $user['surname'];
    //         $new_user->email = $user['email'];
    //         $new_user->address = $user['address'];
    //         $new_user->slug = $user['slug'];
    //         $new_user->password = $user['password'];
    //         $new_user->cv = $user['cv'];
    //         $new_user->phone_number = $user['phone_number'];
    //         $new_user->save(); 
    //         $new_user->specialties()->attach($user['specialty_id']);

            // if (substr( $user['name'], 0, 1 ) === "G") {
            //     $new_user->sponsorships()->attach([1 => ['date_start'=>now(), 'date_end'=>now()]]);
            // }
    //     }
    // }
