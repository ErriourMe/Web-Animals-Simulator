<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\AnimalController\AgeRequest;
use App\Http\Requests\Api\v1\AnimalController\StoreRequest;
use App\Http\Resources\Animal\AnimalResource;
use App\Models\Animal;
use App\Services\AnimalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class AnimalController extends Controller
{
    public function __construct(
        private AnimalService $animalService
    ) {}

    public function index(Request $request): JsonResponse
    {
        return response()->json(
            AnimalResource::collection($this->animalService->index())
        );
    }

    public function show(Request $request, string $name): JsonResponse
    {
        return response()->json(
            AnimalResource::make($this->animalService->show($name))
        );
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $userId = 1; // TODO: Заменить на request()->auth('api')->id при добавлении пользователей
        if(Animal::whereHas('animalKind', function ($q) use ($request) {
            $q->where('kind', $request->kind);
        })->where([
            'user_id' => $userId,
            'died_at' => null,
        ])->count() > 0) {
            throw new HttpException(422, json_encode([
                'errors' => [
                    'count' => ['Вы уже создали максимально допустимое количество животных этого типа'],
                ],
            ]));
        }

        $this->animalService->store($request);
        return response()->json([
            'error' => null,
            'data' => 'ok',
        ]);
    }

    public function age(AgeRequest $request): JsonResponse
    {
        $this->animalService->age($request);
        return response()->json([
            'error' => null,
            'data' => 'ok',
        ]);
    }
}
