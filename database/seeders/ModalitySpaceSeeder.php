<?php

namespace Database\Seeders;

use App\Models\Space;
use App\Models\Modality;
use Illuminate\Database\Seeder;

class ModalitySpaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las modalidades y espacios
        $modalities = Modality::all();
        $spaces = Space::all();
        
        foreach ($spaces as $space) {
            foreach ($modalities as $modality) {
                $space->modalities()->attach($modality->id);
            }
        }
    }
}
