<?php

namespace App\Services;

use App\Http\Requests\Api\v1\AnimalController\AgeRequest;
use App\Http\Requests\Api\v1\AnimalController\StoreRequest;
use App\Models\Animal;
use App\Models\AnimalKind;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AnimalService
 * @package App\Services
 */
class AnimalService
{
    public function index(): Collection
    {
        $userId = 1; // TODO: Заменить на request()->auth('api')->id при добавлении пользователей
        $animals = Animal::where([
            'user_id' => $userId,
            'died_at' => null,
        ])->with('animalKind')->get();

        return $animals;
    }

    public function show(string $name): Animal
    {
        $userId = 1; // TODO: Заменить на request()->auth('api')->id при добавлении пользователей
        $animal = Animal::where([
            'name' => $name,
            'user_id' => $userId
        ])->with('animalKind')->firstOrFail();

        return $animal;
    }

    public function store(StoreRequest $request): Animal
    {
        $animalKind = AnimalKind::where('kind', $request->kind)->first();

        $userId = 1; // TODO: Заменить на request()->auth('api')->id при добавлении пользователей
        return Animal::create([
            'animal_kind_id' => $animalKind->id,
            'user_id' => $userId,
            'name' => $request->name,
        ]);
    }

    public function age(AgeRequest $request): bool
    {
        Animal::where('name', $request->name)->update([
            'died_at' => Carbon::now(),
        ]);

        return true;
    }
}
