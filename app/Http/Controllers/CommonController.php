<?php

namespace App\Http\Controllers;

use App\Services\CrudService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommonController extends Controller
{
    protected $crudService;

    public function __construct(CrudService $crudService) {
        $this->crudService = $crudService;  
    }
    public function toggleStatus(Request $request, $model, $id)
    {
        try {
            $model = ucfirst($model); // ensure it's like "Blog", "Product", etc.
            $data = $this->crudService->toggleStatus($model, $id);

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'status' => $data->status,
            ]);
        } catch (\Exception $e) {
            Log::error("Error toggling status for model $model with ID $id: " . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error toggling status',
            ]);
        }
    }
}
