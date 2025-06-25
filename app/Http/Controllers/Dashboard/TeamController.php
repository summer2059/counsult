<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TeamController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Team';
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
            $data = $this->crudService->all($this->modelName);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('type', function ($data) {
                    return $data->type ? ucfirst($data->type->type) : 'N/A';
                })
                ->addColumn('name', function ($data) {
                    return $data->type && $data->type->type === 'japanese' ? ($data->jp_name ?? 'N/A') : ($data->name ?? 'N/A');
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="/dashboard/team/' . $data->id . '/edit" class="btn btn-sm btn-primary"> Edit</a>
                     <a href="/dashboard/team/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true"> Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.Team.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Type::orderby('type', 'asc')->get();
        return view('dashboard.Team.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required|exists:types,id',
        ]);

        $type = Type::find($request->type_id)?->type;

        $data = [
            'type_id' => $request->type_id,
            'status' => $request->status ?? 0,
            'image' => $request->image,
            'priority' => $request->priority ?? 0,
        ];

        switch ($type) {
            case 'japanese':
                $request->validate([
                    'jp_name' => 'required|string',
                    'jp_position' => 'required|string',
                ]);
                $data += $request->only([
                    'jp_name',
                    'jp_position',
                ]);
                break;

            default:
                $request->validate([
                    'name' => 'required|string',
                    'position' => 'required|string',
                ]);
                $data += $request->only([
                    'name',
                    'position',
                ]);
                break;
        }
        $this->crudService->create($this->modelName, $data);
        toast('Team Added!', 'success');
        return redirect()->route('team.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $team = $this->crudService->find($this->modelName, $id);
        $categories = Type::orderby('type', 'asc')->get();
        return view('dashboard.Team.edit', compact('team', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'type_id' => 'required|exists:types,id',
        ]);

        $type = Type::find($request->type_id)?->type;

        $data = [
            'type_id' => $request->type_id,
            'status' => $request->status ?? 0,
            'priority' => $request->priority ?? 0,
        ];
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image'); // This will be passed to CrudService and uploaded
        }

        switch ($type) {
            case 'japanese':
                $request->validate([
                    'jp_name' => 'required|string',
                    'jp_position' => 'required|string',
                ]);
                $data += $request->only([
                    'jp_name',
                    'jp_position',
                ]);
                break;

            default:
                $request->validate([
                    'name' => 'required|string',
                    'position' => 'required|string',
                ]);
                $data += $request->only([
                    'name',
                    'position',
                ]);
                break;
        }
        $this->crudService->update($this->modelName, $id, $data);
        toast('Team Updated!', 'success');
        return redirect()->route('team.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->crudService->delete($this->modelName, $id);
        toast('Team Deleted!', 'success');
        return redirect()->route('team.index');
    }
}
