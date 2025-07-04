<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
use Exception;

class BannerController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Banner';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        if ($request->ajax()) {
            try {
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
                        $actionBtn = '<a href="/dashboard/banner/' . $data->id . '/edit" class="btn btn-sm btn-primary"> Edit</a>
                         <a href="/dashboard/banner/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true"> Delete</a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action', 'image'])
                    ->make(true);
            } catch (Exception $e) {
                Log::error('Error fetching banners: ' . $e->getMessage());
                return response()->json(['error' => 'Something went wrong while fetching banners.'], 500);
            }
        }
        return view('dashboard.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $categories = Type::orderBy('type', 'asc')->get();
            return view('dashboard.banner.create', compact('categories'));
        } catch (Exception $e) {
            Log::error('Error fetching categories: ' . $e->getMessage());
            return redirect()->route('banner.index')->with('error', 'Failed to load categories.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'type_id' => 'required|exists:types,id',
            ]);

            $type = Type::find($request->type_id)?->type;

            $data = [
                'type_id' => $request->type_id,
                'status' => $request->status ?? 0,
                'priority' => $request->priority ?? 0,
            ];

            // Validation and data preparation for Japanese and other types
            if ($type === 'japanese') {
                $request->validate([
                    'jp_title' => 'required|string',
                    'jp_description' => 'required|string',
                    'image2' => 'nullable|image',
                ]);

                $data += $request->only(['jp_title', 'jp_description']);

                if ($request->hasFile('image2')) {
                    $data['image2'] = $request->file('image2'); // pass file, not string
                }
            } else {
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                    'image' => 'nullable|image',
                ]);

                $data += $request->only(['title', 'description']);

                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image'); // pass file, not string
                }
            }

            $this->crudService->create($this->modelName, $data);

            toast('Banner Added!', 'success');
            return redirect()->route('banner.index');
        } catch (\Exception $e) {
            Log::error('Error adding banner: ' . $e->getMessage());
            toast('Error: ' . $e->getMessage(), 'error');
            return back()->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $why = $this->crudService->find($this->modelName, $id);
            return view('dashboard.banner.edit', compact('why'));
        } catch (Exception $e) {
            Log::error('Error fetching banner for edit: ' . $e->getMessage());
            return redirect()->route('banner.index')->with('error', 'Failed to fetch banner for editing.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
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
                    'jp_description' => 'required|string',
                    'image2' => 'nullable|image',
                ]);

                $data += $request->only(['jp_title', 'jp_description']);

                if ($request->hasFile('image2')) {
                    $data['image2'] = $request->file('image2'); // pass file, not string
                }
            } else {
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                    'image' => 'nullable|image',
                ]);

                $data += $request->only(['title', 'description']);

                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image'); // pass file, not string
                }
            }
            $this->crudService->update($this->modelName, $id, $data);

            toast('Banner Updated!', 'success');
            return redirect()->route('banner.index');
        } catch (Exception $e) {
            Log::error('Error updating banner: ' . $e->getMessage());
            return redirect()->route('banner.index')->with('error', 'Failed to update banner.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->crudService->delete($this->modelName, $id);
            toast('Banner Deleted!', 'success');
            return redirect()->route('banner.index');
        } catch (Exception $e) {
            Log::error('Error deleting banner: ' . $e->getMessage());
            return redirect()->route('banner.index')->with('error', 'Failed to delete banner.');
        }
    }
}
