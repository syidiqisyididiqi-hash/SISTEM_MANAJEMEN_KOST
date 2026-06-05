<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tenant\StoreTenantRequest;
use App\Http\Requests\Tenant\UpdateTenantRequest;
use App\Models\Tenant;
use App\Services\TenantService;
use Illuminate\Http\Request;

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
        return response()->json($this->service->getAll());
    }

    /**
     * Display a listing of the resource as HTML view.
     */
    public function indexView()
    {
        $tenants = $this->service->getAll();
        return view('admin.tenant.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource (view).
     */
    public function createView()
    {
        return view('admin.tenant.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTenantRequest $request)
    {
        $tenant = $this->service->store($request->validated());
        return response()->json($tenant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $tenant = $this->service->findById((int) $id);

        return response()->json([
            'success' => true,
            'data' => $tenant
        ]);
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
     * Show the form for editing the specified resource (view).
     */
    public function editView(int $id)
    {
        $tenant = $this->service->findById($id);
        return view('admin.tenant.edit', compact('tenant'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tenant $tenant)
    {
        $this->service->delete($tenant);
        return response()->noContent();
    }
}
