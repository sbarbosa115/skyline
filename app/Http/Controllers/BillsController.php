<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveInternalBillsRequest;
use App\Http\Requests\UploadImageRequest;
use App\Models\InternalBill;
use App\Services\BillsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BillsController extends Controller
{
    private BillsService $service;

    public function __construct(BillsService $service)
    {
        $this->middleware('auth:sanctum');
        $this->service = $service;
    }

    public function index()
    {
        return response()->json(InternalBill::with('subProperty')->get());
    }

    public function store(SaveInternalBillsRequest $request): JsonResponse
    {
        return $this->service->create($request->validated());
    }

    public function show($id)
    {
        $internalBill = InternalBill::with('subProperty')->findOrFail($id);

        return response()->json($internalBill);
    }

    public function update(SaveInternalBillsRequest $request, $id)
    {
        $internalBill = InternalBill::findOrFail($id);
        $internalBill->update($request->validated());

        return response()->json($internalBill);
    }

    public function destroy($id)
    {
        InternalBill::destroy($id);
        
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function uploadImage(UploadImageRequest $request, $id)
    {
        $internalBill = InternalBill::findOrFail($id);
        $imagePath = $request->file('image')->store('internal_bills_images', 'public');

        $internalBill->image_payment_path = $imagePath;
        $internalBill->save();

        return response()->json(['message' => 'Image uploaded successfully', 'image_path' => $imagePath]);
    }
}
