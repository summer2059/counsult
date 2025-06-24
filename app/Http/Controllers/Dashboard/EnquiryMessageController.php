<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EnquiryMessageController extends Controller
{
        protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'EnquiryMessage';
    }

    public function index(Request $request){
        $title = 'Delete Enquiry Message!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        if ($request->ajax()) {
            $data = $this->crudService->all($this->modelName);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('service_name', function ($data) {
                    return $data->service ? $data->service->title : 'N/A';
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="enquiry-message/' . $data->id . '" class="btn btn-sm btn-danger"  data-confirm-delete="true"> Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.enquiry-message.index');
    }

    public function destroy(string $id)
    {
        $this->crudService->delete($this->modelName, $id);
        toast('Enquiry Message Deleted!', 'success');
        return redirect()->route('enquiry-message.index');
    }
    public function store(Request $request){
         try {
            $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
                'email' => 'required|email|max:255',
                'service_id' => 'required|integer|exists:services,id',
            ]);


            $data = $request->all();
            $this->crudService->create($this->modelName, $data);

            toast('Message Sent!', 'success');
        } catch (\Illuminate\Validation\ValidationException $e) {
            toast("Message isn't sent", 'error');
            return redirect()->back()->withErrors($e->errors())->withInput();
        }


        return redirect()->back();
    
    }
}
