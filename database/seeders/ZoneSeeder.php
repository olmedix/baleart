<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $zones = [
            ['name' => 'Centre'],
            ['name' => 'Ponent'],
            ['name' => 'Nord'],
            ['name' => 'Llevant'],
            ['name' => 'Sud'],
        ];

        foreach ($zones as $zone) {
            Zone::create($zone);
        }
    }
}
