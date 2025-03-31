<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Services\ContractsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ContractsController extends Controller
{
    private ContractsService $service;
    private array $rules = [
        'property_id' => 'required|exists:properties,id',
        'sub_property_id' => 'nullable|exists:sub_properties,id',
        'lessor_id' => 'required|exists:users,id',
        'lessee_id' => 'required|exists:users,id',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'status' => 'required|in:active,inactive',
    ];

    public function __construct(ContractsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json(
            Contract::with(['property', 'subProperty', 'lessor', 'lessee'])->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate($this->rules);
        return $this->service->create($request->all());
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
