<?php

namespace Database\Seeders;

use App\Models\AnimalKind;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnimalTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'name' => 'EgyptCat', 'max_age' => 100, 'max_size' => 50, 'growth_factor' => 1.3],
            [ 'name' => 'Dog', 'max_age' => 150, 'max_size' => 100, 'growth_factor' => 1],
            [ 'name' => 'Pigeon', 'max_age' => 20, 'max_size' => 20, 'growth_factor' => 2],
            [ 'name' => 'Cat', 'max_age' => 80, 'max_size' => 200, 'growth_factor' => 1.6],
        ];

        foreach ($data as $item) {
            AnimalKind::firstOrCreate($item);
        }
    }
}
