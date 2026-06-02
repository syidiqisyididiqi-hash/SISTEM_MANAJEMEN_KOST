<?php

namespace App\Services;
use App\Models\Room;
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
        $room->update($data);
        return $room;
    }

    public function delete(Room $room): void
    {
        $room->delete();
    }
}