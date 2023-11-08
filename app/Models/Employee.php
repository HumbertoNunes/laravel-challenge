<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Employee extends Model
{
    use HasFactory;

    public function user(): MorphOne
    {
        return $this->MorphOne(User::class, 'profile');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
