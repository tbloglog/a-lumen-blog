<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Creo 2 utenti
        $users = [];

        array_push($users,User::factory()->times(1)
        ->create(
            ['subscription'=>'premium',
            'api_token'=>'78SsK60nLMqhiqJsNR1d3N0orzpAHG2V',
            'email' => 'userpremium@gmail.com'
            ])->first());

        array_push($users,User::factory()->times(1)
        ->create(
            ['subscription'=>'free',
            'api_token'=>'IzZzaspCOuFDSujMzyM1V4TachODwend',
            'email' => 'userfree@gmail.com'
            ])->first());

        foreach($users as $user){
            
            //Creo 5 post per ogni utente
            $posts = Post::factory()->times(5)->create([
                'user_id' => $user->id
            ]);

            //Creo dai 5 ai 10 commenti per ogni post
            foreach($posts as $post){

                Comment::factory()->times(rand(5,15))->create([
                    'post_id' => $post->id,
                    'user_id' => $user->id,
                ]);
            }
            
        };
    }
}