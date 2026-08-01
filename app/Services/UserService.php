<?php

namespace App\Services;

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
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
        return DB::transaction(function () use ($data) {

            $user = User::create($data);

            if ($user->role === 'tenant') {
                Tenant::create([
                    'user_id' => $user->id,
                    'phone' => $data['phone'] ?? null,
                    'identity_number' => $data['identity_number'] ?? null,
                    'address' => $data['address'] ?? null,
                ]);
            }

            $this->activityLogService->store(
                "Menambahkan pengguna {$user->id} ({$user->name}) dengan email {$user->email} dan peran {$user->role}."
            );

            return $user;
        });
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
                "Mengubah data pengguna {$userId} ({$oldName}). " .
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
            "Menghapus pengguna {$userId}. " .
            "Nama: {$name}, " .
            "Email: {$email}, " .
            "Peran: {$role}."
        );
    }
}
