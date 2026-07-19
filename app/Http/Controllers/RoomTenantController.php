<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomTenant\StoreRoomTenantRequest;
use App\Http\Requests\RoomTenant\UpdateRoomTenantRequest;
use App\Models\Room;
use App\Models\RoomTenant;
use App\Models\Tenant;
use App\Services\RoomTenantService;

class RoomTenantController extends Controller
{
    public function __construct(private RoomTenantService $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roomTenants = $this->service->getAll();

        return view('admin.room-tenants.index', compact('roomTenants'));
    }


    /**
     * Show the form for creating a new resource (view).
     */
    public function create()
    {
        $rooms = Room::all();
        $tenants = Tenant::all();

        return view('admin.room-tenants.create', compact('rooms', 'tenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomTenantRequest $request)
    {
        $this->service->store($request->validated());

        return redirect()
            ->route('admin.room-tenants.index')
            ->with('success', 'Room Tenant berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RoomTenant $roomTenant)
    {
        return view('admin.room-tenants.show', compact('roomTenant'));
    }

    /**
     * Show the form for editing the specified resource (view).
     */
    public function edit(RoomTenant $roomTenant)
    {
        $rooms = Room::all();
        $tenants = Tenant::all();

        return view('admin.room-tenants.edit', compact('roomTenant', 'rooms', 'tenants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomTenantRequest $request, RoomTenant $roomTenant)
    {
        $this->service->update($roomTenant, $request->validated());

        return redirect()
            ->route('admin.room-tenants.index')
            ->with('success', 'Room Tenant berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomTenant $roomTenant)
    {
        $this->service->delete($roomTenant);

        return redirect()
            ->route('admin.room-tenants.index')
            ->with('success', 'Room Tenant berhasil dihapus.');
    }
}
