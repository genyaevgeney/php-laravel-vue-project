<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCompany;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use App\Services\Company\CompanyService;

class CompanyController extends Controller
{
    protected $companyService;

    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
        $this->middleware('auth:api');
    }

    public function index()
    {
        //
    }

    public function store(CreateCompany $request)
    {
        $validated = $request->validated();

        return $this->companyService->create($validated, $request);
    }

    public function show($id)
    {
        return $this->companyService->paginate();
    }

    public function update(Request $request, $id)
    {
        if ($request->logo) {
            $validated = $request->validate(
                [
          'name' => [
            'min:3',
            'max:255',
            'required',
            Rule::unique('companies')->ignore($id),
          ],
          'email' => 'required|email|max:255',
          'website' => 'required|url',
          'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]
            );
        }
        $validated = $request->validate(
            [
        'name' => [
          'min:3',
          'max:255',
          'required',
          Rule::unique('companies')->ignore($id),
        ],
        'email' => 'required|email|max:255',
        'website' => 'required|url',
      ]
        );
        $this->companyService->update($validated, $id, $request);

        return 'Company has been updated succesfully';
    }

    public function destroy($id)
    {
        $this->companyService->delete($id);
        return 'Deleted successfully';
    }
}
