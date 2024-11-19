<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonDatabase = file_get_contents('c:\\temp\\baleart\\serveis.json');
        $services = json_decode($jsonDatabase, true);

        foreach ($services as $service) {
            Service::create([
                'id' => $service['id'],
                'name' => $service['cat'],
                'description_CA' => $service['cat'],
                'description_ES' => $service['esp'],
                'description_EN' => $service['eng'],
            ]);
        }
    }
}
