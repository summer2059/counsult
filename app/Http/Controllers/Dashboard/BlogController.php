<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BlogController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Blog';
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
                ->addColumn('category_title', function ($data) {
                    $category = $data->blogCategory;
                    if (!$category) return 'N/A';

                    switch ($data->type) {
                        case 'japanese':
                            return $category->jp_title ?? $category->title;
                        default:
                            return $category->title ?? 'N/A';
                    }
                })
                ->addColumn('title', function ($data) {
                    if ($data->type === 'japanese') {
                        return $data->jp_title ?? 'N/A';
                    }
                    return $data->title ?? 'N/A';
                })
                ->addColumn('status', function ($data) {
                    return $data->status ? 1 : 0;
                })
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('blog.edit', $data->id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <a href="' . route('blog.show', $data->id) . '" class="btn btn-sm btn-info">View</a>
                            <a href="' . route('blog.destroy', $data->id) . '" class="btn btn-sm btn-danger" data-confirm-delete="true">Delete</a>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('dashboard.blog.index');
    }

    public function create()
    {
        $categories = BlogCategory::orderby('title', 'asc')->get();
        return view('dashboard.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:english,japanese',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'image' => 'required',
        ]);

        $data = [
            'blog_category_id' => $request->blog_category_id,
            'image' => $request->image,
            'status' => $request->status ?? 0,
            'type' => $request->type,
        ];

        switch ($request->type) {

            case 'japanese':
                $request->validate([
                    'jp_title' => 'required|string',
                    'jp_description' => 'required|string',
                ]);
                $data['jp_title'] = $request->jp_title;
                $data['jp_description'] = $request->jp_description;
                break;

            default:
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                ]);
                $data['title'] = $request->title;
                $data['description'] = $request->description;
                break;
        }

        $this->crudService->create($this->modelName, $data);
        toast('Blog Added!', 'success');

        return redirect()->route('blog.index');
    }

    public function edit($id)
    {
        $data = $this->crudService->find($this->modelName, $id);
        $categories = BlogCategory::orderby('title', 'asc')->get();
        return view('dashboard.blog.edit', compact('data', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|in:english,nepali,japanese',
            'blog_category_id' => 'required|exists:blog_categories,id',
            'image' => 'nullable',
        ]);

        $data = [
            'blog_category_id' => $request->blog_category_id,
            'image' => $request->image,
            'status' => $request->status ?? 0,
            'type' => $request->type,
        ];

        switch ($request->type) {

            case 'japanese':
                $request->validate([
                    'jp_title' => 'required|string',
                    'jp_description' => 'required|string',
                ]);
                $data['jp_title'] = $request->jp_title;
                $data['jp_description'] = $request->jp_description;
                break;

            default:
                $request->validate([
                    'title' => 'required|string',
                    'description' => 'required|string',
                ]);
                $data['title'] = $request->title;
                $data['description'] = $request->description;
                break;
        }

        $this->crudService->update($this->modelName, $id, $data);
        toast('Blog Updated!', 'success');

        return redirect()->route('blog.index');
    }

    public function show($id){
        $blog = $this->crudService->find($this->modelName, $id);
        return view('dashboard.blog.show', compact('blog'));
    }
    public function destroy($id)
    {
        $this->crudService->delete($this->modelName, $id);
        toast('Blog Deleted!', 'success');

        return redirect()->route('blog.index');
    }
}
