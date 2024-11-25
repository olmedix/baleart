<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Zone;
use App\Models\Space;
use App\Models\Address;
use App\Models\Service;
use App\Models\Modality;
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
        

        foreach($data as $service) {

            $accessTypes="";

            if($service['accessibilitat'] ==="Sí"){
                $accessTypes= "y";
            }else if($service['accessibilitat'] ==="No"){
                 $accessTypes= "n";
            }else{
                 $accessTypes= "p";
            } 

            $newAddress = Address::create([
                'name' => $service['adreca'],
                'zone_id' => Zone::where('name',$service['zona'])->first()->id,
                'municipality_id' => Municipality::where('name', $service['municipi'])->first()->id,
            ]);
      
            $newSpace = Space::create([
               'name' => $service['nom'],
               'regNumber' => $service['registre'],
                'observation_CA' => $service['descripcions/cat'],
                'observation_ES' => $service['descripcions/esp'],
                'observation_EN' => $service['descripcions/eng'],
                'email' => $service['email'],
                'phone' => $service['telefon'],
                'website' => $service['web'],
                'access_types' => $accessTypes,
                'totalScore' => 0,
                'countScore' => 0,
                'address_id' => $newAddress->id,
                'space_types_id' => SpaceType::where('name', $service['tipus'])->first()->id,
                'user_id' => User::where('email', $service['gestor'])->first()->id ??
                             Role::where('name', 'administrador')->value('id'),

            ]);

            
            $modalitiesArray =array_map('trim', explode(',', $service['modalitats']));
            $modalities = Modality::whereIn('name', $modalitiesArray)->get();
            $newSpace->modalities()->attach($modalities);

            $serviceArray =array_map('trim', explode(',', $service['serveis']));
            $servei = Service::whereIn('name', $serviceArray)->get();
            $newSpace->services()->attach($servei);

            

        }
    }
}
