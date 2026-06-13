<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Bill;
use App\Models\Payment;
use App\Services\PaymentService;
use App\Http\Requests\Payment\StorePaymentRequest;
use App\Http\Requests\Payment\UpdatePaymentRequest;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $service)
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
        $payments = $this->service->getAll();
        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource (view).
     */
    public function createView()
    {
        $bills = Bill::with([
            'roomtenant.tenant.user'
        ])->where('status', 'unpaid')->get();

        return view('admin.payments.create', compact(
            'bills'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        try {

            $this->service->store(
                $request->validated()
            );

            return redirect()
                ->route('admin.payments.index')
                ->with('success', 'Data payment berhasil ditambahkan.');

        } catch (Exception $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);
        }
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
    public function update(UpdatePaymentRequest $request, int $id)
    {
        try {

            $payment = Payment::find($id);

            if (!$payment) {

                return redirect()
                    ->route('admin.payments.index')
                    ->withErrors([
                        'error' => 'Data payment tidak ditemukan.'
                    ]);
            }

            $this->service->update(
                $payment,
                $request->validated()
            );

            return redirect()
                ->route('admin.payments.index')
                ->with('success', 'Data payment berhasil diperbarui.');

        } catch (Exception $e) {

            return back()
                ->withInput()
                ->withErrors([
                    'error' => $e->getMessage()
                ]);
        }
    }

    /**
     * Show the form for editing the specified resource (view).
     */
    public function editView(int $id)
    {
        $payment = $this->service->findById($id);

        $bills = Bill::with([
            'roomtenant.tenant.user'
        ])->get();

        return view('admin.payments.edit', compact(
            'payment',
            'bills'
        ));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return redirect()
                ->route('admin.payments.index')
                ->withErrors([
                    'error' => 'Data payment tidak ditemukan.'
                ]);
        }

        $this->service->delete($payment);

        return redirect()
            ->route('admin.payments.index')
            ->with('success', 'Data payment berhasil dihapus.');
    }
}
