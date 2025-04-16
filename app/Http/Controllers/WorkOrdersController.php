<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveWorkOrdersRequest;
use App\Models\WorkOrder;
use Illuminate\Http\Response;

class WorkOrdersController extends Controller
{
    public function index()
    {
        return response()->json(
            WorkOrder::with(['subProperty'])->get()
        );
    }

    public function store(SaveWorkOrdersRequest $request) {
        $workOrder = WorkOrder::create($request->validated());

        return response()->json($workOrder, Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        $workOrder = WorkOrder::with('subProperty')->findOrFail($id);

        return response()->json($workOrder);
    }

    public function update(SaveWorkOrdersRequest $request, string $id)
    {
        $workOrder = WorkOrder::findOrFail($id);
        $workOrder->update($request->validated());

        return response()->json($workOrder);
    }

    public function destroy(string $id)
    {
        WorkOrder::destroy($id);
        
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
