<?php

namespace App\Services;

use App\Models\User;
use App\Services\ActivityLogService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserService
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {
    }

    public function getAll($search = null)
    {
        return User::when($search, function ($query) use ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10);
    }

    public function store(array $data): User
    {
        $user = User::create($data);

        $this->activityLogService->store(
            "Menambahkan pengguna ID {$user->id} ({$user->name}) dengan email {$user->email} dan peran {$user->role}."
        );

        return $user;
    }

    public function findById(int $id): User
    {
        $user = User::find($id);

        if (!$user) {
            throw new ModelNotFoundException("User not found");
        }

        return $user;
    }

    public function update(User $user, array $data): User
    {
        $oldData = $user->toArray();
        $oldName = $user->name;
        $userId = $user->id;

        $user->update($data);

        $messages = [];

        if ($oldData['name'] != $user->name) {
            $messages[] = "Nama: {$oldData['name']} → {$user->name}";
        }

        if ($oldData['email'] != $user->email) {
            $messages[] = "Email: {$oldData['email']} → {$user->email}";
        }

        if ($oldData['role'] != $user->role) {
            $messages[] = "Peran: {$oldData['role']} → {$user->role}";
        }

        if (!empty($messages)) {
            $this->activityLogService->store(
                "Mengubah data pengguna ID {$userId} ({$oldName}). " .
                implode(", ", $messages) . "."
            );
        }

        return $user;
    }

    public function delete(User $user): void
    {
        $userId = $user->id;
        $name = $user->name;
        $email = $user->email;
        $role = $user->role;

        $user->delete();

        $this->activityLogService->store(
            "Menghapus pengguna ID {$userId}. " .
            "Nama: {$name}, " .
            "Email: {$email}, " .
            "Peran: {$role}."
        );
    }
}
