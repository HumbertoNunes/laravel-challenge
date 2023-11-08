<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyCreateRequest;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{
    public function __invoke(CompanyCreateRequest $request)
    {
        DB::BeginTransaction();

        $company = Company::create($request->validated());

        $profile = auth()->user()->profile;

        $profile->company()->associate($company)->save();

        DB::commit();

        return to_route('profile.edit');
    }
}
