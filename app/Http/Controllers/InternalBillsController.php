<?php

namespace App\Http\Controllers;

use App\Models\InternalBill;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InternalBillsController extends Controller
{
    private array $rules = [
        'general_bill_id' => 'required|exists:general_bills,id',
        'property_id' => 'nullable|exists:sub_properties,id|required_without:sub_property_id',
        'sub_property_id' => 'nullable|exists:sub_properties,id|required_without:property_id',
        'amount' => 'required|numeric|min:0|max:99999999.99',
        'price' => 'required|numeric|min:0|max:99999999.99',
        'payment_status' => 'required|in:pending,paid',
        'proof_of_payment' => 'nullable|string|max:255',
    ];

    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        return response()->json(InternalBill::with('subProperty')->get());
    }

    public function store(Request $request)
    {
        $request->validate($this->rules);
        $internalBill = InternalBill::create($request->all());

        return response()->json($internalBill, Response::HTTP_CREATED);
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
