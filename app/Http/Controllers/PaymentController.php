<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Bill;
use App\Models\Payment;
use Illuminate\Http\Request;
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
    public function index(Request $request)
    {
        $payments = $this->service->getAll($request->search);

        return view('admin.payments.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource (view).
     */
    public function create()
    {
        $bills = Bill::with([
            'roomTenant.room',
            'roomTenant.tenant.user'
        ])
            ->whereIn('status', ['unpaid', 'overdue'])
            ->get();

        return view('admin.payments.create', compact('bills'));
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
     * Show the form for editing the specified resource (view).
     */
    public function edit(int $id)
    {
        $payment = $this->service->findById($id);

        $bills = Bill::with([
            'roomtenant.room',
            'roomtenant.tenant.user'
        ])->get();

        return view('admin.payments.edit', compact(
            'payment',
            'bills'
        ));
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