<?php

namespace App\Services;
use App\Models\Tenant;

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