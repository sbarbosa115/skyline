<?php

namespace App\Http\Controllers;

use App\Models\GeneralBill;
use App\Services\GeneralBillsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GeneralBillsController extends Controller
{
    private GeneralBillsService $service;
    private array $rules = [
        'property_id' => 'required|exists:properties,id',
        'sub_property_id' => 'nullable|exists:sub_properties,id',
        'service_type_id' => 'required|exists:service_types,id',
        'period_from' => 'required|date',
        'period_to' => 'required|date|after_or_equal:period_from',
        'amount' => 'required|numeric|min:0|max:99999999.99',
        'price' => 'required|numeric|min:0|max:99999999.99',
        'payment_status' => 'required|in:pending,paid',
    ];

    public function __construct(GeneralBillsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json(GeneralBill::with(['property'])->get());
    }

    public function store(Request $request)
    {
        $request->validate($this->rules);

        return $this->service->create($request->all());
    }

    public function show($id)
    {
        $bill = GeneralBill::with(['property'])->findOrFail($id);

        return response()->json($bill);
    }

    public function update(Request $request, $id)
    {
        $bill = GeneralBill::findOrFail($id);
        $request->validate($this->rules);
        $bill->update($request->all());

        return response()->json($bill);
    }

    public function destroy($id)
    {
        GeneralBill::destroy($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
