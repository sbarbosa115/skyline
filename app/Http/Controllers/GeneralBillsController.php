<?php

namespace App\Http\Controllers;

use App\Models\GeneralBill;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GeneralBillsController extends Controller
{
    /**
     * Display a listing of bills.
     */
    public function index()
    {
        return response()->json(GeneralBill::with(['property'])->get());
    }

    /**
     * Store a newly created bill in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'required|exists:properties,id',
            'service_type_id' => 'required|exists:service_types,id',
            'period' => 'required|date',
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'payment_status' => 'required|in:pending,paid',
        ]);

        $bill = GeneralBill::create($request->all());

        return response()->json($bill, Response::HTTP_CREATED);
    }

    /**
     * Display the specified bill.
     */
    public function show($id)
    {
        $bill = GeneralBill::with(['property'])->findOrFail($id);
        return response()->json($bill);
    }

    /**
     * Update the specified bill in storage.
     */
    public function update(Request $request, $id)
    {
        $bill = GeneralBill::findOrFail($id);

        $request->validate([
           'property_id' => 'required|exists:properties,id',
            'service_type_id' => 'required|exists:service_types,id',
            'period' => 'required|date',
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'payment_status' => 'required|in:pending,paid',
        ]);

        $bill->update($request->all());

        return response()->json($bill);
    }

    /**
     * Remove the specified bill from storage.
     */
    public function destroy($id)
    {
        GeneralBill::destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
