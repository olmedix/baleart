<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = new User();
        $user->name = "admin";
        $user->lastName = "admin";
        $user->email = "admin12345678@abc.com";
        $user->phone = "+34 971505050";
        $user->password = Hash::make('12345678'); 
        $user->role_id = Role::where('name', 'administrador')->value('id');
        $user->save();


        $jsonData = file_get_contents('c:\\temp\\baleart\\usuaris.json');
        $users = json_decode($jsonData, true);

        foreach ($users['usuaris']['usuari'] as $user) {
            
            User::create([
                'name' => $user['nom'],
                'lastName' => $user['llinatges'],
                'email' => $user['email'],
                'phone' => $user['telefon'],
                'password' => Hash::make($user['password']),
                'role_id' => Role::where('name', 'gestor')->value('id'),
            ]);
            
        }
    }
}
