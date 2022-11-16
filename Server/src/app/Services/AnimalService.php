<?php

namespace App\Services;

use App\Models\Animal;

/**
 * Class AnimalService
 * @package App\Services
 */
class AnimalService
{
    public function show(string $name): Animal
    {
        $userId = 1; // TODO: Заменить на request()->auth('api')->id при добавлении пользователей
        $animal = Animal::where([
            'name' => $name,
            'user_id' => $userId
        ])->with('animalKind')->firstOrFail();

        return $animal;
    }
}
