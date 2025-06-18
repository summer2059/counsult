<?php

namespace App\Http\Controllers;

use App\Services\CrudService;
use Illuminate\Http\Request;

class FrontendController extends Controller
{

     protected $crudService;
    protected $modelName;

    public function __construct(CrudService $crudService)
    {
        $this->crudService = $crudService;
        $this->modelName = 'Contact';
    }

    public function index()
    {
        return view('frontend.index');
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function services(){
        return view('frontend.service');
    }
    public function contact()
    {
        return view('frontend.contact');
    }
    public function storeContact(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
                'email' => 'required|email|max:255',
                'subject' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
                'message' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255'
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
