<?php

namespace App\Http\Controllers;

use App\Contracts\AnswerContract;
use App\Http\Requests\Pages\RecordRequest;
use App\Services\RecordService;
use Illuminate\Http\JsonResponse;

class RecordController extends Controller
{
    protected AnswerContract $answer;

    public function __construct(AnswerContract $answer)
    {
        $this->answer = $answer;
    }

    public function index()
    {
        if (!auth()->user()->is_admin)
            return view('pages.record');

        return redirect()->route('dashboard');
    }

    public function store(RecordRequest $request, RecordService $service): JsonResponse
    {
        $this->answer->fill($service->saveRecord($request))->save();

        return response()->json([
            'message' => 'Your record successfully send. Redirecting...',
            'redirect' => route('answered')
        ]);

    }
}
