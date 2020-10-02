<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
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
        ->create(['subscription'=>'premium','api_token'=>'78SsK60nLMqhiqJsNR1d3N0orzpAHG2V'])->first());

        array_push($users,User::factory()->times(1)
        ->create(['subscription'=>'free','api_token'=>'IzZzaspCOuFDSujMzyM1V4TachODwend'])->first());

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
