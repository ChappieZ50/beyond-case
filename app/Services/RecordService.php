<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RecordService
{
    protected UploadedFile $file;
    protected string $fileName;

    /**
     * @return string
     */
    private function uniqueRecordName(): string
    {
        return Str::slug(auth()->user()->name) . '-' . Str::random(6) . '.' . $this->file->extension();
    }

    /**
     * @return void
     */
    private function uploadRecord(): void
    {
        $this->fileName = $this->uniqueRecordName();
        Storage::disk('public')->putFileAs(
            path: 'records/',
            file: $this->file,
            name: $this->fileName
        );
    }

    /**
     * @param $request
     * @return array
     */
    public function saveRecord($request): array
    {
        $this->file = $request->file('record');
        $this->uploadRecord();
        $data['record'] = $this->fileName;
        $data['message'] = $request->get('message');
        $data['duration'] = $request->get('duration');
        return $data;
    }

    /**
     * @param $recordName
     * @return string
     */
    public function getRecordUrl($recordName): string
    {
        return url('storage/records/' . $recordName);
    }
}
