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
            'Medicina di comunità',
            'Dermatologia e Venereologia',
            'Ematologia',
            'Endocrinologia e malattie del ricambio',
            'Gastroenterologia',
            'Malattie dell’apparato cardiovascolare',
            'Malattie dell’apparato respiratorio',
            'Malattie infettive',
            'Medicina tropicale',
            'Nefrologia',
            'Reumatologia',
            'Neurofisiopatologia',
            'Neurologia',
            'Neuropsichiatria infantile',
            'Psichiatria',
            'Psicologia clinica',
            'Pediatria',
            'Chirurgia generale',
            'Chirurgia dell’apparato digerente',
            'Chirurgia pediatrica',
            'Chirurgia plastica',
            'Ginecologia ed Ostetricia',
            'Neurochirurgia',
            'Ortopedia e traumatologia',
            'Urologia',
            'Chirurgia maxillo-facciale',
            'Oftalmologia',
            'Otorinolaringoiatria',
            'Cardiochirurgia',
            'Chirurgia toracica',
            'Chirurgia vascolare',
            'Anatomia patologica',
            'Biochimica clinica',
            'Microbiologia e Virologia',
            'Patologia clinica',
            'Radiodiagnostica',
            'Radioterapia',
            'Medicina nucleare',
            'Audiologia e foniatria',
            'Medicina fisica e riabilitativa',
            'Tossicologia medica',
            'Genetica medica',
            'Scienza dell’alimentazione',
            'Farmacologia',
            'Chirurgia orale',
            'Ortognatodonzia',
            'Igiene e Medicina preventiva',
            'Medicina aeronautica e spaziale',
            'Medicina del lavoro',
            'Medicina legale',
            'Statistica sanitaria',
            'Farmacia ospedaliera',
            'Fisica medica',
        ];
        foreach($specialties_name as $specialty_name) {
            $new_specialty_name = new Specialty();
            $new_specialty_name->specialty_name = $specialty_name;
            $new_specialty_name->specialty_slug = $this->generateSpecialtySlugFromName($specialty_name);
            $new_specialty_name->save(); 
        }
    }
}


