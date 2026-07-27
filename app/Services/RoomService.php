<?php

namespace App\Services;

use App\Models\Room;
use App\Services\ActivityLogService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoomService
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {
    }
    public function getAll()
    {
        return Room::with([
            'roomTenants' => function ($query) {
                $query->where('status', 'active')->with('tenant.user');
            }
        ])->latest()->get();
    }

    public function store(array $data): Room
    {
        if (isset($data['image'])) {
            $data['image'] = $data['image']->store(
                'rooms',
                'public'
            );
        }

        $room = Room::create($data);

        $this->activityLogService->store(
            "Menambahkan kamar {$room->room_number}"
        );

        return $room;
    }

    public function findById(int $id): Room
    {
        $room = Room::find($id);

        if (!$room) {
            throw new ModelNotFoundException("Room not found");
        }

        return $room;
    }

    public function update(Room $room, array $data): Room
    {
        if (isset($data['image'])) {

            if (
                $room->image &&
                Storage::disk('public')->exists($room->image)
            ) {
                Storage::disk('public')->delete($room->image);
            }

            $data['image'] = $data['image']->store(
                'rooms',
                'public'
            );
        }

        $oldData = $room->toArray();

        $room->update($data);

        $changes = array_diff_assoc($room->toArray(), $oldData);

        if (!empty($changes)) {
            $this->activityLogService->store(
                "Data kamar {$room->room_number} diperbarui: " . json_encode($changes)
            );
        }

        return $room;
    }
    public function delete(Room $room): void
    {
        $roomNumber = $room->room_number;

        if (
            $room->image &&
            Storage::disk('public')->exists($room->image)
        ) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();

        $this->activityLogService->store(
            "Menghapus kamar {$roomNumber}"
        );
    }
}