<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'category', 'question','correct_answer','pembahasan','incorrect_answers',
    ];

    protected $casts = [
        'incorrect_answers' => 'array'
    ];

    protected $table = 'quiz';
}
