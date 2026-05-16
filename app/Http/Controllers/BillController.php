<?php

namespace App\Http\Controllers;

use App\Http\Requests\Bill\StoreBillRequest;
use App\Http\Requests\Bill\UpdateBillRequest;
use App\Models\Bill;
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
     * Store a newly created resource in storage.
     */
    public function store(StoreBillRequest $request)
    {
        $bill = $this->service->store($request->validated());
        return response()->json($bill, 201);
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
        return response()->json($bill);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bill $bill)
    {
        $this->service->delete($bill);
        return response()->noContent();
    }
}
