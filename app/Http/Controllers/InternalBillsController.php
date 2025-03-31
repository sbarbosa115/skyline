<?php

namespace App\Http\Controllers;

use App\Models\InternalBill;
use App\Services\InternalBillsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InternalBillsController extends Controller
{
    private InternalBillsService $service;
    private array $rules = [
        'general_bill_id' => 'required|exists:general_bills,id',
        'property_id' => 'required|exists:properties,id',
        'sub_property_id' => 'required|exists:sub_properties,id',
        'amount' => 'required|numeric|min:0|max:99999999.99',
        'price' => 'nullable|numeric|min:0|max:99999999.99',
        'payment_status' => 'required|in:pending,paid',
        'proof_of_payment' => 'nullable|string|max:255',
    ];


    public function __construct(InternalBillsService $service)
    {
        $this->middleware('auth:sanctum');
        $this->service = $service;
    }

    public function index()
    {
        return response()->json(InternalBill::with('subProperty')->get());
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate($this->rules);
        return $this->service->create($request->all());
    }

    public function show($id)
    {
        $internalBill = InternalBill::with('subProperty')->findOrFail($id);

        return response()->json($internalBill);
    }

    public function update(Request $request, $id)
    {
        $internalBill = InternalBill::findOrFail($id);

        $request->validate($this->rules);
        $internalBill->update($request->all());

        return response()->json($internalBill);
    }

    public function destroy($id)
    {
        InternalBill::destroy($id);
        
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
