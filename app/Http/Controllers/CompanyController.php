<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCompany;
use App\Http\Controllers\Controller;
use App\Services\Company\CompanyService;
// use App\Http\Requests\CompanyRequest;
// use App\Services\CompanyService;

class CompanyController extends Controller
{ 
	protected $companyService;

	public function __construct(CompanyService $companyService)
	{
		$this->companyService = $companyService;
    $this->middleware('auth:api');
	}
    // public function index(){
       
    // $posts = $this->companyservice->index();
     
    // return view('index', compact('posts'));
    // }

    public function create(CreateCompany $request)
    {
      $validated = $request->validated();
      
      return $this->companyService->create($validated, $request);
    }

    // public function read($id)
    // {
       
    //    $post = $this->companyservice->read($id);

    //    return view('edit', compact('post'));

    // }

    public function update(CreateCompany $request, $id)
    {
     $validated = $request->validated();
     $this->companyService->update($validated, $id, $request);

     return 'Company has been updated succesfully';
    }

    public function paginate()
    {
     return $this->companyService->paginate();
    }

    public function delete($id)
    {
     $this->companyService->delete($id);
     return 'Deleted successfully';
    }
}
