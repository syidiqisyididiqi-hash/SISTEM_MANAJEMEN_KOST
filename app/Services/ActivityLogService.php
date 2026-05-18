<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ActivityLogService
{
    public function getAll()
    {
        return ActivityLog::latest()->get();
    }

    public function store(string $description): ActivityLog
    {
        return ActivityLog::create([
            'description' => $description,
        ]);
    }

    public function findById(int $id): ActivityLog
    {
        $log = ActivityLog::find($id);

        if (!$log) {
            throw new ModelNotFoundException('Activity log not found');
        }

        return $log;
    }
}