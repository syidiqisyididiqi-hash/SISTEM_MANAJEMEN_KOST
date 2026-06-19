<?php

namespace App\Services;
use App\Models\Room;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RoomService
{
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

        return Room::create($data);
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

        $room->update($data);

        return $room;
    }

    public function delete(Room $room): void
    {
        if (
            $room->image &&
            Storage::disk('public')->exists($room->image)
        ) {
            Storage::disk('public')->delete($room->image);
        }

        $room->delete();
    }
}