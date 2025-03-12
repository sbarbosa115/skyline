<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContractsController extends Controller
{
    /**
     * Display a listing of contracts.
     */
    public function index()
    {
        return response()->json(
            Contract::with(['property', 'subProperty', 'tenant'])->get()
        );
    }

    /**
     * Store a newly created contract in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'sub_property_id' => 'nullable|exists:sub_properties,id',
            'tenant_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:activo,por vencer,renovado,finalizado',
        ]);

        $contract = Contract::create($request->all());

        return response()->json($contract, Response::HTTP_CREATED);
    }

    /**
     * Display the specified contract.
     */
    public function show($id)
    {
        $contract = Contract::with(['property', 'subProperty', 'tenant'])->findOrFail($id);
        return response()->json($contract);
    }

    /**
     * Update the specified contract in storage.
     */
    public function update(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);

        $request->validate([
            'property_id' => 'nullable|exists:properties,id',
            'sub_property_id' => 'nullable|exists:sub_properties,id',
            'tenant_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:activo,por vencer,renovado,finalizado',
        ]);

        $contract->update($request->all());

        return response()->json($contract);
    }

    /**
     * Remove the specified contract from storage.
     */
    public function destroy($id)
    {
        Contract::destroy($id);
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
