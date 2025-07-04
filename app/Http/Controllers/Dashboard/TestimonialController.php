<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestimonialController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService) {
        $this->crudService = $crudService;
        $this->modelName = 'Testimonial'; 
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
                ->addColumn('name', function ($data) {
                    return $data->type && $data->type->type === 'japanese' ? ($data->jp_name ?? 'N/A') : ($data->name ?? 'N/A');
                })
                ->addColumn('position', function ($data) {
                    return $data->type && $data->type->type === 'japanese' ? ($data->jp_position ?? 'N/A') : ($data->position ?? 'N/A');
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
                    $actionBtn = '<a href="/dashboard/testimoinal/' . $data->id . '/edit" class="btn btn-sm btn-primary"> Edit</a>
                     <a href="/dashboard/testimoinal/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true"> Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }
        return view('dashboard.testimoinal.index');  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        $categories = Type::orderBy('type', 'asc')->get();
        return view('dashboard.testimoinal.create', compact('categories'));  
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
                'jp_name' => 'required|string',
                'jp_position' => 'required|string',
                'jp_description' => 'required|string',
                'image2' => 'nullable|image',
            ]);

            $data += $request->only(['jp_name', 'jp_position', 'jp_description']);

            if ($request->hasFile('image2')) {
                $data['image2'] = $request->file('image2'); // pass file, not string
            }
        } else {
            $request->validate([
                'name' => 'required|string',
                'position' => 'required|string',
                'description' => 'required|string',
                'image' => 'nullable|image',
            ]);

            $data += $request->only(['name', 'position', 'description']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image'); // pass file, not string
            }
        }

        
        $this->crudService->create($this->modelName, $data);

        
        toast('Testimonial Added!', 'success');
        return redirect()->route('testimoinal.index');  
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
        $testimonial = $this->crudService->find($this->modelName, $id);
        return view('dashboard.testimoinal.edit', compact('testimonial'));  
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
                'jp_name' => 'required|string',
                'jp_position' => 'required|string',
                'jp_description' => 'required|string',
                'image2' => 'nullable|image',
            ]);

            $data += $request->only(['jp_name', 'jp_position', 'jp_description']);

            if ($request->hasFile('image2')) {
                $data['image2'] = $request->file('image2'); // pass file, not string
            }
        } else {
            $request->validate([
                'name' => 'required|string',
                'position' => 'required|string',
                'description' => 'required|string',
                'image' => 'nullable|image',
            ]);

            $data += $request->only(['name', 'position', 'description']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image'); // pass file, not string
            }
        }
        $this->crudService->update($this->modelName, $id, $data);
        toast('Testimonial Updated!', 'success');
        return redirect()->route('testimoinal.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->crudService->delete($this->modelName, $id);
        toast('Testimonial Deleted!', 'success');
        return redirect()->route('testimoinal.index');
    }

}
