<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnimalKind\AnimalKindResource;
use App\Services\AnimalKindService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnimalKindController extends Controller
{
    public function __construct(
        private AnimalKindService $animalKindService
    ) {}

    public function index(Request $request): JsonResponse
    {
        return response()->json(
            AnimalKindResource::collection($this->animalKindService->index())
        );
    }
}
