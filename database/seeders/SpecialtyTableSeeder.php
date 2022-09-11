<?php

namespace Database\Seeders;

use App\Specialty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecialtyTableSeeder extends Seeder
{

    private function generateSpecialtySlugFromName($specialty_name) {
        $base_slug = Str::slug($specialty_name);   
        $slug = $base_slug;
        $count = 1;
        $specialty_found = Specialty::where('specialty_slug', '=', $slug)->first();
        while ($specialty_found) {
            $slug = $base_slug . '-' . $count;
            $specialty_found = Specialty::where('specialty_slug', '=', $slug)->first();
            $count++;
        }
        return $slug;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties_name = [
            'Medicina interna',
            'Geriatria',
            'Dermatologia e Venereologia',
            'Ematologia',
            'Endocrinologia',
            'Gastroenterologia',
            'Nefrologia',
            'Neurologia',
            'Psichiatria',
            'Psicologia',
            'Pediatria',
            'Chirurgia generale',
            'Chirurgia plastica',
            'Ginecologia',
            'Ortopedia',
            'Urologia',
            'Oftalmologia',
            'Otorinolaringoiatria',
            'Cardiologia',
            'Radiologia',
            'Audiologia e foniatria',
            'Scienza dell’alimentazione',
            'Farmacologia',
            'Ortognatodonzia',
            'Medicina del lavoro',
        ];
        foreach($specialties_name as $specialty_name) {
            $new_specialty_name = new Specialty();
            $new_specialty_name->specialty_name = $specialty_name;
            $new_specialty_name->specialty_slug = $this->generateSpecialtySlugFromName($specialty_name);
            $new_specialty_name->save(); 
        }
    }
}



