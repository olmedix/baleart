<?php

namespace Database\Seeders;

use App\Models\Zone;
use App\Models\Address;
use App\Models\Municipality;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents('c:\\temp\\baleart\\espais.json');
        $adresses = json_decode($jsonData, true);

        foreach($adresses as $address) {
            Address::create([
                'name' => $address['adreca'],
                'zone_id' => Zone::where('name',$address['zona'])->first()->id,
                'municipality_id' => Municipality::where('name', $address['municipi'])->first()->id,
            ]);
        }
    }
}
