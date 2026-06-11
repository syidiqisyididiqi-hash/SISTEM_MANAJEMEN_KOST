<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bill\StoreBillRequest;
use App\Http\Requests\Bill\UpdateBillRequest;
use App\Models\Bill;
use App\Models\RoomTenant;
use App\Services\BillService;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function __construct(private BillService $service)
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
        $bills = $this->service->getAll();
        return view('admin.bills.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource (view).
     */
    public function createView()
    {
        $roomTenants = RoomTenant::with(['room', 'tenant.user'])
            ->where('status', 'active')
            ->get();

        return view('admin.bills.create', compact('roomTenants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillRequest $request)
    {
        $bill = $this->service->store($request->validated());

        return redirect()
            ->route('admin.bills.index')
            ->with('success', 'Bill berhasil ditambahkan!');
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
    public function update(UpdateBillRequest $request, Bill $bill)
    {
        $bill = $this->service->update($bill, $request->validated());
        return view('admin.bills.show', compact('bill'));
    }

    /**
     * Show the form for editing the specified resource (view).
     */
    public function editView(int $id)
    {
        $bill = $this->service->findById($id);
        return view('admin.bills.edit', compact('bill'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $this->service->delete($bill);

        return redirect()
            ->route('admin.bills.index')
            ->with('success', 'Bill berhasil dihapus!');
    }
}
