<?php

namespace App\Services;

use App\Models\Room;
use App\Models\RoomTenant;

class RoomTenantService
{
    public function getAll()
    {
        return RoomTenant::with(['room', 'tenant.user'])->latest()->get();
    }

    public function store(array $data): RoomTenant
    {
        $roomTenant = RoomTenant::create($data);

        if ($data['status'] === 'active') {
            Room::where('id', $data['room_id'])
                ->update(['status' => 'occupied']);
        }

        return $roomTenant;
    }

    public function update(RoomTenant $roomTenant, array $data): RoomTenant
    {
        $roomTenant->update($data);

        if ($data['status'] === 'finished') {
            Room::where('id', $roomTenant->room_id)
                ->update(['status' => 'available']);
        }

        return $roomTenant;
    }

    public function delete(RoomTenant $roomTenant): void
    {
        $roomTenant->delete();
    }
}