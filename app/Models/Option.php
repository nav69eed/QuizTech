<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Option.php
class Option extends Model
{
    protected $fillable = ['id', 'question_id', 'ans'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
