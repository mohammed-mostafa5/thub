<?php

namespace App\Http\Controllers\API;

use App\Models\Company;
use App\Http\Controllers\Controller;
class MainController extends Controller
{

    public function profile(Company $company) {

        return response()->json(['company'=>$company],200);
    }

    public function setting(Company $company) {
        return response()->json(['company'=>$company],200);
    }

    public function update(Company $company) {
        $inputs=$request->validate(Company::$rules);
        $inputs['status'] = $company->status == 2 ? 0 : $company->status;
        $company->updated($inputs);
        return response()->json(['company'=>$company],200);
    }

}
