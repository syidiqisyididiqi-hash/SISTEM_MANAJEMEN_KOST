<?php

namespace App\Services;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TenantService
{
    public function __construct(
        private ActivityLogService $activityLogService
    ) {
    }

    public function getAll()
    {
        return Tenant::with('user')->latest()->get();
    }

    public function store(array $data): Tenant
    {
        $tenant = Tenant::create($data);
        $tenant->load('user');

        $this->activityLogService->store(
            "Menambahkan penyewa {$tenant->id}. " .
            "Nama: {$tenant->user->name}, " .
            "Nomor Telepon: {$tenant->phone}, " .
            "Alamat: {$tenant->address}."
        );

        return $tenant;
    }

    public function findById(int $id): Tenant
    {
        $tenant = Tenant::with('user')->find($id);

        if (!$tenant) {
            throw new ModelNotFoundException("Tenant not found");
        }

        return $tenant;
    }

    public function update(Tenant $tenant, array $data): Tenant
    {
        $oldData = $tenant->toArray();

        $tenant->update($data);
        $tenant->refresh();

        $messages = [];

        if ($oldData['phone'] != $tenant->phone) {
            $messages[] = "Nomor Telepon: {$oldData['phone']} → {$tenant->phone}";
        }

        if ($oldData['identity_number'] != $tenant->identity_number) {
            $messages[] = "Nomor Identitas: {$oldData['identity_number']} → {$tenant->identity_number}";
        }

        if ($oldData['address'] != $tenant->address) {
            $messages[] = "Alamat: {$oldData['address']} → {$tenant->address}";
        }

        if (!empty($messages)) {
            $this->activityLogService->store(
                "Mengubah data penyewa {$tenant->id}. " .
                implode(", ", $messages) . "."
            );
        }

        return $tenant;
    }

    public function delete(Tenant $tenant): void
    {
        $tenant->load('user');

        $tenantId = $tenant->id;
        $name = $tenant->user->name;
        $phone = $tenant->phone;

        $tenant->delete();

        $this->activityLogService->store(
            "Menghapus penyewa {$tenantId}. " .
            "Nama: {$name}, " .
            "Nomor Telepon: {$phone}."
        );
    }
}