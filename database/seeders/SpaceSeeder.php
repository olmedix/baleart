<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Space;
use App\Models\Address;
use App\Models\SpaceType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents(database_path('c:\\temp\\baleart\\espais.json'));
        $spaces = json_decode($jsonData, true);

        // Generar un valor aleatorio para access_types
        $accessTypes = ['y', 'n', 'p'];
        $randomAccessType = $accessTypes[array_rand($accessTypes)];

        foreach ($spaces as $space) {
            Space::create([
               'name' => $space['name'],
               'registre' => $space['regNumber'],
                'observation_CA' => $space['descripcions/cat'],
                'observation_ES' => $space['descripcions/esp'],
                'observation_EN' => $space['descripcions/eng'],
                'email' => $space['email'],
                'phone' => $space['telefon'],
                'website' => $space['web'],
                'access_types' => $randomAccessType,
                //'total_scores' => 0,
                //'count_scores' => 0,
                'address_id' => Address::where('name',$space['adreca'] )->first()->id,
                'space_types_id' => SpaceType::where('name', $space['tipus'])->first()->id,
                //'user_id' => User::where('name', $space['usuari'])->first()->id,

            ]);
        }
    }
}
