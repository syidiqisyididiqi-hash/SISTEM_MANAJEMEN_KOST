<?php

namespace App\Services;
use App\Models\Room;

class RoomService
{
    public function getAll()
    {
        return Room::latest()->get();
    }

    public function store(array $data): Room
    {
        return Room::create($data);
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