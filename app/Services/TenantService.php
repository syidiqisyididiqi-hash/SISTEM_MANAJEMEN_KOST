<?php

namespace App\Services;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TenantService
{
    public function getAll()
    {
        return Tenant::with('user')->latest()->get();
    }

    public function store(array $data): Tenant
    {
        return Tenant::create($data);
    }

    public function show(int $id): Tenant
    {
        $tenant = Tenant::with('user')->find($id);

        if (!$tenant) {
            throw new ModelNotFoundException("Tenant not found");
        }

        return $tenant;
    }

    public function update(Tenant $tenant, array $data): Tenant
    {
        $tenant->update($data);
        return $tenant;
    }

    public function delete(Tenant $tenant): void
    {
        $tenant->delete();
    }
}