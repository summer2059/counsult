<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServicesController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Service';
    }

    public function index(Request $request)
    {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        if ($request->ajax()) {
            // Use dynamic modelName for querying the data
            $data = $this->crudService->all($this->modelName);

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('category_title', function ($data) {
                    return $data->serviceCategory ? $data->serviceCategory->title : 'N/A';
                })
                ->addColumn('status', function ($data) {
                    return $data->status ? 1 : 0;
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('services.edit', $data->id) . '" class="btn btn-sm btn-primary">Edit</a>
                            <a href="/dashboard/services/' . $data->id . '" class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.services.index');
    }

    public function create()
    {
        $categories = ServiceCategory::orderby('title', 'asc')->get();
        return view('dashboard.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string',
            'image' => 'required',
            'service_category_id' => 'required',
        ]);

        // Use CrudService to create the blog post with dynamic model
        $this->crudService->create($this->modelName, $request->all());

        // Log success message
        toast('Service Added!', 'success');

        return redirect()->route('services.index');
    }

    public function edit($id)
    {
        // Use CrudService to fetch the service dynamically
        $data = $this->crudService->find($this->modelName, $id);
        $categories = ServiceCategory::orderby('title', 'asc')->get();
        return view('dashboard.services.edit', compact('data', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'title' => 'required|string',
            'image' => 'nullable',
            'service_category_id' => 'required|exists:service_categories,id',
        ]);

        // Get the selected category title
        $category = ServiceCategory::find($request->service_category_id);

        // Define allowed categories that require price
        $categoriesWithPrice = ['Restaurant', 'Halal Food'];

        $data = $request->all();

        // If category is NOT Restaurant or Halal Food, set price to null
        if (!in_array($category->title, $categoriesWithPrice)) {
            $data['price'] = null;
        }

        // Use CrudService to update
        $this->crudService->update($this->modelName, $id, $data);

        toast('Service Updated!', 'success');

        return redirect()->route('services.index');
    }


    public function destroy($id)
    {
        // Use CrudService to delete the service dynamically
        $this->crudService->delete($this->modelName, $id);
        toast('Service Deleted!', 'success');

        return redirect()->route('services.index');
    }
}
