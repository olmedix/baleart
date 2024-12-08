<?php

namespace Database\Seeders;

use App\Models\Island;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class IslandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $islands = [
            ['name' => 'Mallorca'],  // CORRECCIÓ: per què fas un array associatiu si no ho necessites? ... ni l'empres
            ['name' => 'Menorca'],
            ['name' => 'Eivissa'],
            ['name' => 'Formentera'],
        ];

        foreach ($islands as $island) {
            Island::create($island);
        }
    }
}
