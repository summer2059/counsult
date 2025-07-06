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

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'WeOffer';
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
                ->addColumn('title', fn($data) => $data->type && $data->type->type === 'japanese' ? ($data->jp_title ?? 'N/A') : ($data->title ?? 'N/A'))
                ->addColumn('image', function ($data) {
                    $path = $data->type && $data->type->type === 'japanese'
                        ? ($data->image2 ? asset('uploads/images2/' . $data->image2) : null)
                        : ($data->image ? asset('uploads/images/' . $data->image) : null);

                    return $path
                        ? '<img src="' . $path . '" alt="Image" height="50">'
                        : 'N/A';
                })
                ->addColumn('action', function ($data) {
                    return '<a href="/dashboard/offer/' . $data->id . '/edit" class="btn btn-sm btn-primary"> Edit</a>
                            <a href="/dashboard/offer/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true"> Delete</a>';
                })
                ->rawColumns(['action', 'image'])
                ->make(true);
        }

        return view('dashboard.offer.index');
    }

    public function create()
    {
        $categories = Type::orderBy('type', 'asc')->get();
        return view('dashboard.offer.create', compact('categories'));
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
            ];

            if ($type === 'japanese') {
                $request->validate([
                    'jp_title' => 'required|string',
                    'jp_description' => 'nullable|string',
                    'image2' => 'required|image',
                ]);

                $data += $request->only(['jp_title', 'jp_description']);

                if ($request->hasFile('image2')) {
                    $data['image2'] = $request->file('image2');
                }
            } else {
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'nullable|string',
                    'image' => 'required|image',
                ]);

                $data += $request->only(['title', 'description']);

                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image');
                }
            }

            $this->crudService->create($this->modelName, $data);

            toast('Offer Added!', 'success');
            return redirect()->route('offer.index');
        } catch (\Exception $e) {
            Log::error('Error storing offer: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Failed to add offer. Please try again.');
        }
    }

    public function edit(string $id)
    {
        try {
            $banner = $this->crudService->find($this->modelName, $id);
            return view('dashboard.offer.edit', compact('banner'));
        } catch (\Exception $e) {
            Log::error('Error editing offer: ' . $e->getMessage());
            return redirect()->route('offer.index')->with('error', 'Failed to load edit form.');
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
            ];

            if ($type === 'japanese') {
                $request->validate([
                    'jp_title' => 'required|string',
                    'jp_description' => 'nullable|string',
                    'image2' => 'nullable|image',
                ]);

                $data += $request->only(['jp_title', 'jp_description']);

                if ($request->hasFile('image2')) {
                    $data['image2'] = $request->file('image2');
                }
            } else {
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'nullable|string',
                    'image' => 'nullable|image',
                ]);

                $data += $request->only(['title', 'description']);

                if ($request->hasFile('image')) {
                    $data['image'] = $request->file('image');
                }
            }

            $this->crudService->update($this->modelName, $id, $data);
            toast('Offer Updated!', 'success');
            return redirect()->route('offer.index');
        } catch (\Exception $e) {
            Log::error('Error updating offer: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->with('error', 'Failed to update offer.');
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->crudService->delete($this->modelName, $id);
            toast('Offer Deleted!', 'success');
            return redirect()->route('offer.index');
        } catch (\Exception $e) {
            Log::error('Error deleting offer: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return redirect()->route('offer.index')->with('error', 'Failed to delete offer.');
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
                'message' => 'Offer not found',
            ]);
        } catch (\Exception $e) {
            Log::error('Error toggling status: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle status. Please try again.',
            ]);
        }
    }
}
