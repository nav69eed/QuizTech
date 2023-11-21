<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Quiz.php
class Quiz extends Model
{
    protected $fillable = ['title', 'description', 'id'];
    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function attemptedusers()
    {
        return $this->hasMany(Attempteduser::class);
    }

    public function options()
    {
        return $this->hasManyThrough(Option::class, Question::class);
    }
}
