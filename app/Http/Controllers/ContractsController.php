<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveContractRequest;
use App\Models\Contract;
use App\Services\ContractsService;
use Illuminate\Http\Response;

class ContractsController extends Controller
{
    private ContractsService $service;

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

    public function store(SaveContractRequest $request)
    {
        return $this->service->create($request->validated());
    }

    public function show($id)
    {
        $contract = Contract::with(['property', 'subProperty', 'lessor', 'lessee'])->findOrFail($id);
        
        return response()->json($contract);
    }

    public function update(SaveContractRequest $request, $id)
    {
        $contract = Contract::findOrFail($id);
        $contract->update($request->validated());

        return response()->json($contract);
    }

    public function destroy($id)
    {
        Contract::destroy($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
