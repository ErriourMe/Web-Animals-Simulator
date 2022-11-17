<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\AnimalController\StoreRequest;
use App\Http\Resources\Animal\AnimalResource;
use App\Services\AnimalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        $this->animalService->store($request);
        return response()->json([
            'error' => null,
            'data' => 'ok',
        ]);
    }
}
