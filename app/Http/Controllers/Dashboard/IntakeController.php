<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class IntakeController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Intake';
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
                            ? ($data->jp_name ?? 'N/A')
                            : ($data->name ?? 'N/A');
                    })
                    ->addColumn('action', function ($data) {
                        return '<a href="/dashboard/intake/' . $data->id . '/edit" class="btn btn-sm btn-primary"> Edit</a>
                                <a href="/dashboard/intake/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true"> Delete</a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            } catch (\Exception $e) {
                Log::error('Intake index error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
                return response()->json(['error' => 'Something went wrong.'], 500);
            }
        }

        return view('dashboard.intake.index');
    }

    public function create()
    {
        try {
            $categories = Type::orderBy('type', 'asc')->get();
            return view('dashboard.intake.create', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Intake create error: ' . $e->getMessage());
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
            ];

            if ($type === 'japanese') {
                $request->validate([
                    'jp_name' => 'required|string',
                ]);

                $data += $request->only(['jp_name']);

            } else {
                $request->validate([
                    'name' => 'required|string',
                ]);

                $data += $request->only(['name']);

            }

            $this->crudService->create($this->modelName, $data);

            toast('Intake Added!', 'success');
            return redirect()->route('intake.index');
        } catch (\Exception $e) {
            Log::error('Intake store error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->withErrors(['error' => 'Failed to save intake.'])->withInput();
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        try {
            $city = $this->crudService->find($this->modelName, $id);
            return view('dashboard.intake.edit', compact('city'));
        } catch (\Exception $e) {
            Log::error('Intake edit error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to load intake.']);
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
                    'jp_name' => 'required|string',
                ]);

                $data += $request->only(['jp_name']);

                
            } else {
                $request->validate([
                    'name' => 'required|string',
                ]);

                $data += $request->only(['name']);
            }

            $this->crudService->update($this->modelName, $id, $data);
            toast('Intake Updated!', 'success');
            return redirect()->route('intake.index');
        } catch (\Exception $e) {
            Log::error('Intake update error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            return back()->withErrors(['error' => 'Failed to update intake.'])->withInput();
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->crudService->delete($this->modelName, $id);
            toast('Intake Deleted!', 'success');
            return redirect()->route('intake.index');
        } catch (\Exception $e) {
            Log::error('Intake delete error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Failed to delete intake.']);
        }
    }
}
