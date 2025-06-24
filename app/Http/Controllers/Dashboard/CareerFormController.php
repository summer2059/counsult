<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\CareerForm;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CareerFormController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'CareerForm';
    }

    public function index(Request $request)
    {
        $title = 'Delete data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        if ($request->ajax()) {
            $data = $this->crudService->all($this->modelName);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('type', function ($data) {
                    return $data->type->type ?? '-';
                })
                ->addColumn('career_title', function ($data) {
                    return $data->type_id == 2 ? $data->career->jp_title ?? '-' : $data->career->title ?? '-';
                })
                ->addColumn('position', function ($data) {
                    return $data->type_id == 2 ? $data->career->jp_position ?? '-' : $data->career->position ?? '-';
                })
                ->addColumn('cv', function ($row) {
                    if (!empty($row->cv) && file_exists(public_path($row->cv))) {
                        $ext = strtolower(pathinfo($row->cv, PATHINFO_EXTENSION));
                        if ($ext === 'pdf') {
                            return '<a href="' . asset($row->cv) . '" target="_blank" class="btn btn-sm btn-primary">View CV</a>';
                        }
                        if (in_array($ext, ['doc', 'docx'])) {
                            return '<a href="' . asset($row->cv) . '" download class="btn btn-sm btn-success">Download CV</a>';
                        }
                    }
                    return '<span class="badge bg-secondary">N/A</span>';
                })
                ->addColumn('action', function ($data) {
                    return '<a href="career-form/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</a>';
                })
                ->rawColumns(['cv', 'action'])
                ->make(true);
        }
        return view('dashboard.career-form.index');
    }

    public function show(string $id)
    {
        $careerForm = $this->crudService->find($this->modelName, $id);
        return view('dashboard.career-form.show', compact('careerForm'));
    }

    // public function destroy(string $id)
    // {
    //     $this->crudService->delete($this->modelName, $id);
    //     toast('Career Form Deleted!', 'success');
    //     return redirect()->route('career-form.index');
    // }
    public function destroy(string $id)
    {
        $careerForm = $this->crudService->find($this->modelName, $id);
        if ($careerForm && $careerForm->cv && file_exists(public_path($careerForm->cv))) {
            @unlink(public_path($careerForm->cv));
        }
        $this->crudService->delete($this->modelName, $id);

        toast('Career Form Deleted!', 'success');
        return redirect()->route('career-form.index');
    }
}
