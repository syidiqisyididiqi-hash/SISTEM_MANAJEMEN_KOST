<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomTenant\StoreRoomTenantRequest;
use App\Http\Requests\RoomTenant\UpdateRoomTenantRequest;
use App\Models\Room;
use App\Models\RoomTenant;
use App\Models\Tenant;
use App\Services\RoomTenantService;
use Illuminate\Http\Request;

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
        return response()->json($this->service->getAll());
    }

    /**
     * Display a listing of the resource as HTML view.
     */
    public function indexView()
    {
        $roomTenants = $this->service->getAll();
        return view('admin.room-tenants.index', compact('roomTenants'));
    }

    /**
     * Show the form for creating a new resource (view).
     */
    public function createView()
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
        $data = $request->validated();
        $rt = $this->service->store($data);

        if ($request->wantsJson()) {
            return response()->json($rt, 201);
        }

        return redirect()->route('admin.room-tenant')
            ->with('success', 'Room Tenant berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $data = $this->service->findById((int) $id);

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomTenantRequest $request, RoomTenant $roomTenant)
    {
        $rt = $this->service->update($roomTenant, $request->validated());

        if ($request->wantsJson()) {
            return response()->json($rt);
        }

        return redirect()->route('admin.room-tenant')
            ->with('success', 'Room Tenant berhasil diperbarui.');
    }

    /**
     * Show the form for editing the specified resource (view).
     */
    public function editView(int $id)
    {
        $roomTenant = RoomTenant::findOrFail($id);
        $rooms = Room::all();
        $tenants = Tenant::all();

        return view('admin.room-tenants.edit', compact('roomTenant', 'rooms', 'tenants'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomTenant $roomTenant)
    {
        $this->service->delete($roomTenant);

        if (request()->wantsJson()) {
            return response()->noContent();
        }

        return redirect()->route('admin.room-tenant')
            ->with('success', 'Room Tenant berhasil dihapus.');
    }
}
