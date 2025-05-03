<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveWorkOrdersNotesRequest;
use App\Models\WorkOrderNote;
use Illuminate\Http\Response;

class WorkOrdersNotesController extends Controller
{
    public function index()
    {
        return response()->json(
            WorkOrderNote::with(['workOrder'])->get()
        );
    }

    public function store(SaveWorkOrdersNotesRequest $request) {
        $workOrder = WorkOrderNote::create($request->validated());

        return response()->json($workOrder, Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        $workOrder = WorkOrderNote::with('workOrder')->findOrFail($id);

        return response()->json($workOrder);
    }

    public function update(SaveWorkOrdersNotesRequest $request, string $id)
    {
        $workOrder = WorkOrderNote::findOrFail($id);
        $workOrder->update($request->validated());

        return response()->json($workOrder);
    }

    public function destroy(string $id)
    {
        WorkOrderNote::destroy($id);
        
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
