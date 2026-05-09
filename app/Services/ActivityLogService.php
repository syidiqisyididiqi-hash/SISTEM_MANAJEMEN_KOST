<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogService
{
    public function store(string $description): ActivityLog
    {
        return ActivityLog::create([
            'description' => $description,
        ]);
    }

    public function getAll()
    {
        return ActivityLog::latest()->get();
    }
}