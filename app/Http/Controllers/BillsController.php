<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveBillsRequest;
use App\Http\Requests\UploadImageRequest;
use App\Models\Bill;
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
        return response()->json(Bill::with('subProperty')->get());
    }

    public function store(SaveBillsRequest $request): JsonResponse
    {
        return $this->service->create($request->validated());
    }

    public function show($id)
    {
        $bill = Bill::with('subProperty')->findOrFail($id);

        return response()->json($bill);
    }

    public function update(SaveBillsRequest $request, $id)
    {
        $bill = Bill::findOrFail($id);
        $bill->update($request->validated());

        return response()->json($bill);
    }

    public function destroy($id)
    {
        Bill::destroy($id);
        
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    public function uploadImage(UploadImageRequest $request, $id)
    {
        $bill = Bill::findOrFail($id);
        $imagePath = $request->file('image')->store('bills_images', 'public');

        $bill->image_payment_path = $imagePath;
        $bill->save();

        return response()->json(['message' => 'Image uploaded successfully', 'image_path' => $imagePath]);
    }
}
