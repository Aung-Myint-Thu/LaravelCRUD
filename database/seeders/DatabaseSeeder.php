<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Alice',
            'email' => 'alice@gmail.com'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Bob',
            'email' => 'bob@gmail.com'
        ]);

       Article::factory()->count(20)->create();
       Comment::factory()->count(60)->create();
       $list = ['Tech','News','Animal','World','Sport'];

        foreach($list as $name){
            Category::create([
                'name' => $name
            ]);
        }
    }
}
