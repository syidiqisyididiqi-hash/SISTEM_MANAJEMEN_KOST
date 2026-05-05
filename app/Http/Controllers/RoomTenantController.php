<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoomTenant\StoreRoomTenantRequest;
use App\Http\Requests\RoomTenant\UpdateRoomTenantRequest;
use App\Models\RoomTenant;
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
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomTenantRequest $request)
    {
        $data = $request->validated();
        $rt = $this->service->store($data);

        return response()->json($rt, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomTenantRequest $request, RoomTenant $roomTenant)
    {
        $rt = $this->service->update($roomTenant, $request->validated());

        return response()->json($rt);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoomTenant $roomTenant)
    {
        $this->service->delete($roomTenant);

        return response()->noContent();
    }
}
