<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnimalKind extends Model
{
    use HasFactory;

    protected $fillable = [
        'kind',
        'max_size',
        'max_age',
        'growth_factor',
        'sort',
    ];
}
