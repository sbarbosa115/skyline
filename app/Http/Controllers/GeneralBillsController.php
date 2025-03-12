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
        return response()->json(GeneralBill::with(['property', 'subProperty'])->get());
    }

    /**
     * Store a newly created bill in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type'           => 'required|in:general,internal',
            'property_id'    => 'nullable|exists:properties,id',
            'sub_property_id' => 'nullable|exists:sub_properties,id',
            'service_type'   => 'required|string|max:255',
            'period'         => 'required|string|max:50',
            'amount'         => 'required|numeric|min:0',
            'status'         => 'required|in:pendiente,pagado,vencido',
        ]);

        $bill = GeneralBill::create($request->all());

        return response()->json($bill, Response::HTTP_CREATED);
    }

    /**
     * Display the specified bill.
     */
    public function show($id)
    {
        $bill = GeneralBill::with(['property', 'subProperty'])->findOrFail($id);
        return response()->json($bill);
    }

    /**
     * Update the specified bill in storage.
     */
    public function update(Request $request, $id)
    {
        $bill = GeneralBill::findOrFail($id);

        $request->validate([
            'type'           => 'required|in:general,internal',
            'property_id'    => 'nullable|exists:properties,id',
            'sub_property_id' => 'nullable|exists:sub_properties,id',
            'service_type'   => 'required|string|max:255',
            'period'         => 'required|string|max:50',
            'amount'         => 'required|numeric|min:0',
            'status'         => 'required|in:pendiente,pagado,vencido',
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
