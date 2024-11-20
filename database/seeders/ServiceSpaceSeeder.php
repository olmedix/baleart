<?php

namespace Database\Seeders;

use App\Models\Space;
use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $services = Service::all();
        $spaces = Space::all();
        
        foreach ($spaces as $space) {
            foreach ($services as $service) {
                $space->services()->attach($service->id);
            }
        }
    }
}
