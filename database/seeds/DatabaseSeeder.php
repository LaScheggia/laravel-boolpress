<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            PostsTableSeeder::class,
            CategoryTableSeeder::class, //questo dovrebbe essere plurale ma io sono infame e ho sbagliato
            UpdatePostsSeeder::class,
            TagsTableSeeder::class,
        ]);
    }
}
