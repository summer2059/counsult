<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ContactController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Contact';
    }

    public function index(Request $request){
        $title = 'Delete Contact!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        if ($request->ajax()) {
            $data = $this->crudService->all($this->modelName);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="contact/' . $data->id . '" class="btn btn-sm btn-danger"  data-confirm-delete="true"> Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.contact.index');
    }

    public function destroy(string $id)
    {
        $this->crudService->delete($this->modelName, $id);
        toast('Contact Deleted!', 'success');
        return redirect()->route('contact.index');
    }
}
