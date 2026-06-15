<?php

namespace App\Services;

use App\Models\Bill;
use App\Models\Payment;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\RoomTenant;
use App\Models\ActivityLog;

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
}