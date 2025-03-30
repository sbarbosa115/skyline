<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContractsController extends Controller
{

    private array $rules = [
        'property_id' => 'nullable|exists:sub_properties,id|required_without:sub_property_id',
        'sub_property_id' => 'nullable|exists:sub_properties,id|required_without:property_id',
        'tenant_id' => 'required|exists:users,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'status' => 'required|in:active,inactive',
    ];

    public function index()
    {
        return response()->json(
            Contract::with(['property', 'subProperty', 'lessor', 'lessee'])->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate($this->rules);
        $contract = Contract::create($request->all());

        return response()->json($contract, Response::HTTP_CREATED);
    }

    public function show($id)
    {
        $contract = Contract::with(['property', 'subProperty', 'lessor', 'lessee'])->findOrFail($id);
        
        return response()->json($contract);
    }

    public function update(Request $request, $id)
    {
        $contract = Contract::findOrFail($id);
        $request->validate($this->rules);
        $contract->update($request->all());

        return response()->json($contract);
    }

    public function destroy($id)
    {
        Contract::destroy($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
