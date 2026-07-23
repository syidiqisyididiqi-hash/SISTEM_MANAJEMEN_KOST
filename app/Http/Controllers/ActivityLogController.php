<?php

namespace App\Http\Controllers;

use App\Http\Requests\ActivityLog\StoreActivityLogRequest;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function __construct(private ActivityLogService $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $logs = $this->service->getAll();

        return view('admin.activity-log.index', compact('logs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityLogRequest $request)
    {
        $this->service->store(
            $request->validated()['description']
        );

        return redirect()
            ->route('admin.activity-log.index')
            ->with('success', 'Activity log berhasil ditambahkan.');
    }
    public function clear(Request $request)
    {
        $request->validate([
            'days' => 'required|integer|in:0,7,30,90,180,365',
        ]);

        $days = (int) $request->days;

        if ($days === 0) {
            ActivityLog::truncate();
            $message = "Semua activity log berhasil dibersihkan.";
        } else {
            ActivityLog::where('created_at', '<', now()->subDays($days))->delete();
            $message = "Activity log lebih dari {$days} hari berhasil dihapus.";
        }

        return redirect()
            ->route('admin.activity-log.index')
            ->with('success', $message);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
