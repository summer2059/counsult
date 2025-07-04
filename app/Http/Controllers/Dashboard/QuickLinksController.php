<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class QuickLinksController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService) {
        $this->crudService = $crudService;
        $this->modelName = 'QuickLink';  
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
                ->addColumn('type', function ($data) {
                    return $data->type ? ucfirst($data->type->type) : 'N/A';
                })
                ->addColumn('title', function ($data) {
                    return $data->type && $data->type->type === 'japanese' ? ($data->jp_title ?? 'N/A') : ($data->title ?? 'N/A');
                })
                ->addColumn('url', function ($data) {
                    return $data->type && $data->type->type === 'japanese' ? ($data->jp_url ?? 'N/A') : ($data->url ?? 'N/A');
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="/dashboard/quick-links/' . $data->id . '/edit" class="btn btn-sm btn-primary"> Edit</a>
                     <a href="/dashboard/quick-links/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true"> Delete</a>';
                    
                    return $actionBtn;
                })
                ->rawColumns(['action', 'link'])
                ->make(true);
        }
        return view('dashboard.quick-links.index');  
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = Type::orderBy('type', 'asc')->get();
        return view('dashboard.quick-links.create', compact('categories'));  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'type_id' => 'required|exists:types,id',
        ]);

        $type = Type::find($request->type_id)?->type;
        $data = [
            'type_id' => $request->type_id,
            'status' => $request->status ?? 0,
            'priority' => $request->priority ?? 0,
        ];
        
        if ($type === 'japanese') {
            $request->validate([
                'jp_title' => 'required|string',
                'jp_url' => 'required',
            ]);

            $data += $request->only(['jp_title', 'jp_url']);
        } else {
            $request->validate([
                'title' => 'required|string',
                'url' => 'required',
            ]);

            $data += $request->only(['title', 'url']);
        }

        $this->crudService->create($this->modelName, $data);

        toast('Quick Links Added!', 'success');
        return redirect()->route('quick-links.index');  
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
        $finance = $this->crudService->find($this->modelName, $id);
        return view('dashboard.quick-links.edit', compact('finance'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
         $request->validate([
            'type_id' => 'required|exists:types,id',
        ]);

        $type = Type::find($request->type_id)?->type;
        $data = [
            'type_id' => $request->type_id,
            'status' => $request->status ?? 0,
            'priority' => $request->priority ?? 0,
        ];
        
        if ($type === 'japanese') {
            $request->validate([
                'jp_title' => 'required|string',
                'jp_url' => 'required',
            ]);

            $data += $request->only(['jp_title', 'jp_url']);
        } else {
            $request->validate([
                'title' => 'required|string',
                'url' => 'required',
            ]);

            $data += $request->only(['title', 'url']);
        }
        $this->crudService->update($this->modelName, $id, $data);
        toast('Quick Links Updated!', 'success');
        return redirect()->route('quick-links.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->crudService->delete($this->modelName, $id);
        toast('Quick Links  Deleted!', 'success');
        return redirect()->route('quick-links.index');
    }

}
