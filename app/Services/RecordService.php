<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecordService
{
    protected UploadedFile $file;
    protected string $fileName;

    private function uniqueRecordName(): string
    {
        return Str::slug(auth()->user()->name) . '-' . Str::random(6) . '.' . $this->file->extension();
    }

    private function uploadRecord()
    {
        $this->fileName = $this->uniqueRecordName();
        Storage::disk('public')->putFileAs(
            path: 'records/',
            file: $this->file,
            name: $this->fileName
        );
        return $this;
    }

    private function getDuration()
    {
    }

    public function saveRecord($request): array
    {
        $this->file = $request->file('record');
        $data['duration'] = $this->uploadRecord()->getDuration();
        $data['record'] = $this->fileName;
        $data['message'] = $request->get('message');
        $data['duration'] = $request->get('duration');
        return $data;
    }
}
