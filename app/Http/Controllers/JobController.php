<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobCreateRequest;
use App\Models\Job;
use Inertia\Inertia;

class JobController extends Controller
{
    public function index()
    {
        return Inertia::render('Job/Index', [
            'jobs' => Job::orderBy('created_at', 'desc')->paginate(2),
            'page' => request('page')
        ]);
    }

    public function create()
    {
        $this->authorize('create', Job::class);

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
