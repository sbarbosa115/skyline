<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveWorkOrdersNotesRequest;
use App\Mail\WorkOrdersUpdatesEmail;
use App\Models\WorkOrderNote;
use Illuminate\Http\Response;
use Mail;

class WorkOrdersNotesController extends Controller
{
    public function index()
    {
        return response()->json(
            WorkOrderNote::with(['workOrder'])->get()
        );
    }

    public function store(SaveWorkOrdersNotesRequest $request) {
        $workOrderNote = WorkOrderNote::create($request->validated());
        $subProperty = $workOrderNote->workOrder->subProperty;

        if ($subProperty->activeContract) {
            Mail::to($subProperty->activeContract->lessee->email)->send(new WorkOrdersUpdatesEmail());
        }

        return response()->json($workOrderNote, Response::HTTP_CREATED);
    }

    public function show(string $id)
    {
        $workOrderNote = WorkOrderNote::with('workOrder')->findOrFail($id);

        return response()->json($workOrderNote);
    }

    public function update(SaveWorkOrdersNotesRequest $request, string $id)
    {
        $workOrderNote = WorkOrderNote::findOrFail($id);
        $workOrderNote->update($request->validated());
        $subProperty = $workOrderNote->workOrder->subProperty;

        if ($subProperty->activeContract) {
            Mail::to($subProperty->activeContract->lessee->email)->send(new WorkOrdersUpdatesEmail());
        }

        return response()->json($workOrderNote);
    }

    public function destroy(string $id)
    {
        WorkOrderNote::destroy($id);
        
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
