<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Models\Company;

class CompanyController extends Controller
{
    public function __invoke(CompanyCreateRequest $request)
    {
        $company = Company::create($request->validated());

        $profile = auth()->user()->profile;

        $profile->company()->associate($company)->save();

        return to_route('profile.edit');
    }
}
