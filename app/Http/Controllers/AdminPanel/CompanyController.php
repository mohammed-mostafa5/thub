<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Requests\AdminPanel\CreateCompanyRequest;
use App\Http\Requests\AdminPanel\UpdateCompanyRequest;
use App\Repositories\AdminPanel\CompanyRepository;
use App\Http\Controllers\AppBaseController;
use App\Models\Company;
use Illuminate\Http\Request;
use Flash;
use Response;

class CompanyController extends AppBaseController
{
    /** @var  CompanyRepository */
    private $companyRepository;

    public function __construct(CompanyRepository $companyRepo)
    {
        $this->companyRepository = $companyRepo;
    }

    /**
     * Display a listing of the Company.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $companies = $this->companyRepository->all();

        return view('adminPanel.companies.index')
            ->with('companies', $companies);
    }

    public function show($id)
    {
        $company = $this->companyRepository->find($id);

        if (empty($company)) {
            Flash::error(__('messages.not_found', ['model' => __('models/companies.singular')]));

            return redirect(route('adminPanel.companies.index'));
        }

        return view('adminPanel.companies.show')->with('company', $company);
    }

    public function approve(Company $company)
    {
        $company->update(['status' => 2]);

        return back();
    }

    public function reject(Company $company)
    {
        $company->update(['status' => 3]);

        return back();
    }

    public function deactivate(Company $company)
    {
        $company->update(['status' => 4]);

        return back();
    }
}
