<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
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
            AnimalKindSeeder::class,
        ]);

        if (!User::where('email', '=', 'admin@site.ru')->first()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@site.com',
                'password' => env('ADMIN_PASSWORD') ?? '7u86lo7yujtrhgd',
            ]);
        }
    }
}
