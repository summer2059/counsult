<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class ConsultDetailController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService) {
        $this->crudService = $crudService;
        $this->modelName = 'CosultDetail';  
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        if ($request->ajax()) {
            $data = $this->crudService->all($this->modelName);  
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="/dashboard/consult-detail/' . $data->id . '/edit" class="btn btn-sm btn-primary"> Edit</a>
                     <a href="/dashboard/consult-detail/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true"> Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.consult-detail.index');  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('dashboard.consult-detail.create');  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = $request->all();

        $this->crudService->create($this->modelName, $data);

        toast('Consult Detail Added!', 'success');
        return redirect()->route('consult-detail.index'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $banner = $this->crudService->find($this->modelName, $id);
        return view('dashboard.consult-detail.edit', compact('banner'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);
        $data = $request->all();
        $this->crudService->update($this->modelName, $id, $data);
        toast('Consult Detail Updated!', 'success');
        return redirect()->route('consult-detail.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->crudService->delete($this->modelName, $id);
        toast('Consult Detail Deleted!', 'success');
        return redirect()->route('consult-detail.index');
    }

    public function toggleStatus( Request $request, $id){
        try{
            $banner = $this->crudService->find($this->modelName, $id);

            if($banner){
                $banner->status = !$banner->status;
                $banner->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Status updated successfully',
                    'status' => $banner->status,
                ]);

            }
            return response()->json([
                'success' => 'false',
                'message' => 'Consult Detail not Found',
            ]);
        }
        catch(\Exception $e){
            Log::error('Error toggling status:' .$e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error toggling status:' .$e->getMessage(),
            ]);
        }

    }
}