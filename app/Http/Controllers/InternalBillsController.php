<?php

namespace App\Http\Controllers;

use App\Models\InternalBill;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InternalBillsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    /**
     * Display a listing of internal bills.
     */
    public function index()
    {
        return response()->json(InternalBill::with('subProperty')->get());
    }

    /**
     * Store a newly created internal bill in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'general_bill_id' => 'required|exists:general_bills,id',
            'property_id' => 'nullable|exists:sub_properties,id|required_without:sub_property_id',
            'sub_property_id' => 'nullable|exists:sub_properties,id|required_without:property_id',
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'payment_status' => 'required|in:pending,paid',
            'proof_of_payment' => 'nullable|string|max:255',
        ]);

        $internalBill = InternalBill::create($request->all());

        return response()->json($internalBill, Response::HTTP_CREATED);
    }

    /**
     * Display the specified internal bill.
     */
    public function show($id)
    {
        $internalBill = InternalBill::with('subProperty')->findOrFail($id);
        return response()->json($internalBill);
    }

    /**
     * Update the specified internal bill in storage.
     */
    public function update(Request $request, $id)
    {
        $internalBill = InternalBill::findOrFail($id);

        $request->validate([
            'general_bill_id' => 'required|exists:general_bills,id',
            'property_id' => 'nullable|exists:sub_properties,id|required_without:sub_property_id',
            'sub_property_id' => 'nullable|exists:sub_properties,id|required_without:property_id',
            'amount' => 'required|numeric|min:0|max:99999999.99',
            'price' => 'required|numeric|min:0|max:99999999.99',
            'payment_status' => 'required|in:pending,paid',
            'proof_of_payment' => 'nullable|string|max:255',
        ]);

        $internalBill->update($request->all());

        return response()->json($internalBill);
    }

    /**
     * Remove the specified internal bill from storage.
     */
    public function destroy($id)
    {
        InternalBill::destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
