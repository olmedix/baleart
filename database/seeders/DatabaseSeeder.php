<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $this->call(IslandSeeder::class);
        $this->call(SpaceTypeSeeder::class);
        $this->call(ModalitySeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(MunicipalitySeeder::class);
        $this->call(ZoneSeeder::class);
        $this->call(UserSeeder::class);
        User::factory(50)->create();
        $this->call(SpaceSeeder::class);
        $this->call(CommentSeeder::class);
        Image::factory(50)->create();
    
    }
}
