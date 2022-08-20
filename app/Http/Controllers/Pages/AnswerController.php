<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Vote;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function index()
    {
        $answers = Answer::orderByDesc('id')->simplePaginate();
        return view('pages.answer.index')->with('answers', $answers);
    }


    public function show(Answer $answer)
    {
        $record = url('storage/records/' . $answer->record);

        return view('pages.answer.show')->with([
            'record' => $record,
            'answer' => $answer
        ]);
    }

    public function vote(Answer $answer, Vote $vote, Request $request): JsonResponse
    {
        $data = [
            'vote' => (bool)$request->get('vote') ? 1 : -1,
            'user_id' => auth()->id(),
            'answer_id' => $answer->id
        ];

        $vote->fill($data)->save();

        return response()->json([
            'message' => 'Answer voted'
        ]);
    }

}
