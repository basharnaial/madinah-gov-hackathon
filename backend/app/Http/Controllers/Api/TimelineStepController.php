<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TimelineStep;
use Illuminate\Http\Request;

class TimelineStepController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $steps = TimelineStep::active()->get();
            
            return response()->json([
                'success' => true,
                'data' => $steps
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch timeline steps',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title_ar' => 'required|string|max:255',
                'title_en' => 'required|string|max:255',
                'subtitle_ar' => 'nullable|string',
                'subtitle_en' => 'nullable|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'step_date' => 'nullable|date',
                'order' => 'required|integer|min:1',
                'is_active' => 'boolean'
            ]);

            $step = TimelineStep::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Timeline step created successfully',
                'data' => $step
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create timeline step',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $step = TimelineStep::findOrFail($id);
            
            return response()->json([
                'success' => true,
                'data' => $step
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Timeline step not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch timeline step',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $step = TimelineStep::findOrFail($id);
            
            $validatedData = $request->validate([
                'title_ar' => 'sometimes|required|string|max:255',
                'title_en' => 'sometimes|required|string|max:255',
                'subtitle_ar' => 'nullable|string',
                'subtitle_en' => 'nullable|string',
                'description_ar' => 'nullable|string',
                'description_en' => 'nullable|string',
                'step_date' => 'nullable|date',
                'order' => 'sometimes|required|integer|min:1',
                'is_active' => 'boolean'
            ]);

            $step->update($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Timeline step updated successfully',
                'data' => $step->fresh()
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Timeline step not found'
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update timeline step',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $step = TimelineStep::findOrFail($id);
            $step->delete();

            return response()->json([
                'success' => true,
                'message' => 'Timeline step deleted successfully'
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Timeline step not found'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete timeline step',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
