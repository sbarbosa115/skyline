<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveGeneralBillsRequest;
use App\Models\GeneralBill;
use App\Services\GeneralBillsService;
use Illuminate\Http\Response;

class GeneralBillsController extends Controller
{
    private GeneralBillsService $service;

    public function __construct(GeneralBillsService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        return response()->json(GeneralBill::with(['property'])->get());
    }

    public function store(SaveGeneralBillsRequest $request)
    {
        return $this->service->create($request->validated());
    }

    public function show($id)
    {
        $bill = GeneralBill::with(['property'])->findOrFail($id);

        return response()->json($bill);
    }

    public function update(SaveGeneralBillsRequest $request, $id)
    {
        $bill = GeneralBill::findOrFail($id);
        $bill->update($request->validated());

        return response()->json($bill);
    }

    public function destroy($id)
    {
        GeneralBill::destroy($id);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
