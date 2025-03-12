<?php

namespace App\Http\Controllers;

use App\Models\InternalBill;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InternalBillsController extends Controller
{
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
            'sub_property_id' => 'required|exists:sub_properties,id',
            'service_type'    => 'required|string|max:255',
            'period'          => 'required|string|max:50',
            'amount'          => 'required|numeric|min:0',
            'status'          => 'required|in:pendiente,pagado,vencido',
            'receipt'         => 'nullable|string|max:255', // URL o referencia al comprobante
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
            'sub_property_id' => 'required|exists:sub_properties,id',
            'service_type'    => 'required|string|max:255',
            'period'          => 'required|string|max:50',
            'amount'          => 'required|numeric|min:0',
            'status'          => 'required|in:pendiente,pagado,vencido',
            'receipt'         => 'nullable|string|max:255',
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
