<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BlogCategoryController extends Controller
{
     protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService) {
        $this->crudService = $crudService;
        $this->modelName = 'BlogCategory';  
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        
        if ($request->ajax()) {
            $data = $this->crudService->all($this->modelName);  
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $actionBtn = '<a href="/dashboard/blog-category/' . $data->id . '/edit" class="btn btn-sm btn-primary"> Edit</a>
                     <a href="/dashboard/blog-category/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true"> Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.blog-category.index');  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('dashboard.blog-category.create');  
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255', 
        ]);

        $data = $request->all();

        $this->crudService->create($this->modelName, $data);

        toast('Blog Category Added!', 'success');
        return redirect()->route('blog-category.index'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        $sc = $this->crudService->find($this->modelName, $id);
        return view('dashboard.blog-category.edit', compact('sc'));  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        $this->validate($request, [
            'title' => 'required|string|max:255',
        ]);
        $data = $request->all();
        $this->crudService->update($this->modelName, $id, $data);
        toast('Blog Category Updated!', 'success');
        return redirect()->route('blog-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->crudService->delete($this->modelName, $id);
        toast('Blog Category Deleted!', 'success');
        return redirect()->route('blog-category.index');
    }
}
