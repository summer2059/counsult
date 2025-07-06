<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class TeamController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Team';
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

    public function create()
    {
        $categories = Type::orderby('type', 'asc')->get();
        return view('dashboard.Team.create', compact('categories'));
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

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }

            switch ($type) {
                case 'japanese':
                    $request->validate([
                        'jp_name' => 'required|string',
                        'jp_position' => 'required|string',
                    ]);
                    $data += $request->only(['jp_name', 'jp_position']);
                    break;

                default:
                    $request->validate([
                        'name' => 'required|string',
                        'position' => 'required|string',
                    ]);
                    $data += $request->only(['name', 'position']);
                    break;
            }

            $this->crudService->create($this->modelName, $data);
            toast('Team Added!', 'success');
        } catch (\Exception $e) {
            Log::error('Error adding team: ' . $e->getMessage());
            toast('An error occurred while adding the team.', 'error');
        }

        return redirect()->route('team.index');
    }

    public function show(string $id) {}

    public function edit(string $id)
    {
        $team = $this->crudService->find($this->modelName, $id);
        $categories = Type::orderby('type', 'asc')->get();
        return view('dashboard.Team.edit', compact('team', 'categories'));
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

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image');
            }

            switch ($type) {
                case 'japanese':
                    $request->validate([
                        'jp_name' => 'required|string',
                        'jp_position' => 'required|string',
                    ]);
                    $data += $request->only(['jp_name', 'jp_position']);
                    break;

                default:
                    $request->validate([
                        'name' => 'required|string',
                        'position' => 'required|string',
                    ]);
                    $data += $request->only(['name', 'position']);
                    break;
            }

            $this->crudService->update($this->modelName, $id, $data);
            toast('Team Updated!', 'success');
        } catch (\Exception $e) {
            Log::error('Error updating team: ' . $e->getMessage());
            toast('An error occurred while updating the team.', 'error');
        }

        return redirect()->route('team.index');
    }

    public function destroy(string $id)
    {
        try {
            $this->crudService->delete($this->modelName, $id);
            toast('Team Deleted!', 'success');
        } catch (\Exception $e) {
            Log::error('Error deleting team: ' . $e->getMessage());
            toast('An error occurred while deleting the team.', 'error');
        }

        return redirect()->route('team.index');
    }
}
