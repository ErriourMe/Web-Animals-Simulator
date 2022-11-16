<?php

namespace Database\Seeders;

use App\Models\AnimalKind;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnimalKindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 'kind' => 'EgyptCat', 'max_age' => 100, 'max_size' => 50, 'growth_factor' => 1.3, 'sort' => 1],
            [ 'kind' => 'Dog', 'max_age' => 150, 'max_size' => 100, 'growth_factor' => 1, 'sort' => 2],
            [ 'kind' => 'Pigeon', 'max_age' => 20, 'max_size' => 20, 'growth_factor' => 2, 'sort' => 3],
            [ 'kind' => 'Cat', 'max_age' => 80, 'max_size' => 200, 'growth_factor' => 1.6, 'sort' => 4],
        ];

        foreach ($data as $item) {
            AnimalKind::firstOrCreate($item);
        }
    }
}
