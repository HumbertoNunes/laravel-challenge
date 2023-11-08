<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;

class EmployeeController extends Controller
{
    public function store(EmployeeCreateRequest $request)
    {
        auth()->user()->addProfile(
            Employee::create($request->validated())
        );

        return to_route('profile.edit');
    }

    public function update(EmployeeUpdateRequest $request)
    {
        $profile = auth()->user()->profile;

        $profile->fill($request->only(['position']))->save();

        return to_route('profile.edit');
    }
}
