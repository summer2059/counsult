<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ConsultRequest;
use App\Models\CosultBanner;
use App\Services\CrudService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConsultBannerController extends Controller
{
    protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'CosultBanner';
    }

    public function index()
    {
        $ab = CosultBanner::first(); 
        return view('dashboard.consult-banner.index', compact('ab'));
    }

    public function update(ConsultRequest $request)
    {
        $dbData = ['title' => $request->title, 'description' => $request->description];

        if ($request->hasFile('image')) {
            // Check for an image and upload if it exists
            $dbData['image'] = $request->file('image');
        }

        if ($request->id) {
            try {
                $data = $this->crudService->update($this->modelName, $request->id, $dbData);
                toast('Consult Banner updated successfully', 'success');
                return back()->withInput();
            } catch (\Exception $e) {
                Log::error('Error: ' . $e->getMessage(), ['exception' => $e, 'trace' => $e->getTraceAsString()]);
                toast('Error while updating data: ' . $e->getMessage(), 'error'); 
                return back()->withInput();
            }
        }

        try {
            $data = $this->crudService->create($this->modelName, $dbData);
            toast('Consult Banner added successfully', 'success'); 
            return back()->withInput();
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage(), ['exception' => $e, 'trace' => $e->getTraceAsString()]);
            toast('Error while adding data: ' . $e->getMessage(), 'error'); 
            return back()->withInput();
        }
    }
}