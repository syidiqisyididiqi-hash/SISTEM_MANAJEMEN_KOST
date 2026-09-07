<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\RoomTenant;
use App\Models\ActivityLog;
use Carbon\Carbon;

class DashboardService
{
    public function getDashboardSummary(): array
    {
        $totalTenants = Tenant::count();

        $totalRooms = Room::count();

        $occupiedRooms = RoomTenant::where('status', 'active')
            ->distinct('room_id')
            ->count();

        $availableRooms = $totalRooms - $occupiedRooms;

        $occupiedPercentage = $totalRooms > 0
            ? round(($occupiedRooms / $totalRooms) * 100)
            : 0;

        $availablePercentage = $totalRooms > 0
            ? round(($availableRooms / $totalRooms) * 100)
            : 0;

        $totalPayments = Payment::count();

        $totalPaidAmount = Payment::sum('amount') ?? 0;

        $recentPayments = Payment::with([
            'bill.roomTenant.room',
            'bill.roomTenant.tenant.user'
        ])
            ->latest()
            ->take(5)
            ->get();

        $recentActivities = ActivityLog::latest()
            ->take(10)
            ->get();

        $billStats = [
            'total' => Bill::count(),
            'paid' => Bill::where('status', 'paid')->count(),
            'unpaid' => Bill::where('status', 'unpaid')->count(),
            'overdue' => Bill::where('status', 'overdue')->count(),
        ];

        return compact(
            'totalTenants',
            'totalRooms',
            'occupiedRooms',
            'availableRooms',
            'occupiedPercentage',
            'availablePercentage',
            'totalPayments',
            'totalPaidAmount',
            'recentPayments',
            'recentActivities',
            'billStats'
        );
    }

    public function getTenantDashboardSummary(int $userId): array
    {
        $roomTenant = RoomTenant::with('room')
            ->whereHas('tenant', fn ($query) => $query->where('user_id', $userId))
            ->where('status', 'active')
            ->latest('start_date')
            ->first();

        $bill = $roomTenant?->bills()
            ->whereDate('bill_month', '<=', Carbon::today())
            ->orderByRaw("CASE WHEN status = 'paid' THEN 1 ELSE 0 END")
            ->latest('bill_month')
            ->first();

        $recentPayments = $roomTenant?->bills()
            ->with('payments')
            ->get()
            ->flatMap(fn ($item) => $item->payments)
            ->sortByDesc('paid_at')
            ->take(3)
            ->values() ?? collect();

        return [
            'roomTenant' => $roomTenant,
            'bill' => $bill,
            'recentPayments' => $recentPayments,
        ];
    }
}
