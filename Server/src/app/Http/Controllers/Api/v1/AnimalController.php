<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Animal\AnimalResource;
use App\Services\AnimalService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function __construct(
        private AnimalService $animalService
    ) {}

    public function show(Request $request, string $name): JsonResponse
    {
        return response()->json(
            AnimalResource::make($this->animalService->show($name))
        );
    }
}
