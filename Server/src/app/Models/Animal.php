<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_kind_id',
        'user_id',
        'name',
        'age',
        'size',
        'died_at',
    ];

    public function animalKind()
    {
        return $this->hasOne(AnimalKind::class, 'id', 'animal_kind_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
