<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Space;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonData = file_get_contents('c:\\temp\\baleart\\comentaris.json');
        $comments = json_decode($jsonData, true);

        foreach ($comments['comentaris']['comentari'] as $comment) {
            Comment::create([
                'comment' => $comment['text'],
                'score' => $comment['puntuacio'],
                'status' => 'y',
                'space_id' => Space::where('regNumber', $comment['espai'])->first()->id,
                'user_id' => User::where('email', $comment['usuari'])->first()->id,
                'created_at' => Carbon::createFromFormat('d-m-Y H:i:s', $comment['data'] . ' ' . $comment['hora']),
                'updated_at' => now(),
            ]);
        }
    }
}
