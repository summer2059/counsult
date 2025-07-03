<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class WeOfferController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService) {
        $this->crudService = $crudService;
        $this->modelName = 'WeOffer';  
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
                ->addColumn('image', function ($data) {
                    if ($data->type && $data->type->type === 'japanese') {
                        $imagePath = $data->image2 ? asset('uploads/images2/' . $data->image2) : null;
                    } else {
                        $imagePath = $data->image ? asset('uploads/images/' . $data->image) : null;
                    }

                    return $imagePath
                        ? '<img src="' . $imagePath . '" alt="Image" height="50">'
                        : 'N/A';
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="/dashboard/offer/' . $data->id . '/edit" class="btn btn-sm btn-primary"> Edit</a>
                     <a href="/dashboard/offer/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true"> Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        return view('dashboard.offer.index');  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = Type::orderBy('type', 'asc')->get();
        return view('dashboard.offer.create', compact('categories'));  
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
            'status' => $request->status
        ];

        if ($type === 'japanese') {
            $request->validate([
                'jp_title' => 'required|string',
                'jp_description' => 'nullable|string',
                'image2' => 'required|image',
            ]);

            $data += $request->only(['jp_title', 'jp_description']);
            if ($request->hasFile('image2')) {
                $data['image2'] = $request->file('image2'); // pass file, not string
            }
        }
        else {
            $request->validate([
                'title' => 'required|string',
                'description' => 'nullable|string',
                'image' => 'required|image',
            ]);

            $data += $request->only(['title', 'description']);
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image'); // pass file, not string
            }
        }

        $this->crudService->create($this->modelName, $data);

        toast('Offer Added!', 'success');
        return redirect()->route('offer.index'); 
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
        return view('dashboard.offer.edit', compact('banner'));  
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
        ];

        if ($type === 'japanese') {
            $request->validate([
                'jp_title' => 'required|string',
                'jp_description' => 'nullable|string',
                'image2' => 'required|image',
            ]);

            $data += $request->only(['jp_title', 'jp_description']);
            if ($request->hasFile('image2')) {
                $data['image2'] = $request->file('image2'); // pass file, not string
            }
        }
        else {
            $request->validate([
                'title' => 'required|string',
                'description' => 'nullable|string',
                'image' => 'required|image',
            ]);

            $data += $request->only(['title', 'description']);
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image'); // pass file, not string
            }
        }
        $this->crudService->update($this->modelName, $id, $data);
        toast('Offer Updated!', 'success');
        return redirect()->route('offer.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->crudService->delete($this->modelName, $id);
        toast('Offer Deleted!', 'success');
        return redirect()->route('banner.index');
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
                'message' => 'Offer not Found',
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