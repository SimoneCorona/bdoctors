<?php

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
        for ($i=0; $i < 300 ; $i++) { 
            
            $user = new User();
            $user->name = $faker->firstName();
            $user->surname = $faker->lastName();
            $user->email = $faker->email();
            $user->address = $faker->address();
            $user->slug = User::generateUserSlugFromName($user->name, $user->surname);
            $user->cv = $faker->sentence();
            $user->phone_number = $faker->phoneNumber();
            $user->password = $faker->password();
            $user->save();
            $user->specialties()->attach($faker->numberBetween(1, 54));
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
            $new_user->cv = 'Sono Mario Rossi, un Geriatra con 40 anni di esperienza';
            $new_user->phone_number = '051 8060';
            $new_user->save(); 
            $new_user->specialties()->attach(2);
            // $new_user->sponsorships()->attach([1 => ['date_start'=>now(), 'date_end'=>now()]]);
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
