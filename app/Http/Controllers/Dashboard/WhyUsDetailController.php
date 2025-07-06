<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class WhyUsDetailController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'WhyUsDetail';
    }

    public function index(Request $request)
    {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        if ($request->ajax()) {
            $data = $this->crudService->all($this->modelName);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('type', fn($data) => $data->type ? ucfirst($data->type->type) : 'N/A')
                ->addColumn('title', fn($data) =>
                    $data->type && $data->type->type === 'japanese'
                        ? ($data->jp_title ?? 'N/A')
                        : ($data->title ?? 'N/A'))
                ->addColumn('image', function ($data) {
                    $imagePath = $data->type && $data->type->type === 'japanese'
                        ? ($data->image2 ? asset('uploads/images2/' . $data->image2) : null)
                        : ($data->image ? asset('uploads/images/' . $data->image) : null);

                    return $imagePath
                        ? '<img src="' . $imagePath . '" alt="Image" height="50">'
                        : 'N/A';
                })
                ->addColumn('action', function ($data) {
                    return '<a href="/dashboard/whyus-detail/' . $data->id . '/edit" class="btn btn-sm btn-primary">Edit</a>
                            <a href="/dashboard/whyus-detail/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</a>';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('dashboard.whyus-detail.index');
    }

    public function create()
    {
        $categories = Type::orderBy('type', 'asc')->get();
        return view('dashboard.whyus-detail.create', compact('categories'));
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
            toast('Why Us Detail Added!', 'success');
        } catch (\Throwable $e) {
            Log::error('Error in WhyUsDetailController@store: ' . $e->getMessage(), ['exception' => $e]);
            toast('Failed to add data. Please try again.', 'error');
        }

        return redirect()->route('whyus-detail.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        try {
            $why = $this->crudService->find($this->modelName, $id);
            return view('dashboard.whyus-detail.edit', compact('why'));
        } catch (\Throwable $e) {
            Log::error('Error in WhyUsDetailController@edit: ' . $e->getMessage(), ['exception' => $e]);
            toast('Unable to load edit form.', 'error');
            return redirect()->route('whyus-detail.index');
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
            toast('Why Us Detail Updated!', 'success');
        } catch (\Throwable $e) {
            Log::error('Error in WhyUsDetailController@update: ' . $e->getMessage(), ['exception' => $e]);
            toast('Update failed. Please try again.', 'error');
        }

        return redirect()->route('whyus-detail.index');
    }

    public function destroy(string $id)
    {
        try {
            $this->crudService->delete($this->modelName, $id);
            toast('Why Us Detail Deleted!', 'success');
        } catch (\Throwable $e) {
            Log::error('Error in WhyUsDetailController@destroy: ' . $e->getMessage(), ['exception' => $e]);
            toast('Delete failed. Please try again.', 'error');
        }

        return redirect()->route('whyus-detail.index');
    }
}
