<?php

namespace App\Http\Controllers;

use App\Models\Payment_method;
use App\Http\Requests\StorePayment_methodRequest;
use App\Http\Requests\UpdatePayment_methodRequest;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePayment_methodRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment_method $payment_method)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment_method $payment_method)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePayment_methodRequest $request, Payment_method $payment_method)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment_method $payment_method)
    {
        //
    }
}
