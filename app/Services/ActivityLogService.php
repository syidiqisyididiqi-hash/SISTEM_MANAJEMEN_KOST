<?php

namespace App\Services;
use App\Models\ActivityLog;

class ActivityLogService
{
    public function getAll()
    {
        return ActivityLog::latest()->get();
    }

    public function create(string $description): ActivityLog
    {
        return ActivityLog::create([
            'description' => $description,
        ]);
    }
    
}