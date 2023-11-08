<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCreateRequest;
use App\Models\Job;
use Inertia\Inertia;

class JobController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard', [
            'jobs' => Job::orderBy('created_at', 'desc')->paginate(3),
        ]);
    }

    public function create()
    {
        return Inertia::render('Job/Create', [
            'status' => session('status'),
            'profileIncomplete' => empty($user->profile),
        ]);
    }

    public function store(JobCreateRequest $request)
    {
        $company = auth()->user()->profile->company;

        $company->jobs()->create(
            $request->validated()
        );
    }
}
