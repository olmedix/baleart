<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use App\Models\Space;
use App\Models\Address;
use App\Models\SpaceType;
use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents('c:\\temp\\baleart\\espais.json');
        $data = json_decode($jsonData, true);

        // Generar un valor aleatorio para access_types
        $accessTypes = ['y', 'n', 'p'];
        $randomAccessType = $accessTypes[array_rand($accessTypes)];

        foreach($data as $address) {
            $newAddress = Address::create([/
                'name' => $address['adreca'],
                'zone_id' => Zone::where('name',$address['zona'])->first()->id,
                'municipality_id' => Municipality::where('name', $address['municipi'])->first()->id,
            ]);
      
            $newSpace = Space::create([
               'name' => $address['nom'],
               'regNumber' => $address['registre'],
                'observation_CA' => $address['descripcions/cat'],
                'observation_ES' => $address['descripcions/esp'],
                'observation_EN' => $address['descripcions/eng'],
                'email' => $address['email'],
                'phone' => $address['telefon'],
                'website' => $address['web'],
                'access_types' => $randomAccessType,
                'totalScore' => 0,
                'countScore' => 0,
                'address_id' => $newAddress->id;
                'space_types_id' => SpaceType::where('name', $address['tipus'])->first()->id,
                'user_id' => User::where('email', $address['gestor'])->first()->id ??
                             Role::where('name', 'administrador')->value('id'),

            ]);

        }
    }
}
