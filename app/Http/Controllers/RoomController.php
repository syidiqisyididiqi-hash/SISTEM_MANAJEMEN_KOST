<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Services\RoomService;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;

class RoomController extends Controller
{
    public function __construct(private RoomService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rooms = $this->service->getAll();

        return view('admin.rooms.index', compact('rooms'));
    }

    /**
     * untuk tenant
     */
    public function tenantIndex()
    {
        $rooms = Room::all();

        return view('tenant.rooms.index', compact('rooms'));
    }

    /**
     * Show the a new resource (view).
     */
    public function tenantShow(Room $room)
    {
        return view('tenant.rooms.show', compact('room'));
    }

    /**
     * Show the form for creating a new resource (view).
     */
    public function create()
    {
        return view('admin.rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoomRequest $request)
    {
        $room = $this->service->store($request->validated());

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $room = $this->service->findById($id);

        return view('tenant.rooms.show', compact('room'));
    }


    /**
     * Show the form for editing the specified resource (view).
     */
    public function edit(Room $room)
    {
        return view('admin.rooms.edit', compact('room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room = $this->service->update($room, $request->validated());

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $this->service->delete($room);

        return redirect()
            ->route('admin.rooms.index')
            ->with('success', 'Kamar berhasil dihapus!');
    }
}
