<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Career;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CareerController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Career';
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $careers = Career::with('type')->latest();

            return DataTables::of($careers)
                ->addIndexColumn()
                ->addColumn('type', function ($row) {
                    return ucfirst($row->type->type ?? 'N/A');
                })
                ->addColumn('title', function ($row) {
                    return $row->type->type === 'japanese' ? ($row->jp_title ?? 'N/A') : ($row->title ?? 'N/A');
                })
                ->addColumn('status', function ($row) {
                    return $row->status ? 1 : 0;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
                ->addColumn('action', function ($row) {
                    return '
                    <a href="' . route('career.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <a href="' . route('career.show', $row->id) . '" class="btn btn-sm btn-info">View</a>
                    <a href="' . route('career.destroy', $row->id) . '" class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</a>
                ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.career.index');
    }

    public function create()
    {
        $categories = Type::orderby('type', 'asc')->get();
        return view('dashboard.career.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required|exists:types,id',
        ]);

        $type = Type::find($request->type_id)?->type;

        $data = [
            'type_id' => $request->type_id,
            'status' => $request->status ?? 0,
        ];

        switch ($type) {
            case 'japanese':
                $request->validate([
                    'jp_title' => 'required|string',
                    'jp_description' => 'required|string',
                    'jp_position' => 'required|string',
                    'jp_location' => 'required|string',
                    'jp_start_date' => 'required|date',
                    'jp_end_date' => 'required|date',
                ]);
                $data += $request->only([
                    'jp_title',
                    'jp_description',
                    'jp_position',
                    'jp_location',
                    'jp_start_date',
                    'jp_end_date'
                ]);
                break;

            default:
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                    'position' => 'required|string',
                    'location' => 'required|string',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                ]);
                $data += $request->only([
                    'title',
                    'description',
                    'position',
                    'location',
                    'start_date',
                    'end_date'
                ]);
                break;
        }

        $this->crudService->create($this->modelName, $data);
        toast('Career Added!', 'success');

        return redirect()->route('career.index');
    }


    public function edit($id)
    {
        $data = $this->crudService->find($this->modelName, $id);
        $categories = Type::orderby('type', 'asc')->get();
        return view('dashboard.career.edit', compact('data', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type_id' => 'required|exists:types,id',
        ]);

        $type = Type::find($request->type_id)?->type;

        $data = [
            'type_id' => $request->type_id,
            'status' => $request->status ?? 0,
        ];

        switch ($type) {
            case 'japanese':
                $request->validate([
                    'jp_title' => 'required|string',
                    'jp_description' => 'required|string',
                    'jp_position' => 'required|string',
                    'jp_location' => 'required|string',
                    'jp_start_date' => 'required|date',
                    'jp_end_date' => 'required|date',
                ]);
                $data += $request->only([
                    'jp_title',
                    'jp_description',
                    'jp_position',
                    'jp_location',
                    'jp_start_date',
                    'jp_end_date'
                ]);
                break;

            default:
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                    'position' => 'required|string',
                    'location' => 'required|string',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date',
                ]);
                $data += $request->only([
                    'title',
                    'description',
                    'position',
                    'location',
                    'start_date',
                    'end_date'
                ]);
                break;
        }

        $this->crudService->update($this->modelName, $id, $data);
        toast('Career Updated!', 'success');

        return redirect()->route('career.index');
    }

    public function show($id)
    {
        $career = Career::with('type')->findOrFail($id);
        return view('dashboard.career.show', compact('career'));
    }

    public function destroy($id)
    {
        $this->crudService->delete($this->modelName, $id);
        toast('Career Deleted!', 'success');

        return redirect()->route('career.index');
    }
}
