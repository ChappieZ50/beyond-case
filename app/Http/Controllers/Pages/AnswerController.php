<?php

namespace App\Http\Controllers\Pages;

use App\Contracts\AnswerContract;
use App\Contracts\VoteContract;
use App\Http\Controllers\Controller;
use App\Services\RecordService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    protected AnswerContract $answer;
    protected VoteContract $voteEntity;

    public function __construct(AnswerContract $answer, VoteContract $voteEntity)
    {
        $this->answer = $answer;
        $this->voteEntity = $voteEntity;
    }

    public function index()
    {
        $answers = $this->answer->orderByDesc()->simplePaginate();
        return view('pages.answer.index')->with('answers', $answers);
    }


    public function show($id, RecordService $service)
    {
        $answer = $this->answer->find($id);

        return view('pages.answer.show')->with([
            'record' => $service->getRecordUrl($answer->record),
            'answer' => $answer
        ]);
    }

    public function vote($id, Request $request): JsonResponse
    {
        $answer = $this->answer->find($id);
        $this->voteEntity->vote($answer->id, (bool)$request->get('vote'));

        return response()->json([
            'message' => 'Answer voted'
        ]);
    }

}
