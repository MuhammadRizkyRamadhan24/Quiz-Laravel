<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;

class quizController extends Controller
{
    public function createquiz(Request $request)
    {
        $quiz = Quiz::create([
            'category'    => $request->category,
            'question'    => $request->question,
            'correct_answer'    => $request->correct_answer,
            'incorrect_answers'    => $request->incorrect_answers,
            'pembahasan'    => $request->pembahasan,
        ]);
        return $quiz;
    }

    public function showquiz()
    {
        $quiz = Quiz::where('category', '=', 'latihansoal')->get();
        return $quiz->toArray();
    }

    public function exam()
    {
        $quiz = Quiz::where('category', '=', 'ujian')->get();
        return $quiz->toArray();
    }
}
