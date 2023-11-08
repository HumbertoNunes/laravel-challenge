<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'compensation', 'requirement'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
