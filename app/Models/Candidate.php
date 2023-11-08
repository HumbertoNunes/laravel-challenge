<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'birthdate', 'gender', 'course', 'biography'];

    public function user(): MorphOne
    {
        return $this->MorphOne(User::class, 'profile');
    }
}
