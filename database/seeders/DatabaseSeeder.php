<?php

namespace Database\Seeders;

use App\Models\Note;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User 1',
            'email' => 'user1@test.com',
            'password' => bcrypt('123456')
        ]);
        User::factory()->create([
            'name' => 'Test User 2',
            'email' => 'user2@test.com',
            'password' => bcrypt('123456')
        ]);
        User::factory(10)->create();

        $users = User::all();
        $users->each(function ($user) {
            Note::factory(5)->create([
                'user_id' => $user->id,
            ]);
        });
    }
}
