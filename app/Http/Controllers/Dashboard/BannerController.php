<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class BannerController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Banner';
    }

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
                        return $data->type && $data->type->type === 'japanese'
                            ? ($data->jp_title ?? 'N/A')
                            : ($data->title ?? 'N/A');
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
                        return '<a href="/dashboard/banner/' . $data->id . '/edit" class="btn btn-sm btn-primary"> Edit</a>
                                <a href="/dashboard/banner/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true"> Delete</a>';
                    })
                    ->rawColumns(['action', 'image'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error('Banner index error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
                return response()->json(['error' => 'Something went wrong.'], 500);
            }
        }

        return view('dashboard.banner.index');
    }

    public function create()
    {
        try {
            $categories = Type::orderBy('type', 'asc')->get();
            return view('dashboard.banner.create', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Banner create error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to load create form.']);
        }
    }

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

            if ($type === 'japanese') {
                $request->validate([
                    'jp_title' => 'required|string',
                    'jp_description' => 'required|string',
                    'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $data += $request->only(['jp_title', 'jp_description']);

                if ($request->hasFile('image2')) {
                    $data['image2'] = $request->file('image2');
                }
            } else {
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $data += $request->only(['title', 'description']);

                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image');
                }
            }

            $this->crudService->create($this->modelName, $data);

            toast('Banner Added!', 'success');
            return redirect()->route('banner.index');
        } catch (\Exception $e) {
            Log::error('Banner store error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->withErrors(['error' => 'Failed to save banner.'])->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        try {
            $why = $this->crudService->find($this->modelName, $id);
            return view('dashboard.banner.edit', compact('why'));
        } catch (\Exception $e) {
            Log::error('Banner edit error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to load banner.']);
        }
    }

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
                    'image2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $data += $request->only(['jp_title', 'jp_description']);

                if ($request->hasFile('image2')) {
                    $data['image2'] = $request->file('image2');
                }
            } else {
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                    'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                $data += $request->only(['title', 'description']);

                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image');
                }
            }

            $this->crudService->update($this->modelName, $id, $data);
            toast('Banner Updated!', 'success');
            return redirect()->route('banner.index');
        } catch (\Exception $e) {
            Log::error('Banner update error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->withErrors(['error' => 'Failed to update banner.'])->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->crudService->delete($this->modelName, $id);
            toast('Banner Deleted!', 'success');
            return redirect()->route('banner.index');
        } catch (\Exception $e) {
            Log::error('Banner delete error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete banner.']);
        }
    }

    public function toggleStatus(Request $request, $id)
    {
        try {
            $banner = $this->crudService->find($this->modelName, $id);

            if ($banner) {
                $banner->status = !$banner->status;
                $banner->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Status updated successfully',
                    'status' => $banner->status,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Banner not found',
            ]);
        } catch (\Exception $e) {
            Log::error('Error toggling banner status: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return response()->json([
                'success' => false,
                'message' => 'Error toggling status: ' . $e->getMessage(),
            ]);
        }
    }
}
