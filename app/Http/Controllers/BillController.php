<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bill\StoreBillRequest;
use App\Http\Requests\Bill\UpdateBillRequest;
use App\Models\Bill;
use App\Models\RoomTenant;
use App\Services\BillService;

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
        $bills = $this->service->getAll();

        return view('admin.bills.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource (view).
     */
    public function create()
    {
        $roomTenants = RoomTenant::with([
            'room',
            'tenant.user'
        ])
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
     * Show the form for editing the specified bill.
     */
    public function edit(Bill $bill)
    {
        $bill->load([
            'roomtenant.room',
            'roomtenant.tenant.user'
        ]);

        $roomTenants = RoomTenant::with([
            'room',
            'tenant.user'
        ])
            ->where('status', 'active')
            ->get();

        return view('admin.bills.edit', compact('bill', 'roomTenants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBillRequest $request, Bill $bill)
    {
        $this->service->update($bill, $request->validated());

        return redirect()
            ->route('admin.bills.index')
            ->with('success', 'Bill berhasil diperbarui!');
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