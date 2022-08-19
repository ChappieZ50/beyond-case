<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pages\RecordRequest;
use App\Models\Answer;
use App\Services\RecordService;

class RecordController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_admin)
            return view('pages.record');

        return redirect()->route('dashboard');
    }

    public function store(RecordRequest $request, RecordService $service, Answer $answer)
    {
        $answer->fill($service->saveRecord($request))->save();

        return response()->json([
            'message' => 'Your record successfully send. Redirecting...',
            'redirect' => route('answered')
        ]);

    }
}
