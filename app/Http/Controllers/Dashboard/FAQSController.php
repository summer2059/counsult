<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\FAQs;
use App\Models\Type;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FAQSController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'FAQs';
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $faqs = FAQs::with('type')->latest();

            return DataTables::of($faqs)
                ->addIndexColumn()
                ->addColumn('type', function ($row) {
                    return ucfirst($row->type->type ?? 'N/A');
                })
                ->addColumn('question', function ($row) {
                    return $row->type->type === 'japanese' ? ($row->jp_question ?? 'N/A') : ($row->question ?? 'N/A');
                })
                ->addColumn('status', function ($row) {
                    return $row->status ? 1 : 0;
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->format('Y-m-d');
                })
                ->addColumn('action', function ($row) {
                    return '
                    <a href="' . route('faqs.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <a href="' . route('faqs.destroy', $row->id) . '" class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</a>
                ';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.faqs.index');
    }

    public function create()
    {
        $categories = Type::orderby('type', 'asc')->get();
        return view('dashboard.faqs.create', compact('categories'));
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
                    'jp_question' => 'required|string',
                    'jp_answer' => 'required|string',
                ]);
                $data += $request->only([
                    'jp_question',
                    'jp_answer',
                ]);
                break;

            default:
                $request->validate([
                    'question' => 'required|string',
                    'answer' => 'required|string',
                ]);
                $data += $request->only([
                    'question',
                    'answer',
                ]);
                break;
        }

        $this->crudService->create($this->modelName, $data);
        toast('FAQS Added!', 'success');

        return redirect()->route('faqs.index');
    }


    public function edit($id)
    {
        $data = $this->crudService->find($this->modelName, $id);
        $categories = Type::orderby('type', 'asc')->get();
        return view('dashboard.faqs.edit', compact('data', 'categories'));
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
                    'jp_question' => 'required|string',
                    'jp_answer' => 'required|string',
                ]);
                $data += $request->only([
                    'jp_question',
                    'jp_answer',
                ]);
                break;

            default:
                $request->validate([
                    'question' => 'required|string',
                    'answer' => 'required|string',
                ]);
                $data += $request->only([
                    'question',
                    'answer',
                ]);
                break;
        }

        $this->crudService->update($this->modelName, $id, $data);
        toast('FAQS Updated!', 'success');

        return redirect()->route('faqs.index');
    }


    public function destroy($id)
    {
        $this->crudService->delete($this->modelName, $id);
        toast('FAQS Deleted!', 'success');

        return redirect()->route('faqs.index');
    }
}
