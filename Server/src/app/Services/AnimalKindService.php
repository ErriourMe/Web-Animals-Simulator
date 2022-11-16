<?php

namespace App\Services;

use App\Models\AnimalKind;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class AnimalKindService
 * @package App\Services
 */
class AnimalKindService
{
    public function index(): Collection
    {
        return AnimalKind::all();
    }
}
