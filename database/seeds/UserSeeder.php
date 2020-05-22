<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class, 10000)->create()->each(function ($user) {
            factory(\App\Models\Note::class, 3)->make()->each(function (\App\Models\Note $note) use ($user) {
                $note->user()->associate($user)->save();
            });
        });
    }
}
