<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rol1 = new Role();
        $rol1->name = 'administrador';
        $rol1->save();

        $rol2 = new Role();
        $rol2->name = 'gestor';
        $rol2->save();

        $rol3 = new Role();
        $rol3->name = 'visitant';
        $rol3->save();
    }
}
