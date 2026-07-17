<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tenant\StoreTenantRequest;
use App\Http\Requests\Tenant\UpdateTenantRequest;
use App\Models\Tenant;
use App\Services\TenantService;
use App\Models\User;

class TenantController extends Controller
{
    public function __construct(private TenantService $service)
    {

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tenants = $this->service->getAll();

        return view('admin.tenant.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource (view).
     */
    public function create()
    {
        $users = User::all();

        return view('admin.tenant.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenantRequest $request)
    {
        $tenant = $this->service->store($request->validated());

        return redirect()
            ->route('admin.tenants.index')
            ->with('success', 'Tenant berhasil ditambahkan!');
    }

    /**
     * Edit
     */
    public function edit(Tenant $tenant)
    {
        return view('admin.tenant.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTenantRequest $request, Tenant $tenant)
    {
        $tenant = $this->service->update($tenant, $request->validated());

        return redirect()
            ->route('admin.tenants.index')
            ->with('success', 'Tenant berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $this->service->delete($tenant);
        return redirect()
            ->route('admin.tenants.index')
            ->with('success', 'Tenant berhasil dihapus!');
    }
}