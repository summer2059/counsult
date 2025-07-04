<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class ServicesController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Service';
    }

    public function index(Request $request)
    {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        if ($request->ajax()) {
            // Use dynamic modelName for querying the data
            $data = $this->crudService->all($this->modelName);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_title', function ($data) {
                    if (!$data->serviceCategory) return 'N/A';

                    // Check if the type is Japanese
                    if ($data->type_id == 2) {
                        return $data->serviceCategory->jp_title ?? $data->serviceCategory->title;
                    }

                    return $data->serviceCategory->title;
                })
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
                ->addColumn('status', function ($data) {
                    return $data->status ? 1 : 0;
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('services.edit', $data->id) . '" class="btn btn-sm btn-primary">Edit</a>
                            <a href="/dashboard/services/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</a>';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('dashboard.services.index');
    }
    public function getByLanguage(Request $request)
    {
        $language = $request->input('language', 'english');

        $typeId = Type::where('type', $language)->value('id');
        if (!$typeId) {
            return response()->json([], 404);
        }

        $categories = ServiceCategory::where('type_id', $typeId)
            ->select('id', $typeId === 2 ? 'jp_title as title' : 'title') // Language-specific label
            ->orderBy('title', 'asc')
            ->get();

        return response()->json($categories);
    }


    public function create()
    {
        $types = Type::all();
        $categories = ServiceCategory::orderBy('title')->get();
        return view('dashboard.services.create', compact('types', 'categories'));
    }




    public function store(Request $request)
    {
        try {
            $request->validate([
                'type_id' => 'required|exists:types,id',
                'service_category_id' => 'required|exists:service_categories,id',
            ]);

            $type = Type::find($request->type_id)?->type;

            $data = [
                'type_id' => $request->type_id,
                'service_category_id' => $request->service_category_id,
                'status' => $request->status ?? 0,
                'priority' => $request->priority ?? 0,
                'price' => $request->price ?? null,
            ];

            if ($type === 'japanese') {
                $request->validate([
                    'jp_title' => 'required|string',
                    'jp_description' => 'required|string',
                    'image2' => 'nullable|image',
                ]);

                $data += $request->only(['jp_title', 'jp_description']);

                if ($request->hasFile('image2')) {
                    $data['image2'] = $request->file('image2');
                }
            } else {
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                    'image' => 'nullable|image',
                ]);

                $data += $request->only(['title', 'description']);

                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image');
                }
            }

            $this->crudService->create($this->modelName, $data);

            toast('Service Added!', 'success');
            return redirect()->route('services.index');
        } catch (\Exception $e) {
            // Log error with full context
            Log::error('Service Store Error', [
                'message' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'stack' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);

            toast('Something went wrong while saving the service.', 'error');
            return redirect()->back()->withInput();
        }
    }



    public function edit($id)
    {
        // Use CrudService to fetch the service dynamically
        $data = $this->crudService->find($this->modelName, $id);
        $categories = ServiceCategory::orderby('title', 'asc')->get();
        return view('dashboard.services.edit', compact('data', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'type_id' => 'required|exists:types,id',
            'service_category_id' => 'required|exists:service_categories,id',
        ]);

        $type = Type::find($request->type_id)?->type;
        $serviceCategory = ServiceCategory::find($request->service_category_id)?->name; // Assuming 'name' is the category name.

        // List of categories where price should be shown
        $categoriesWithPrice = ['Restaurant', 'Halal Food', 'レストラン', 'ハラール 食品'];

        // Set price based on the category
        $price = in_array($serviceCategory, $categoriesWithPrice) ? $request->price : null;

        $data = [
            'type_id' => $request->type_id,
            'service_category_id' => $request->service_category_id,
            'status' => $request->status ?? 0,
            'priority' => $request->priority ?? 0,
            'price' => $price,
        ];

        if ($type === 'japanese') {
            $request->validate([
                'jp_title' => 'required|string',
                'jp_description' => 'required|string',
                'image2' => 'nullable|image',
            ]);

            $data += $request->only(['jp_title', 'jp_description']);

            if ($request->hasFile('image2')) {
                $data['image2'] = $request->file('image2');
            }
        } else {
            $request->validate([
                'title' => 'required|string',
                'description' => 'required|string',
                'image' => 'nullable|image',
            ]);

            $data += $request->only(['title', 'description']);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }
        }

        $this->crudService->update($this->modelName, $id, $data);

        toast('Service Updated!', 'success');
        return redirect()->route('services.index');
    }




    public function destroy($id)
    {
        // Use CrudService to delete the service dynamically
        $this->crudService->delete($this->modelName, $id);
        toast('Service Deleted!', 'success');

        return redirect()->route('services.index');
    }
}
