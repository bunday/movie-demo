<?php

use Illuminate\Database\Seeder;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Movie::class, 3)->create()->each(function ($movie) {
            $movie->comments()->save(factory(App\Comment::class)->make());
        });
    }
}
