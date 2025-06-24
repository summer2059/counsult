<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PageController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Page';
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $pages = Page::with('type')->latest();

            return DataTables::of($pages)
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
                    <a href="' . route('page.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <a href="' . route('page.destroy', $row->id) . '" class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</a>
                ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.page.index');
    }

    public function create()
    {
        $categories = Type::orderby('type', 'asc')->get();
        return view('dashboard.page.create', compact('categories'));
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
                ]);
                $data += $request->only([
                    'jp_title',
                    'jp_description',
                ]);
                break;

            default:
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                ]);
                $data += $request->only([
                    'title',
                    'description',
                ]);
                break;
        }

        $this->crudService->create($this->modelName, $data);
        toast('Page Added!', 'success');

        return redirect()->route('page.index');
    }


    public function edit($id)
    {
        $data = $this->crudService->find($this->modelName, $id);
        $categories = Type::orderby('type', 'asc')->get();
        return view('dashboard.page.edit', compact('data', 'categories'));
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
                ]);
                $data += $request->only([
                    'jp_title',
                    'jp_description',
                ]);
                break;

            default:
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                ]);
                $data += $request->only([
                    'title',
                    'description',
                ]);
                break;
        }

        $this->crudService->update($this->modelName, $id, $data);
        toast('Page Updated!', 'success');

        return redirect()->route('page.index');
    }


    public function destroy($id)
    {
        $this->crudService->delete($this->modelName, $id);
        toast('Page Deleted!', 'success');

        return redirect()->route('page.index');
    }
}
