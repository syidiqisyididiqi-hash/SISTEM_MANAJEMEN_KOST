<?php

namespace App\Services;
use App\Models\User;

class UserService
{
    public function getAll()
    {
        return User::latest()->get();
    }

    public function store(array $data): User
    {
        return User::create($data);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
