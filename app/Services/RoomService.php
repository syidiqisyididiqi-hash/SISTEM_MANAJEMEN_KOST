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

    private function getStatusLabel(string $status): string
    {
        return match ($status) {
            'available' => 'Tersedia',
            'occupied' => 'Terisi',
            'maintenance' => 'Perbaikan',
            default => $status,
        };
    }
    public function getAll($search = null)
    {
        return Room::with([
            'roomTenants' => function ($query) {
                $query->where('status', 'active')
                    ->with('tenant.user');
            }
        ])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('room_number', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10);
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
            "Menambahkan kamar {$room->id}. Nomor Kamar: {$room->room_number}, Harga: Rp" .
            number_format($room->price_per_month, 0, ',', '.') .
            ", Status: " . $this->getStatusLabel($room->status) . "."
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
        $oldRoomNumber = $room->room_number;

        $room->update($data);

        $messages = [];

        if ($oldData['room_number'] != $room->room_number) {
            $messages[] = "Nomor Kamar: {$oldData['room_number']} → {$room->room_number}";
        }

        if ($oldData['price_per_month'] != $room->price_per_month) {
            $messages[] = "Harga: Rp" .
                number_format($oldData['price_per_month'], 0, ',', '.') .
                " → Rp" .
                number_format($room->price_per_month, 0, ',', '.');
        }

        if ($oldData['status'] != $room->status) {
            $messages[] = "Status: " .
                $this->getStatusLabel($oldData['status']) .
                " → " .
                $this->getStatusLabel($room->status);
        }

        if (!empty($messages)) {
            $this->activityLogService->store(
                "Mengubah data {$room->id}. Kamar {$oldRoomNumber}. " .
                implode(", ", $messages) . "."
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
            "Menghapus kamar {$room->id}. Nomor Kamar: {$roomNumber}, Harga: Rp" .
            number_format($room->price_per_month, 0, ',', '.') . "."
        );
    }
}